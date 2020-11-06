import React, { Component } from "react";

class WidgetMarketTopBuild extends React.Component {
	constructor(props){
        super(props);
    }

    componentDidMount(){
        $('#tradmill-widget-top').easyTicker({
            direction: 'up',
            easing: 'swing',
            speed: 'slow',
            interval: 2000,
            height: '60',
            visible: 0,
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
         <div id="tradmill-widget-top">
            <div style={{width: "100%"}}>
              {
                this.props.widgetdata.map(list => (
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
          </div>
        );
	}
}

export default WidgetMarketTopBuild;