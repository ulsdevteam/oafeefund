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
var dataArray=document.getElementById("para").innerHTML;

dataArray=JSON.parse(dataArray);
dataArray=replaceEmpty(dataArray);
dataArray=addIndex(dataArray);
$("#para").hide();

createGraph(dataArray);
createPie(dataArray);
var tooltip = d3.select("body").append("div").attr("id","ttip").style("opacity","0").style("position","absolute");


function addIndex(){
for(i=0;i<dataArray.length;i++){
    dataArray[i]["Index(X-axis)"]=i+1;
}
return dataArray;
}

function replaceEmpty(data){
    var school=[]

    for(i=0;i<data.length;i++)
    {
        if(data[i].school==""){
            data[i].school="Unknown";
        }
    }
    return data;
    console.log(school);
}

function getCount(d){
    return d.count;
}
function getMax(data){
    max=data[0];
    for(i=0;i<data.length;i++){
        val=getCount(data[i]);
        console.log("curr"+data[i].count+"max"+max.count);
        if(parseInt(data[i].count)>parseInt(max.count)){
        max=data[i];
        console.log("Change-curr"+data[i].count+"max"+max.count);
    }
    }
    return max.count;
}
function getMaxSchool(data){
    max=data[0];
    for(i=0;i<data.length;i++){
        val=getCount(data[i]);
        console.log("curr"+data[i].count+"max"+max.count);
        if(parseInt(data[i].count)>parseInt(max.count)){
        max=data[i];
        console.log("Change-curr"+data[i].count+"max"+max.count);
    }
    }
    return max.school;
}

