<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Vendeur $vendeur
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        
         <li class="heading"><?= __('Menu') ?></li>
        <li><?= $this->Html->link(__('List Proprietes'), ['controller' => 'Proprietes', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('List Vendeurs'), ['controller' => 'Vendeurs', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('List Tags'), ['controller' => 'Tags', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('List Files'), ['controller' => 'Files', 'action' => 'index']) ?> </li>
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Vendeur'), ['action' => 'edit', $vendeur->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Vendeur'), ['action' => 'delete', $vendeur->id], ['confirm' => __('Are you sure you want to delete # {0}?', $vendeur->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Vendeurs'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Vendeur'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Proprietes'), ['controller' => 'Proprietes', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Propriete'), ['controller' => 'Proprietes', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="vendeurs view large-9 medium-8 columns content">
    <table class="vertical-table">

        <tr>
            <th scope="row"><?= __('Nom') ?></th>
            <td><?= h($vendeur->nom) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Prenom') ?></th>
            <td><?= h($vendeur->prenom) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Phone') ?></th>
            <td><?= h($vendeur->phone) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Email') ?></th>
            <td><?= h($vendeur->email) ?></td>
        </tr>

        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($vendeur->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($vendeur->modified) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Proprietes') ?></h4>
        <?php if (!empty($vendeur->proprietes)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
               
                <th scope="col"><?= __('Adresse') ?></th>
                <th scope="col"><?= __('Prix') ?></th>
                <th scope="col"><?= __('Description') ?></th>
                
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                
                
            </tr>
            <?php foreach ($vendeur->proprietes as $proprietes): ?>
            <tr>
               
                <td><?= h($proprietes->adresse) ?></td>
                <td><?= h($proprietes->prix) ?></td>
                <td><?= h($proprietes->description) ?></td>
           
                <td><?= h($proprietes->created) ?></td>
                <td><?= h($proprietes->modified) ?></td>
             
            
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
