<?php
$this->assign('title', __('Send mail to Author for Approval.'));
?>
<?php echo $this->Html->css('forms'); ?>

<?= $this->Html->script(array('http://code.jquery.com/jquery-1.11.0.min.js')); ?>                                                             

<?= $this->fetch('script'); ?>
<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
  <script>
   tinymce.init({ selector:'.edittextarea', height: 500,  plugins: [
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
                echo $this->Form->input('id',array('options' => $results2, 'empty' =>'(Choose one)'));
                echo $this->Form->button('AutoFill',['onclick'=>'approvalcheck()']);
                //echo $this->Form->input('to');
                //echo $this->Form->input('from_name');
                //echo $this->Form->input('from_addr', array('label' => 'From Address'));
                ?>
                </br>
                
                    <label>Choose your approval reason:</label>
                
                <?php
                //$this->Froala->plugin();
                //$this->Froala->editor('#message-body'); // J
                
                echo $this->Form->input('subject');
                echo $this->Form->input('Message_Body', array('type' => 'textarea','class' => 'edittextarea form-control','label' => 'Content :'));
        ?>
        </fieldset>
        <label>Upon clicking submit, an approval message will be sent to the sender and this particular request will be shown as approved in our records.</label>
<?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
        
</div>
 <script>
     
  function approvalcheck(){
       var copy=$("#id option:selected").text()
               document.getElementById('subject').value=copy;
               var id= document.getElementById('id').value;
		$.ajax({
			type:'POST',
			cache: false,
			url: 'http://192.168.56.101/app/requests/denialchecker',
                        data:{id: id},
			success: function(response) {					
				//success
                                var resp_data= response;
                                tinyMCE.activeEditor.setContent(response);
				console.log(response);                
			},
			error: function(response) {					
				console.log(response);
			},
			
		});
                
	
    }
 </script>