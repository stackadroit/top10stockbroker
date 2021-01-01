import React, { Component } from "react";

class WidgetMarketBuild extends React.Component {
	constructor(props){
        super(props);
    }

    componentDidMount(){
        $('#tradmill-widget').easyTicker({
            direction: 'up',
            easing: 'swing',
            speed: 'slow',
            interval: 4000,
            height: '60',
            visible: 1,
            mousePause: true,
            controls: {
                up: '',
                down: '',
                toggle: '',
                playText: 'Play',
                stopText: 'Stop'
            },
            callbacks: {
                before: false,
                after: false
            }
        });
    }

	render() {
        return (
         <div id="tradmill-widget">
            <div style={{width: "100%"}}>
                <div className="treadmill-unit overflow-hidden">
                        <div className="moveBx w-50 float-left px-1">
                            <a target="_new" href={ this.props.widgetdata.siteUrl + "/share-market/nifty-50/"} className="bl_12 nm_a">
                               NIFTY 50
                            </a>
                            <div className="MT2mns"> 
                             <span className="gd_15 prc font-weight-bold">{ this.props.widgetdata.NSE.PRICE }</span>
                             <span className={ (this.props.widgetdata.NSE.CHANGE > 0 ? "grArrow" : "rdArrow") + " p-1"}>
                                <i className={(this.props.widgetdata.NSE.CHANGE > 0 ? "fa-caret-up" : "fa-caret-down") + " fas"}></i>
                             </span> 
                             <span className={ (this.props.widgetdata.NSE.CHANGE > 0 ? "gr_13" : "r_13") + " chg-wrp chg font-weight-bold"}>{ this.props.widgetdata.NSE.CHANGE }</span>
                             { this.props.widgetdata.NSE.PER_CHANGE > 0 ? (
                                <span className="prchg gr_13"> (+ { this.props.widgetdata.NSE.PER_CHANGE }%) </span>
                                ):(
                                <span className="prchg r_13"> ({ this.props.widgetdata.NSE.PER_CHANGE }%) </span>
                             )}
                            </div>
                        </div>
                        <div className="moveBx w-50 float-left px-1">
                            <a target="_new" href={ this.props.widgetdata.siteUrl + "/share-market/sensex/"} className="bl_12 nm_a">
                               SENSEX
                            </a>
                            <div className="MT2mns">
                             <span className="gd_15 prc font-weight-bold">{ this.props.widgetdata.BSE.PRICE }</span>
                             <span className={ (this.props.widgetdata.BSE.CHANGE > 0 ? "grArrow" : "rdArrow") + " p-1"}>
                                <i className={(this.props.widgetdata.BSE.CHANGE > 0 ? "fa-caret-up" : "fa-caret-down") + " fas"}></i>
                             </span> 
                             <span className={ (this.props.widgetdata.BSE.CHANGE > 0 ? "gr_13" : "r_13") + " chg-wrp chg font-weight-bold"}>{ this.props.widgetdata.BSE.CHANGE }</span>
                             { this.props.widgetdata.BSE.PER_CHANGE > 0 ? (
                                <span className="prchg gr_13"> (+ { this.props.widgetdata.BSE.PER_CHANGE }%) </span>
                                ):(
                                <span className="prchg r_13"> ({ this.props.widgetdata.BSE.PER_CHANGE }%) </span>
                             )}
                            </div>
                        </div>
                </div>
                <div className="treadmill-unit overflow-hidden"> 
                    <div className="moveBx w-50 float-left px-1">
                        <a target="_new" href={ this.props.widgetdata.siteUrl + "/gold-rate/"} className="bl_12 nm_a">
                           Gold Rate (10 Gm)
                        </a>
                        <div className="MT2mns">
                         <span className="gd_15 prc font-weight-bold">{ this.props.widgetdata.goldPriceFilter.PRICE }</span>
                         <span className={ (this.props.widgetdata.goldPriceFilter.CHANGE > 0 ? "grArrow" : "rdArrow") + " p-1"}>
                            <i className={(this.props.widgetdata.goldPriceFilter.CHANGE > 0 ? "fa-caret-up" : "fa-caret-down") + " fas"}></i>
                         </span> 
                             <span className={ (this.props.widgetdata.goldPriceFilter.CHANGE > 0 ? "gr_13" : "r_13") + " chg-wrp chg font-weight-bold"}>{ this.props.widgetdata.goldPriceFilter.CHANGE }</span>
                         { this.props.widgetdata.goldPriceFilter.PER_CHANGE > 0 ? (
                            <span className="prchg gr_13"> (+ { this.props.widgetdata.goldPriceFilter.PER_CHANGE }%) </span>
                            ):(
                            <span className="prchg r_13"> ({ this.props.widgetdata.goldPriceFilter.PER_CHANGE }%) </span>
                         )}
                        </div>
                    </div>
                    <div className="moveBx w-50 float-left px-1">
                        <a target="_new" href={ this.props.widgetdata.siteUrl + "/silver-rate/"} className="bl_12 nm_a">
                           Silver Rate (1 Kg)
                        </a>
                        <div className="MT2mns">
                         <span className="gd_15 prc font-weight-bold">{ this.props.widgetdata.silverPriceFilter.PRICE }</span>
                         <span className={ (this.props.widgetdata.silverPriceFilter.CHANGE > 0 ? "grArrow" : "rdArrow") + " p-1"}>
                            <i className={(this.props.widgetdata.silverPriceFilter.CHANGE > 0 ? "fa-caret-up" : "fa-caret-down") + " fas"}></i>
                         </span> 
                             <span className={ (this.props.widgetdata.silverPriceFilter.CHANGE > 0 ? "gr_13" : "r_13") + " chg-wrp chg font-weight-bold"}>{ this.props.widgetdata.silverPriceFilter.CHANGE }</span>
                         { this.props.widgetdata.silverPriceFilter.PER_CHANGE > 0 ? (
                            <span className="prchg gr_13"> (+ { this.props.widgetdata.silverPriceFilter.PER_CHANGE }%) </span>
                            ):(
                            <span className="prchg r_13"> ({ this.props.widgetdata.silverPriceFilter.PER_CHANGE }%) </span>
                         )}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        );
	}
}
export default WidgetMarketBuild;