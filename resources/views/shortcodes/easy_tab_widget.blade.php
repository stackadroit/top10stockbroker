<div id="content">
  <div id="easy_tabs_container_wrap_{{$post_id}}" class="easy_tabs_container_wrap">
      @if($totalCount)         
        <div id="easy_tabs_container_{{$post_id}}" class="easy_tabs_container">
          <div class="easy_tabs_wrapper">
            <ul class="tabs tabHeader"> 
              @php
                $i = 1
              @endphp
               @foreach ($tabs_data as $tabs_single_data)
                  <li @php if($i==1){ @endphp class="active"  @php } @endphp >
                      <a href="#tabs_desc_{{$post_id}}_{{$i}}">
                        <span><?php echo @$tabs_single_data['tabs_name']; ?></span>
                      </a>
                  </li>
                  @php
                    $i = $i+ 1
                  @endphp
              @endforeach
            </ul>
             <span class="next"><i class="fa fa-angle-right"></i></span>
              <span class="previous"><i class="fa fa-angle-left"></i></span>
          </div>
          <section class="tab_content_wrapper">
            @php
              $j = 1
            @endphp
             @foreach ($tabs_data as $tabs_single_data)
              @php
                  $tabs_name = @$tabs_single_data['tabs_name'];
                  $tab_option = @$tabs_single_data['tab_option'];
                  $tabs_post_type = @$tabs_single_data['tabs_post_type'];
                  $categories = @$tabs_single_data['categories'];
                  $tabs_link = @$tabs_single_data['tabs_link'];
                  $tabs_link_to = @$tabs_single_data['tabs_link_to'];
                  $post_modified = @$tabs_single_data['post_modified'];
              @endphp
                <div class="tab_content {{ $j== 1  ? 'in active fadeIn' : 'fadeOut' }} " id="tabs_desc_@php echo $post_id; @endphp_{{$j}}">
                  @php 
                    if(@$tabs_headline){
                      echo '<h4 class="tab-headline">'. $tabs_headline .'</h4>';
                    }
                    if($tab_option ==1){
                    if($is_mobile && $i >= 5){
                        $rowStyle ='style="display:none;"';
                    }
                       @endphp
                       <div class="row">
                        @php
                        if(is_array($tabs_link) && count(@$tabs_link)){
                             for($i=0;$i< count($tabs_link); $i++){
                                if($is_mobile && $i >= 10){
                                    $rowStyle ='style="display:none;"';
                                }
                        @endphp
                             <div class="col-sm-6" {{$rowStyle }}>
                                <div class="et-wrapd">
                                  <!--<h3>-->
                                    <a href="{{$tabs_link_to[$i]}}" title="{{ ucfirst(@$tabs_link[$i]) }}">{{ ucfirst(@$tabs_link[$i]) }}</a>
                                  <!--</h3>-->
                                  <div class="post-ant-details" style="display: inline-block;">
                                      <span class="post_date">{{$post_modified[$i]}}</span>
                                  @if($categories)
                                   <span class="post_cat_list">{!! $categories[$i] !!}</span>
                                  @endif
                                  </div>
                                 
                                 </div>
                            </div>
                      @php
                          } 
                        }
                       @endphp
                       <a class="see-all-btn" title="See More" href="#" onclick="return false;" style="background: #ddd;width: 100%;display: block;text-align: center;padding: 5px 15px; margin-top: 15px;    color: #000;">More ...</a>
                      </div>
                       @php
                      }else{
                       @endphp
                        <div class="row">
                          @php 
                          if(is_array($tabs_link) && count(@$tabs_link)){
                             for($i=0;$i< count($tabs_link); $i++){
                                if($is_mobile && $i >= 10){
                                    $rowStyle ='style="display:none;"';
                                }
                              @endphp
                              <div class="col-sm-4" {{$rowStyle}}>
                                  <div class="et-link-wrap">
                                      <a href="{{$tabs_link_to[$i]}}" title="{{ ucfirst(@$tabs_link[$i]) }}">{{ ucfirst(@$tabs_link[$i]) }}</a>
                                  </div>
                              </div>
                              @php  
                             }   
                          }
                        @endphp
                        <a class="see-all-btn" title="See More" href="#" onclick="return false;" style="background: #ddd;width: 100%;display: block;text-align: center;padding: 5px 15px; margin-top: 15px;    color: #000;">More ...</a>
                        </div>
                      @php    
                      }
                    @endphp
                  </div>
                @php
                  $j = $j+ 1
                @endphp
            @endforeach
          </section>
        </div>      
      @else
            {{'No Data'}}       
      @endif
  </div>
</div>
