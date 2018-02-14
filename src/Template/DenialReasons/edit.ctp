<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\DenialReason $denialReason
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $denialReason->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $denialReason->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Denial Reasons'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="denialReasons form large-9 medium-8 columns content">
    <?= $this->Form->create($denialReason) ?>
    <fieldset>
        <legend><?= __('Edit Denial Reason') ?></legend>
        <?php
            echo $this->Form->control('denial_reason');
            echo $this->Form->control('denial_email');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