function getSchools(data){
    var school=[]

    for(i=0;i<data.length;i++)
    {
        school.push(data[i].school);
    }
    return school;
    console.log(school);
}
function getEmptySchools(data){
    var school=[]

    for(i=0;i<data.length;i++)
    {
            school.push(i+1);
    }
    return school;
    console.log(school);
}
function createGraph2(dataArray){
    var svg=d3.select(".container").append("svg").attr("height","1000").attr("width","2000").attr("id","graph");
    var margin={left:50,right:50,top:40,bottom:0};

    val=getMax(dataArray);
    var y= d3.scaleLinear()  // Which type of scale?
            .domain([0,parseInt(val)])
            .range([getMax(dataArray)*8,0]);


    var yAxis = d3.axisLeft(y).ticks(5); // Axis generator

    var x= d3.scaleBand()  // Which type of scale? scaleOrdinal/ scalePoint/ scaleBands
            .domain(getSchools(dataArray))
            .range([50,50*(dataArray.length+1)])
            .paddingInner(0);

    var xAxis = d3.axisBottom(x); 
    /*svg.selectAll("circle")
    .data(dataArray)
    .enter().append("circle")
    .attr("cx","300")
    .attr("cy",function(d,i){ return 220+(i*20);})
    .attr("r","5")
    .text("School 1");*/

    var chartGroup= svg.append("g").attr("transform","translate("+margin.left+","+margin.top+")");

    chartGroup.selectAll("circle")
    .data(dataArray)
    .enter().append("circle")
    .attr("class","circlex")
    .attr("cx",function(d,i){ return 50*(i+1);})
    .attr("cy",function(d,i){ return y(getCount(d));})
    .attr("transform","translate(25,0)")  // Move the circles and path to the axis point.
    .attr("r","5");


    var line= d3.line()
            .x(function(d,i){ return 50*(i+1);})
            .y(function(d,i){ return y(getCount(d));}) 
            .curve(d3.curveCardinal);
            //.curve(d3.curveStep);

    chartGroup.append("path")
            .attr("fill","none")
            .attr("class","linex")
            .attr("stroke","gold")
            .attr("transform","translate(25,0)") // Move the circles and path to the axis point.
            .attr("d",line(dataArray));

    chartGroup.selectAll("rect")
    .data(dataArray)
    .enter().append("rect")
    .attr("class","rectangle")
    .attr("height",function(d,i){ return (getCount(d)*8);})
    .attr("width","40")
    .attr("x",function(d,i){ return 50*(i+1);})
    .attr("y",function(d,i){ return y(getCount(d));})
    .on("mouseover",function(d){
        tooltip.style("opacity","1")
        .style("left",d3.event.pageX+10+"px")
        .style("top",d3.event.pageY+10+"px");
        $(this).css({"fill": "#d4b66c"});
        tooltip.html("Number of Requests:"+d.count+"</br>School:"+d.school);
    }).
    on("mouseout",function(d){
        tooltip.style("opacity","0");
        $(this).css({"fill": "#15848F"});
        tooltip.html("");
    });

    chartGroup.append("text")
    .attr("x","50")
    .attr("y","600")
    .attr("fill","black")
    .attr("font-size","40")
    .text("Max requests: "+getMax(dataArray)+" School: "+getMaxSchool(dataArray));

    chartGroup
            .append("g")
            .attr("class","axis x")
            .attr("transform","translate("+0+","+getMax(dataArray)*8+")")
            .attr("class","x-ax")
            .call(xAxis);
    chartGroup.selectAll("text")
            .attr("transform","translate(12.5,200),rotate(90)")
            .attr("font-size","20");
        chartGroup
            .append("g")
            .attr("class","axis y")
            .call(yAxis);
    /*chartGroup.append("text")
            .attr("id","requeststabletext")
            .attr("x","50")
            .attr("y","700")
            .attr("fill","black")
            .attr("font-size","40")
            .text("Tabular representation:");*/
    //tabulate(dataArray, ['Index(X-axis)','school', 'count'])
}
function createGraph(dataArray){
    
    
    
    var svg=d3.select(".container").append("svg").attr("height","1400").attr("width","2000").attr("id","graph");
    var margin={left:400,right:50,top:40,bottom:0};

    val=getMax(dataArray);
    
    var y= d3.scaleBand()  // Which type of scale?
            .domain(getSchools(dataArray))
            .range([30,30*(dataArray.length+1)])
            .paddingInner(0);


    var yAxis = d3.axisLeft(y); // Axis generator
    val=getMax(dataArray);
    var x= d3.scaleLinear()  // Which type of scale? scaleOrdinal/ scalePoint/ scaleBands
            .domain([0,val])
            .range([0,((dataArray.length+1)*35)]);

    var xAxis = d3.axisBottom(x); 
    /*svg.selectAll("circle")
    .data(dataArray)
    .enter().append("circle")
    .attr("cx","300")
    .attr("cy",function(d,i){ return 220+(i*20);})
    .attr("r","5")
    .text("School 1");*/
    var chartGroup= svg.append("g").attr("transform","translate("+margin.left+","+margin.top+")");
    
    
    svg.append("text")
            .attr("id","reports")
    .attr("x","30")
    .attr("y","30")
    .attr("fill","black")
    .attr("font-size","40")
    .text("Reports");
    
    
     chartGroup.selectAll("rect")
                            .data(dataArray)
                            .enter().append("rect")
                            .attr("class","rectangle")
                            .attr("height","20")
                            .attr("width",function(d,i){ return 0;})
                            .attr("x",function(d,i){ return 1;})
                            .attr("y",function(d,i){ return 30*(i+1);})
                            .on("mouseover",function(d){
                                tooltip.style("opacity","1")
                                .style("left",d3.event.pageX+10+"px")
                                .style("top",d3.event.pageY+10+"px");
                                $(this).css({"fill": "#d4b66c"});
                                tooltip.html("Number of Requests:"+d.count+"</br>School:"+d.school);
                            }).
                            on("mouseout",function(d){
                                tooltip.style("opacity","0");
                                $(this).css({"fill": "#15848F"});
                                tooltip.html("");
                            });
    var transit = d3.select("svg").selectAll("rect")
            .data(dataArray)
            .transition()
            .duration(2000)
            .attr("width",function(d,i){ return x(getCount(d));})

    chartGroup
            .append("g")
            .attr("class","axis x 1")
            .attr("class","x-ax")
            .call(xAxis);
    
    chartGroup
            .append("g")
            .attr("class","axis x 2")
            .attr("transform","translate("+0+","+30*(dataArray.length+1)+")")
            .attr("class","x-ax")
            .call(xAxis);

        chartGroup
            .append("g")
            .attr("class","axis y")
            .call(yAxis);
    
        chartGroup.selectAll("text")
            .select(".tick")
            .attr("font-size","30");
    chartGroup.append("text")
    .attr("font-size","40");
        chartGroup.append("text")
                .attr("id","max")
    .attr("x","50")
    .attr("y",30*(dataArray.length+4))
    .attr("fill","black")
    .attr("font-size","40")
    .text("Max requests: "+getMax(dataArray)+" School: "+getMaxSchool(dataArray));
    chartGroup.append("text")
            .attr("id","requeststabletext")
            .attr("x","0")
            .attr("y","1200")
            .attr("fill","black")
            .text("Tabular representation:");
   // tabulate(dataArray, ['Index(X-axis)','school', 'count'])
}
function createPie(data){
    d3.select("svg").remove();

    
var text = "";

var width = 1200;
var height = 1200;
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
.value(function(d) { return d.count; })
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
        tooltip.html("Number of Requests:"+d.data.count+"</br>School:"+d.data.school);
      
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
			.text(d => `${d.school} (${d.count})`);

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