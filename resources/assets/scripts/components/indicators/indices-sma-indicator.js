import React, { Component } from "react";
import ReactDOM from 'react-dom';
import Chip from '@material-ui/core/Chip';
import MUIDataTable, { TableFilterList } from "mui-datatables";
import axios from 'axios';
import ContentLoader from "react-content-loader";
import { Select, MenuItem, Button,InputLabel,FormControl,CircularProgress} from "@material-ui/core"; 
import { useState,setState } from "react";
import CustomToolbar from "./custom-toolbar";

class IndicesSmaIndicator extends React.Component {
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
      const columns = [
        {
            name: "Index",
            label: "Index",
            options: {
              filter: false,
              sort: true,
              customBodyRender: (value, tableMeta, updateValue) => {
                return (
                  <a href={tableMeta.rowData[11]} title={value}>{value}</a>
                );
              }
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
            name: "sma_7day",
            label: "7 Day SMA",
            options: {
              filter: false,
              sort: true,
            }
        },
        {
            name: "sma_15day",
            label: "15 Day SMA",
            options: {
              filter: false,
              sort: false,
            }
        },
        {
            name: "sma_30day",
            label: "30 Day SMA",
            options: {
              filter: false,
              sort: false,
            }
        },
        {
            name: "sma_50day",
            label: "50 Day SMA",
            options: {
              filter: false,
              sort: false,
            }
        },
        {
            name: "sma_100day",
            label: "100 Day SMA",
            options: {
              filter: false,
              sort: false,
            }
        },
        {
            name: "sma_200day",
            label: "200 Day SMA",
            options: {
              filter: false,
              sort: false,
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
        axios.post(global_vars.apiServerUrl + '/apiblock/main-sma-indices-list', data)
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
        axios.post(global_vars.apiServerUrl + '/apiblock/main-sma-indices-list', data)
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
        var value =event.target.value;
        const filteredCols = this.state.columns;
        let filterList = [];
        filteredCols[9].options.filterList =[];
        filteredCols[10].options.filterList =[];
         
        if (value !== "All") {
           
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
            filteredCols[9].options.filterList = filterList; 
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
                  filteredCols[10].options.filterList = filterList;
          }
              
           
        }
        this.setState({
            selectedFilter: value,
        });
    }
    onRefreshed(){
      const filteredCols = this.state.columns;
      let filterList = [];
        filteredCols[9].options.filterList =[];
        filteredCols[10].options.filterList =[];
      this.setState({
        isRefreshing : true,
      });
      this.getData();
    }
    render() {
        const {isRefreshing,error,columns,selectedFilter, isLoaded, lists,tableFilterOptions} = this.state;
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

export default IndicesSmaIndicator;
