import React, { Component } from "react";
import axios from 'axios';
import ContentLoader from "react-content-loader";
import WidgetMarketTopBuild from './widgetmarketTopBuild';

class WidgetMarketTop extends React.Component {
	constructor(props){
        super(props);
        this.state = {
            error : null,
            isLoaded : false,
            lists : []          
        };
    }

    componentDidMount(){
    	this.getData();
    }

    getData(){

		axios.get(global_vars.apiServerUrl + '/apiblock/widget-market-top')
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
        	const widgetdata = lists.widget2;
		    return (
		      <WidgetMarketTopBuild widgetdata={widgetdata} />
		    );
		}
	}
}

export default WidgetMarketTop;