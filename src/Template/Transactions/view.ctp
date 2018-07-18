<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Transaction $transaction
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(__('Delete Transaction'), ['action' => 'delete', $transaction->id], ['confirm' => __('Are you sure you want to delete # {0}?', $transaction->id)]) ?> </li>
        <li><?= $this->Html->link(__('Go Back'), ['action' => 'index']) ?> </li>
    </ul>
</nav>
<div class="transactions view large-9 medium-8 columns content">
    <h3><?= "Username: ".h($transaction->request->username) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Request') ?></th>
            <td><?= $transaction->has('request') ? $this->Html->link($transaction->request->author_name, ['controller' => 'Requests', 'action' => 'view', $transaction->request->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Amount Paid') ?></th>
            <td><?= $this->Number->format($transaction->amount_paid) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Cheque Number') ?></th>
            <td><?= $this->Number->format($transaction->cheque_number) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Date Paid') ?></th>
            <td><?= h($transaction->date_paid) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Date Completed') ?></th>
            <td><?= h($transaction->date_completed) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Description') ?></h4>
        <?= $this->Text->autoParagraph(h($transaction->description)); ?>
    </div>
</div>
