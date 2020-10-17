import React, { Component } from "react";
import Slider from "react-slick";
import axios from 'axios';
import ContentLoader from "react-content-loader";

class ListSlider extends React.Component {
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
	    const rootElement = document.getElementById('list-slider');
		const data = new FormData();
		data.append('ID', rootElement.getAttribute('data-id'));
		data.append('action', 'icon_slider_data_ajax_request');
		data.append('nonce', global_vars.ajax_nonce);

		axios.post('/wp-admin/admin-ajax.php', data)
	    .then(res => {
	        const result = res.data;
	        //console.log(result);
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
        }else {
		    return (
		      <Slider {...settings}>
		      	{
		      		lists.map(list => (
		      			<div key={list.id}>
					      <a href={ list.link_url } target="_blank">
					     	<img src={ list.image_upload } alt="globe" />
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