<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Request $request
 */
?>
<?= $this->Html->css('options.css'); ?>
<div class="requests view large-9 medium-8 columns content">
    <h3><?= h($request->id) ?></h3>
   
        <div class="options1">
        <tr>
                    
                    <?php
                    if($role->role === 'admin'){
                    
                    echo $this->Html->link(__('Click here to Approve this request'), ['action' => 'approve', $request->id]);
                    echo "<br>"; 
                    
                    }
                    ?>
                    <?php 
                     if($role->role === 'admin'){
                    echo $this->Html->link(__('Click here to Deny this Request'), ['action' => 'deny', $request->id]); 
                    echo "<br>"; 
                    
                     }
                            ?>
                    <?php 
                     if($role->role === 'payment_team'){
                     echo $this->Html->link(__('Paid'), ['controller' => 'Transactions','action' => 'add', $request->id]); 
                     echo "<br>"; 
                     
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
            <th scope="row"><?= __('First Name') ?></th>
            <td><?= h($request->first_name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Last Name') ?></th>
            <td><?= h($request->last_name) ?></td>
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
            <td><?= $request->has('denial_reason') ? $this->Html->link($request->denial_reason->id, ['controller' => 'DenialReasons', 'action' => 'view', $request->denial_reason->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($request->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Amount Requested') ?></th>
            <td><?= $this->Number->format($request->amount_requested) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Inquiry Date') ?></th>
            <td><?= h($request->inquiry_date) ?></td>
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
        <h4><?= __('Related Articles') ?></h4>
        <?php if (!empty($request->articles)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Request Id') ?></th>
                <th scope="col"><?= __('Publication Date') ?></th>
                <th scope="col"><?= __('Article Url') ?></th>
                <th scope="col"><?= __('Dscholarship Archive') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($request->articles as $articles): ?>
            <tr>
                <td><?= h($articles->id) ?></td>
                <td><?= h($articles->request_id) ?></td>
                <td><?= h($articles->publication_date) ?></td>
                <td><?= h($articles->article_url) ?></td>
                <td><?= h($articles->dscholarship_archive) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Articles', 'action' => 'view', $articles->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Articles', 'action' => 'edit', $articles->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Articles', 'action' => 'delete', $articles->id], ['confirm' => __('Are you sure you want to delete # {0}?', $articles->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Transactions') ?></h4>
        <?php if (!empty($request->transactions)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Amount Paid') ?></th>
                <th scope="col"><?= __('Description') ?></th>
                <th scope="col"><?= __('Date Paid') ?></th>
                <th scope="col"><?= __('Cheque Number') ?></th>
                <th scope="col"><?= __('Request Id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($request->transactions as $transactions): ?>
            <tr>
                <td><?= h($transactions->id) ?></td>
                <td><?= h($transactions->amount_paid) ?></td>
                <td><?= h($transactions->description) ?></td>
                <td><?= h($transactions->date_paid) ?></td>
                <td><?= h($transactions->cheque_number) ?></td>
                <td><?= h($transactions->request_id) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Transactions', 'action' => 'view', $transactions->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Transactions', 'action' => 'edit', $transactions->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Transactions', 'action' => 'delete', $transactions->id], ['confirm' => __('Are you sure you want to delete # {0}?', $transactions->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
