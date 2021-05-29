import React from 'react';
import Grow from '@material-ui/core/Grow';
import TextField from '@material-ui/core/TextField';
import SearchIcon from '@material-ui/icons/Search';
import IconButton from '@material-ui/core/IconButton';
import ClearIcon from '@material-ui/icons/Clear';
import { withStyles } from '@material-ui/core/styles';

 const defaultSearchStyles = theme => ({
  main: {
    display: 'flex',
    flex: '1 0 auto',
  },
  searchText: {
    flex: '0.8 0',
  },
  clearIcon: {
    '&:hover': {
      color: theme.palette.error.main,
    },
  },
});

class CustomSearchRender extends React.Component {
  constructor(props){
    super(props);
    this.handleTextChange = this.handleTextChange.bind(this);
  }
  handleTextChange() {
    this.props.onSearch(event.target.value);
  };

  componentDidMount() {
    // document.addEventListener('keydown', this.onKeyDown, false);
  }

  componentWillUnmount() {
    // document.removeEventListener('keydown', this.onKeyDown, false);
  }

  onKeyDown (){
    if (event.keyCode === 27) {
      this.props.onHide();
    }
  };

  render() {
    const { classes, options, onHide, searchText } = this.props;
    return (
      <Grow appear in={true} timeout={300}>
        <div className={classes.main} ref={el => (this.rootRef = el)}>
          <SearchIcon className={classes.searchIcon} />
          <TextField
            className={classes.searchText}
            autoFocus={false}
            InputProps={{
              'data-test-id': options.textLabels.toolbar.search,
            }}
            inputProps={{
              'aria-label': options.textLabels.toolbar.search,
            }}
            value={searchText || ''}
            onKeyDown={this.onKeyDown}
            onChange={this.handleTextChange}
            fullWidth={true}
            inputRef={el => (this.searchField = el)}
            placeholder={options.searchPlaceholder}
            {...(options.searchProps ? options.searchProps : {})}
          />
           
        </div>
      </Grow>
    );
  }
}

export default withStyles(defaultSearchStyles, { name: 'CustomSearchRender' })(CustomSearchRender);