<?php

namespace App\Controller;

use Cake\Utility\Text;
use App\Controller\AppController;

/**
 * Vendeurs Controller
 *
 * @property \App\Model\Table\VendeursTable $Vendeurs
 *
 * @method \App\Model\Entity\Vendeur[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class VendeursController extends AppController {

    public function isAuthorized($user) {
        parent::isAuthorized($user);
        
        $action = $this->request->getParam('action');
        if ($user['type'] == '1') {
            return true;
        }
        if ($user['type'] == '0') {

            //un user peut ajouter un nouveau vendeur
            if (in_array($action, ['add', 'view', 'index'])) {
                return true;
            }

            if (in_array($action, ['edit', 'delete'])) {
                $id = $this->request->getParam('pass.0');

                if (!$id) {
                    $this->Flash->error(__('Lien incomplet'));
                    return false;
                }

                $vendeur = $this->Vendeurs->findById($id)->first();
                return $user['id'] === $vendeur['user_id'];
            }
        }
        return $this->redirect(['controller' => 'users', 'action' => 'confirmer']);
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index() {
        $this->paginate = [
            'contain' => ['Users']
        ];
        $vendeurs = $this->paginate($this->Vendeurs);

        $this->set(compact('vendeurs'));
    }

    /**
     * View method
     *
     * @param string|null $id Vendeur id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null) {
        $vendeur = $this->Vendeurs->get($id, [
            'contain' => ['Users', 'Proprietes']
        ]);

        $this->set('vendeur', $vendeur);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $vendeur = $this->Vendeurs->newEntity();
        if ($this->request->is('post')) {
            $vendeur = $this->Vendeurs->patchEntity($vendeur, $this->request->getData());


            $vendeur->user_id = $this->Auth->user('id');

            //on crée un code de confirmation qu'on insere dans le TYPE
            $slug = Text::uuid();
            $vendeur->slug = $slug;



            if ($this->Vendeurs->save($vendeur)) {
                $this->Flash->success(__('The vendeur has been saved.'));



                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The vendeur could not be saved. Please, try again.'));
        }
        $users = $this->Vendeurs->Users->find('list', ['limit' => 200]);
        $this->set(compact('vendeur', 'users'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Vendeur id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        $vendeur = $this->Vendeurs->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $vendeur = $this->Vendeurs->patchEntity($vendeur, $this->request->getData(), [
                //On empêche la modification du user_id
                'accessibleFields' => ['user_id' => false]
            ]);



            if ($this->Vendeurs->save($vendeur)) {
                $this->Flash->success(__('The vendeur has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The vendeur could not be saved. Please, try again.'));
        }
        $users = $this->Vendeurs->Users->find('list', ['limit' => 200]);
        $this->set(compact('vendeur', 'users'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Vendeur id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null) {
        $this->request->allowMethod(['post', 'delete']);
        $vendeur = $this->Vendeurs->get($id);
        if ($this->Vendeurs->delete($vendeur)) {
            $this->Flash->success(__('The vendeur has been deleted.'));
        } else {
            $this->Flash->error(__('The vendeur could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

}
