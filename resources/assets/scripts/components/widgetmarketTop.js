import React, { Component } from "react";
import axios from 'axios';
import ContentLoader from "react-content-loader";

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
             <ContentLoader viewBox="0 0 400 80" height={80} width={400}>
				  <rect x="0" y="0" rx="3" ry="3" width="400" height="80" />
			  </ContentLoader>
            );
        }else {
		    return (
		      <div className="treadmill-wrap">
		          {
		          	lists.widget2.map(list => (
		          		<div className="treadmill-unit overflow-hidden" key={list.id}>
		          			<div className="moveBx w-50 float-left px-1">
		          				<a target="_new" href={list.rodata1_permalink} className="bl_12 nm_a">
						           { list.growObject.S_NAME }
						        </a>
						        <div className="MT2mns">
						      	 <span className="gd_15 prc font-weight-bold">{ list.growObject.CLOSE_PRICE }</span>
						      	 <span className={ (list.growObject.CHANGE > 0 ? "grArrow" : "rdArrow") + " p-1"}>
						      	 	<i className={(list.growObject.CHANGE > 0 ? "fa-caret-up" : "fa-caret-down") + " fas"}></i>
						      	 </span> 
									 <span className={ (list.growObject.CHANGE > 0 ? "gr_13" : "r_13") + " chg-wrp chg font-weight-bold"}>{ list.growObject.CHANGE }</span>
						         { list.growObject.PER_CHANGE > 0 ? (
						         	<span className="prchg gr_13"> (+ { list.growObject.PER_CHANGE }%) </span>
						         	):(
						         	<span className="prchg r_13"> ({ list.growObject.PER_CHANGE }%) </span>
						         )}
						      	</div>
		          			</div>
		          			<div className="moveBx w-50 float-left px-1">
		          				<a target="_new" href={list.rodata2_permalink} className="bl_12 nm_a">
						           { list.lrowObject.S_NAME }
						        </a>
						        <div className="MT2mns">
						      	 <span className="gd_15 prc font-weight-bold">{ list.lrowObject.CLOSE_PRICE }</span>
						      	 <span className={ (list.lrowObject.CHANGE > 0 ? "grArrow" : "rdArrow") + " p-1"}>
						      	 	<i className={(list.lrowObject.CHANGE > 0 ? "fa-caret-up" : "fa-caret-down") + " fas"}></i>
						      	 </span> 
									 <span className={ (list.lrowObject.CHANGE > 0 ? "gr_13" : "r_13") + " chg-wrp chg font-weight-bold"}>{ list.lrowObject.CHANGE }</span>
						         { list.lrowObject.PER_CHANGE > 0 ? (
						         	<span className="prchg gr_13"> (+ { list.lrowObject.PER_CHANGE }%) </span>
						         	):(
						         	<span className="prchg r_13"> ({ list.lrowObject.PER_CHANGE }%) </span>
						         )}
						      	</div>
		          			</div>
		          		</div>
		          	))
		          }	
		      </div>
		    );
		}
	}
}

export default WidgetMarketTop;