<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = 'OAAFF application';
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $cakeDescription ?>:
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>
    <?php // $this->Html->script(array('https://code.jquery.com/jquery-1.11.0.min.js')); ?>  
    <?= $this->Html->script('jquery-3.3.1.min') ?>

    <?= $this->fetch('script'); ?>
    <?= $this->Html->css('base.css') ?>
    <?= $this->Html->css('cake.css') ?>
    <?= $this->Html->css('navbar.css') ?>
    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
    <style>
        #image2{
            width:15%;
            height: 100%;
            margin-left: 15%;
            margin-bottom: 0.5%;
        }
        
        .bottom{
           margin-top: 10%;
           margin-right: 5%;
        }
    </style>
</head>
<body>
    <nav class="top-bar expanded" data-topbar role="navigation">
        <ul class="title-area columns">
            <li class="name">
                <h1><a href=""><?= $this->fetch('title') ?></a></h1>
            </li>
        </ul>
        <div class="top-bar-section">
            <img src="//www.pitt.edu/sites/default/files/pitt_logo.png">
            
               <!--<li><a target="_blank" href="https://book.cakephp.org/3.0/">Documentation</a></li>
                <li><a target="_blank" href="https://api.cakephp.org/3.0/">API</a></li>-->
            
          <ul class="right bottom">
                <?= $this->Form->create(null,['url' => ['controller'=>'Requests','action' => 'search'],'type' => 'get','div'=>false]); ?>
              <?= $this->Form->input('Parameter',[
            'options' => ['username' => 'Username', 'author_name' => 'Author Name', 'publisher'=> 'Publisher'],'label' => false]);?>
                <?= $this->Form->input('value',array( 'label' => false ));?>
              <?= $this->Form->button('search');?>
                <?= $this->Form->end();?>
            </ul>
        </div>
        
    </nav>
        <div id="navbar1">
            <ul>
                <li>
                    <ul><?= $this->Html->link('Requests',['controller' => 'Requests', 'action' => 'index', '_full' => true],['onmouseover'=>'additionalmethod(1)','onmouseout'=>'additionalmethod(2)']);?></ul>
                    <div class="additionalmethods">
                         <ul><?= $this->Html->link('Pending Requests',['controller' => 'Requests', 'action' => 'pendingrequests', '_full' => true],['onmouseover'=>'additionalmethod(1)','onmouseout'=>'additionalmethod(2)']);?></ul>
                         <ul><?= $this->Html->link('Approved Requests',['controller' => 'Requests', 'action' => 'approvedrequests', '_full' => true],['onmouseover'=>'additionalmethod(1)','onmouseout'=>'additionalmethod(2)']);?></ul>
                         <ul><?= $this->Html->link('Paid Requests',['controller' => 'Requests', 'action' => 'paidrequests', '_full' => true],['onmouseover'=>'additionalmethod(1)','onmouseout'=>'additionalmethod(2)']);?></ul>
                         <ul><?= $this->Html->link('Denied Requests',['controller' => 'Requests', 'action' => 'deniedrequests', '_full' => true],['onmouseover'=>'additionalmethod(1)','onmouseout'=>'additionalmethod(2)']);?></ul>
                    </div>
                </li>
                <li><?= $this->Html->link('Users',['controller' => 'Users', 'action' => 'index', '_full' => true]);?></li>
                <li><?= $this->Html->link('Transactions',['controller' => 'Transactions', 'action' => 'index', '_full' => true]);?></li>
                <li><?= $this->Html->link('Articles Published',['controller' => 'Articles', 'action' => 'index', '_full' => true]);?></li>
                <li><?= $this->Html->link('Denial Reasons',['controller' => 'DenialReasons', 'action' => 'index', '_full' => true]);?></li>
                <li><?= $this->Html->link('Approval Reasons',['controller' => 'ApprovalReasons', 'action' => 'index', '_full' => true]);?></li>
                <li><?= $this->Html->link('Check Budget',['controller' => 'Budgets', 'action' => 'index', '_full' => true]);?></li>
                <li><?= $this->Html->link('Reports',['controller' => 'Requests', 'action' => 'reports', '_full' => true]);?></li>
            </ul>
                 
                
        </div>
   
    <?= $this->Flash->render() ?>
    <div class="container clearfix">
        <?= $this->fetch('content') ?>
    </div>
    <footer>
    </footer>
</body>
    <script>
        $('.additionalmethods').hide();
        $('.paginator').show();
        function additionalmethod(num){
            if(num == "1")
            {
               $('.additionalmethods').show(); 
            }
            else if(num == "2")
            {
                $('.additionalmethods').hide(); 
            }
    
        }
    </script>

</html>
