<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Budget[]|\Cake\Collection\CollectionInterface $budgets
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Budget'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="budgets index large-9 medium-8 columns content">
    <h3><?= __('Budgets') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('fiscal_year') ?></th>
                <th scope="col"><?= $this->Paginator->sort('budget_date_begin') ?></th>
                <th scope="col"><?= $this->Paginator->sort('budget_date_end') ?></th>
                <th scope="col"><?= $this->Paginator->sort('total_budget') ?></th>
                <th scope="col"><?= $this->Paginator->sort('approved_amount') ?></th>
                <th scope="col"><?= $this->Paginator->sort('budget_per_person') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php
            $i=0;
            foreach ($budgets as $budget): ?>

            <tr>
                <td><?= h($budget->fiscal_year) ?></td>
                <td><?= h($budget->budget_date_begin) ?></td>
                <td><?= h($budget->budget_date_end) ?></td>
                <td><?= $this->Number->format($budget->total_budget) ?></td>
                <td><?= $this->Number->format($budget->sum_amtreqt) ?></td>
                <td><?= $this->Number->format($budget->budget_per_person) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $budget->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $budget->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $budget->id], ['confirm' => __('Are you sure you want to delete # {0}?', $budget->id)]) ?>
                </td>
            </tr>
            <?php $i= $i+1; ?>
            <?php endforeach; ?>
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
