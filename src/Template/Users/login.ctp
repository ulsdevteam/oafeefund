<h1>Login</h1>
<?= $this->Form->create('User'); ?>
<?= $this->Form->control('user'); ?>
<?= $this->Form->submit('Login', array('class'=>'button')); ?>
<?= $this->Form->end() ?>