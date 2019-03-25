
<?php
$this->assign('title', __('Send mail to Author for Denial.'));
?>
<?php echo $this->Html->css('forms'); ?>

<?= $this->Html->script(array('http://code.jquery.com/jquery-1.11.0.min.js')); ?>

<?= $this->fetch('script'); ?>
<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
<script>
    tinymce.init({ selector: '.edittextarea', height: 500,
        force_br_newlines: false,
        force_p_newlines: false,
        forced_root_block: '',
        plugins: [
            'advlist autolink lists link print preview anchor',
            'insertdatetime table contextmenu paste code'
        ], });
</script>

<div class="MailForm">
    <fieldset>
        <legend><?php echo $this->fetch('title'); ?></legend>
        <?php
            echo "<b>Mail will be sent to:</b> ";
            echo "<br />\n";
            echo h($results-> first_name);
            echo " ";
            echo h($results-> last_name);
            echo "<br />\n";
            echo '<b>Mail will be received on the below email address: </b>';
            echo "<br />\n";
            echo h($results-> email);
            echo "<br />\n";

            echo $this->Form->create();
            echo "</br>";
            echo $this->Form->input('id',array('options' => $results2, 'empty' =>'(Choose one)'));
            echo $this->Form->button('AutoFill',['onclick'=>'denialcheck()','type'=>'button']);
            echo '';
            //echo $this->Form->hidden('denial',["id"=>"denial"]);
            echo $this->Form->input('subject');
            echo $this->Form->input('Message_Body', array('type' => 'textarea','class' => 'edittextarea form-control','label' => 'Content :'));
        ?>
    </fieldset>

    <label>Upon clicking submit, a denial message will be sent to the sender and this particular request will be shown as denied in our records.</label>
    <script type="text/javascript">
        var mytextbox = document.getElementById('message-body');
        var mydropdown = document.getElementById('dropdownID');
        function denialcheck() {
            var copy=$("#id option:selected").text()
            document.getElementById('subject').value="RE: Author Fund Request: "+copy;
            var id= document.getElementById('id').value;
            $.ajax({
                type:'GET',
                cache: false,
                url: '/requests/denialchecker',
                data:{id: id},
                success: function(response) {
                    response=JSON.parse(response);
                    tinyMCE.activeEditor.setContent(response);
                    console.log(response);
                },
                error: function(response) {
                    console.log(response);
                },
            });
        }
    </script>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
