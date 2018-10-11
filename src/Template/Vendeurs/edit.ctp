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
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $vendeur->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $vendeur->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Vendeurs'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Proprietes'), ['controller' => 'Proprietes', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Propriete'), ['controller' => 'Proprietes', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="vendeurs form large-9 medium-8 columns content">
    <?= $this->Form->create($vendeur) ?>
    <fieldset>
        <legend><?= __('Edit Vendeur') ?></legend>
        <?php
            echo $this->Form->control('nom');
            echo $this->Form->control('prenom');
            echo $this->Form->control('phone');
            echo $this->Form->control('email');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
