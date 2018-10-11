<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Propriete $propriete
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
                ['action' => 'delete', $propriete->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $propriete->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Proprietes'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Vendeurs'), ['controller' => 'Vendeurs', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Vendeur'), ['controller' => 'Vendeurs', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="proprietes form large-9 medium-8 columns content">
    <?= $this->Form->create($propriete) ?>
    <fieldset>
        <legend><?= __('Edit Propriete') ?></legend>
        <?php
            echo $this->Form->control('adresse');
            echo $this->Form->control('prix');
            echo $this->Form->control('description');
            echo $this->Form->control('tags._ids', ['options' => $tags]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
