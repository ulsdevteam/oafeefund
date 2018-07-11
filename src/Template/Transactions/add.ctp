<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Transaction $transaction
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Go back'), ['action' => 'index']) ?></li>
        <li><?php //$this->Html->link(__('List Requests'), ['controller' => 'Requests', 'action' => 'index']) ?></li>
        <li><?php //$this->Html->link(__('New Request'), ['controller' => 'Requests', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="transactions form large-9 medium-8 columns content">
    <?= $this->Form->create($transaction) ?>
    <fieldset>
        <legend><?= __('Add Transaction') ?></legend>
        <?php
            echo $this->Form->control('amount_paid');
            echo $this->Form->control('description');
            echo $this->Form->control('date_paid');
            echo $this->Form->control('date_completed');
            echo $this->Form->control('cheque_number');
            echo $this->Form->hidden('request_id', ['options' => $requests,'value'=> $id  ]);
            
           
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
    <div class="requests view large-9 medium-8 columns content">
    <h3><?= h($request->author_name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Username') ?></th>
            <td><?= h($request->username) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Email') ?></th>
            <td><?= h($request->email) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('School') ?></th>
            <td><?= h($request->school) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Department') ?></th>
            <td><?= h($request->department) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Publisher') ?></th>
            <td><?= h($request->publisher) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Author Status') ?></th>
            <td><?= h($request->author_status) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Bmc') ?></th>
            <td><?= h($request->bmc) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Hs') ?></th>
            <td><?= h($request->hs) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Funded') ?></th>
            <td><?= h($request->funded) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Denial Reason') ?></th>
            <td><?= $request->has('denial_reason') ? $this->Html->link($request->denial_reason->id, ['controller' => 'DenialReasons', 'action' => 'view', $request->denial_reason->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Amount Requested') ?></th>
            <td><?= $this->Number->format($request->amount_requested) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Inquiry Date') ?></th>
            <td><?= h($request->inquiry_date) ?></td>
        </tr>
    </table>
</div>
