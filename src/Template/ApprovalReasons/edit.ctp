<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ApprovalReason $approvalReason
 */
?>
<script src="/js/tinymce/js/tinymce/tinymce.min.js"></script>
<script src='http://code.jquery.com/jquery-1.11.0.min.js'></script>
<script>
    tinymce.init({ selector:'.edittextarea', height: 500,  plugins: [
        'advlist autolink lists link print preview anchor',
        'insertdatetime table paste code'
    ], });
</script>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $approvalReason->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $approvalReason->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Approval Reasons'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="approvalReasons form large-9 medium-8 columns content">
    <?= $this->Form->create($approvalReason) ?>
    <fieldset>
        <legend><?= __('Edit Approval Reason') ?></legend>
        <?php
            echo $this->Form->control('approval_reason');
            echo $this->Form->input('approval_email', array('type' => 'textarea','class' => 'edittextarea form-control','label' => 'Content :'));
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
