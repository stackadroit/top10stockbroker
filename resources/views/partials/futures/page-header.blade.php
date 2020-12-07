<div class="section-companydetails section-padding">
    <div class="inner-wrap">
          @if($get_meta)
            <div class="custom-menu-class">
                <ul>
                   @php 
                    foreach( $get_meta as $gm ){ 
                        $current_class =  ($current_url == $gm['purl'] ) ? 'current': ''; 
                        echo'<li class="'.$current_class.'"><a href="'.$gm['purl'].'">'.$gm['ptitle'].'</a></li>';
                    }
                   @endphp
                </ul>
            </div><!-- custom menu class -->
        @endif
      <h1 class="text-orange">{{ @$top_data['main_h1_title'] }}</h1>
      <p>{{ @$top_data['main_para_content'] }}</p>
    </div>
      @if ($top_data['main_h2_title'])
	    <div class="inner-wrap">
          <h2>{{ @$top_data['main_h2_title'] }}</h2>
          <p>{{ @$top_data['main_para2_content'] }}</p>
      </div>
       @endif
</div>
