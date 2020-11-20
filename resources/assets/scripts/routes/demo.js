// import {HighchartGraph}  from '../library/highchartgraph';
import React, { Component } from "react";
import ReactDOM from 'react-dom';
// import HighchartsReact from 'highcharts-react-official';
import ReactHighcharts from 'react-highcharts';

// import Highcharts from 'https://code.highcharts.com/stock/highstock.js';
export default {
    init() {
      (function($) {
        function get_stock_graph_dummy(){
          var config = {

              title: {
                  text: 'Solar Employment Growth by Sector, 2010-2016'
              },

              subtitle: {
                  text: 'Source: thesolarfoundation.com'
              },

              yAxis: {
                  title: {
                      text: 'Number of Employees'
                  }
              },

              xAxis: {
                  accessibility: {
                      rangeDescription: 'Range: 2010 to 2017'
                  }
              },

              legend: {
                  layout: 'vertical',
                  align: 'right',
                  verticalAlign: 'middle'
              },

              plotOptions: {
                  series: {
                      label: {
                          connectorAllowed: false
                      },
                      pointStart: 2010
                  }
              },

              series: [{
                  name: 'Installation',
                  data: [43934, 52503, 57177, 69658, 97031, 119931, 137133, 154175]
              }, {
                  name: 'Manufacturing',
                  data: [24916, 24064, 29742, 29851, 32490, 30282, 38121, 40434]
              }, {
                  name: 'Sales & Distribution',
                  data: [11744, 17722, 16005, 19771, 20185, 24377, 32147, 39387]
              }, {
                  name: 'Project Development',
                  data: [null, null, 7988, 12169, 15112, 22452, 34400, 34227]
              }, {
                  name: 'Other',
                  data: [12908, 5948, 8105, 11248, 8989, 11816, 18274, 18111]
              }],

              responsive: {
                  rules: [{
                      condition: {
                          maxWidth: 500
                      },
                      chartOptions: {
                          legend: {
                              layout: 'horizontal',
                              align: 'center',
                              verticalAlign: 'bottom'
                          }
                      }
                  }]
              }
          };
        
          return config;
        };
        var config= get_stock_graph_dummy();
        function get_stock_graph_data(){
          var config={};
           var dur ='1Y';
          var apiExchg ="NSE";
          var finCode ="100180";
          var self    = this; 
          $.ajax({
            cache: false,
              url: 'https://api.top10stockbroker.com/api/company-graph',
              type: "post",
              dataType: "json",
              data: {
                  'action':'get_company_graph_data',
                  // 'api_action':'get_company_graph_data',
                  'dur':dur,
                  'apiExchg':apiExchg,
                  'finCode':finCode,
              },
              success: function(t){
                 var n50d = [];
                var temp = [];
                var x_open = [];
                var x_high = [];
                var x_low = [];
                var x_close = [];
                var x_volume = [];
                var x_data = [];
                var temp_stat = [];
                var temp_vol = [];
                var i = 0;
                var first_val_1 = 0;
                var dt1 = [];
                var navval = [];
                var dividend = [];
                var bonus = [];
                var rights = [];
                var splits = [];
                var news =[];
                $.each(t.newsdata, function(k, v) {
                  var newsdate = v.graphdate.split(",");
                  var y = newsdate[0];
                  var m = newsdate[1] - 1;
                  var d = newsdate[2];
                  var newDate=newsdate[1]+"/"+newsdate[2]+"/"+newsdate[0];
                  news.push({x : parseInt(new Date(newDate).getTime()), title:'N', text:v.desc});
                });

                $.each(t.data, function(k, v) {


                  if(k == 'dividends')
                  {
                      $.each(v, function(ky, val) {
                          var divdate = val.date.split(",");
                          var y = divdate[0];
                          var m = divdate[1] - 1;
                          var d = divdate[2];
                          var newDate=divdate[1]+"/"+divdate[2]+"/"+divdate[0];
                          dividend.push({x : parseInt(new Date(newDate).getTime()), title:'D', text:val.ratio});
                      });
                  }
                  
                  if(k == 'bonus')
                  {
                      $.each(v, function(ky, val) {
                          var bondate = val.date.split(",");
                          var y = bondate[0];
                          var m = bondate[1] - 1;
                          var d = bondate[2];
                          var newDate=bondate[1]+"/"+bondate[2]+"/"+bondate[0];
                          bonus.push({x : parseInt(new Date(newDate).getTime()), title:'B', text:val.ratio});
                      });
                  }
                  if(k == 'rights')
                  {
                      $.each(v, function(ky, val) {
                          var rightsdate = val.date.split(",");
                          var y = rightsdate[0];
                          var m = rightsdate[1] - 1;
                          var d = rightsdate[2];
                          var newDate=rightsdate[1]+"/"+rightsdate[2]+"/"+rightsdate[0];
                          rights.push({x : parseInt(new Date(newDate).getTime()), title:'R', text:val.ratio});
                      });
                  }
                  if(k == 'splits')
                  {
                      $.each(v, function(ky, val) {
                          var splitssdate = val.date.split(",");
                          var y = splitssdate[0];
                          var m = splitssdate[1] - 1;
                          var d = splitssdate[2];
                          var newDate=splitssdate[1]+"/"+splitssdate[2]+"/"+splitssdate[0];
                          splits.push({x : parseInt(new Date(newDate).getTime()), title:'S', text:val.ratio});
                      });
                  }
                });
                var month_arr = ['Jan','Feb','Mar','Apr','May','Jun','July','Aug','Sept','Oct','Nov','Dec']
          
                var datalow = 0; 
                var datahigh = 0; 
                var datalowdate = 0; 
                var datahighdate = 0; 
              $.each(t.g1, function(k, v) {
                var spl = v.date.split("-");
                var y = spl[0];
                var m = spl[1] - 1;
                var d = spl[2];
                var h = spl[3]? spl[3] : 0;
                var i = spl[4]? spl[4] : 0;

                //var gtime = parseInt(Date.UTC(y, m, d, h, i));
                if(dur == '1D' || dur == '1W'){
                  var newDate=spl[1]+"/"+spl[2]+"/"+spl[0]+" "+spl[3]+":"+spl[4];
                }else{
                  var newDate=spl[1]+"/"+spl[2]+"/"+spl[0];  
                }
                dt1.push(new Date(newDate).getTime());

                  x_data.push(parseFloat(v.value));
                  x_open.push(parseFloat(v.open));
                  x_high.push(parseFloat(v.high));
                  x_low.push(parseFloat(v.low));
                  x_close.push(parseFloat(v.close));
                  x_volume.push(parseInt(v.volume));
                  if (v.low !== null) {
                      if(datalow > parseFloat(v.low) && k!=0){
                          datalow = parseFloat(v.low);
                          datalowdate = dt1[k];
                      }else if(k==0){
                          datalow = parseFloat(v.low);    
                          datalowdate = dt1[k];
                      }
                  }
                  if (v.high !== null) {
                      if(datahigh < parseFloat(v.high) && k!=0){
                          datahigh = parseFloat(v.high);
                          datahighdate = dt1[k];
                      }else if(k==0){
                          datahigh = parseFloat(v.high);    
                          datahighdate = dt1[k];
                      }
                  }
              });
              first_val_1 = x_data[0]
        
              for (var k = 0; k < x_data.length; k++) {
                navval.push(x_data[k]);
                //x_data[k] = ((x_data[k] - first_val_1) / first_val_1) * 100;
                var ttt = [dt1[k], x_data[k], x_open[k], x_high[k], x_low[k], x_close[k], x_volume[k]];
                var tttvol = [dt1[k], x_volume[k]];
                temp_stat.push(ttt)
                temp_vol.push(tttvol)
              }
              var y_min = Math.min.apply(null, x_data);
              var y_max = Math.max.apply(null, x_data);

              var width = window.innerWidth || document.documentElement.clientWidth;
              var width = 500;

              var config ={
                chart: {
                  borderColor: '#EBBA95',
                    type: 'areaspline',
                    zoomType: false,
                    backgroundColor: 'white',
                    panning: false,
                    events:{
                      load: function () {
                          this.renderer.image('https://top10stockbroker.com/wp-content/uploads/2017/11/cropped-cropped-logo-web-1.png',950,-9,160,50).attr({
                              zIndex: 1,
                              id:"credit_img"
                          }).add();
                          $("#credit_img").click(function() {
                              window.open("https://top10stockbroker.com");
                          });
                      }
                  },
                },
           
            title: {
              text: ''
            },
            subTitle: {
              text: ''
            },
    
            xAxis: {
                type: 'datetime',
                crosshair: {
                    width: 1,
                    //color: '#56BBFF',
                   color: '#F2A028',
                    zIndex:'1000',
                    snap:true
                },
                labels: {
                    style: {
                      color: 'black'
                    }
                },
                ordinal: true,
                minTickInterval: (dur!='1D') ? (dur=='1W'? 24 * 3600 * 1000 : 24 * 3600 * 1000 * 30) : ''
            },
            yAxis: [{
              title: {
                //text: (width < 768 ? '' : 'Price')
                text: ''
              },
              labels: {
                    x: 20,
                    y:-2,
                    style: {
                  color: 'black'
                }
                      },
              crosshair: {
                width: 1,
                color: '#F2A028',
                zIndex:'1000',
                snap:true
              },
              gridLineColor: '#EBEBEB',
                    startOnTick: false,
            
                      min: Math.min(y_min),
                      max: Math.max(y_max),
                      //gridLineWidth: 0.5,
    
            },
            {
                  title: {
                      text: ''
                  },
                  id: "y_axis_0",
                  labels: {
                      x: 20,
                      y: 10,
                      enabled: false
                  },
                  top: '100%',
                  height: '20%',
                  offset: 0,
                  //lineWidth: 2
              }]
            ,
           credits: {
                text: '',
                href: '',
                position: {
                    align: 'right',
                    x: -20,
                    y:-275
                }
            },
            tooltip: {
              //borderColor: null,
              pointFormatter: function() {
                var point = this;
                var date_obj=new Date(point.x)
                if(dur == '1D' || dur == '1W'){
                    $('.details_container').show(); 
                    $("#mouseoverDate").html(date_obj.getDate()+' '+month_arr[date_obj.getMonth()]+' '+date_obj.getFullYear());
                    $("#openVal").hide();
                    $("#highVal").hide();
                    $("#lowVal").hide();
                    $("#closeVal").hide();
                    $("#mouseovervol").html(temp_stat[point.index][6]);
                } else{
                    $('.details_container').show();
                    $("#mouseoverDate").html(date_obj.getDate()+' '+month_arr[date_obj.getMonth()]+' '+date_obj.getFullYear());
                    $("#mouseoveropenVal").html(temp_stat[point.index][2].toFixed(2));
                    $("#mouseoverhighVal").html(temp_stat[point.index][3].toFixed(2));
                    $("#mouseoverlowVal").html(temp_stat[point.index][4].toFixed(2));
                    $("#mouseovercloseVal").html(temp_stat[point.index][5].toFixed(2));
                    $("#mouseovervol").html(temp_stat[point.index][6]);

                    $("#openVal").show();
                    $("#highVal").show();
                    $("#lowVal").show();
                    $("#closeVal").show();
                }
                if(point.series.name == 'High'){
                    return '<span style="color:' + point.color + '">\u25CF</span> ' + point.series.name + ': ' + datahigh.toFixed(2) + '';
                }else if(point.series.name == 'Low'){
                    return '<span style="color:' + point.color + '">\u25CF</span> ' + point.series.name + ': ' + datalow.toFixed(2) + '';
                }else if(point.series.name == 'Dividend' || point.series.name == 'Bonus' || point.series.name == 'Rights' || point.series.name == 'splits'){
                    return '<span tyle="color:' + point.color + '">\u25CF</span> ' + point.series.name + ': ' + point.series.data[point.index].text + '';
                }else if(point.series.name == 'News'){
                    return '<span style="color:' + point.color + '">\u25CF</span> ' + point.series.name + ': ' + point.series.data[point.index].text + '';
                }else if(point.series.name == 'Volume'){
                    return '<span style="color:' + point.color + '">\u25CF</span> Volume: ' + point.y.toFixed(2) + '';
                }else{
                    return '<span style="color:' + point.color + '">\u25CF</span> Price: ' + point.y.toFixed(2) + '';
                }
                
              }
            },
            
            legend: {
              layout: 'horizontal',
              // floating: true,
              y: 20,
            },
            plotOptions: {
              line: {
                marker: {
                  enabled: false
                }
              },
              areaspline: {
                marker: {
                  enabled: false
                }
              }
            },
            series: [{
              name: 'Stock Graph',
              data: temp_stat,
              //absoluteY:
              color: '#295D8A',
            fillColor: {
                    linearGradient: [0, 0, 0, 300],
                    stops: [
                        [0, '#F2F9FF'],
                        [1, '#F2F9FF']
                        //[0, '#48f9b4'],
                        //[1, '#13e6ff']
                    ]
                },
                showInLegend: false,
                id: 'dataseries'
    
            },
            {
                  type: 'column',
                  name: 'Volume',
                  id:'dataseries',
                  data: temp_vol,
                  color: '#0066CC',
                  yAxis: 'y_axis_0',
                  dataGrouping: {
                      enabled: false,
                  }
            },
            {
                type: 'flags',
                name: 'High',
                data: [{
                    x: datahighdate ,
                    title: 'H'
                }],
                onSeries: 'dataseries',
                shape: 'squarepin',
                showInLegend: false,
            },
            {
                type: 'flags',
                name: 'Low',
                data: [{
                    x: datalowdate,
                    title: 'L'
                }],
                onSeries: 'dataseries',
                shape: 'squarepin',
                showInLegend: false,
            },
            {
                type: 'flags',
                name: 'Dividend',
                data: dividend,
                onSeries: 'dataseries',
                shape: 'squarepin',
                showInLegend: false,
            },
            {
                type: 'flags',
                name: 'Bonus',
                data: bonus,
                onSeries: 'dataseries',
                shape: 'squarepin',
                showInLegend: false,
            },
            {
                type: 'flags',
                name: 'Rights',
                data: rights,
                onSeries: 'dataseries',
                shape: 'squarepin',
                showInLegend: false,
            },
            {
                type: 'flags',
                name: 'splits',
                data: splits,
                onSeries: 'dataseries',
                shape: 'squarepin',
                showInLegend: false,    
            },
            {
                type: 'flags',
                name: 'News',
                data: news,
                onSeries: 'dataseries',
                shape: 'squarepin',
                showInLegend: false,
            }],
            
          };
                 console.log(config);

                 ReactDOM.render(<ReactHighcharts config = {config}></ReactHighcharts>, oneyearchart);

              },
              error: function(response){
                console.log('Module Data Error.'); 
              }
          });

            return config;
        }
         //var config= get_stock_graph_data();
        console.log(config);
        ReactDOM.render(<ReactHighcharts config = {config}></ReactHighcharts>, oneyearchart);


      }).apply(this, [jQuery]);


    },
    finalize() {
     
  },
};
