import React, { Component } from "react";
import axios from 'axios';
import ContentLoader from "react-content-loader";

class WidgetMarket extends React.Component {
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
             <ContentLoader viewBox="0 0 400 80" height={80} width={400}>
				  <rect x="0" y="0" rx="3" ry="3" width="400" height="80" />
			  </ContentLoader>
            );
        }else {
		    return (
		      <div>
		      	<div className="treadmill-unit">
        				<div className="moveBx w-50 float-left px-1">
					        <a target="_new" href={ lists.widget1.siteUrl + "/share-market/nifty-50/"} className="bl_12 nm_a">
					           NIFTY 50
					        </a>
					      	<div className="MT2mns"> 
					      	 <span className="gd_15 prc font-weight-bold">{ lists.widget1.NSE.PRICE }</span>
					      	 <span className={ (lists.widget1.NSE.CHANGE > 0 ? "grArrow" : "rdArrow") + " p-1"}>
					      	 	<i className={(lists.widget1.NSE.CHANGE > 0 ? "fa-caret-up" : "fa-caret-down") + " fas"}></i>
					      	 </span> 
					         <span className={ (lists.widget1.NSE.CHANGE > 0 ? "gr_13" : "r_13") + " chg-wrp chg font-weight-bold"}>{ lists.widget1.NSE.CHANGE }</span>
					         { lists.widget1.NSE.PER_CHANGE > 0 ? (
					         	<span className="prchg gr_13"> (+ { lists.widget1.NSE.PER_CHANGE }%) </span>
					         	):(
					         	<span className="prchg r_13"> ({ lists.widget1.NSE.PER_CHANGE }%) </span>
					         )}
					      	</div>
        				</div>
        				<div className="moveBx w-50 float-left px-1">
					        <a target="_new" href={ lists.widget1.siteUrl + "/share-market/sensex/"} className="bl_12 nm_a">
					           SENSEX
					        </a>
					      	<div className="MT2mns">
					      	 <span className="gd_15 prc font-weight-bold">{ lists.widget1.BSE.PRICE }</span>
					      	 <span className={ (lists.widget1.BSE.CHANGE > 0 ? "grArrow" : "rdArrow") + " p-1"}>
					      	 	<i className={(lists.widget1.BSE.CHANGE > 0 ? "fa-caret-up" : "fa-caret-down") + " fas"}></i>
					      	 </span> 
 							 <span className={ (lists.widget1.BSE.CHANGE > 0 ? "gr_13" : "r_13") + " chg-wrp chg font-weight-bold"}>{ lists.widget1.BSE.CHANGE }</span>
					         { lists.widget1.BSE.PER_CHANGE > 0 ? (
					         	<span className="prchg gr_13"> (+ { lists.widget1.BSE.PER_CHANGE }%) </span>
					         	):(
					         	<span className="prchg r_13"> ({ lists.widget1.BSE.PER_CHANGE }%) </span>
					         )}
					      	</div>
        				</div>
    			</div>
    			<div className="treadmill-unit"> 
    				<div className="moveBx w-50 float-left px-1">
				        <a target="_new" href={ lists.widget1.siteUrl + "/gold-rate/"} className="bl_12 nm_a">
				           Gold Rate (10 Gm)
				        </a>
				      	<div className="MT2mns">
				      	 <span className="gd_15 prc font-weight-bold">{ lists.widget1.goldPriceFilter.PRICE }</span>
				      	 <span className={ (lists.widget1.goldPriceFilter.CHANGE > 0 ? "grArrow" : "rdArrow") + " p-1"}>
				      	 	<i className={(lists.widget1.goldPriceFilter.CHANGE > 0 ? "fa-caret-up" : "fa-caret-down") + " fas"}></i>
				      	 </span> 
							 <span className={ (lists.widget1.goldPriceFilter.CHANGE > 0 ? "gr_13" : "r_13") + " chg-wrp chg font-weight-bold"}>{ lists.widget1.goldPriceFilter.CHANGE }</span>
				         { lists.widget1.goldPriceFilter.PER_CHANGE > 0 ? (
				         	<span className="prchg gr_13"> (+ { lists.widget1.goldPriceFilter.PER_CHANGE }%) </span>
				         	):(
				         	<span className="prchg r_13"> ({ lists.widget1.goldPriceFilter.PER_CHANGE }%) </span>
				         )}
				      	</div>
    				</div>
    				<div className="moveBx w-50 float-left px-1">
				        <a target="_new" href={ lists.widget1.siteUrl + "/silver-rate/"} className="bl_12 nm_a">
				           Silver Rate (1 Kg)
				        </a>
				      	<div className="MT2mns">
				      	 <span className="gd_15 prc font-weight-bold">{ lists.widget1.silverPriceFilter.PRICE }</span>
				      	 <span className={ (lists.widget1.silverPriceFilter.CHANGE > 0 ? "grArrow" : "rdArrow") + " p-1"}>
				      	 	<i className={(lists.widget1.silverPriceFilter.CHANGE > 0 ? "fa-caret-up" : "fa-caret-down") + " fas"}></i>
				      	 </span> 
							 <span className={ (lists.widget1.silverPriceFilter.CHANGE > 0 ? "gr_13" : "r_13") + " chg-wrp chg font-weight-bold"}>{ lists.widget1.silverPriceFilter.CHANGE }</span>
				         { lists.widget1.silverPriceFilter.PER_CHANGE > 0 ? (
				         	<span className="prchg gr_13"> (+ { lists.widget1.silverPriceFilter.PER_CHANGE }%) </span>
				         	):(
				         	<span className="prchg r_13"> ({ lists.widget1.silverPriceFilter.PER_CHANGE }%) </span>
				         )}
				      	</div>
    				</div>
    			</div>
		      </div>
		    );
		}
	}
}

export default WidgetMarket;