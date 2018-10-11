<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Vendeur[]|\Cake\Collection\CollectionInterface $vendeurs
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
        <li><?= $this->Html->link(__('New Vendeur'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Proprietes'), ['controller' => 'Proprietes', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Propriete'), ['controller' => 'Proprietes', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="vendeurs index large-9 medium-8 columns content">
    <h3><?= __('Vendeurs') ?></h3>
     <?php $loguser = $this->request->getSession()->read('Auth.User');?>
    
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>

                <th scope="col"><?= $this->Paginator->sort('nom') ?></th>
                <th scope="col"><?= $this->Paginator->sort('prenom') ?></th>
                <th scope="col"><?= $this->Paginator->sort('phone') ?></th>
                <th scope="col"><?= $this->Paginator->sort('email') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
              <?php if($loguser) : ?>
                <th scope='col' class='actions'><?= __('Actions')?></th>
              <?php endif; ?>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($vendeurs as $vendeur): ?>
            <tr>
                <td><?= h($vendeur->nom) ?></td>
                <td><?= h($vendeur->prenom) ?></td>
                <td><?= h($vendeur->phone) ?></td>
                <td><?= h($vendeur->email) ?></td>
                <td><?= h($vendeur->created) ?></td>
                <td><?= h($vendeur->modified) ?></td>
                <?php if($loguser) : ?>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $vendeur->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $vendeur->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $vendeur->id], ['confirm' => __('Are you sure you want to delete # {0}?', $vendeur->id)]) ?>
                </td>
                <?php endif; ?>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
