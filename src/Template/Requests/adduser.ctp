<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Request $request
 */
?>
<!--<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?=  __('Actions') ?></li>
        <li><?php //$this->Html->link(__('List Requests'), ['action' => 'index']) ?></li>
        <li><?php //$this->Html->link(__('List Denial Reasons'), ['controller' => 'DenialReasons', 'action' => 'index']) ?></li>
        <li><?php //$this->Html->link(__('New Denial Reason'), ['controller' => 'DenialReasons', 'action' => 'add']) ?></li>
        <li><?php //$this->Html->link(__('List Articles'), ['controller' => 'Articles', 'action' => 'index']) ?></li>
        <li><?php //$this->Html->link(__('New Article'), ['controller' => 'Articles', 'action' => 'add']) ?></li>
        <li><?php //$this->Html->link(__('List Transactions'), ['controller' => 'Transactions', 'action' => 'index']) ?></li>
        <li><?php //$this->Html->link(__('New Transaction'), ['controller' => 'Transactions', 'action' => 'add']) ?></li>
    </ul>
</nav> -->

<?= $this->Html->script(array('http://code.jquery.com/jquery-1.11.0.min.js')); ?>                                                             

<?= $this->fetch('script'); ?>
<div class="requests form large-9 medium-8 columns content">
    <?= $this->Form->create($request) ?>
    <fieldset>
        <legend><?= __('OAPPP funding') ?></legend>
        <?php
            echo $this->Form->control('username',['default'=>$details["username"]]);
            // echo $this->Form->button('AutoFill',['type'=>'button','onclick'=>'auto()']);
            //echo "</br>";
            echo $this->Form->control('author_name',['default'=>$details["first_name"]." ".$details["last_name"]]);
            echo $this->Form->control('email',['default'=>$details["email"]]);
            echo $this->Form->control('school');
            echo $this->Form->control('department',['default'=>$details["department"]]);
            echo $this->Form->control('publisher');
            echo $this->Form->control('publication_name');
            echo $this->Form->control('amount_requested');
            echo $this->Form->control('article_title');
          //echo $this->Form->hidden('inquiry_date');
            ;
            $attributes = array();
            $foo= 'student';
            echo nl2br ("Author Status* \n");
            $options = array('student' => 'Student', 'professor' => 'Professor', 'post-Doc' => 'Post-Doc', 'staff' => 'Staff' );
            //$attributes= $this->Form->control('author_status');

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
        //console.log(val);
        //document.getElementById('first-name').value=val;
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

