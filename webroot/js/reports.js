/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/* 
    Created on : Jun 24, 2018, 12:01:21 AM
    Author     : hok14
*/

var width=window.innerWidth;
var height=window.innerHeight;
margin={left:500,right:50,top:100,bottom:0};
$("#para").hide();
var tooltip = d3.select("body").append("div").attr("id","ttip").style("opacity","0").style("position","absolute");

function addIndex(data){
    for(i=0;i<data.length;i++){
        data[i]["Index(X-axis)"]=i+1;
    }
return data;
}
function replaceEmpty(data){
    var parameter=[];
    for(i=0;i<data.length;i++)
    {
        if(data[i].parameter=="")
        {
            data[i].parameter="Unknown";
        }
    }
    return data;
    //console.log(parameter);
}
function getParameter(d){
    return d.parameter;
}
function getValue(d){
    return d.value;
}
function getMax(data){
    max=data[0];
    for(i=0;i<data.length;i++){
        val=getParameter(data[i]);
        //console.log("curr"+data[i].value+"max"+max.value);
        if(parseInt(data[i].value)>parseInt(max.value)){
        max=data[i];
        //console.log("Change-curr"+data[i].value+"max"+max.value);
    }
    }
    return max.value;
}

function getMaxParameter(data){
    max=data[0];
    for(i=0;i<data.length;i++){
        val=getParameter(data[i]);
       // console.log("curr"+data[i].parameter+"max"+max.parameter);
        if(parseInt(data[i].parameter)>parseInt(max.parameter)){
        max=data[i];
       // console.log("Change-curr"+data[i].parameter+"max"+max.parameter);
    }
    }
    return max.parameter;
}


function getParameters(data){
    var parameter=[]

    for(i=0;i<data.length;i++)
    {
        parameter.push(data[i].parameter);
    }
    return parameter;
    //console.log(parameter);
}


function createGraph(data,chart){
    console.log(data);
    d3.select("svg").remove();
    y_height= 30; // set the y height
    footer=2;
    after_text=4;
    tooltip_away=10;
    height=y_height*(data.length+(after_text + footer))// y_height*(data.length+( after text+ footer))
    width= 1800;
    width_graph=1000;
    x2_start_x= 0;  // second x-axis -x
    x2_start_y= y_height*(data.length+1); // second x-axis -y
    //d3.selectAll(".legend").remove();
    data=replaceEmpty(data);
    var svg=d3.select(".container").append("svg").attr("height",height).attr("width",width).attr("id","graph");
    // y_height=30;
    var y= d3.scaleBand()  // Which type of scale?
            .domain(getParameters(data)) // get Parameter
            .range([y_height,y_height*(data.length+1)]); // y_height to y_height*(data.length +1)


    var yAxis = d3.axisLeft(y); // Axis generator
    val=getMax(data);
    var x= d3.scaleLinear()  // Which type of scale? scaleOrdinal/ scalePoint/ scaleBands
            .domain([0,val])
            .range([0,width_graph])  /// create constant width, dependent on .attr("height","1400").attr("width","2000").attr("id","graph");
            .nice();

    var xAxis = d3.axisBottom(x); 
    /*svg.selectAll("circle")
    .data(data)
    .enter().append("circle")
    .attr("cx","300")
    .attr("cy",function(d,i){ return 220+(i*20);})
    .attr("r","5")
    .text("School 1");*/
    var chartGroup= svg.append("g").attr("transform","translate("+margin.left+","+margin.top+")");
    
    
    svg.append("text")
    .attr("id","reports")
    .attr("x","50") // x
    .attr("y","30") // Report heading y
    .attr("fill","black")
    .attr("font-size","40") // font size y 
    .text("Report for "+chart[1]+":");  // Pass in the whole value
    
    
     chartGroup.selectAll("rect")
                            .data(data)
                            .enter().append("rect")
                            .attr("class","rectangle")
                            .attr("height","20") // 2/3 of y_height
                            .attr("width",function(d,i){ return 0;})
                            .attr("x",function(d,i){ return 1;})
                            .attr("y",function(d,i){ return y_height*(i+1);}) // y_height*(i+1)
                            .on("mouseover",function(d){
                                tooltip.style("opacity","1")
                                .style("left",d3.event.pageX+tooltip_away+"px")
                                .style("top",d3.event.pageY+tooltip_away+"px");
                                $(this).css({"fill": "#d4b66c"});
                                tooltip.html(chart[2]+": "+Math.round(d.value)+"</br>"+chart[3]+": "+d.parameter);
                            }).
                            on("mouseout",function(d){
                                tooltip.style("opacity","0");
                                $(this).css({"fill": "#15848F"});
                                tooltip.html("");
                            });
    var transit = d3.select("svg").selectAll("rect")
            .data(data)
            .transition()
            .duration(2000)
            .attr("width",function(d,i){ return x(getValue(d));})

    chartGroup
            .append("g")
            .attr("class","axis x 1")
            .attr("class","x-ax")
            .call(xAxis);
    
    chartGroup
            .append("g")
            .attr("class","axis x 2")
            .attr("transform","translate("+x2_start_x+","+x2_start_y+")") // y_height
            .attr("class","x-ax")
            .call(xAxis);

        chartGroup
            .append("g")
            .attr("class","axis y")
            .call(yAxis);
    
/*        chartGroup.append("text")
                .attr("id","max")
                .attr("x","50")
                .attr("font-size","145")
                .attr("y",30*(data.length+4)) // y_height
                .attr("fill","black")
                .text("Max requests: "+getMax(data)+" School: "+getMaxParameter(data)); **/
 /*   chartGroup.append("text")
            .attr("id","requeststabletext")
            .attr("x","0")
            .attr("y","1200")
            .attr("fill","black")
            .text("Tabular representation:"); **/
   // tabulate(data, ['Index(X-axis)','parameter', 'value'])
}

