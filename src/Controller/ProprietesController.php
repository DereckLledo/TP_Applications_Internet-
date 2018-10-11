<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\Query;
use Cake\ORM\TableRegistry;

/**
 * Proprietes Controller
 *
 * @property \App\Model\Table\ProprietesTable $Proprietes
 *
 * @method \App\Model\Entity\Propriete[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ProprietesController extends AppController {

    public function initialize() {
        parent::initialize();
        $this->Auth->allow(['tags', 'index', 'view']);
    }

    public function isAuthorized($user) {

        $action = $this->request->getParam('action');

        //si super-admin il peut tout faire
        if ($user['type'] == '1') {
            return true;
        }
        if ($user['type'] == '0') {

            //un user peut ajouter une nouvelle propriete
            if (in_array($action, ['add'])) {
                return true;
            }

            if (in_array($action, ['edit', 'delete'])) {
                $id = $this->request->getParam('pass.0');

                if (!$id) {
                    $this->Flash->error(__('Lien incomplet'));
                    return false;
                }

                $propriete = $this->Proprietes->findById($id)->first();

                //on doit verifier qu'on est le user qui à ajouter le Vendeur à qui appartient la propriete
                $vendeur = $this->Proprietes->Vendeurs->findById($propriete['vendeur_id'])->first();
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
            'contain' => ['Vendeurs']
        ];
        $proprietes = $this->paginate($this->Proprietes);



        $this->set(compact('proprietes'));
    }

    /**
     * View method
     *
     * @param string|null $id Propriete id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null) {
        $propriete = $this->Proprietes->get($id, [
            'contain' => ['Vendeurs', 'Tags', 'Files']
        ]);


        $this->set('propriete', $propriete);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $propriete = $this->Proprietes->newEntity();
        if ($this->request->is('post')) {
            $propriete = $this->Proprietes->patchEntity($propriete, $this->request->getData());
            
            if (!$propriete['vendeur_id']){
                $this->Flash->error(__('You need to add a seller before adding a property'));
                return $this->redirect(['action' => 'add']);
            }
           
            if ($this->Proprietes->save($propriete)) {
                $this->Flash->success(__('The propriete has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The propriete could not be saved. Please, try again.'));
        }


        $user = $this->Auth->user();
        
        //on affiche seulement les vendeurs qui ont été ajouter par le user connecté
        $vendeurs = $this->Proprietes->Vendeurs->find('list', ['limit' => 200])->where(['Vendeurs.user_id' => $user['id']  ]);
        //on va chercher les tags
        $tags = $this->Proprietes->Tags->find('list', ['limit' => 200]);
        $files = $this->Proprietes->Files->find('list', ['limit' => 200]);

        //on passe les tags à la vue
        $this->set(compact('propriete', 'users', 'tags', 'vendeurs', 'files'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Propriete id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        $propriete = $this->Proprietes->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $propriete = $this->Proprietes->patchEntity($propriete, $this->request->getData());
            if ($this->Proprietes->save($propriete)) {
                $this->Flash->success(__('The propriete has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The propriete could not be saved. Please, try again.'));
        }
        $vendeurs = $this->Proprietes->Vendeurs->find('list', ['limit' => 200]);

        // Récupère une liste des tags.
        $tags = $this->Proprietes->Tags->find('list');

        // Passe les tags au context de la view
        $this->set('tags', $tags);


        $this->set(compact('propriete', 'vendeurs'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Propriete id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null) {
        $this->request->allowMethod(['post', 'delete']);
        $propriete = $this->Proprietes->get($id);
        if ($this->Proprietes->delete($propriete)) {
            $this->Flash->success(__('The propriete has been deleted.'));
        } else {
            $this->Flash->error(__('The propriete could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function tags() {
        // The 'pass' key is provided by CakePHP and contains all
        // the passed URL path segments in the request.
        $tags = $this->request->getParam('pass');

        // Use the ArticlesTable to find tagged articles.
        $proprietes = $this->Proprietes->find('tagged', [
            'tags' => $tags
        ]);

        // Pass variables into the view template context.
        $this->set([
            'proprietes' => $proprietes,
            'tags' => $tags
        ]);
    }

}
