<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<p>VOUS DEVEZ CONFIRMER VOTRE COMPTE POUR BIEN UTILISER LE SITE WEB</p>
<div>
    </br>
    	<?php 
	echo $this->Form->postButton('Send the confirmation email', ['controller' => 'Users', 'action' => 'renvoyer', $user['id']]);
	echo "</fieldset><fieldset>";
	echo $this->Form->postButton('Continue', ['controller' => 'Proprietes', 'action' => 'index']);
	?>
</div>