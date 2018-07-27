<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Request[]|\Cake\Collection\CollectionInterface $requests
 */
?>
<!--<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><//?= $this->Html->link(__('Edit Request'), ['action' => 'edit', $request->id]) ?> </li>
        <li><//?= $this->Form->postLink(__('Delete Request'), ['action' => 'delete', $request->id], ['confirm' => __('Are you sure you want to delete # {0}?', $request->id)]) ?> </li>
        <li><//?= $this->Html->link(__('List Requests'), ['action' => 'index']) ?> </li>
        <li><//?= $this->Html->link(__('New Request'), ['action' => 'add']) ?> </li>
        <li><//?= $this->Html->link(__('List Denial Reasons'), ['controller' => 'DenialReasons', 'action' => 'index']) ?> </li>
        <li><//?= $this->Html->link(__('New Denial Reason'), ['controller' => 'DenialReasons', 'action' => 'add']) ?> </li>
        <li><//?= $this->Html->link(__('List Articles'), ['controller' => 'Articles', 'action' => 'index']) ?> </li>
        <li><//?= $this->Html->link(__('New Article'), ['controller' => 'Articles', 'action' => 'add']) ?> </li>
        <li><//?= $this->Html->link(__('List Transactions'), ['controller' => 'Transactions', 'action' => 'index']) ?> </li>
        <li><//?= $this->Html->link(__('New Transaction'), ['controller' => 'Transactions', 'action' => 'add']) ?> </li>
    </ul>
</nav> -->
<?= $this->Html->css('options.css'); ?>
<style>
    #export{
    background: #000;
    padding: 0.4%;
    text-align: center;
    border-radius: 5px;
    color: white;
    font-weight: bold;
}
  #export:hover{
    background: #116d76;
    text-align: center;
    border-radius: 5px;
    color: #C5B358;
    font-weight: bold;
    
}
    
    form{
  display: flex; /* 2. display flex to the rescue */
  flex-direction: row;
    }

