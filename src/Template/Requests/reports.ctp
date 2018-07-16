<?= $this->Html->script('d3.v4'); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/json2html/1.2.0/json2html.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.json2html/1.2.0/jquery.json2html.min.js"></script>
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
    .date{
        width: 10%;
        background-color: #008CBA;
        color: #C5B358;
        font-weight: bold;
    }
</style>
<p id="para"><?php print_r($query1);?></p>
<?= $this->Html->script('reports'); ?>
<p id="para1"></p>
<?= $this->Html->script('reports'); ?>
<?= $this->Html->css('style.css'); ?>
<?= $this->Form->input('Requests Per School',['type'=>'button','label'=>false,'onclick'=>"createChart(['/requests/schoolRequests','Requests per School','Requests','School'])"]); ?>
<?php // $this->Form->input('Pie Chart ',['type'=>'button','label'=>false,'onclick'=>'createRPSChart(2)']); ?>
<?= $this->Form->input('Budgets Per School',['type'=>'button','label'=>false,'onclick'=>"createChart(['/requests/budgetRequests','Budgets Per School','Budget','School'])"]); ?>
<?php // $this->Form->input('Pie Chart ',['type'=>'button','label'=>false,'onclick'=>'createBPSChart(2)']); ?>
<?= $this->Form->input('Publisher Costs',['type'=>'button','label'=>false,'onclick'=>"createChart(['/requests/publisherCosts','Publisher Costs','Cost','Publisher'])"]); ?>

<?php 
$options=array(''=>'All','2018'=>'FY2017-2018','2017'=>'FY2016-2017','2016'=>'FY2015-2016','2015'=>'FY2014-2015','2014'=>'FY2013-2014','2013'=>'FY2012-2013');
echo $this->Form->control('',['options'=>$options,'id'=>'choose-fiscal-year','class'=>'date right','onchange'=>'createChart()']); ?>
<div id="table"></div>
<script>
   /* function dateChange(){
         = document.getElementById("choose-fiscal-year").value;
        document.getElementById("FY").innerHTML=;
        if(currReport!=null){
            document.getElementById("FY").innerHTML= + currReport;
            if(currReport!=null){
                
            }
        }
    }*/
    prev_chart=null;
    chart=null;
    function createChart(chart)
    {
        
        var FY=document.getElementById("choose-fiscal-year").value;
        if(!prev_chart){
        prev_chart=['/requests/schoolRequests','Requests per School','requests','school'];
    }
        if(!chart){
            chart=prev_chart;
        }
        prev_chart=chart;
        console.log(chart);
        //document.getElementById('first-name').value=val;
        $.ajax({
			type:'GET',
			cache: false,
			url: chart[0],
                        data: {FY : FY},
			success: function(response) {					
				//success 
                               // console.log(response);
                                json = JSON.parse(response);
                               // console.log(json); 
                                createGraph(json,chart);
                                /* var t = {'<>':'ul','id':'table','html':'${'+chart[4]+'} ${'+chart[3]+'}'};
                                
        
                                 var d = json;

                                document.write( json2html.transform(d,t) );**/
			},
			error: function(response) {					
				console.log(response.responseText);
			},
			
		});
    }
</script>
