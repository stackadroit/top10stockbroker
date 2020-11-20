<div class="container-fluid py-4 bull-bg">
    <div class="row">
      <div class="col-md-6 p-4 left-section show-desktop">
        @if(!$auto_status)
          <h3>
            <span class="red">Fill your details</span> & get all exclusive offers. <span class="red">Hurry!!!</span>
          </h3>
           <ul>
              <li> - <strong>Get 90% Discount on Brokerage</strong></li>
              <li> - Open Demat A/C in just 5 minute</li>
              <li> - Start Trading in 1 Hour</li>
              <li> - <strong>Get more than 20% Return on Investment</strong></li>
              <li> - Receive Premium Stock Tips Daily</li>
              <li> - Get 40 times Exposure Immediately</li>
              <li> - <strong>Start with Zero Margin & Free AMC</strong></li>
          </ul>
        @else
          <h3>
            <span class="red">Still Confused!</span> Fill your details & Get Free Expert Help. <span class="red">Hurry!!!</span>
          </h3>
           <ul>
              <li> - <strong>Get 90% Discount on Brokerage</strong></li>
              <li> - Open Demat A/C in just 5 minute</li>
              <li> - Start Trading in 1 Hour</li>
              <li> - <strong>Get more than 20% Return on Investment</strong></li>
              <li> - Receive Premium Stock Tips Daily</li>
              <li> - Get 40 times Exposure Immediately</li>
              <li> - <strong>Start with Zero Margin & Free AMC</strong></li>
          </ul>
        @endif
      </div>
      <div class="col-md-6 ml-auto p-4 border-light">
        <div class="form-container">
          @if(!$auto_status)
            <h3 class="show-desktop"><strong>Open 100% Free Demat A/C</strong> in just 5 Minute</h3>
            <h3 class="show-mobile">Fill your Details <strong>& Open 100% Free Demat A/C</strong></h3>
            <hr>
          @else 
            <h3 class="show-desktop"><strong>Open 100% Free Demat A/C</strong> in just 5 Minute</h3>
            <h3 class="show-mobile">Fill your Details <strong>& Open 100% Free Demat A/C</strong></h3>
            <hr>
          @endif
            {!! do_shortcode($do_contactform) !!} 
          <p class="show-mobile bdr">
            @if(!$auto_status)
              <small> - Get 90% Discount on Brokerage</small>
              <small> - Get more than 20% Return on Investment</small>
              <small> - Start with Zero Margin & Free AMC</small>
            @else
              <small> - Get 90% Discount on Brokerage</small>
              <small> - Get more than 20% Return on Investment</small>
              <small> - Start with Zero Margin & Free AMC</small>
            @endif
          </p>
        </div><!-- end of form-container -->
      </div>
    </div>
</div>