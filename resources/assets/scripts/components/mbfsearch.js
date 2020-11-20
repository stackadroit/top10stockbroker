import React, { Component } from "react";

class MdfSearch extends React.Component {
	constructor(props){
        super(props);
    }

	render() {
        return (
         <div className="mbf-search" id="mbf-search">
            <span className="hvr-ripple-out">
                <i className="fas fa-bell"></i>
            </span>
         </div>
        );
	}
}

export default MdfSearch;