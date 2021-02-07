<div class="section_history pb-5">
    <div class="inner-wrap">
        <div class="section-head">
            <h2 class="">{{@$section_title}}</h2>
            <p>{{@$section_content}}</p>
        </div>
        <div class="history_table table-responsive tb-fixed-head" data-simplebar data-simplebar-auto-hide="false">
            <table class="table-bordered">
                <thead>
                    <tr>
                        <th width="35%"></th>
                        <th>
                            <select id="history_period_box_filter" name="period_box_bse" class="select-style1">
                                <option value="1W" class=""{{ ($historyFilter  =='1w'?'selected="selected"':'')}}>1 week</option>
                                <option value="1M" class="" {{ ($historyFilter  =='1M'?'selected="selected"':'')}}>1 month</option>
                                <option value="3M" class="" {{ ($historyFilter  =='3M'?'selected="selected"':'') }}>3 months</option>
                                <option value="6M" class="" {{ ($historyFilter  =='6M'?'selected="selected"':'') }}>6 months</option>
                                <option value="1Y" class="" {{ ($historyFilter  =='1Y'?'selected="selected"':'') }}>1 year</option>
                                <option value="3Y" class="" {{ ($historyFilter  =='3Y'?'selected="selected"':'') }}>3 year</option>
                                <option value="5Y" class="" {{ ($historyFilter  =='5Y'?'selected="selected"':'')}}>5 year</option>
                            </select>
                        </th>
                        <th>Current Price</th>
                        <th>%Gain / Loss</th>
                    </tr>
                </thead>
                <tbody id="history-price-wrap">  
                </tbody>
            </table>
        </div>
    </div>
</div>
