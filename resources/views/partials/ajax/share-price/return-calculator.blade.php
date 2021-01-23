<div class="section_returnCal section-padding">
    <div class="inner-wrap">
        <div class="section-head">
            <h2 class="">{{$section_title }}</h2>
            <p>{{$section_content}}</p>
        </div>
        <!-- /.section-head -->
        <div class="retcalc_form">
            <form action="">
                <label for="">If I had made an Investment of Rs</label>
                <input type="text" name="" id="investmentOf" placeholder="10000">
                <br />
                <br />
                <label for="">Into a company / stock name &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                <select name="" id="company-list" placeholder="company / stock name">
                    <option value="">Select company / stock name</option>
                </select>
                 
                <br />
                <br />
                <label for="">For a period of about
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                </label>
                <select id="rc_period_box_filter" class="select-style1d">
                    <option value="1W" class="">1 week</option>
                    <option value="1M" class="">1 month</option>
                    <option value="3M" class="">3 months</option>
                    <option value="6M" class="">6 months</option>
                    <option value="1Y" class="">1 year</option>
                    <option value="3Y" class="">3 year</option>
                    <option value="5Y" class="">5 year</option>
                </select>
                <br />
                <div style="width: 100%;margin: 0px auto;
                    text-align: center;padding: 25px 10px;    margin: 0px;    height: 70px;">
                    <button style="padding: 5px 20px;" id="getCalculatedResult">Calculate</button>
                </div>
                <!-- <label for="">Period Ago</label> -->
                <div class="total_worth" id="get_return_result"></div>
            </form>
        </div>
        <!-- /.retcalc_form -->
    </div>
    <!-- /.inner-wrap -->
</div>