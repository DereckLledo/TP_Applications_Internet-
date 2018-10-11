<?php

$this->titre = 'A propos'; ?>


<p> 
    Dereck Lledo <br />
    420-5b7 MO Applications Internet <br />
    Automne 2018, Collège Montmorency <br /> <br /> <br />

<h1>Comptes à utiliser</h1>

<table>
    <tr>
        <th>TYPE DE COMPTE</th>
        <th>LOGIN</th>
        <th>PASSWORD</th>
    </tr>
    <tr>
        <td>Admin</td>
        <td>admin@admin.com</td>
        <td>admin</td>
    </tr>
    <tr>
        <td>Utilisateur-CONFIRMÉ</td>
        <td>test@test.com</td>
        <td>test</td>
    </tr>
        <tr>
        <td>Utilisateur-SANS_CONFIRMATION</td>
        <td>notRegister@test.com</td>
        <td>test</td>
    </tr>
</table>

<font color="red"><b>Pour ajouter un nouveau admin, il faut modifier le "Type" du user à partir de la base de données et y mettre "1"</b></font>

<h1>Fonctionnement du site web</h1>

<h3>Utilisateurs</h3>
<ul>
    <ol>Visiteurs : Les visiteurs on seulement accès à l'index des propriétés mais ne peuvent pas modifier, ajouter, etc.</ol>
    <ol>NON-confirmé : Les utilisateurs doivent aller sur le lien envoyer en email pour confirmer leur inscription sinon ils n'ont pas beaucou de droits.</ol>
    <ol>Confirmé : Les utilisateurs qui auront confirmé leur inscription pourront ajouter des vendeurs, proprietes, etc. Ils peuvent aussi modifier et effacer leur propres données </ol>
    <ol>ADMIN : Les admins sont les seul qui ont le droit de tout modifier/effacer/ajouter. Ils sont aussi les seuls qui ont le droit de modifier la table "Users"</ol>                   
</ul>

<h3>Comment ajouter une propriété</h3>
<ul>
    <ol>Pour ajouter une propriété, l'utilisateur doit avoir confirmer son compte grâce au lien qu'il a reçu par courriel.<br/>	
        Il doit ensuite avoir au moins un vendeur de disponible. Sans vendeur relié a son ID_USER, il sera impossible d'ajouter une propriété.<br/>	
        Lorsqu'un vendeur est créer, l'utilisateur peut ensuite ajouter une propriétée.</ol><br/>	<br/>	
</ul>



<h1>Diagramme de la base de données actuelle utilisée par mon application :</h1> <br/>	
		<?=$this->Html->image("uploads/files/relations.PNG", ['fullBase' => true,'alt' => 'image']) ?><br /><br />
Diagramme original à partir duquel ma BD a été conçue :<br/><br/>
                <?=$this->Html->image("uploads/files/databaseanswers.png", ['fullBase' => true,'alt' => 'image']) ?><br /><br />


Lien vers l'emplacement du diagramme original :
<a href="http://www.databaseanswers.org/data_models/real_estate_agent/index.htm"> www.databaseanswers.org - Real Estate agent </a> <br />
</p>
