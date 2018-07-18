<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Article $article
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Go Back'), ['controller' => 'articles', 'action' => 'index']) ?></li>
    </ul>
</nav>
<div class="articles form large-9 medium-8 columns content">
    <?= $this->Form->create($article) ?>
    <fieldset>
        <legend><?= __('Add Article') ?></legend>
        <?php 
            echo $this->Form->hidden('request_id', ['options' => $requests,'value'=> $id ]);
            echo $this->Form->control('publication_date', ['empty' => true]);
            echo $this->Form->control('article_url', array('type' => 'url','placeholder'=> "http://example.com"));
            echo $this->Form->control('dscholarship_archive', array('type' => 'url','placeholder'=> "http://example.com"));
            echo $this->Form->control('doi', array('type' => 'url','placeholder'=> "https://example.com"));
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
