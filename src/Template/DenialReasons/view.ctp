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
        <li><?= $this->Html->link(__('List Denial Reasons'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Denial Reason'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="denialReasons view large-9 medium-8 columns content">
    <h3><?= h($denialReason->denial_reason).":" ?></h3>
    <div class="row">
        <h4><?= __('Denial Email') ?></h4>
        <?= $denialReason->denial_email ?>
    </div>
</div>
