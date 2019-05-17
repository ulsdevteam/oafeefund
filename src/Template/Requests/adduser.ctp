<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Request $request
 */
?>


<?= $this->Html->script(array('//code.jquery.com/jquery-1.11.0.min.js')); ?>

<?= $this->fetch('script'); ?>
<div class="requests form large-offset-2 large-8 medium-8 medium-offset-2 columns content">
    <?= $this->Form->create($request) ?>
    <fieldset>
        <legend><?= __('OAPPP funding') ?></legend>
        <?php
            echo $this->Form->control('username',['default'=>(isset($details["username"]) ? $details["username"] : '')]);
            echo $this->Form->button('AutoFill',['type'=>'button','onclick'=>'auto()']);
            echo $this->Form->control('author_name',['default'=>(isset($details["first_name"]) ? $details["first_name"]." ".$details["last_name"] : '')]);
            echo $this->Form->control('email',['default'=>(isset($details["email"]) ? $details["email"] : '')]);
            echo $this->Form->control('school');
            echo $this->Form->control('department',['default'=>(isset($details["department"]) ? $details["department"] : '')]);
            echo $this->Form->control('publisher');
            echo $this->Form->control('publication_name');
            echo $this->Form->control('amount_requested');
            echo $this->Form->control('article_title');

            $attributes = array();
            $foo= 'student';
            echo nl2br ("Author Status* \n");
            $options = array('student' => 'Student', 'professor' => 'Professor', 'post-Doc' => 'Post-Doc', 'staff' => 'Staff' );
            echo $this->Form->radio('author_status', $options, $attributes);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
<script>
    function auto()
    {
        var val=document.getElementById('username').value;
        $.ajax({
            type:'GET',
            cache: false,
            url: '<?=  $this->Url->build([
                "controller" => "Users",
                "action" => "details"
            ]); ?>',
            data:{val: val},
            success: function(response) {
                //success
                console.log(response);
                var json = JSON.parse(response);
                console.log(json["first_name"]);
                document.getElementById('author-name').value=json["first_name"]+" "+json["last_name"];
                document.getElementById('email').value=json["email"];
                document.getElementById('department').value=json["department"];
            },
            error: function(response) {
                console.log(response.responseText);
            },
        });
    }
</script>
