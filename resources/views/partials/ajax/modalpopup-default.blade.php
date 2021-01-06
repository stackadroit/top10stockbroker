<div class="container-fluid">
    <div class="row">
      <div class="col-md-6 p-4 left-section d-none d-md-block">
        @if(!$auto_status)
          <h3>
            <span class="red">Fill your details</span> & get all exclusive offers. <span class="red">Hurry!!!</span>
          </h3>
           <ul>
              <li> - <strong>Get 80% Revenue Sharing</strong></li>
              <li> - Open Demat A/C in just 5 minute</li>
              <li> - Get change to Win iPhone & Laptop</li>
              <li> - <strong>Get Rs.1000 Amazon Voucher for Free</strong></li>
              <li> - Partner with India\'s Largest Sub-Broker</li>
              <li> - Best Back-office Software</li>
              <li> - <strong>Start with Zero Security Deposit</strong></li>
          </ul>
        @else
          <h3>
            <span class="red">Still Confused!</span> Fill your details & Get Free Consultancy <span class="red">Hurry!!!</span>
          </h3>
          <ul>
            <li> - <strong>Get 80% Revenue Sharing</strong></li>
            <li> - Open Demat A/C in just 5 minute</li>
            <li> - Get change to Win iPhone & Laptop</li>
            <li> - <strong>Get Rs.1000 Amazon Voucher for Free</strong></li>
            <li> - Partner with India\'s Largest Sub-Broker</li>
            <li> - Best Back-office Software</li>
            <li> - <strong>Start with Zero Security Deposit</strong></li>
          </ul>
        @endif
      </div>
      <div class="col-md-6 ml-auto p-4 border-light">
        <div class="form-container">
          @if(!$auto_status)
            <h3 class="show-desktop"><strong>Become a Sub Broker</strong> in just 3 days</h3>
            <h3 class="show-mobile text-center">Fill your details & <strong> Become a Sub-Broker in just 3 Days</strong></h3>
            <hr>
          @else 
            <h3 class="show-desktop"><strong>Become a Sub Broker</strong> in just 3 days</h3>
            <h3 class="show-mobile text-center">Still Confused! <strong>Fill Details & Get Free Consultancy</strong></h3>
            <hr>
          @endif
            {!! do_shortcode($do_contactform) !!} 
          <p class="show-mobile bdr">
            @if(!$auto_status)
              <small> - Get 80% Revenue Sharing</small>
              <small> - Start with Zero Security Deposit</small>
              <small> - Get Rs.1000 Amazon Voucher for Free</small>
            @else
              <small> - Get 80% Revenue Sharing</small>
              <small> - Start with Zero Security Deposit</small>
              <small> - Get Rs.1000 Amazon Voucher for Free</small>
            @endif
          </p>
        </div><!-- end of form-container -->
      </div>
    </div>
</div>