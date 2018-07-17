<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\DenialReason[]|\Cake\Collection\CollectionInterface $denialReasons
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Denial Reason'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="denialReasons index large-9 medium-8 columns content">
    <h3><?= __('Denial Reasons') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('denial_reason') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($denialReasons as $denialReason): ?>
            <tr>
                <td><?= h($denialReason->denial_reason) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $denialReason->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $denialReason->id]) ?>
                </td>
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
