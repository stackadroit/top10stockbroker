import React, { Component } from "react";
import ReactDOM from 'react-dom';
import Chip from '@material-ui/core/Chip';
import MUIDataTable, { TableFilterList } from "mui-datatables";
import axios from 'axios';
import ContentLoader from "react-content-loader";
import { Select, MenuItem, Button,InputLabel,FormControl,CircularProgress} from "@material-ui/core"; 
import { useState,setState } from "react";
import CustomToolbar from "./custom-toolbar";

class IndicesPivotPointsIndicator extends React.Component {
    constructor(props){
        super(props);
        this.state = {
            isRefreshing : false,
            error : null,
            isLoaded : false,
            columns:[],
            lists : [],
            selectedFilter:'All',       
            filter_list:[
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
                { name: "No Trade" },
              ]    
        };
       // this.onFilterChange = this.onFilterChange.bind(this);
    }
   
    componentDidMount(){
      this.getColumns();
      this.getData();
    }
    getColumns(){
      // parseFloat(response.OPEN).toFixed(2)
      const columns = [
        {
            name: "Index",
            label: "Index",
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
        {
            name: "LTP",
            label: "LTP",
            options: {
             filter: false,
             sort: false,
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
              sort: false,
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
              sort: false,
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
              sort: false,
              filterOptions:{
                logic: (Support_1, filters, row) => {
                  if (filters.length){
                    // console.log(row[2] +'----------'+ row[7]);
                    return (row[2] > row[7]);
                    // var cLtp =row[2].replace(/[^\d]/g, '');
                    // var Support_1 =row[5].replace(/[^\d]/g, '');
                    // // console.log(cLtp+':: < '+Support_1);
                    // if(row[2] < row[5]){
                    //   // console.log('________'+row[2]+':: < '+row[5]);
                    //   return true;
                    // }
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
              sort: false,
              filterOptions:{
                logic: (Support_2, filters, row) => {
                  // console.log(row);
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
              sort: false,
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
      const data = new FormData();
        data.append('nonce', global_vars.ajax_nonce);
        data.append('paged',1);
        axios.post(global_vars.apiServerUrl + '/apiblock/main-ppi-indices-list', data)
          .then(res => {
              const result = res.data;
              this.setState({
                  isLoaded : true,
                  isRefreshing : false,
                  lists : result
              });
               
          })
          .catch(error =>  {
              //console.log(error);
            this.setState({
              isLoaded: true,
              isRefreshing : false,
              error
            });
        });
    }
    // No Need For Pagination
    getMoreData(paged){
      const data = new FormData();
        data.append('nonce', global_vars.ajax_nonce);
        data.append('paged',paged);
        axios.post(global_vars.apiServerUrl + '/apiblock/main-ppi-indices-list', data)
          .then(res => {
              var result =this.state.lists;
              var per_page =res.data.length;
              for (var i = 0; i < per_page; i++) {
                result.push(res.data[i]);
              }
              this.setState({
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
           if((value =='Trade - Sell' || value =='Trade - Buy' || value =='No Trade')){
                  if(value =='Trade - Sell'){
                    filterList[0] ='Sell';
                  }
                  if(value =='Trade - Buy'){
                    filterList[0] ='Buy';
                  }
                  if(value =='No Trade'){
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
      this.setState({
        isRefreshing : true,
      });
      this.getData();
    }
    render() {
        const {isRefreshing,error,columns,selectedFilter, isLoaded, lists,filter_list} = this.state;
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
            customToolbar: () => {
              return (
                <CustomToolbar selectedFilter={selectedFilter} onFilterSelect={this.onFilterSelected.bind(this)} onRefreshClick={this.onRefreshed.bind(this)}/>
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

export default IndicesPivotPointsIndicator;
