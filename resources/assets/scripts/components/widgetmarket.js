import React, { Component } from "react";
import axios from 'axios';
import ContentLoader from "react-content-loader";
import WidgetMarketBuild from './widgetmarketBuild';

class WidgetMarket extends React.Component {
	constructor(props){
        super(props);
        this.state = {
            error : null,
            isLoaded : false,
            lists : []          
        };
        this.getData = this.getData.bind(this);
        // setTimeout(function(ele) {
        // 	ele.getData = ele.getData.bind(ele);
        // }, 3000,this);
    }

    componentDidMount(){
        this.getData();
        this.interval = setInterval(this.getData, 100000);
    	// set Interval
    	// setTimeout(function(ele) {
    	// 	ele.getData();
    	// 	ele.interval = setInterval(ele.getData, 100000);
    	// }, 3000,this);
    }

    componentWillUnmount() {
	    // Clear the interval right before component unmount
	    clearInterval(this.interval);
	}
	
    getData(){

		axios.get(global_vars.apiServerUrl + '/apiblock/widget-market')
	    .then(res => {
	        const result = res.data;
	        this.setState({
	            isLoaded : true,
		        lists : result
		    });
	    })
	    .catch(error =>  {
		    this.setState({
                isLoaded: true,
                error
            });
		});
	}

	render() {
		const {error, isLoaded, lists} = this.state;

	    if(error){
            return <div>Error in loading</div>
        }else if (!isLoaded) {
            return (
             <ContentLoader viewBox="0 0 400 60" height={60} width={400}>
				  <rect x="0" y="0" rx="3" ry="3" width="400" height="60" />
			  </ContentLoader>
            );
        }else {
        	const widgetdata = lists.widget1;
		    return (
		      <WidgetMarketBuild widgetdata={widgetdata} />
		    );
		}
	}
}

export default WidgetMarket;