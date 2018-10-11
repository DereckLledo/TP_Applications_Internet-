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
        <li><?= $this->Html->link(__('Edit Propriete'), ['action' => 'edit', $propriete->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Propriete'), ['action' => 'delete', $propriete->id], ['confirm' => __('Are you sure you want to delete # {0}?', $propriete->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Proprietes'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Propriete'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Vendeurs'), ['controller' => 'Vendeurs', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Vendeur'), ['controller' => 'Vendeurs', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="proprietes view large-9 medium-8 columns content">
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Vendeur') ?></th>
            <td><?= $propriete->has('vendeur') ? $this->Html->link($propriete->vendeur->prenom.' '.$propriete->vendeur->nom, ['controller' => 'Vendeurs', 'action' => 'view', $propriete->vendeur->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Adresse') ?></th>
            <td><?= h($propriete->adresse) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Prix') ?></th>
            <td><?= h($propriete->prix) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($propriete->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($propriete->modified) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Description') ?></h4>
        <?= $this->Text->autoParagraph(h($propriete->description)); ?>
    </div>
    <div class="related">
        <h4><?= __('Related Tags') ?></h4>
        <?php if (!empty($propriete->tags)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Title') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
            </tr>
                <?php foreach ($propriete->tags as $tags): ?>
            <tr>
                <td><?= h($tags->title) ?></td>
                <td><?= h($tags->created) ?></td>
                <td><?= h($tags->modified) ?></td>
  
            </tr>
                <?php endforeach; ?>
             <?php endif; ?>
        </table>
 </div>
    <div class="related">
        <h4><?= __('Related Files') ?></h4>
        <?php if (!empty($propriete->files)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Name') ?></th>
                <th scope="col"><?= __('Path') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
            </tr>
                <?php foreach ($propriete->files as $files): ?>
            <tr>
                <td><?= h($files->name) ?></td>
                <td><?= h($files->path) ?></td>
                <td><?= h($files->created) ?></td>
                <td><?= h($files->modified) ?></td>
                <td><?=$this->Html->image($files->path.$files->name, ['fullBase' => true,'alt' => 'image']) ?></td>
            </tr>
                <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>    


    </div>
