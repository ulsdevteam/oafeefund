<?= $this->Html->script('d3.v4'); ?>
    <title>Testing Pie Chart</title>
    <style type="text/css">
        .slice text {
            font-size: 16pt;
            font-family: Arial;
        }   
    
    text{
        font-size: 15px;
    }
    #reports{
        font-size: 30px;
        font-style: bold;
    }
    #max{
        font-size: 25px;
    }
    #requeststabletext{
       font-size: 30px; 
    }
</style>
<p id="para"><?php print_r($query1);?></p>
<?= $this->Html->script('reports'); ?>
<p id="para1"></p>
<?= $this->Html->script('reports'); ?>
<?= $this->Html->css('style.css'); ?>



