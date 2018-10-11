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
class AproposController extends AppController {

    public function initialize() {
       parent::initialize();
       $this->Auth->allow(['index']); 
    }

    public function isAuthorized($user) {
        return true;
    }
    
    public function index(){
               
    }
}