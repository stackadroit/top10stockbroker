import React, { Component } from "react";
import Slider from "react-slick";
import ContentLoader from "react-content-loader";

class ListSlider extends React.Component {
	constructor(props){
        super(props);
        this.state = {
            error : null,
            isLoaded : false,
            list : []          
        };
    }

    componentDidMount(){
    	this.setState({
            isLoaded : true
        });
    }

	render() {
		const {error, isLoaded, list} = this.state;

	    var settings = {
	      dots: false,
	      adaptiveHeight: false,
	      slidesPerRow: 5,
	      lazyLoad: 'ondemand',
	      fade: true,
	      rows: 4,
	      arrows: true,
	      responsive: [
	        {
	          	breakpoint: 1024,
		        settings: {
		          slidesPerRow: 4,
		          rows: 4,
		        }
	        },
	        {
	          	breakpoint: 767,
		        settings: {
		          slidesPerRow: 4,
		          rows: 4,
		        }
	        },
	        {
	          	breakpoint: 680,
		        settings: {
		          slidesPerRow: 3,
		          rows: 4,
		        }
	        },
	        {
	          	breakpoint: 480,
		        settings: {
		          slidesPerRow:3 ,
		          rows: 4,
		        }
	        }
	      ]  
	    };
	    
	    const lists = [
					    {
					    	"id" : 1,
					        "link" : "https://top10stockbroker.com/share-market/nifty-50/",
					        "title" : "NIFTY 50 Live",
					        "img" : "/wp-content/uploads/2019/05/nifty-50.png"
					    }
					];

	    if(error){
            return <div>Error in loading</div>
        }else if (!isLoaded) {
            return (
             <ContentLoader viewBox="0 0 800 350" height={350} width={800}>
				  <rect x="0" y="0" rx="3" ry="3" width="400" height="80" />
			      <rect x="410" y="0" rx="3" ry="3" width="400" height="80" />
			      <rect x="0" y="90" rx="3" ry="3" width="400" height="80" />
			      <rect x="410" y="90" rx="3" ry="3" width="400" height="80" />
			      <rect x="0" y="190" rx="3" ry="3" width="400" height="80" />
			      <rect x="410" y="190" rx="3" ry="3" width="400" height="80" />
			  </ContentLoader>
            );
        }else{
		    return (
		      <Slider {...settings}>
		      	{
		      		lists.map(list => (
		      			<div key={list.id}>
					      <a href={ list.link } target="_blank">
					     	<img src={ list.img } alt="globe" />
					      	<h4>{ list.title }</h4>
					      </a>
					    </div>
		      		))
		      	}
		      </Slider>
		    );
		}
	}
}

export default ListSlider;