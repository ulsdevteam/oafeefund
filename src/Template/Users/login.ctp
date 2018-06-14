<?= $this->Html->css('login.css') ?>
<img src="http://www.pitt.edu/sites/default/files/pitt_logo.png" id="image1">
<h1 id="header1">Username :</h1>
<?= $this->Form->create('User'); ?>
<?= $this->Form->control('user', array('label' => false)); ?>
<?= $this->Form->submit('Login', array('class'=>'button')); ?>
<?= $this->Form->end() ?>