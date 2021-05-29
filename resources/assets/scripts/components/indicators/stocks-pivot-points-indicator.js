import React, { Component } from "react";
import ReactDOM from 'react-dom';
import Chip from '@material-ui/core/Chip';
import MUIDataTable, { TableFilterList } from "mui-datatables";
import axios from 'axios';
import ContentLoader from "react-content-loader";
import { Select, MenuItem, Button,InputLabel,FormControl, CircularProgress} from "@material-ui/core"; 
import { useState,setState } from "react";
import CustomToolbar from "./custom-toolbar";
import CustomSearchRender from "./customSearchRender";

class StocksPivotPointsIndicator extends React.Component {
    constructor(props){
        super(props);
        this.state = {
            isRefreshing : false,
            error : null,
            isLoaded : false,
            columns:[],
            lists : [],
            selectedFilter:'All',       
            tableFilterOptions:[
                { name: "Resistance 1" },
                { name: "Support 1" },
                { name: "Resistance 2" },
                { name: "Support 2" },
                { name: "Resistance 3" },
                { name: "Support 3" },
                { name: "Sentiment - Bullish" },
                { name: "Sentiment - Bearish" },
                { name: "Sentiment - Neutral" },
                { name: "Trade - Buy" },
                { name: "Trade - Sell" },
                { name: "Trade - Hold" },
              ]    
        };
       // this.onFilterChange = this.onFilterChange.bind(this);
 
    }
   
