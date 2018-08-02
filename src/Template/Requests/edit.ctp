<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Request $request
 */
?>

<div class="requests form large-9 medium-8 columns content">
    <?= $this->Form->create($request) ?>
    <fieldset>
        <legend><?= __('Edit Request') ?></legend>
        <?php
            echo $this->Form->control('username');
            echo $this->Form->control('author_name');
            echo $this->Form->control('email');
            echo $this->Form->control('school');
            echo $this->Form->control('department');
            echo $this->Form->control('publisher');
            echo $this->Form->control('publication_name');
            echo $this->Form->control('amount_requested');
            echo $this->Form->control('article_title');
            echo $this->Form->control('inquiry_date');
            echo $this->Form->control('author_status',['options'=> ['student' => 'Student', 'professor' => 'Professor', 'post-Doc' => 'Post-Doc', 'staff' => 'Staff'], 'empty'=> true]);
            echo $this->Form->control('bmc',['options'=> ['Y'=> 'Yes','N'=>'No'], 'empty'=> true]);
            echo $this->Form->control('hs',['options'=> ['Y'=> 'Yes','N'=>'No'], 'empty'=> true]);
            echo $this->Form->control('funded',['options' => ['Approved' => 'Approved','Denied'=>'Denied','Paid'=>'Paid','Pending'=>'Pending'], 'empty' => false]);
            echo $this->Form->control('denial_id', ['options' => $denial_reasons, 'empty' => true]); // Ask Clinton
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
