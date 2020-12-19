<div class="section-charts section-padding">
    <div class="inner-wrap">
        <div class="section-head">
           <h2>{{ @$section_title }}</h2>
            <p>{{ @$section_content }}</p>
        </div>
        <!-- /.section-head -->
                
        <div class="month_tabs">
            <ul class="tabs nested_tab">
                <li><a href="#li_1d" title="1D" data-filter="1D" data-element="li_1d" data-chart-element="onedaychart" class="shart_market_chart">1D</a></li>
                <li><a href="#li_1w" title="1W" data-filter="1W" data-element="li_1w" data-chart-element="oneweekchart" class="shart_market_chart">1W</a></li>
                <li><a href="#li_1m" title="1M" data-filter="1M" data-element="li_1m" data-chart-element="onemonthchart" class="shart_market_chart">1M</a></li> 
                <li><a href="#li_3m" title="3M" data-filter="3M" data-element="li_3m" data-chart-element="threemonthchart" class="shart_market_chart">3M</a></li>
                <li><a href="#li_6m" title="6M" data-filter="6M" data-element="li_6m" data-chart-element="sixmonthchart" class="shart_market_chart">6M</a></li>
                <li><a href="#li_1y" title="1Y" data-filter="1Y" data-element="li_1y" data-chart-element="oneyearchart" class="shart_market_chart">1Y</a></li>
                <li><a href="#li_3y" title="3Y" data-filter="3Y" data-element="li_3y" data-chart-element="threeyearchart" class="shart_market_chart">3Y</a></li>
                <li><a href="#li_5y" title="5Y" data-filter="5Y" data-element="li_5y" data-chart-element="fiveyearchart" class="shart_market_chart">5Y</a></li>
                <li><a href="#li_all" title="ALL" data-filter="ALL" data-element="li_all" data-chart-element="allchart" class="shart_market_chart">ALL</a></li>
            </ul>   
            
            <div class="details_container  bg-light">
              <ul class="details" id="details">
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
                    <div id="onedaychart" class="tab-pane in faded stock_graphs"></div>
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