import React, { Component } from "react";
import Slider from "react-slick";
import axios from 'axios';
import ContentLoader from "react-content-loader";
import MdfSearch from './mbfsearch';

class MdfSearchWrap extends React.Component {
	constructor(props){
        super(props);
        this.state = {
        	isToggleOn: true,
            error : null,
            isLoaded : false,
            lists : []          
        };

        // This binding is necessary to make `this` work in the callback
    	this.handleClick = this.handleClick.bind(this);
    }

    handleClick() {
	    this.setState(state => ({
	      isToggleOn: !state.isToggleOn
	    }));
	    console.log(this.state.isToggleOn);
	}

	render() {
		const {error, isLoaded, lists} = this.state;

	    if(error){
            return <div>Error in loading</div>
        }else if (!isLoaded) {
            return (
            	<MdfSearch  />
            );
        }else {
		    
		}
	}
}

export default MdfSearchWrap;