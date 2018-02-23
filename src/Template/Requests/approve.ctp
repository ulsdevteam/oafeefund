<?php
$this->assign('title', __('Send mail to Author for Approval.'));
?>
<?php echo $this->Html->css('forms'); ?>

<?= $this->Html->script(array('http://code.jquery.com/jquery-1.11.0.min.js')); ?>                                                             >

<?= $this->fetch('script'); ?>
<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
  <script>
   tinymce.init({ selector:'.edittextarea', height: 500,  plugins: [
    'advlist autolink lists link print preview anchor',
    'insertdatetime table contextmenu paste code'
   ], });
 </script>

<div class="MailForm">
<?php echo $this->Form->create(); ?>
        <fieldset>
                <legend><?php echo $this->fetch('title'); ?></legend>
        <?php
                echo h($results-> first_name);
                echo h($results-> last_name);
                echo h($results-> email);
                echo $this->Form->input('to');
                echo $this->Form->input('from_name');
                echo $this->Form->input('from_addr', array('label' => 'From Address'));
                echo $this->Form->input('subject');
                ?>
                <?php
                //$this->Froala->plugin();
                //$this->Froala->editor('#message-body'); // J
                echo $this->Form->select(
                    'field',
                    ['empty' => '(choose one)']
                );
                echo $this->Form->input('Message_Body', array('type' => 'textarea','class' => 'edittextarea form-control','label' => 'Content :'));
        ?>
        </fieldset>
<?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
