<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Budget $budget
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Budget'), ['action' => 'edit', $budget->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Budget'), ['action' => 'delete', $budget->id], ['confirm' => __('Are you sure you want to delete # {0}?', $budget->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Budgets'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Budget'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="budgets view large-9 medium-8 columns content">
    <h3><?= h($budget->fiscal_year) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Total Budget') ?></th>
            <td><?= $this->Number->format($budget->total_budget) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Budget Per Person') ?></th>
            <td><?= $this->Number->format($budget->budget_per_person) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Budget Date Begin') ?></th>
            <td><?= h($budget->budget_date_begin) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Budget Date End') ?></th>
            <td><?= h($budget->budget_date_end) ?></td>
        </tr>
    </table>
</div>
