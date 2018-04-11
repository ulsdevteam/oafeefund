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
    <?= $this->Html->script(array('http://code.jquery.com/jquery-1.11.0.min.js')); ?>                                                             

    <?= $this->fetch('script'); ?>
    <?= $this->Html->css('base.css') ?>
    <?= $this->Html->css('cake.css') ?>
    <?= $this->Html->css('navbar.css') ?>
    <?= $this->Html->css('/app/Froala/css/froala_editor.min.css');
       $this->Html->script('/app/Froala/js/froala_editor.min.js'); ?>
    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body>
    <nav class="top-bar expanded" data-topbar role="navigation">
        <ul class="title-area large-3 medium-4 columns">
            <li class="name">
                <h1><a href=""><?= $this->fetch('title') ?></a></h1>
            </li>
        </ul>
        <div class="top-bar-section">
            <ul class="right">
                <li><a href="http://192.168.56.101/app/users/logout">Logout</a></li>
               <!--<li><a target="_blank" href="https://book.cakephp.org/3.0/">Documentation</a></li>
                <li><a target="_blank" href="https://api.cakephp.org/3.0/">API</a></li>-->
            </ul>
        </div>
        
    </nav>
        <div id="navbar1">
            <ul>
                <li>
                    <ul><a onmouseover="additionalmethod(1)" onmouseout="additionalmethod(2)" href="/app/requests/">Requests</a></ul>
                    <div class="additionalmethods">
                         <ul><a onmouseover="additionalmethod(1)" onmouseout="additionalmethod(2)" href="/app/requests/pendingrequests" >Pending Requests</a></ul>
                         <ul><a onmouseover="additionalmethod(1)" onmouseout="additionalmethod(2)" href="/app/requests/approvedrequests">Approved Requests</a></ul>
                         <ul><a onmouseover="additionalmethod(1)" onmouseout="additionalmethod(2)" href="/app/requests/paidrequests">Paid Requests</a></ul>
                         <ul><a onmouseover="additionalmethod(1)" onmouseout="additionalmethod(2)" href="/app/requests/deniedrequests">Denied Requests</a></ul>
                    </div>
                </li>
                <li><a href="/app/users">Users</a></li>
                <li><a href="/app/transactions">Transactions</a></li>
                <li><a href="/app/articles">Articles Published</a></li>
                <li><a href="/app/denial-reasons">Denial Reasons</a></li>
                <li><a href="/app/approval-reasons">Approval Reasons</a></li>
                <li><a href="/app/budgets">Check Budget</a></li>
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
