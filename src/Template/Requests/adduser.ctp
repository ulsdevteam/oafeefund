<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Request $request
 */
?>
<!--<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?=  __('Actions') ?></li>
        <li><?php //$this->Html->link(__('List Requests'), ['action' => 'index']) ?></li>
        <li><?php //$this->Html->link(__('List Denial Reasons'), ['controller' => 'DenialReasons', 'action' => 'index']) ?></li>
        <li><?php //$this->Html->link(__('New Denial Reason'), ['controller' => 'DenialReasons', 'action' => 'add']) ?></li>
        <li><?php //$this->Html->link(__('List Articles'), ['controller' => 'Articles', 'action' => 'index']) ?></li>
        <li><?php //$this->Html->link(__('New Article'), ['controller' => 'Articles', 'action' => 'add']) ?></li>
        <li><?php //$this->Html->link(__('List Transactions'), ['controller' => 'Transactions', 'action' => 'index']) ?></li>
        <li><?php //$this->Html->link(__('New Transaction'), ['controller' => 'Transactions', 'action' => 'add']) ?></li>
    </ul>
</nav> -->
<div class="requests form large-9 medium-8 columns content">
    <?= $this->Form->create($request) ?>
    <fieldset>
        <legend><?= __('OAPPP funding') ?></legend>
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
          //echo $this->Form->hidden('inquiry_date');
            ;
            $attributes = array();
            $foo= 'student';
            echo nl2br ("Author Status* \n");
            $options = array('student' => 'Student', 'professor' => 'Professor', 'post-Doc' => 'Post-Doc', 'staff' => 'Staff' );
            //$attributes= $this->Form->control('author_status');

            echo $this->Form->radio('author_status', $options, $attributes); 
            echo $this->Form->hidden('bmc');
            echo $this->Form->hidden('hs');
            echo $this->Form->hidden('funded');
            echo $this->Form->hidden('denial_id', ['options' => $denialReasons, 'empty' => true]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>

