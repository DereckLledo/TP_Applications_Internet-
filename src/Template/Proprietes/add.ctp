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
        <li><?= $this->Html->link(__('List Proprietes'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Vendeurs'), ['controller' => 'Vendeurs', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Vendeur'), ['controller' => 'Vendeurs', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="proprietes form large-9 medium-8 columns content">
    <?= $this->Form->create($propriete) ?>
    <fieldset>
        <legend><?= __('Add Propriete') ?></legend>
        <?php
            echo "<p style='Color:red'>".h(__('Make sure to have a seller before adding a property'))."</p>";
            echo $this->Form->control('vendeur_id', ['options'=> $vendeurs]);
            echo $this->Form->control('adresse');
            echo $this->Form->control('prix');
            echo $this->Form->control('description');
            echo $this->Form->control('tags._ids', ['options' => $tags]);
            echo $this->Form->control('files._ids', ['options' => $files]);
        ?>
    </fieldset> 
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
