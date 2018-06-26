<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\DenialReason $denialReason
 */
?>
<script src='http://code.jquery.com/jquery-1.11.0.min.js'></script>
<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
  <script>
   tinymce.init({ selector:'.edittextarea', height: 500,  plugins: [
    'advlist autolink lists link print preview anchor',
    'insertdatetime table contextmenu paste code'
   ], });
 </script>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Denial Reasons'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="denialReasons form large-9 medium-8 columns content">
    <?= $this->Form->create($denialReason) ?>
    <fieldset>
        <legend><?= __('Edit Denial Reason') ?></legend>
        <?php
            echo $this->Form->control('denial_reason');
            echo $this->Form->input('denial_email', array('type' => 'textarea','class' => 'edittextarea form-control','label' => 'Content :'));
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
<script type="text/javascript">
       var mytextbox = document.getElementById('denial-email');
    
</script>    
