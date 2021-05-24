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
        };
       
  }
  render() {
    const { classes } = this.props;

    return (
      <React.Fragment>
          <span>Filters &nbsp;</span>
            <Select
              style={{width:'200px', marginBottom:'10px', marginRight:10}}
              onChange={this.props.onFilterSelect} value={this.props.selectedFilter}>
              <MenuItem value="All">All</MenuItem>
              {this.props.tableFilterOptions.map((x) => (
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