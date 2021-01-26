import React, { Component } from "react";
import { render } from 'react-dom';
import axios from 'axios';
import HighchartsReact from 'highcharts-react-official';
import Highcharts from 'highcharts';
 
class OptionFutureChart extends React.Component {
  constructor(props) {
    super(props);
    var dur=$('.nested_tab').find('a.active').data("filter");
    this.state = {
      // To avoid unnecessary update keep all options in the state.
        chartOptions: {
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
          xAxis: {
                type: 'datetime',
                crosshair: {
                    width: 1,
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
          
            //         min: Math.min(y_min),
            //         max: Math.max(y_max),
             gridLineWidth: 0.5,
  
          },{
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
            }],

          series: [{
            name: 'Price',
            data:[],
            color: '#295D8A',
            fillColor: {
              linearGradient: [0, 0, 0, 300],
              stops: [
                [0, '#F2F9FF'],
                [1, '#F2F9FF']
              ]
            },
            showInLegend: false,
            id: 'dataseries'
    
          }],
          credits: {
                text: '',
                href: '',
                position: {
                    align: 'right',
                    x: -20,
                    y:-275
                }
          },
          
          plotOptions: {
            series: {
              point: {
                events: {
                  mouseOver: this.setHoverData.bind(this)
                }
              }
            }
          }
        },
        hoverData: null,
      };
    }
    componentDidMount(){
        this.getData();
    }
   
  	getData(){
      	var dur=$('.nested_tab').find('a.active').data("filter");
      	var selli=$('.nested_tab').find('a.active').data("element");
     	  var resp_div=$('.nested_tab').find('a.active').data("chart-element");
      	const data = new FormData();
        // var apiExchg =$('#ajax-load-api-data').data('apiexchg');
          // finCode: $('#ajax-load-api-data').data('fincode'),
        if($(document).find('#ddlCompanySymble').length){
          var symbol =$('#ddlCompanySymble').find(':selected').attr('data-symble');
        }
        if($(document).find('#ddlCompanySymbleTpl').length){
          var symbol =$('#ddlCompanySymbleTpl').val();
        }
        symbol =(symbol)?symbol:'TCS';
        var instName =$('#companyInstName').val();
        var expDate =$('#ExpiryDate').val();
      	data.append('dur', dur);
      	// data.append('apiExchg', apiExchg);
      	data.append('symbol', symbol);
        data.append('instName', instName);
        data.append('expDate', expDate);
      	data.append('action', 'get_derivative_company_graph_data');
      	data.append('nonce', global_vars.ajax_nonce);

      	axios.post(global_vars.apiServerUrl + '/api/derivative-company-graph', data)
        .then(response => {
           var result = response.data.stocks;
            var graphDataArray=[];
            var dt1=[];
            var x_data=[];
            // console.log(response.data);
            $.each(result.g1, function(k, v) {
              // console.log(v);
              var spl = v.date.split("-");
              // console.log(spl);
              var y = spl[0];
              var m = spl[1] - 1;
              var d = spl[2];
              var h =0;
              var i =0; 
              if(spl[3] != undefined){
                h = spl[3];
              }
              if(spl[4] != undefined){
                i = spl[4];
              }
              if(dur == '1D' || dur == '1W'){
                  var newDate=spl[1]+"/"+spl[2]+"/"+spl[0]+" "+h+":"+i;
              }else{
                  var newDate=spl[1]+"/"+spl[2]+"/"+spl[0];  
              }
              // console.log(newDate);
              dt1.push(new Date(newDate).getTime());
              x_data.push(parseFloat(v.value));
              var rowValue = [new Date(newDate).getTime(),
                  parseFloat(v.value),
                  parseFloat(v.price), 
                    parseFloat(v.open),
                    parseFloat(v.high),
                    parseFloat(v.low),
                    parseFloat(v.close),
                    parseFloat(v.volume)];
              graphDataArray.push(rowValue);
            });
            console.log(graphDataArray);
            var y_min = Math.min.apply(null, x_data);
            var y_max = Math.max.apply(null, x_data);
            this.setState({ 
              chartOptions: {
                yAxis: [
                  {
                    gridLineColor: '#EBEBEB',
                    startOnTick: false,
                    min: Math.min(y_min),
                    max: Math.max(y_max),
                    gridLineWidth: 0.5,
                  },
                ],
                series: [
                  { data:graphDataArray}
                ]
              }
            }); 
             $('#'+resp_div).prev('.fb-loader').remove();
        })
        .catch(error =>  {
             $('#'+resp_div).prev('.fb-loader').remove();
        });
     
  }

  setHoverData(e) { 
    var month_arr = ['Jan','Feb','Mar','Apr','May','Jun','July','Aug','Sept','Oct','Nov','Dec'];
    // var date_obj=new Date(e.target.series.userOptions.data[e.target.index][0])
    // console.log(e.target);
    var date_obj=new Date(e.target.category);
    $('.details_container').show();
    var dur=$('.nested_tab').find('a.active').data("filter");
    if(dur == '1D' || dur == '1W'){
      var overvol= e.target.series.userOptions.data[e.target.index][7];
      $("#mouseoverDate").html(date_obj.getDate()+' '+month_arr[date_obj.getMonth()]+' '+date_obj.getFullYear());
      $("#openVal").hide();
      $("#highVal").hide();
      $("#lowVal").hide();
      $("#closeVal").hide();
      $("#mouseovervol").html(overvol);
    }else{
      var openVal= e.target.series.userOptions.data[e.target.index][3];
      var highVal= e.target.series.userOptions.data[e.target.index][4];
      var lowVal= e.target.series.userOptions.data[e.target.index][5];
      var closeVal= e.target.series.userOptions.data[e.target.index][6];
      var overvol= e.target.series.userOptions.data[e.target.index][7];
      $("#openVal").show();
      $("#highVal").show();
      $("#lowVal").show();
      $("#closeVal").show();
      $("#mouseoverDate").html(date_obj.getDate()+' '+month_arr[date_obj.getMonth()]+' '+date_obj.getFullYear());
      $('#mouseoveropenVal').show().html(openVal);
      $('#mouseoverhighVal').show().html(highVal);
      $('#mouseoverlowVal').show().html(lowVal);
      $('#mouseovercloseVal').show().html(closeVal);
      $('#mouseovervol').show().html(overvol);
    }
  }
  render() {
    const { chartOptions, hoverData } = this.state;
    return (
        <HighchartsReact
          highcharts={Highcharts}
          options={chartOptions}
        />
    )
  }
}
export default OptionFutureChart;
