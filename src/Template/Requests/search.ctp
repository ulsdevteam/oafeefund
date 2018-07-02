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
<?= $this->Html->css('requests.css') ?>
<div class="test">
    <h3><?= __('Requests') ?></h3>
    <?php print_r($value); ?>
    <table cellpadding="20" cellspacing="20" align="center">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('username') ?></th>
                <th scope="col"><?= $this->Paginator->sort('author_name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('email') ?></th>
                <th scope="col"><?= $this->Paginator->sort('school') ?></th>
                <th scope="col"><?= $this->Paginator->sort('department') ?></th>
                <th scope="col"><?= $this->Paginator->sort('publisher') ?></th>
                <th scope="col"><?= $this->Paginator->sort('amount_requested') ?></th>
                <th scope="col"><?= $this->Paginator->sort('inquiry_date') ?></th>
                <th scope="col"><?= $this->Paginator->sort('funded') ?></th>             
<!--   <th scope="col"><?php $this->Paginator->sort('author_status') ?></th>
                <th scope="col"><?php $this->Paginator->sort('bmc') ?></th>
                <th scope="col"><?php $this->Paginator->sort('hs') ?></th>
                <th scope="col"><?php $this->Paginator->sort('funded') ?></th>
                <th scope="col"><?php $this->Paginator->sort('denial_id') ?></th> -->
                
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($requests as $request): ?>
            <tr>
                <td><?= $this->Number->format($request->id) ?></td>
                <td><?= h($request->username) ?></td>
                <td><?= h($request->author_name) ?></td>
                <td><?= h($request->email) ?></td>
                <td><?= h($request->school) ?></td>
                <td><?= h($request->department) ?></td>
                <td><?= h($request->publisher) ?></td>
                <td><?= $this->Number->format($request->amount_requested) ?></td>
                <td><?= h($request->inquiry_date) ?></td>
                <td><?= h($request->funded) ?></td>
  
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $request->id]) ?>
                    
                    <?php if(h($request->funded)=="Pending"): 
                    {
                    if($role->role === 'admin'){
                    echo $this->Html->link(__('Approve'), ['action' => 'approve', $request->id]);
                    echo $this->Html->link(__('Deny'), ['action' => 'deny', $request->id]); 
                     }
                     }
                     elseif(h($request->funded)=="Approved"): 
                     {
                     if($role["role"] === 'payment_team'){
                     echo $this->Html->link(__('Pay'), ['controller' => 'Transactions','action' => 'add', $request->id]); 
                     }
                     }
                    elseif( (h($request->funded)=="Paid") && ($role["role"] === 'OSCP_students')):{
                        if(empty($request->articles))
                        {
                            echo $this->Html->link(__('New Article'), ['controller' => 'Articles','action' => 'add', $request->id]); 
                        }
                        elseif(!empty($request->articles))
                        {
                            $article_id=$request->articles;
                            echo $this->Html->link(__('Edit Article'), ['controller' => 'Articles','action' => 'edit',$article_id[0]->id ]);  
                        }
                     }
                     endif;
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
