<?php
$this->assign('title', __('Send mail to Author for Approval.'));
?>
<?php echo $this->Html->css('forms'); ?>
<div class="MailForm">
<?php echo $this->Form->create(); ?>
        <fieldset>
                <legend><?php echo $this->fetch('title'); ?></legend>
        <?php
                echo $this->Form->input('name');
                echo $this->Form->input('from_name');
                echo $this->Form->input('from_addr', array('label' => 'From Address'));
                echo $this->Form->input('subject');
                ?>
                <label>Body</label>
                <?php
                echo $this->Form->textarea('body');
                echo $this->Form->input('reply_to');
        ?>
        </fieldset>
<?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