function createPie(data){
    d3.select("svg").remove();
    d3.selectAll(".legend").remove();
    var margin={left:400,right:50,top:100,bottom:0};
    //svg.append("g").attr("transform","translate("+margin.left+","+margin.top+")");
    data=replaceEmpty(data);
    data=addIndex(data);
var text = "";

var width = 700;
var height = 700;
var thickness = 40;
var duration = 750;
var padding = 10;
var opacity = .8;
var opacityHover = 1;
var otherOpacityOnHover = .8;
var tooltipMargin = 13;

var radius = Math.min(width-padding, height-padding) / 2;
var color = d3.scaleOrdinal(d3.schemeCategory10);

var svg = d3.select(".container")
.append('svg')
.attr('class', 'pie')
.attr('width', width)
.attr('height', height);

var g = svg.append('g')
.attr('transform', 'translate(' + (width/2) + ',' + (height/2) + ')');

var arc = d3.arc()
.innerRadius(0)
.outerRadius(radius);

var pie = d3.pie()
.value(function(d) { return d.value; })
.sort(null);

var path = g.selectAll('path')
  .data(pie(data))
  .enter()
  .append("g")  
  .append('path')
  .attr('d', arc)
  .attr('fill', (d,i) => color(i))
  .style('opacity', opacity)
  .style('stroke', 'white')
  .on("mouseover", function(d) {
      d3.selectAll('path')
        .style("opacity", otherOpacityOnHover);
      d3.select(this) 
        .style("opacity", opacityHover);
      tooltip.style("opacity","1")
        .style("left",d3.event.pageX+10+"px")
        .style("top",d3.event.pageY+10+"px");
        tooltip.html("Number of Requests:"+d.data.value+"</br>School:"+d.data.parameter);
      
    })
  
  .on("mouseout", function(d) {   
     tooltip.style("opacity","0");
     tooltip.html("");
    })
  .on("touchstart", function(d) {
      d3.select("svg")
        .style("cursor", "none");    
  })
  .each(function(d, i) { this._current = i; });

let legend = d3.select(".container").append('div')
			.attr('class', 'legend')
			.style('margin-top', '30px');

let keys = legend.selectAll('.key')
			.data(data)
			.enter().append('div')
			.attr('class', 'key')
			.style('display', 'flex')
			.style('align-items', 'center')
			.style('margin-right', '20px');

		keys.append('div')
			.attr('class', 'symbol')
			.style('height', '10px')
			.style('width', '10px')
			.style('margin', '5px 5px')
			.style('background-c\olor', (d, i) => color(i));

		keys.append('div')
			.attr('class', 'name')
			.text(d => `${d.parameter} (${d.value})`);

		keys.exit().remove();
}
    
function tabulate(data, columns) {
        
		var table = d3.select('.container').append('table').attr("id","requeststable").attr("x","100");
		var thead = table.append('thead');
		var tbody = table.append('tbody');
                // append the header row
		thead.append('tr')
		  .selectAll('th')
		  .data(columns).enter()
		  .append('th')
		    .text(function (column) { return column; });

		// create a row for each object in the data
		var rows = tbody.selectAll('tr')
		  .data(data)
		  .enter()
		  .append('tr');

		// create a cell in each row for each column
		var cells = rows.selectAll('td')
		  .data(function (row) {
		    return columns.map(function (column) {
		      return {column: column, value: row[column]};
		    });
		  })
		  .enter()
		  .append('td')
		    .text(function (d) { return d.value; });
               

	  return table;
          
	}

	// render the table(s)
	 // 2 column table

hidden=0;
//$(".rectangle").hide();
//$(".linex").hide();
//$(".circlex").hide();