    componentDidMount(){
      this.getColumns();
      this.getData();
      var self =this;
      var funCallIdx=1;
        var myVar = setInterval(function(){
            funCallIdx++;
            if(funCallIdx >5){
              clearInterval(myVar);
            }
            self.getMoreData(funCallIdx);
        },100,funCallIdx,self);
    }
    getColumns(){
      const columns = [
        {
            name: "Stock",
            label: "Stock",
            options: {
              filter: false,
              sort: true,
              customBodyRender: (value, tableMeta, updateValue) => {
                return (
                  <a href={tableMeta.rowData[12]} title={value}>{value}</a>
                );
              }
            }
        },
        {
            name: "Pivot_Point",
            label: "Pivot Point",
            options: {
              filter: false,
              sort: true,
            }
        },
        // {
        //     name: "Open",
        //     label: "Open",
        //     options: {
        //      filter: false,
        //      sort: false,
        //     }
        // },
        // {
        //     name: "High",
        //     label: "High",
        //     options: {
        //      filter: false,
        //      sort: false,
        //     }
        // },
        // {
        //     name: "Low",
        //     label: "Low",
        //     options: {
        //      filter: false,
        //      sort: false,
        //     }
        // },
        {
            name: "LTP",
            label: "LTP",
            options: {
             filter: false,
             sort: true,
            }
        },
        {
            name: "Change_pre",
            label: "Change%",
            options: {
             filter: false,
             sort: true,
            }
        },
        {
            name: "Resistance_1",
            label: "Resistance 1",
            options: {
              filter: false,
              sort: true,
              filterOptions:{
                logic: (Resistance_1, filters, row) => {
                  if (filters.length){
                    return (row[2] < row[4]);
                  }
                  return false;
                },
              }
            }
        },
        {
            name: "Resistance_2",
            label: "Resistance 2",
            options: {
              filter: false,
              sort: true,
              filterOptions:{
                logic: (Resistance_2, filters, row) => {
                  if (filters.length){
                    return (row[2] < row[5]);
                  }
                  return false;
                },
              }
            }
        },
        {
            name: "Resistance_3",
            label: "Resistance 3",
            options: {
              filter: false,
              sort: true,
              filterOptions:{
                logic: (Resistance_3, filters, row) => {
                  if (filters.length){
                    return (row[2] < row[6]);
                  }
                  return false;
                },
              }
            }
        },
        {
            name: "Support_1",
            label: "Support 1",
            options: {
              filter: false,
              sort: true,
              filterOptions:{
                logic: (Support_1, filters, row) => {
                  if (filters.length){
                    return (row[2] > row[7]);
                  }
                  return false;
                },
              }
            }
        },
        {
            name: "Support_2",
            label: "Support 2",
            options: {
              filter: false,
              sort: true,
              filterOptions:{
                logic: (Support_2, filters, row) => {
                  if (filters.length){
                    return (row[2] > row[8]);
                  }
                  return false;
                },
              }
            }
        },
        {
            name: "Support_3",
            label: "Support 3",
            options: {
              filter: false,
              sort: true,
              filterOptions:{
                logic: (Support_3, filters, row) => {
                  if (filters.length){
                    return (row[2] > row[9]);
                  }
                  return false;
                },
              }
            }
        },
        {
            name: "Sentiment",
            label: "Sentiment",
            options: {
             filter: false,
             sort: true,
            }
        },
        {
            name: "Trade",
            label: "Trade",
            options: {
             filter: false,
             sort: true,

            }
        },
        {
            name: "post_link",
            label: "",
            options: {
              display:false,
              filter: false,
              sort: true,
               
            }
        },
      ];
      this.setState({
        columns : columns
      });
    }
    getData(){
      // var d= [{"Stock":"Indian Bank","Open":"126.80","High":"143.10","Low":"126.80","LTP":"140.30","Change_pre":"10.78","Pivot_Point":"126.22","Sentiment":"Neutral","Trade":"Sell","Resistance_1":"128.43","Resistance_2":"131.22","Resistance_3":"133.43","Support_1":"123.43","Support_2":"121.22","Support_3":"118.43"},{"Stock":"HFCL","Open":"45.00","High":"50.70","Low":"45.00","LTP":"49.10","Change_pre":"10.59","Pivot_Point":"41.18","Sentiment":"Neutral","Trade":"Sell","Resistance_1":"45.12","Resistance_2":"47.68","Resistance_3":"51.62","Support_1":"38.62","Support_2":"34.68","Support_3":"32.12"},{"Stock":"Jamna Auto","Open":"70.75","High":"79.90","Low":"70.05","LTP":"77.45","Change_pre":"10.33","Pivot_Point":"69.30","Sentiment":"Neutral","Trade":"Sell","Resistance_1":"70.10","Resistance_2":"71.30","Resistance_3":"72.10","Support_1":"68.10","Support_2":"67.30","Support_3":"66.10"},{"Stock":"Motilal Oswal","Open":"751.40","High":"838.00","Low":"751.40","LTP":"812.60","Change_pre":"8.72","Pivot_Point":"728.53","Sentiment":"Neutral","Trade":"Sell","Resistance_1":"740.07","Resistance_2":"751.48","Resistance_3":"763.02","Support_1":"717.12","Support_2":"705.58","Support_3":"694.17"},{"Stock":"Shriram City","Open":"1,750.00","High":"1,917.20","Low":"1,732.30","LTP":"1,868.90","Change_pre":"7.89","Pivot_Point":"1,612.53","Sentiment":"Neutral","Trade":"Sell","Resistance_1":"1,640.67","Resistance_2":"1,662.08","Resistance_3":"1,690.22","Support_1":"1,591.12","Support_2":"1,562.98","Support_3":"1,541.57"},{"Stock":"Varroc Engineering","Open":"393.05","High":"425.00","Low":"386.70","LTP":"419.35","Change_pre":"6.69","Pivot_Point":"379.87","Sentiment":"Neutral","Trade":"Sell","Resistance_1":"387.63","Resistance_2":"397.57","Resistance_3":"405.33","Support_1":"369.93","Support_2":"362.17","Support_3":"352.23"},{"Stock":"JK Lakshmi Cement","Open":"481.00","High":"513.80","Low":"481.00","LTP":"493.55","Change_pre":"5.96","Pivot_Point":"418.28","Sentiment":"Neutral","Trade":"Sell","Resistance_1":"425.22","Resistance_2":"430.93","Resistance_3":"437.87","Support_1":"412.57","Support_2":"405.63","Support_3":"399.92"},{"Stock":"Natco Pharma","Open":"940.00","High":"997.40","Low":"937.00","LTP":"990.05","Change_pre":"5.94","Pivot_Point":"925.45","Sentiment":"Neutral","Trade":"Sell","Resistance_1":"933.90","Resistance_2":"948.35","Resistance_3":"956.80","Support_1":"911.00","Support_2":"902.55","Support_3":"888.10"},{"Stock":"NCC","Open":"83.95","High":"89.25","Low":"83.60","LTP":"88.15","Change_pre":"5.82","Pivot_Point":"78.67","Sentiment":"Neutral","Trade":"Sell","Resistance_1":"80.03","Resistance_2":"80.87","Resistance_3":"82.23","Support_1":"77.83","Support_2":"76.47","Support_3":"75.63"},{"Stock":"PNB Housing Finance","Open":"391.05","High":"421.00","Low":"391.05","LTP":"415.25","Change_pre":"5.72","Pivot_Point":"386.33","Sentiment":"Neutral","Trade":"Sell","Resistance_1":"389.67","Resistance_2":"393.68","Resistance_3":"397.02","Support_1":"382.32","Support_2":"378.98","Support_3":"374.97"},{"Stock":"JM Financial","Open":"80.30","High":"85.90","Low":"79.75","LTP":"84.35","Change_pre":"5.64","Pivot_Point":"80.03","Sentiment":"Neutral","Trade":"Sell","Resistance_1":"80.57","Resistance_2":"81.33","Resistance_3":"81.87","Support_1":"79.27","Support_2":"78.73","Support_3":"77.97"},{"Stock":"BOB","Open":"77.50","High":"81.15","Low":"77.10","LTP":"80.80","Change_pre":"5.62","Pivot_Point":"76.22","Sentiment":"Neutral","Trade":"Sell","Resistance_1":"78.63","Resistance_2":"80.17","Resistance_3":"82.58","Support_1":"74.68","Support_2":"72.27","Support_3":"70.73"},{"Stock":"KNR Construction","Open":"223.00","High":"230.00","Low":"218.65","LTP":"227.75","Change_pre":"5.56","Pivot_Point":"212.42","Sentiment":"Neutral","Trade":"Sell","Resistance_1":"215.73","Resistance_2":"218.02","Resistance_3":"221.33","Support_1":"210.13","Support_2":"206.82","Support_3":"204.53"},{"Stock":"Edelweiss","Open":"61.40","High":"63.95","Low":"61.10","LTP":"63.95","Change_pre":"4.92","Pivot_Point":"61.42","Sentiment":"Neutral","Trade":"Sell","Resistance_1":"62.03","Resistance_2":"62.62","Resistance_3":"63.23","Support_1":"60.83","Support_2":"60.22","Support_3":"59.63"},{"Stock":"Adani Transmission","Open":"1,444.00","High":"1,455.00","Low":"1,415.05","LTP":"1,453.85","Change_pre":"4.91","Pivot_Point":"1,165.63","Sentiment":"Bullish","Trade":"Sell","Resistance_1":"1,235.27","Resistance_2":"1,270.18","Resistance_3":"1,339.82","Support_1":"1,130.72","Support_2":"1,061.08","Support_3":"1,026.17"},{"Stock":"Dishman Carbogen Amcis","Open":"186.00","High":"199.90","Low":"185.05","LTP":"193.55","Change_pre":"4.82","Pivot_Point":"175.03","Sentiment":"Neutral","Trade":"Sell","Resistance_1":"182.17","Resistance_2":"189.13","Resistance_3":"196.27","Support_1":"168.07","Support_2":"160.93","Support_3":"153.97"},{"Stock":"Century Ply","Open":"385.00","High":"406.20","Low":"385.00","LTP":"401.45","Change_pre":"4.76","Pivot_Point":"346.55","Sentiment":"Neutral","Trade":"Sell","Resistance_1":"358.60","Resistance_2":"372.05","Resistance_3":"384.10","Support_1":"333.10","Support_2":"321.05","Support_3":"307.60"},{"Stock":"JB Chemicals","Open":"1,383.00","High":"1,458.00","Low":"1,381.90","LTP":"1,443.00","Change_pre":"4.72","Pivot_Point":"1,383.45","Sentiment":"Neutral","Trade":"Sell","Resistance_1":"1,400.05","Resistance_2":"1,423.90","Resistance_3":"1,440.50","Support_1":"1,359.60","Support_2":"1,343.00","Support_3":"1,319.15"},{"Stock":"GE Power","Open":"255.10","High":"271.65","Low":"255.10","LTP":"266.75","Change_pre":"4.61","Pivot_Point":"260.23","Sentiment":"Neutral","Trade":"Sell","Resistance_1":"263.02","Resistance_2":"267.58","Resistance_3":"270.37","Support_1":"255.67","Support_2":"252.88","Support_3":"248.32"},{"Stock":"Torrent Power","Open":"444.00","High":"465.90","Low":"426.10","LTP":"450.60","Change_pre":"4.61","Pivot_Point":"431.78","Sentiment":"Neutral","Trade":"Sell","Resistance_1":"437.27","Resistance_2":"446.38","Resistance_3":"451.87","Support_1":"422.67","Support_2":"417.18","Support_3":"408.07"}];
      // this.setState({
      //             isLoaded : true,
      //             lists : d
      // });
      const data = new FormData();
        data.append('nonce', global_vars.ajax_nonce);
        data.append('paged',1);
        axios.post(global_vars.apiServerUrl + '/apiblock/main-ppi-stocks-list', data)
          .then(res => {
              const result = res.data;
              this.setState({
                  isLoaded : true,
                  lists : result
              });
               
          })
          .catch(error =>  {
              //console.log(error);
            this.setState({
              isLoaded: true,
              error
            });
        });
    }
    getMoreData(paged,refresh=0){
      const data = new FormData();
        data.append('nonce', global_vars.ajax_nonce);
        data.append('paged',paged);
        axios.post(global_vars.apiServerUrl + '/apiblock/main-ppi-stocks-list', data)
          .then(res => {
              if(refresh){
                var result =[];
              }else{
                var result =this.state.lists;
              }
              
              var per_page =res.data.length;
              for (var i = 0; i < per_page; i++) {
                result.push(res.data[i]);
              }
              this.setState({
                  lists : result,
                  isRefreshing : false
              });
               
          })
          .catch(error =>  {
              //console.log(error);
              this.setState({
                  isRefreshing :false,
                  isLoaded: true,
                  error
            });
        });
    }
    onFilterSelected(event) {
      console.log(event.target.value);
        var value =event.target.value;
        const filteredCols = this.state.columns;
        let filterList = [];
        filteredCols[4].options.filterList =[];
        filteredCols[5].options.filterList =[];
        filteredCols[6].options.filterList =[];
        filteredCols[7].options.filterList =[];
        filteredCols[8].options.filterList =[];
        filteredCols[9].options.filterList =[];
        filteredCols[10].options.filterList =[];
        filteredCols[11].options.filterList =[];
        if (value !== "All") {
          // Resistance 1
          if((value =='Resistance 1' || value =='Resistance 2' || value =='Resistance 3')){
            filterList[0] =value;
            switch(value){
              case 'Resistance 1':
                filteredCols[4].options.filterList = filterList;
                break;
              case 'Resistance 2':
                filteredCols[5].options.filterList = filterList;
                break;
              case 'Resistance 3':
                filteredCols[6].options.filterList = filterList;
                break;
            }
             
          }
          // Support 1
          if((value =='Support 1' || value =='Support 2' || value =='Support 3')){
            filterList[0] =value;
            switch(value){
              case 'Support 1':
                filteredCols[7].options.filterList = filterList;
                break;
              case 'Support 2':
                filteredCols[8].options.filterList = filterList;
                break;
              case 'Support 3':
                filteredCols[9].options.filterList = filterList;
                break;
            }
          }
          // Sentiment Filter
          if((value =='Sentiment - Bullish' || value =='Sentiment - Bearish' || value =='Sentiment - Neutral')){
            if(value =='Sentiment - Bullish'){
                    filterList[0] ='Bullish';
            }
            if(value =='Sentiment - Bearish'){
                    filterList[0] ='Bearish';
            }
            if(value =='Sentiment - Neutral'){
                    filterList[0] ='Neutral';
            }
            filteredCols[10].options.filterList = filterList; 
          }
           // Trade Filter
           if((value =='Trade - Sell' || value =='Trade - Buy' || value =='Trade - Hold')){
                  if(value =='Trade - Sell'){
                    filterList[0] ='Sell';
                  }
                  if(value =='Trade - Buy'){
                    filterList[0] ='Buy';
                  }
                  if(value =='Trade - Hold'){
                    filterList[0] ='Hold';
                  }
                  filteredCols[11].options.filterList = filterList;
          }
              
           
        }
        this.setState({
            selectedFilter: value,
        });
    }
    onRefreshed(){
      console.log('Refresh Button Click');
      var self =this;
      var funCallIdx=1;
       
      this.setState({
        isRefreshing : true,
      });
      var myVar = setInterval(function(){
          var refresh=1;
            if(funCallIdx >5){
              clearInterval(myVar);
            }
            if(funCallIdx !=1){
              refresh =0;
            }
            self.getMoreData(funCallIdx,refresh);
            funCallIdx++;
      },100,funCallIdx,self);
    }
    
