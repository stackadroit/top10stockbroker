import React, { Component } from "react";
import ReactDOM from 'react-dom';
import Chip from '@material-ui/core/Chip';
import MUIDataTable, { TableFilterList } from "mui-datatables";
import axios from 'axios';
import ContentLoader from "react-content-loader";
import { Select, MenuItem, Button,InputLabel,FormControl, CircularProgress} from "@material-ui/core"; 
import { useState,setState } from "react";
import CustomToolbar from "./custom-toolbar";
import { createMuiTheme, MuiThemeProvider, withStyles } from '@material-ui/core/styles';
import { withStyles } from "@material-ui/core/styles";
import CustomSearchRender from "./customSearchRender";
 
class StocksTiIndicator extends React.Component {
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
                { name: "Buy Target 1" },
                { name: "Sell Target 1" },
                { name: "Buy Target 2" },
                { name: "Sell Target 2" },
                { name: "Sell Entry" },
                { name: "Buy Entry" },
                { name: "Sell StopLoss" },
                { name: "Buy StopLoss" },
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
      // var funCallIdx=1;
      //   var myVar = setInterval(function(){
      //       funCallIdx++;
      //       if(funCallIdx >5){
      //         clearInterval(myVar);
      //       }
      //       self.getMoreData(funCallIdx);
      //   },100,funCallIdx,self);
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
                  <a href={tableMeta.rowData[13]} title={value}>{value}</a>
                );
              },


            }
        },
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
            name: "Support_3",
            label: "Buy Entry",
            options: {
              filter: false,
              sort: true,
              filterOptions:{
                logic: (Support_3, filters, row) => {
                  if (filters.length){
                    return (row[1] > row[8]);
                  }
                  return false;
                },
              }
            }
        },
        {
            name: "Resistance_1",
            label: "Buy Target 1",
            options: {
              filter: false,
              sort: true,
              filterOptions:{
                logic: (Resistance_1, filters, row) => {
                  if (filters.length){
                    return (row[1] < row[3]);
                  }
                  return false;
                },
              }
            }
        },
        {
            name: "Resistance_2",
            label: "Buy Target 2",
            options: {
              filter: false,
              sort: true,
              filterOptions:{
                logic: (Resistance_2, filters, row) => {
                  if (filters.length){
                    return (row[1] < row[5]);
                  }
                  return false;
                },
              }
            }
        },
        {
            name: "Support_4",
            label: "Buy StopLoss",
            options: {
              filter: false,
              sort: true,
              filterOptions:{
                logic: (Support_4, filters, row) => {
                  if (filters.length){
                    return (row[1] > row[10]);
                  }
                  return false;
                },
              }
            }
        },
        {
            name: "Resistance_3",
            label: "Sell Entry",
            options: {
              filter: false,
              sort: true,
              filterOptions:{
                logic: (Resistance_3, filters, row) => {
                  if (filters.length){
                    return (row[1] < row[7]);
                  }
                  return false;
                },
              }
            }
        },
        {
            name: "Support_1",
            label: "Sell Target 1",
            options: {
              filter: false,
              sort: true,
              filterOptions:{
                logic: (Support_1, filters, row) => {
                  if (filters.length){
                    return (row[1] > row[4]);
                  }
                  return false;
                },
              }
            }
        },
        {
            name: "Support_2",
            label: "Sell Target 2",
            options: {
              filter: false,
              sort: true,
              filterOptions:{
                logic: (Support_2, filters, row) => {
                  if (filters.length){
                    return (row[1] > row[6]);
                  }
                  return false;
                },
              }
            }
        },
        {
            name: "Resistance_4",
            label: "Sell StopLoss",
            options: {
              filter: false,
              sort: true,
              filterOptions:{
                logic: (Resistance_4, filters, row) => {
                  if (filters.length){
                    return (row[1] < row[9]);
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
      const data = new FormData();
        data.append('nonce', global_vars.ajax_nonce);
        data.append('paged',1);
        axios.post(global_vars.apiServerUrl + '/apiblock/main-cl-stocks-list', data)
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
        axios.post(global_vars.apiServerUrl + '/apiblock/main-cl-stocks-list', data)
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
        filteredCols[3].options.filterList =[];
        filteredCols[4].options.filterList =[];
        filteredCols[5].options.filterList =[];
        filteredCols[6].options.filterList =[];
        filteredCols[7].options.filterList =[];
        filteredCols[8].options.filterList =[];
        filteredCols[9].options.filterList =[];
        filteredCols[10].options.filterList =[];
        filteredCols[11].options.filterList =[];
        filteredCols[12].options.filterList =[];
        if (value !== "All") {
          // Buy Target 1
          if((value =='Buy Target 1' || value =='Buy Target 2' || value =='Sell Entry' || value =='Sell StopLoss')){
            filterList[0] =value;
            switch(value){
              case 'Buy Target 1':
                filteredCols[3].options.filterList = filterList;
                break;
              case 'Buy Target 2':
                filteredCols[5].options.filterList = filterList;
                break;
              case 'Sell Entry':
                filteredCols[7].options.filterList = filterList;
                break;
              case 'Sell StopLoss':
                filteredCols[9].options.filterList = filterList;
                break;
            }
             
          }
          // Sell Target 1
          if((value =='Sell Target 1' || value =='Sell Target 2' || value =='Buy Entry' || value =='Buy StopLoss')){
            filterList[0] =value;
            switch(value){
              case 'Sell Target 1':
                filteredCols[4].options.filterList = filterList;
                break;
              case 'Sell Target 2':
                filteredCols[6].options.filterList = filterList;
                break;
              case 'Buy Entry':
                filteredCols[8].options.filterList = filterList;
                break;
              case 'Buy StopLoss':
                filteredCols[10].options.filterList = filterList;
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
            filteredCols[11].options.filterList = filterList; 
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
                  filteredCols[12].options.filterList = filterList;
          }
              
           
        }
        this.setState({
            selectedFilter: value,
        });
    }
    onRefreshed(){
      var self =this;
      const filteredCols = this.state.columns;
      let filterList = [];
      filteredCols[3].options.filterList =[];
        filteredCols[4].options.filterList =[];
        filteredCols[5].options.filterList =[];
        filteredCols[6].options.filterList =[];
        filteredCols[7].options.filterList =[];
        filteredCols[8].options.filterList =[];
        filteredCols[9].options.filterList =[];
        filteredCols[10].options.filterList =[];
        filteredCols[11].options.filterList =[];
        filteredCols[12].options.filterList =[];
      var funCallIdx=1;
      var refresh=1;
      this.setState({
        isRefreshing : true,
      });
      self.getMoreData(funCallIdx,refresh);
    }
    
    render() {
        const {isRefreshing,error,columns,selectedFilter, 
          isLoaded, lists,tableFilterOptions} = this.state;
        const options = {
            selectableRows: 'none', 
            hasIndex: true, 
            search:false,
            searchOpen:true,
            searchBox: true, 
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

export default StocksTiIndicator;
