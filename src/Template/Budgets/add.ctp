<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Budget $budget
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Budgets'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="budgets form large-9 medium-8 columns content">
    <?= $this->Form->create($budget) ?>
    <fieldset>
        <legend><?= __('Add Budget') ?></legend>
        <?php
            echo $this->Form->control('fiscal_year');
            echo $this->Form->control('budget_date_begin');
            echo $this->Form->control('budget_date_end');
            echo $this->Form->control('total_budget');
            echo $this->Form->control('budget_per_person');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
