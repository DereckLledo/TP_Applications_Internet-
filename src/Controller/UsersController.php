<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Utility\Text;
use App\Controller\EmailsController;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 *
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsersController extends AppController {

    public function initialize() {
        parent::initialize();
        $this->Auth->allow(['logout', 'verifyCode', 'confirmer', 'renvoyer', 'add']);
    }

    public function isAuthorized($user) {
        $action = $this->request->getParam('action');

        //si super-admin il peut tout faire
        if ($user['type'] == '1') {
            return true;
        }

        if ($user['type'] == '0') {
            // Les usagers normaux ont le droit de view et edit leur propres profiles
            if (in_array($action, ['view', 'edit'])) {

                // All other actions require a slug.
                $id = $this->request->getParam('pass.0');
                if (!$id) {
                    $this->Flash->error(__('Lien incomplet'));
                    return false;
                }
                if ($user['id'] != $id) {
                    $this->Flash->error(__('Vous n\'avez pas le droit d\'afficher les informations d\'un autre usager.'));
                    return false;
                }
                // Check that the user they want to view/edit is the current user
                $leUser = $this->Users->findById($id)->first();
                return $leUser->id === $user['id'];
            }
        }
        //pas le droit si ce n'est pas un user confirmé ou qu'il n'est pas un admin
        $this->Flash->error(__('Vous n\'avez pas le droit d\'afficher les users'));
        return $this->redirect(['controller' => 'Proprietes', 'action' => 'index']);
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index() {
        $users = $this->paginate($this->Users);

        $this->set(compact('users'));
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null) {
        $user = $this->Users->get($id, [
            'contain' => []
        ]);

        $this->set('user', $user);
    }

    public function confirmLink($user) {
        $newUser = $user;
        $email = new EmailsController();
        $email->confirmLink($newUser);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());

            //on crée un code de confirmation qu'on insere dans le TYPE
            $code = Text::uuid();
            $user->type = $code;

            if ($this->Users->save($user)) {

                $this->confirmLink($user);

                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'login']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        $user = $this->Users->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null) {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    // verifie le code pour changer le type -> si il n'y a pas de type, on met automatiquement '20' dans type ce qui va faire une erreur
    public function verifyCode($type = 20) {
        //code pour confirmer son compte
        if ($id_user = $this->Users->find()->select(['id'])->where(['type' => $type])->first()) {
            $user = $this->Users->get($id_user['id']);

            if ($user->type == $type) {

                //on affecte le type a 0, donc il est considérer comme un compte vendeur et confirmé
                $user->type = '0';
                if ($this->Users->save($user)) {
                    $this->Auth->setUser($user);
                    $this->Flash->success(__('Votre compte est maintenant confirmé'));
                    $this->logout();
                } else {
                    $this->Flash->error(__('ERREUR dans le code de confirmation'));
                }
            }
        } else {
            $this->Flash->error(__('ERREUR il n\'y a pas de compte valide avec le code de confirmation'));
            return $this->redirect(['action' => 'login']);
        }
    }

    public function renvoyer() {

        $user = $this->Auth->user();
        $id = $user['id'];
        $user = $this->Users->get($id);

        if ($id != null) {
            $user = $this->Users->get($id);
            $this->confirmLink($user);
            $this->Flash->success(__('Lien de confirmation à été envoyer'));
            return $this->redirect(['controller' => 'Proprietes', 'action' => 'index']);
        } else {
            return $this->redirect(['action' => 'login']);
        }
    }

    public function login() {
        if ($this->request->is('post')) {
            $user = $this->Auth->identify();
            if ($user) {
                $this->Auth->setUser($user);
                if ($user['type'] == '0' || $user['type'] == '1') {
                    return $this->redirect(['controller' => 'Proprietes', 'action' => 'index']);
                } else {
                    return $this->redirect(['action' => 'confirmer']);
                }
                return $this->redirect($this->Auth->redirectUrl());
            }
            $this->Flash->error('Votre identifiant ou votre mot de passe est incorrect.');
        }
    }

    public function confirmer() {
        $user = $this->Auth->user();
        $id_user = $user['id'];
        $user = $this->Users->get($id_user);
        $this->set('user', $user);
    }

    public function logout() {
        $this->Flash->success('Vous avez été déconnecté.');
        return $this->redirect($this->Auth->logout());
    }

}
