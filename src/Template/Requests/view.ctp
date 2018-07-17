<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Request $request
 */
?>
<?= $this->Html->css('options.css'); ?>
<div class="requests view large-9 medium-8 columns content">
    <?php  
        $article=$request->article;
        $transaction=$request->transaction;
    ?>
    <h3><?php echo "Author Name: ". h($request->author_name) ."  (Username: ". h($request->username). ")" ?></h3>
    <h3><?php echo "Total amount used: $".h($request3)."";
    ?></h3>
        <div class="options1">
        <tr>
                    <?php if(h($request->funded)=="Pending"): 
                    {
                    if($role->role === 'admin'){
                    
                    echo $this->Html->link(__('Click here to Approve this request'), ['action' => 'approve', $request->id],['class' => 'button', 'target' => '_blank']); //
                    
                    
                    } 
                     if($role->role === 'admin'){
                    echo $this->Html->link(__('Click here to Deny this Request'), ['action' => 'deny', $request->id],['class' => 'button', 'target' => '_blank']); 
                    echo "<br>"; 
                    
                     }
                    }
                    endif; ?>
                    <?php 
                    if(h($request->funded)=="Approved"): 
                    {
                     if($role->role === 'payment_team'){
                     echo $this->Html->link(__('Payment for this request'), ['controller' => 'Transactions','action' => 'add', $request->id]); 
                     echo "<br>"; 
                     }
                    }
                     endif;
                    ?>
            
                    <?php 
                    if( (h($request->funded)=="Paid") && (($role->role === 'OSCP_students') || ($role->role === 'admin'))){
                        if(empty($request->article))
                        {
                            echo $this->Html->link(__('New Article'), ['controller' => 'Articles','action' => 'add', $request->id]); 
                            echo "<br>"; 
                        }
                        elseif(!empty($request->article))
                        {
                            $article_id=$request->article;
                            echo $this->Html->link(__('Edit Article'), ['controller' => 'Articles','action' => 'edit',$article->id ]); 
                            echo "<br>";   
                        }
                     }
                    
                    
                     
                     ?>
        </tr>
        </div>
     <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Username') ?></th>
            <td><?= h($request->username) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Author Name') ?></th>
            <td><?= h($request->author_name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Email') ?></th>
            <td><?= h($request->email) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('School') ?></th>
            <td><?= h($request->school) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Department') ?></th>
            <td><?= h($request->department) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Publisher') ?></th>
            <td><?= h($request->publisher) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Author Status') ?></th>
            <td><?= h($request->author_status) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Bmc') ?></th>
            <td><?= h($request->bmc) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Hs') ?></th>
            <td><?= h($request->hs) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Funded') ?></th>
            <td><?= h($request->funded) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Denial Reason') ?></th>
            <td><?= $request->has('denial_reason') ? $this->Html->link($request->denial_reason->denial_reason, ['controller' => 'DenialReasons', 'action' => 'view', $request->denial_reason->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Amount Requested') ?></th>
            <td><?= $this->Number->format($request->amount_requested) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Inquiry Date') ?></th>
            <td><?= h($request->inquiry_date) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Internal Note') ?></th>
            <td><?= h($request->internal_note) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Other Authors') ?></th>
            <td><?= h($request->other_authors) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Application Completed') ?></th>
            <td><?= h($request->application_completed) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Publication Name') ?></h4>
        <?= $this->Text->autoParagraph(h($request->publication_name)); ?>
    </div>
    <div class="row">
        <h4><?= __('Article Title') ?></h4>
        <?= $this->Text->autoParagraph(h($request->article_title)); ?>
    </div>
   
    <div class="related">
        <h4><?= __('Other requests made by same username') ?></h4>
        <?php if (!empty($other_requests)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Publisher') ?></th>
                <th scope="col"><?= __('Publication Date') ?></th>
                <th scope="col"><?= __('Article Title') ?></th>
                <th scope="col"><?= __('Inquiry Date') ?></th>
                <th scope="col"><?= __('Amount Requested') ?></th>
                <th scope="col"><?= __('Funded') ?></th>
            </tr>
        <?php foreach ($other_requests as $otr): ?>
        <tr>
                <td><?= h($otr["id"] ) ?></td>
                <td><?= h($otr["publisher"] ) ?></td>
                <td><?= h($otr["publication_name"] ) ?></td>
                <td><?= h($otr["article_title"] ) ?></td>
                <td><?= h($otr["inquiry_date"] ) ?></td>
                <td><?= h($otr["amount_requested"] ) ?></td>
                <td><?= h($otr["funded"] ) ?></td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
         
    </div>
    <div class="related">
        <h4><?= __('Related Articles') ?></h4>
        <?php if (!empty($request->article)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Publication Date') ?></th>
                <th scope="col"><?= __('Article Url') ?></th>
                <th scope="col"><?= __('Dscholarship Archive') ?></th>
                <th scope="col"><?= __('DOI') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <tr>
                <td><?= h($article->publication_date) ?></td>
                <td><?= h($article->article_url) ?></td>
                <td><?= h($article->dscholarship_archive) ?></td>
                <td><?= h($article->doi) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Articles', 'action' => 'view', $article->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Articles', 'action' => 'edit', $article->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Articles', 'action' => 'delete', $article->id], ['confirm' => __('Are you sure you want to delete # {0}?', $article->id)]) ?>
                </td>
            </tr>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Transactions') ?></h4>
        <?php if (!empty($request->transaction)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Amount Paid') ?></th>
                <th scope="col"><?= __('Description') ?></th>
                <th scope="col"><?= __('Date Paid') ?></th>
                <th scope="col"><?= __('Cheque Number') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <tr>
                <td><?= h($transaction->amount_paid) ?></td>
                <td><?= h($transaction->description) ?></td>
                <td><?= h($transaction->date_paid) ?></td>
                <td><?= h($transaction->cheque_number) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Transactions', 'action' => 'view', $transaction->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Transactions', 'action' => 'edit', $transaction->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Transactions', 'action' => 'delete', $transaction->id], ['confirm' => __('Are you sure you want to delete # {0}?', $transaction->id)]) ?>
                </td>
            </tr>
        </table>
        <?php endif; ?>
    </div>
</div>
