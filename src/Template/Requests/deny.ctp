
<?php
$this->assign('title', __('Send mail to Author for Denial.'));
?>
<?php echo $this->Html->css('forms'); ?>

<?= $this->Html->script(array('http://code.jquery.com/jquery-1.11.0.min.js')); ?>                                                             

<?= $this->fetch('script'); ?>
<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
  <script>
   tinymce.init({ selector:'.edittextarea', height: 500, 
      force_br_newlines : false,
      force_p_newlines : false,
      forced_root_block : '',
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
                
                
                //echo $this->Form->input('to');
                //echo $this->Form->input('from_name');
                //echo $this->Form->input('from_addr', array('label' => 'From Address'));
                ?>
                </br>
              
                    <label>Choose your denial reason:</label>
                
                <?php
                //$this->Froala->plugin();
                //$this->Froala->editor('#message-body'); // J
                $arrayobj1 = new ArrayObject(array());
                $arrayobj2 = new ArrayObject(array());
                $arrayobj3 = new ArrayObject(array());
                /*foreach($results2 as $ul1):
                    $arrayobj3->append(h($ul1->denial_email));
                    $arrayobj1->append(h($ul1->denial_reason));
                    $arrayobj2->append(h($ul1->id));
                endforeach;
                echo '<select id="test">';
                $i=0;
                foreach($arrayobj1 as $select => $row){    
                echo '<option value=' . $arrayobj2[$i] . '>' . $row . '</option>';
                $i=$i+1;
                }
                echo '</select>';*/
             
                ?>
                  <p id="txt">This will change</p>
                   
                   <?php
                    echo $this->Form->input('id',array('options' => $results2, 'empty' =>'(Choose one)'));
                    $i=0;
                    /*echo"<div class='emails'>";
                    foreach($arrayobj3 as $row)
                    {    
                    echo '<p id='.$i.'>';
                    //echo "<br />\n"; 
                    echo $row;
                    echo '</p>';
                    $i=$i+1;
                    
                    
                    }
                    echo"</div>"*/
                   // echo "document.getElementById('txt').innerHTML='yes';";
                    ?>
                  <?php
                    echo $this->Form->button('AutoFill',['onclick'=>'denialcheck()']);
                    ?>

                    
                    
                    
                    <?php
                     echo ''
                    ?>
                    <!--<button id="denialchange" onclick="denialchanger()">Autofill</button>    -->
                    
                    <?php echo $this->Form->create(); ?>
                        <?php
               /* echo $this->Form->select(
                    'field',
                    ['empty' => '(choose one)']
                        
                );*/
                
                echo $this->Form->input('subject');
                echo $this->Form->input('Message_Body', array('type' => 'textarea','class' => 'edittextarea form-control','label' => 'Content :'));
        ?>
        </fieldset>
    
    <label>Upon clicking submit, a denial message will be sent to the sender and this particular request will be shown as denied in our records.</label>
<script type="text/javascript">
   // $(".emails").hide();
    var mytextbox = document.getElementById('message-body');
    var mydropdown = document.getElementById('dropdownID');

    /*function denialchanger(){
        var a=$('#test').find('option:selected').val();
        document.getElementById('message-body').innerHTML=document.getElementById(a-1).innerHTML;
        //document.getElementById('txt').innerHTML=a;
       tinyMCE.activeEditor.setContent(document.getElementById(a-1).innerHTML);
        
    }*/
    function denialcheck(){
                         var copy=$("#id option:selected").text()
               document.getElementById('subject').value="RE: Author Fund Request: "+copy;
               var id= document.getElementById('id').value;
		$.ajax({
			type:'GET',
			cache: false,
			url: 'http://192.168.56.101/app/requests/denialchecker',
                        data:{id: id},
			success: function(response) {					
				//success
                                //response = response.replace(/\\(.)/mg, "$1");
                                //var resp_data= response;
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
    <?php //echo "$arrayobj3[0]" ?>
                <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
