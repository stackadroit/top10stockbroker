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

 
class StocksGivIndicator extends React.Component {
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
                { name: "Overvalued" },
                { name: "Undervalued" },
                { name: "Neutral" },
                { name: "Invest - Buy" },
                { name: "Invest - Sell" },
                { name: "Invest - Hold" },
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
              // display: 'excluded',
              sortThirdClickReset: true,
              sortDescFirst: true,
              customBodyRender: (value, tableMeta, updateValue) => {
                return (
                  <a href={tableMeta.rowData[13]} title={value}>{value}</a>
                );
              },


            }
        },
        {
            name: "Open",
            label: "Open",
            options: {
             filter: false,
             sort: false,
            }
        },
        {
            name: "High",
            label: "High",
            options: {
             filter: false,
             sort: false,
            }
        },
        {
            name: "Low",
            label: "Low",
            options: {
             filter: false,
             sort: false,
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
            name: "eps",
            label: "EPS",
            options: {
              filter: false,
              sort: true,
            }
        },
        {
            name: "expectedGrowth",
            label: "Expected Growth %",
            options: {
              filter: false,
              sort: false,
            }
        },
        {
            name: "intrinsicValue",
            label: "Intrinsic Value",
            options: {
              filter: false,
              sort: false,
            }
        },
        {
            name: "Overvalued",
            label: "Overvalued / Undervalued",
            options: {
              filter: false,
              sort: false,
            }
        },
        {
            name: "Overvalued_pre",
            label: "Overvalued / Undervalued %",
            options: {
              filter: false,
              sort: false,
            }
        },
        {
            name: "Status",
            label: "Status",
            options: {
             filter: false,
             sort: true,
            }
        },
        {
            name: "Invest",
            label: "Invest",
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
        axios.post(global_vars.apiServerUrl + '/apiblock/main-giv-stocks-list', data)
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
        axios.post(global_vars.apiServerUrl + '/apiblock/main-giv-stocks-list', data)
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
        filteredCols[11].options.filterList =[];
        filteredCols[12].options.filterList =[];
        if (value !== "All") {
          
          // Sentiment Filter
          if((value =='Overvalued' || value =='Undervalued' || value =='Neutral')){
            if(value =='Overvalued'){
                    filterList[0] ='Overvalued';
            }
            if(value =='Undervalued'){
                    filterList[0] ='Undervalued';
            }
            if(value =='Neutral'){
                    filterList[0] ='Neutral';
            }
            filteredCols[11].options.filterList = filterList; 
          }
           // Trade Filter
          if((value =='Invest - Buy' || value =='Invest - Sell' || value =='Invest - Hold')){
                  if(value =='Invest - Buy'){
                    filterList[0] ='Buy';
                  }
                  if(value =='Invest - Sell'){
                    filterList[0] ='Sell';
                  }
                  if(value =='Invest - Hold'){
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

export default StocksGivIndicator;
