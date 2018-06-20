<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Request[]|\Cake\Collection\CollectionInterface $requests
 */
?>

<?= $this->Html->css('requests.css') ?>
<div class="test">
    <h3><?= __('Pending Requests') ?></h3>
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
                <td><?= h($request->suthor_name) ?></td>
                <td><?= h($request->email) ?></td>
                <td><?= h($request->school) ?></td>
                <td><?= h($request->department) ?></td>
                <td><?= h($request->publisher) ?></td>
                <td><?= $this->Number->format($request->amount_requested) ?></td>
                <td><?= h($request->inquiry_date) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $request->id]) ?>
                    
                    <?php
                    if($role->role === 'admin'){
                    echo $this->Html->link(__('Approve'), ['action' => 'approve', $request->id]);
                    }
                    ?>
                    <?php 
                     if($role->role === 'admin'){
                    echo $this->Html->link(__('Deny'), ['action' => 'deny', $request->id]); 
                     }
                            ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $request->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $request->id], ['confirm' => __('Are you sure you want to delete # {0}?', $request->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
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
