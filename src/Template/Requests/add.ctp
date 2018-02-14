<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Request $request
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Requests'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Denial Reasons'), ['controller' => 'DenialReasons', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Denial Reason'), ['controller' => 'DenialReasons', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Articles'), ['controller' => 'Articles', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Article'), ['controller' => 'Articles', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Transactions'), ['controller' => 'Transactions', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Transaction'), ['controller' => 'Transactions', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="requests form large-9 medium-8 columns content">
    <?= $this->Form->create($request) ?>
    <fieldset>
        <legend><?= __('Add Request') ?></legend>
        <?php
            echo $this->Form->control('username');
            echo $this->Form->control('first_name');
            echo $this->Form->control('last_name');
            echo $this->Form->control('email');
            echo $this->Form->control('school');
            echo $this->Form->control('department');
            echo $this->Form->control('publisher');
            echo $this->Form->control('publication_name');
            echo $this->Form->control('amount_requested');
            echo $this->Form->control('article_title');
            echo $this->Form->control('inquiry_date');
            echo $this->Form->control('author_status');
            echo $this->Form->control('bmc');
            echo $this->Form->control('hs');
            echo $this->Form->control('funded');
            echo $this->Form->control('denial_id', ['options' => $denialReasons, 'empty' => true]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