.adjust{
    margin-top: 0.5%;
}
#search{
    display: block;
    height:2.4em;
    width: 7em;
    -webkit-border-radius:10px;
    padding: 3px 2px;
}
</style>
<?= $this->Html->css('requests.css') ?>
<div class="test">
    
    <ul class="right adjust">
        
                <?= $this->Form->create(null,['url' => ['controller'=>'Requests','action' => 'search'],'type' => 'get','div'=>false]); ?>
                <?php
                if(!isset($value)){
                    $value="";
                }
                if(!isset($prev_value)){
                    $prev_value="";
                }
                $action=$this->request->params["action"];
               if($action=="search" & isset($prev_action)){
                    $action=$prev_action;
                } 
                ?>
        <?= $this->Form->input('action', array('options' => ['index'=>'All','pendingrequests'=>'Pending Requests','approvedrequests'=>'Approved Requests','paidrequests'=>'Paid Requests','deniedrequests'=>'Denied Requests'], 'label' => false, 'default'=>$action));?>
                <?= $this->Form->input('Parameter',[
            'options' => ['username' => 'Username', 'author_name' => 'Author Name', 'publisher'=> 'Publisher'],'label' => false]);?>
                <?= $this->Form->input('value',array( 'label' => false, 'default'=>$value));?>
              <?= $this->Form->button('search',array('id'=>'search'));?>
                <?= $this->Form->end();?>
            </ul>
    
    <h3>
   <?php 
   if($this->request->params["action"]=="index"){
   echo 'Requests ';
   }
   elseif ($this->request->params["action"]=="pendingrequests") {
   echo 'Pending Requests';
    }
    elseif ($this->request->params["action"]=="approvedrequests") {
    echo 'Approved Requests';
    }
    elseif ($this->request->params["action"]=="deniedrequests") {
    echo 'Denied Requests';
    }
    elseif ($this->request->params["action"]=="paidrequests") {
    echo 'Paid Requests';
    } 
    elseif ($this->request->params["action"]=="search") {
    echo 'Requests';
    } 
   ?></h3>
    <?php
    if((isset($prev_action))&&(isset($value))&&(isset($parameter))){
    echo $this->Html->link('Export to CSV', [
	'controller' => 'Requests', 
	'action' => 'export',
        '_ext' => 'csv',
        '?'=>["action"=>$prev_action,"parameter"=>$parameter,"value"=>$value]
        ],["id"=>"export","type"=>"button"]);
    }
    else{
        echo $this->Html->link('Export to CSV', [
	'controller' => 'Requests', 
	'action' => 'export',
        '_ext' => 'csv',
        '?'=>["action"=>$action]
        ],["id"=>"export","type"=>"button"]);
    }
    ?>
    <?php if ($this->request->params["action"]=="search") {
        echo "The parameter '<b>".$parameter."</b>' for the pattern of '<b>".$value."</b>' returned '<b>". $count."</b>' of '<b>".$prev_value."</b>' requests:";
    }
    ?>
    <table cellpadding="20" cellspacing="20" align="center">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('username') ?></th>
                <th scope="col"><?= $this->Paginator->sort('author_name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('email') ?></th>
                <th scope="col"><?= $this->Paginator->sort('school') ?></th>
                <th scope="col"><?= $this->Paginator->sort('department') ?></th>
                <th scope="col"><?= $this->Paginator->sort('publisher') ?></th>
                <th scope="col"><?= $this->Paginator->sort('amount_requested') ?></th>
                <th scope="col"><?= $this->Paginator->sort('inquiry_date') ?></th>
               <?php if(($this->request->params["action"]=="index") || ($this->request->params["action"]=="search")){
                    echo "<th scope='col'>";
                    echo $this->Paginator->sort('funded');
                    echo "</th>";
                } ?>         

                
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($requests as $request): ?>
            <tr>
                <td><?= h($request->username) ?></td>
                <td><?= h($request->author_name) ?></td>
                <td><?= h($request->email) ?></td>
                <td><?= h($request->school) ?></td>
                <td><?= h($request->department) ?></td>
                <td><?= h($request->publisher) ?></td>
                <td><?= $this->Number->format($request->amount_requested) ?></td>
                <td><?= h($request->inquiry_date) ?></td>
               <?php
                
                if(($this->request->params["action"]=="index") || ($this->request->params["action"]=="search")){
                    echo "<td>";
                echo $request->funded;
                echo "</td>";
                }
                
                ?>
  <!--    <td><?php //h($request->author_status) ?></td>
                <td><?php //h($request->bmc) ?></td>
                <td><?php //h($request->hs) ?></td>
                <td><?php //h($request->funded) ?></td>
                <td><?php // $request->has('denial_reason') ? $this->Html->link($request->denial_reason->id, ['controller' => 'DenialReasons', 'action' => 'view', $request->denial_reason->id]) : '' ?></td> -->
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $request->id]) ?>
                    
                    <?php if(h($request->funded)=="Pending"): 
                    {
                    if($role["role"] === 'admin'){
                    echo $this->Html->link(__('Approve'), ['action' => 'approve', $request->id]);
                    }
                    }
                endif;
                    ?>
                    <?php 
                     if(h($request->funded)=="Pending"): 
                     {
                     if($role["role"] === 'admin'){
                    echo $this->Html->link(__('Deny'), ['action' => 'deny', $request->id]); 
                     }
                     }
                     endif;
                            ?>
                    <?php 
                     if(h($request->funded)=="Approved"): 
                     {
                     if($role["role"] === 'payment_team'){
                     echo $this->Html->link(__('Pay'), ['controller' => 'Transactions','action' => 'add', $request->id]); 
                     }
                     }
                     endif;
                            ?>
                    <?php 
                    $article=$request->article;
                    $transaction=$request->transaction;
                    if( (h($request->funded)=="Paid") && (($role["role"] === 'OSCP_students') || ($role["role"] === 'admin'))){
                        if(empty($request->article))
                        {
                            echo $this->Html->link(__('New Article'), ['controller' => 'Articles','action' => 'add', $request->id]); 
                        }
                        elseif(!empty($request->article))
                        {
                            echo $this->Html->link(__('Edit Article'), ['controller' => 'Articles','action' => 'edit',$article->id ]);  
                        }
                     }
                     ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $request->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $request->id], ['confirm' => __('Are you sure you want to delete # {0}?', $request->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginate">
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
            
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
    </div>
</div>


<script>
    
</script>
