@php 
    if(!$company_details){
  @endphp
       <div class="section-companyprice bg-light section-padding"  id="company-stock-live">
        <div class="inner-wrap">
            <h2 class="text-orange">"Live Data is not available for <?php echo str_replace('Share Price', '', get_the_title()); ?> because they are yet to be Listed in NSE or BSE or both."</h2>
        </div>
    </div>
       @php
    }
  @endphp
<div class="section-companydetails section-padding">
        <div class="inner-wrap">

       @php
      $tab_id =  get_post_meta( get_the_id() , 'tab_filter_id' , true );
        if( !empty( $tab_id ) ) :
            $get_meta = get_post_meta( $tab_id , 'repeatable_fields' , true );
                global $wp;
                $current_url = home_url( add_query_arg( array(), $wp->request ) ) .'/';
            @endphp
            <div class="custom-menu-class">
                <ul>
                    @php 
                    foreach( $get_meta as $gm ){ 
                        $current_class =  ( $current_url == $gm['purl'] ) ? 'current': ''; 
                        
                
                        echo'<li class="'.$current_class.'"><a href="'.$gm['purl'].'">'.$gm['ptitle'].'</a></li>';
                    }
                    
                    @endphp
                </ul>
            </div><!-- custom menu class -->
        @php
        endif;
        @endphp



          <h1 class="text-orange">{{ @$top_data['main_h1_title'] }}</h1>
          <p>{{ @$top_data['main_para_content'] }}</p>
      </div>
      <!-- @if ($top_data['main_h2_title'])
	    <div class="inner-wrap">
          <h2>{{ @$top_data['main_h2_title'] }}</h2>
          <p>{{ @$top_data['main_para2_content'] }}</p>
        </div>
       @endif -->
</div>
