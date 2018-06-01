<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\DenialReason $denialReason
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Denial Reason'), ['action' => 'edit', $denialReason->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Denial Reason'), ['action' => 'delete', $denialReason->id], ['confirm' => __('Are you sure you want to delete # {0}?', $denialReason->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Denial Reasons'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Denial Reason'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="denialReasons view large-9 medium-8 columns content">
    <h3><?= h($denialReason->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Denial Reason') ?></th>
            <td><?= h($denialReason->denial_reason) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($denialReason->id) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Denial Email') ?></h4>
        <?= $denialReason->denial_email ?>
    </div>
</div>
