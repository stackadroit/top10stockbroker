import React from "react";
import IconButton from "@material-ui/core/IconButton";
import Tooltip from "@material-ui/core/Tooltip";
import AddIcon from "@material-ui/icons/Add";
import { withStyles } from "@material-ui/core/styles";
import { Select, MenuItem, Button,InputLabel} from "@material-ui/core"; 


const defaultToolbarStyles = {
  iconButton: {
  },
};

class CustomToolbar extends React.Component {
  constructor(props){
    super(props);
        this.state = {
            filter_list:[
                { name: "Resistance 1" },
                { name: "Support 1" },
                { name: "Resistance 2" },
                { name: "Support 2" },
                { name: "Resistance 3" },
                { name: "Support 3" },
                { name: "Sentiment - Bullish" },
                { name: "Sentiment - Bearish" },
                { name: "Sentiment - Neutral" },
                { name: "Trade - Buy" },
                { name: "Trade - Sell" },
                { name: "No Trade" },
              ]    
        };
       
  }
  render() {
    const { classes } = this.props;
    const {filter_list} = this.state;

    return (
      <React.Fragment>
          <span>Filters &nbsp;</span>
            <Select
              style={{width:'200px', marginBottom:'10px', marginRight:10}}

              onChange={this.props.onFilterSelect} value={this.props.selectedFilter}>
              <MenuItem value="All">All</MenuItem>
              {filter_list.map((x) => (
                <MenuItem key={x.name} value={x.name}>
                  {x.name}
                </MenuItem>
              ))}
      </Select>
       <Button onClick={this.props.onRefreshClick}>Refresh</Button>
      </React.Fragment>
    );
  }

}

export default withStyles(defaultToolbarStyles, { name: "CustomToolbar" })(CustomToolbar);