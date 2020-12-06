<div class="section-charts section-padding">
    <div class="inner-wrap">
        <div class="section-head">
           <h2>{{ @$section_title }}</h2>
            <p>{{ @$section_content }}</p>
        </div>
        <!-- /.section-head -->
                
        <div class="month_tabs">
            <ul class="tabs nested_tab">
                <li><a href="#li_1d" title="1D" onclick="get_stock_graph('1D','li_1d','onedaychart')">1D</a></li>
                <li><a href="#li_1w" title="1W" onclick="get_stock_graph('1W','li_1w','oneweekchart')">1W</a></li>
                <li><a href="#li_1m" title="1M" onclick="get_stock_graph('1M','li_1m','onemonthchart')">1M</a></li> 
                <li><a href="#li_3m" title="3M" onclick="get_stock_graph('3M','li_3m','threemonthchart')">3M</a></li>
                <li><a href="#li_6m" title="6M" onclick="get_stock_graph('6M','li_6m','sixmonthchart')">6M</a></li>
                <li><a href="#li_1y" title="1Y" onclick="get_stock_graph('1Y','li_1y','oneyearchart')">1Y</a></li>
                <li><a href="#li_3y" title="3Y" onclick="get_stock_graph('3Y','li_3y','threeyearchart')">3Y</a></li>
                <li><a href="#li_5y" title="5Y" onclick="get_stock_graph('5Y','li_5y','fiveyearchart')">5Y</a></li>
                <li><a href="#li_all" title="ALL" onclick="get_stock_graph('ALL','li_all','allchart')">ALL</a></li>
            </ul>   
            
            <div class="details_container  bg-light">
              <ul class="details">
                <li><span id="mouseoverDate"></span></li>
                <li id="openVal"><strong>Open :</strong> <span id="mouseoveropenVal"></span></li>
                <li id="highVal"><strong>High :</strong> <span id="mouseoverhighVal"></span></li>
                <li id="lowVal"><strong>Low</strong> <span id="mouseoverlowVal"></span></li>
                <li id="closeVal"><strong>Close:</strong> <span id="mouseovercloseVal"></span></li>
                <li><strong>Volume</strong> <span id="mouseovervol"></span></li>
              </ul>
            </div>
            <div id="li_1d" class="tab_content">
                <!-- <div class="stb_graph"> -->
                    <div id="onedaychart" class="tab-pane in fade stock_graphs"></div>
                <!-- </div> -->
            </div>

            <div id="li_1w" class="tab_content">
                <!-- <div class="stb_graph"> -->
                 <div id="oneweekchart" class="tab-pane in fade stock_graphs"></div>
                <!-- </div> -->
            </div>
             <div id="li_1m" class="tab_content">
                <div id="onemonthchart"></div>
            </div>
            <div id="li_3m" class="tab_content">
                <div id="threemonthchart"></div>
            </div>
            <div id="li_6m" class="tab_content">
                <div id="sixmonthchart"></div>
            </div>
            <div id="li_1y" class="tab_content">
                <div id="oneyearchart"></div>
            </div>
            <div id="li_3y" class="tab_content">
               <div id="threeyearchart"></div>
            </div>
            <div id="li_5y" class="tab_content">
                <div id="fiveyearchart"></div>
            </div>
            <div id="li_all" class="tab_content">
                <div id="allchart"></div>
            </div>
        </div>

        <!-- /.month_tabs -->

    </div>
    <!-- /.inner-wrap -->
</div>