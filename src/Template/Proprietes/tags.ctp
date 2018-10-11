<h1>
    Proprietes tagged with
    <?= $this->Text->toList(h($tags), 'or') ?>
</h1>

<section>
<?php foreach ($proprietes as $propriete): ?>
    <article>
        <!-- Use the HtmlHelper to create a link -->
        <h4><?= $this->Html->link(
            $propriete->adresse,
            ['controller' => 'Proprietes', 'action' => 'view', $propriete->id]
        ) ?></h4>
        <span><?= h($propriete->created) ?>
    </article>
<?php endforeach; ?>
</section>