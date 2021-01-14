<?php
$this->assign('title', __('Send mail to Author for Approval.'));
?>
<?php echo $this->Html->css('forms'); ?>

<?= $this->Html->script(array('//code.jquery.com/jquery-1.11.0.min.js')); ?>

<?= $this->fetch('script'); ?>
<script src="/js/tinymce/js/tinymce/tinymce.min.js"></script>
<script>
    tinymce.init({
        mode : "textareas",
        force_br_newlines: false,
        force_p_newlines: false,
        selector: '.edittextarea', height: 500,  plugins: [
            'advlist autolink lists link print preview anchor',
            'insertdatetime table paste code'
    ], });
</script>

<div class="MailForm">
    <fieldset>
        <legend><?php echo $this->fetch('title'); ?></legend>
        <div>
            <b><?= h($results->author_name) ?></b> (<?= h($results->email) ?>) is approved for <b><?php $fmt = new NumberFormatter( 'en_US', NumberFormatter::CURRENCY ); echo $fmt->formatCurrency($results->amount_requested, 'USD'); ?></b> to publish <i><?= h($results->article_title) ?></i> in <b><?= h($results->publication_name) ?></b>.
        </div>
        <?php
            echo $this->Form->input('id', array('options' => $approvalReasons, 'empty' =>'(Choose one)', 'label' => 'Mail Template'));
            echo $this->Form->button('AutoFill',['onclick'=>'approvalcheck()']);
        ?>
        </br>

        <label></label>
        <?php echo $this->Form->create(); ?>
        <?php
            echo $this->Form->input('internal_note');
            echo $this->Form->input('subject');
            echo $this->Form->input('Message_Body', array('type' => 'textarea','class' => 'edittextarea form-control','label' => 'Content :'));
        ?>
    </fieldset>
    <label>Upon clicking submit, an approval message will be sent to the sender and this particular request will be shown as approved in our records.</label>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
<script>
  function approvalcheck() {
        var copy=$("#id option:selected").text()
        document.getElementById('subject').value="RE: Author Fund Request: "+copy;
        var id= document.getElementById('id').value;
        $.ajax({
            type:'GET',
            cache: false,
            url: '/requests/approvalchecker',
            data:{id: id},
            success: function(response) {
                //success
                response=JSON.parse(response);
                console.log(response);
                tinyMCE.activeEditor.setContent(response);
            },
            error: function(response) {
                console.log(response);
            },
        });
    }
 </script>
