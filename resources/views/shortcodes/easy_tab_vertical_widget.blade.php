<div id="v_tabs_wrapper_{{$post_id}}" class="v_tabs_wrapper_{{$post_id}} v_tabs_wrapper">
      @if($totalCount)         
        <!-- <div id="easy_tabs_container_{{$post_id}}" class="easy_tabs_container"> -->
         
          <div class="dots">
            <p class=""><strong></strong> {{count($tabs_data)}} Courses</p><p class=""><strong></strong> {{$totalTopic}} Topics</p>
            </div>
            <ul class="v_tabs"> 
              @php
                $i = 1
              @endphp
               @foreach ($tabs_data as $tabs_single_data)
                <li @php if($i==1){ @endphp class="v_active"  @php } @endphp rel="tab{{$i}}">
                     @php
                        if(@$tabs_single_data['tabs_icon_image']) { 
                        echo '<img src="'.@$tabs_single_data['tabs_icon_image'].'" />'; 
                        }
                        echo @$tabs_single_data['tabs_name'];
                     @endphp
                      <i class="fa fa-angle-right"></i>
                  </li>
                  @php
                    $i = $i+ 1
                  @endphp
              @endforeach
            </ul>
          <div class="v_tab_container">
            @php
              $i = 1
            @endphp
             @foreach ($tabs_data as $tabs_single_data)
              @php
                  $tabs_name = @$tabs_single_data['tabs_name'];
                  $tabs_icon_image = @$tabs_single_data['tabs_icon_image'];
                  $tab_option = @$tabs_single_data['tab_option'];
                  $tabs_post_type = @$tabs_single_data['tabs_post_type'];
                  $tabs_category = @$tabs_single_data['tabs_category'];
                  $tabs_link = @$tabs_single_data['tabs_link'];
                  $tabs_link_to = @$tabs_single_data['tabs_link_to'];
              @endphp
               <h3 class="v_tab_drawer_heading" rel="tab{{$i}}">
                  @if($tabs_icon_image)
                  <img src="{{$tabs_icon_image}}" /> 
                  @endif
                  {{$tabs_name}}<i class="fa fa-angle-right"></i>
                </h3>
                <div class="v_tab_content" id="tab{{$i}}">
                  <ul class="list-content">
                    @php 
                        if(is_array($tabs_link) && count(@$tabs_link)){
                             for($s=0;$s< count($tabs_link); $s++){
                                if($is_mobile && $s >= 10){
                                    $rowStyle ='style="display:none;"';
                                }
                              @endphp
                              <li>
                                <i class="fa fa-angle-right text-oringe" aria-hidden="true" style="color:hsl(13deg 79% 52%);padding-top: 3px;"></i>
                                <a href="{{$tabs_link_to[$s]}}" title="{{ ucfirst(@$tabs_link[$s]) }}">{{ ucfirst(@$tabs_link[$s]) }}</a>
                              </li>
                              @php  
                             }   
                          }
                        @endphp
                    </ul>
                  </div>
                  
                @php
                  $i = $i+ 1
                @endphp
            @endforeach
        </div>      
      @else
            {{'No Data'}}       
      @endif
  <!-- </div> -->
</div>