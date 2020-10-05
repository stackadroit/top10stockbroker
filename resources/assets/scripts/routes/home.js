import React from 'react';
import ReactDOM from 'react-dom';
import ContentLoader, { Facebook } from "react-content-loader";

export default {
  init() {
    // JavaScript to be fired on the home page


	const MyFacebookLoader = () => <Facebook />;

	const App = () => (
	    <MyFacebookLoader />
	);

	const rootElement = document.querySelector('#like_button_container');
	ReactDOM.render(<App />, rootElement);

  },
  finalize() {
    // JavaScript to be fired on the home page, after the init JS
  },
};
