<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Article $article
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Article'), ['action' => 'edit', $article->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Article'), ['action' => 'delete', $article->id], ['confirm' => __('Are you sure you want to delete # {0}?', $article->id)]) ?> </li>
        <li><?= $this->Html->link(__('Go Back'), ['controller' => 'articles', 'action' => 'index']) ?></li>

    </ul>
</nav>
<div class="articles view large-9 medium-8 columns content">
    <h3><?= h($article->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Request') ?></th>
            <td><?= $article->has('request') ? $this->Html->link($article->request->id, ['controller' => 'Requests', 'action' => 'view', $article->request->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($article->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Publication Date') ?></th>
            <td><?= h($article->publication_date) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Article Url') ?></h4>
        <?= $this->Text->autoParagraph(h($article->article_url)); ?>
    </div>
    <div class="row">
        <h4><?= __('Dscholarship Archive') ?></h4>
        <?= $this->Text->autoParagraph(h($article->dscholarship_archive)); ?>
    </div>
</div>
