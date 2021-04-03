import React, { Component } from "react";
import axios from 'axios';
import ContentLoader from "react-content-loader";

class ForeCastPivotPoint extends React.Component {
	constructor(props){
        super(props);
        this.state = {
            error : null,
            isLoaded : false,
            _html : ''          
        };
        // this.getData = this.getData.bind(this);
        setTimeout(function(ele) {
        	ele.getData = ele.getData.bind(ele);
        }, 3000,this);
    }

    componentDidMount(){
        // this.getData();
        // this.interval = setInterval(this.getData, 100000);
    	// set Interval
    	setTimeout(function(ele) {
    		ele.getData();
    		ele.interval = setInterval(ele.getData, 100000);
    	}, 3000,this);
    }
 
    getData(){
		axios.post(global_vars.apiServerUrl + '/apiblock/react-fore-cast/get-pivot-points')
	    .then(res => {
	        const result = res;
	        this.setState({
	            isLoaded : true,
		        _html : result
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
		const {error, isLoaded, _html} = this.state;

	    if(error){
            return <div>Error in loading</div>
        }else if (!isLoaded) {
            return (
             <ContentLoader viewBox="0 0 400 60" height={60} width={400}>
				  <rect x="0" y="0" rx="3" ry="3" width="400" height="60" />
			  </ContentLoader>
            );
        }else {
            return (_html);
		    
		}
	}
}

export default ForeCastPivotPoint;