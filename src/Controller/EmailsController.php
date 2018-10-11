<?php
   namespace App\Controller;
   use App\Controller\AppController;
   use Cake\Mailer\Email;

   class EmailsController extends AppController{
      
       public function index(){

      }
      
      public function confirmLink($user){
          $courriel = $user['email'];
          $confirmCode = $user['type'];
          $email = new Email('default');
          $message = "<html>"
                  . "<head>"
                  . "<title>Inscription TP_DereckLledo</title>"
                  . "</head>"
                  . "<body>"
                  . "<p>Bienvenue ".$user['username']."</p>"
                  . "<p>Veuillez confirmer votre inscription sur ce lien.</p>"
                  . "<a href='http://localhost/TP_DereckLledo/users/verifyCode/$confirmCode'>Cliquez pour confirmer votre inscription</a>";
                  
          $email->to($courriel)->subject('Inscription TP')->send($message);
      }
   }
?>