    render() {
        const {isRefreshing,error,columns,selectedFilter, isLoaded, lists,tableFilterOptions} = this.state;
        const options = {
            selectableRows: 'none', 
            hasIndex: true, 
            search:false,
            searchOpen:true,
            searchBox: false, 
            csv: false,  
            download:false,
            print:false,
            indexColumn: "fname",  
            rowsPerPage:15,
            fixedSelectColumn:false,
            searchPlaceholder:"Search Stocks",
            selectableRowsHeader:false,
            sortFilterList:false,
            viewColumns:false,
            filter:false,
            customSearchRender: (searchText, handleSearch, hideSearch, options) => {
              return (
                <CustomSearchRender
                  searchText={searchText}
                  onSearch={handleSearch}
                  onHide={hideSearch}
                  options={options}
                />
              );
            },
            customToolbar: () => {
              return (
                <CustomToolbar tableFilterOptions={tableFilterOptions} selectedFilter={selectedFilter} onFilterSelect={this.onFilterSelected.bind(this)} onRefreshClick={this.onRefreshed.bind(this)}/>
              );
            },
            
        };
     
        
        if(error){
            return <div>Error in loading</div>
        }else if (!isLoaded) {
           return (
            <React.Fragment>
              <ContentLoader viewBox="0 0 1000 60" height={60} width={1000}>
            <rect x="0" y="0" rx="3" ry="3" width="1000" height="60" />
            </ContentLoader> 
            </React.Fragment> 
            
            );
        }else if(isRefreshing){
          return (
           <React.Fragment>
           <CircularProgress />
            <MUIDataTable
              title={""}
              data={lists}
              columns={columns}
              options={options}
              
            />
           </React.Fragment>
          );
        }else{
            return (
             <React.Fragment>
              <MUIDataTable
                title={""}
                data={lists}
                columns={columns}
                options={options}
                
              />
             </React.Fragment>
            );
        }
    }
}

export default StocksPivotPointsIndicator;
