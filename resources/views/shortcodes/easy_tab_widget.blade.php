<style>
  .easy_tabs_container_wrap ul,.easy_tabs_container_wrap ol{ list-style:none outside none;}
.easy_tabs_container_wrap h1{font-size: 25px; color:#000; padding-bottom:20px; margin-bottom: 20px;}
.easy_tabs_container_wrap h3{margin:30px 0 10px;}
.easy_tabs_container_wrap p{margin: 0 0 20px;}
.easy_tabs_container_wrap pre{ border: 1px solid #ddd; box-shadow: 1px 1px 0 #fff, 2px 2px 0 #ddd; margin:10px 0; padding: 10px; background: #fcfcfc; }

.easy_tabs_container_wrap #container{ width:80%; padding:0px 50px; margin:0 auto;}

/*a:link, a:visited{ color: #000; text-decoration:none;}
a:hover{ color: #666;}*/

/*  == tab heading */
.easy_tabs_container_wrap .tabs { border: 1px solid #ccc; overflow:hidden; }
.easy_tabs_container_wrap .tabs li{ float:left; }
.easy_tabs_container_wrap .tabs li a{ border-left: 1px solid #ccc; color:rgb(0 0 0 / 65%); display:block; font-weight:bold; padding: 15px 20px; transition: all 0.5s ease;}
.easy_tabs_container_wrap .tabs li:first-child a{ border-left: none; }
.easy_tabs_container_wrap .tabs li a:hover, .tabs li a:focus{ color:#232323;  text-decoration: none;}
.easy_tabs_container_wrap .tabs .active a{ color: #000; }

/* == accordion */
.easy_tabs_container_wrap .accordion_tabs { display:none; border-top: 1px solid #ccc; padding: 10px; font-weight: bold; background: #eee; }
.easy_tabs_container_wrap .tab_content_wrapper > .accordion_tabs:first-child{ border-top:none; }
.easy_tabs_container_wrap a.accordion_tabs:link, .easy_tabs_container_wrap a.accordion_tabs:visited{ color: #21759B; }
.easy_tabs_container_wrap a.accordion_tabs:hover, .easy_tabs_container_wrap a.accordion_tabs:focus{ color:#D54E21; }
.easy_tabs_container_wrap a.accordion_tabs.active{ color: #000; border-bottom: 1px solid #ccc;}

/*  == tab content  */
.easy_tabs_container_wrap .tab_content_wrapper{ overflow:hidden;  position:relative; transition: all .3s ease-in-out .3s; }
.easy_tabs_container_wrap .tab_content{ transition: all .6s ease-in-out; padding:15px; background:#f6f6f6;}
.easy_tabs_container_wrap .toggle_display{display:block;}
.easy_tabs_container_wrap .toggle_position{ position:absolute; }
.easy_tabs_container_wrap .toggle_border{ border:1px solid #ccc; border-width: 0 1px 1px 1px; }
.easy_tabs_container_wrap .invert_border{ border-width: 1px 1px 0 1px;}

/* Media Queries
***********************/
@media screen and (max-width: 600px) {
  .easy_tabs_container_wrap  #container{ width:90%; padding:40px 20px; }
 .easy_tabs_container_wrap  .accordion_tabs{ display:block; }
  .easy_tabs_container_wrap .tab_content_wrapper{ height:auto !important;}
  .easy_tabs_container_wrap .tab_content{ transition:none; padding:10px;}
  /*.toggle_display{display:none;}*/
  .easy_tabs_container_wrap .toggle_position{ position:relative; }
  .easy_tabs_container_wrap .toggle_border{ border-width: 1px; }
}


/*/New Css*/

.easy_tabs_container_wrap .tabHeader li a {
    border: none;
    margin-bottom: 5px;
    margin-right: 5px;
}
 .easy_tabs_container_wrap .col-sm-12 {
    max-width: 100%;
    flex: 0 0 100%;
}
.easy_tabs_container_wrap .row {
    display: flex;
    flex-wrap: wrap;
    margin: 0 -15px;
}
.easy_tabs_container_wrap .col-sm-6 {
    max-width: 50%;
    flex: 0 0 50%;
}
.easy_tabs_container_wrap [class*='col-']{
    padding: 0 15px;
}
.easy_tabs_container_wrap .col-sm-4{
    max-width: 33.3%;
    flex: 0 0 33.3%;
}
.easy_tabs_container_wrap .col-sm-3{
    max-width: 25%;
    flex: 0 0 25%;
}

@media screen and (max-width: 590px){
    .easy_tabs_container_wrap .col-sm-6 {
        max-width: 100%;
        flex: 0 0 100%;
    }  
}

@media screen and (max-width: 590px){
    .easy_tabs_container_wrap .col-sm-4{
        max-width: 50%;
        flex: 0 0 50%;
    }
    .easy_tabs_container_wrap .col-sm-3{
        max-width: 50%;
        flex: 0 0 50%;
    }
}

#content .easy_tabs_container_wrap ul.tabHeader {
    list-style: none;
    padding: 0 !important;
    margin: 0;
    border: none;
}

.easy_tabs_container_wrap .tabHeader li.active a {
    background: #ffc958;
    color: #232323;
}
.easy_tabs_container_wrap .tab_content{
    background: #eee;
    width: 100%;
    height: 100%;
}

.easy_tabs_container_wrap .tabHeader a {
    padding: 10px 10px 8px;
    font-size: 12px;
    background: #eee;
    font-weight: 500;
    color: #000;
    font-family: 'Fira Sans', sans-serif;
}

@media screen and (max-width: 590px){
    .easy_tabs_container_wrap [class*="col-sm-6"]:not(:last-child) .et-wrapd,
    .easy_tabs_container_wrap [class*="col-sm-3"]:not(:last-child) .et-link-wrap,
    .easy_tabs_container_wrap [class*="col-sm-4"]:not(:last-child) .et-link-wrap   {
        margin-bottom: 5px;
        border-bottom: 1px dashed #c7c7c7;
        padding-bottom: 5px;
    }
}

@media screen and (min-width: 591px){
    .easy_tabs_container_wrap [class*="col-sm-6"]:not(:nth-last-child(-n+2)) .et-wrapd {
        margin-bottom: 5px;
        border-bottom: 1px dashed #c7c7c7;
        padding-bottom: 5px;
    }
    .easy_tabs_container_wrap [class*="col-sm-3"]:not(:nth-last-child(-n+4)) .et-link-wrap {
        margin-bottom: 5px;
        border-bottom: 1px dashed #c7c7c7;
        padding-bottom: 5px;
    }
    .easy_tabs_container_wrap [class*="col-sm-4"]:not(:nth-last-child(-n+3)) .et-link-wrap {
        margin-bottom: 5px;
        border-bottom: 1px dashed #c7c7c7;
        padding-bottom: 5px;
    }

}
.easy_tabs_container_wrap .tab-headline{
/*    padding: 0 15px; */
  text-align:center;
}
.easy_tabs_container_wrap h3 {
    padding-bottom: 2px;
}
.easy_tabs_container_wrap .post-ant-details {
    font-size: 13px;
}
.easy_tabs_container_wrap  a, .easy_tabs_container_wrap .et-link-wrap a, .easy_tabs_container_wrap h3{
    font-size: 14px;
}
.easy_tabs_container_wrap a:hover, .easy_tabs_container_wrap .et-link-wrap a:hover {
    text-decoration: underline;
}
.easy_tabs_container_wrap .toggle_border{
    border: none;
}

.easy_tabs_container_wrap .post-ant-details span:not(:last-child) {
    border-right: 1px solid #fff;
    padding-right: 5px;
}
.easy_tabs_container_wrap .fadeOut{
  display: none;
}
.easy_tabs_container_wrap .fadeIn{
  display: block;
}
 
 
 /*//Tab scrolling */
 .easy_tabs_wrapper{
    overflow: hidden;
    height: 35px; 
     position: relative;
 }
 .easy_tabs_wrapper ul.tabs {
    overflow: auto;
    white-space: nowrap;
    margin:0 30px;
    
}

.easy_tabs_wrapper ul.tabs li {
    float: none;
    display: inline-block;
     line-height: 0 !important;
}

.easy_tabs_container_wrap .next, .easy_tabs_container_wrap .previous {
    /* position:absolute; */
    padding: 2px 4px;
    top: 0;
    background-color: #232323;
  opacity: 0.63;
  border-radius: 50%;
    width: 30px;
    height: 30px;
    line-height: 25px;
    display: block;
    text-align: center;
    position: absolute;
    cursor: pointer;
    color: #ddd;
}

.easy_tabs_container_wrap .next {
    right: 0;
}

.easy_tabs_container_wrap .previous {
    left: 0;
}
</style>
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
                  $tabs_category = @$tabs_single_data['tabs_category'];
                  $tabs_link = @$tabs_single_data['tabs_link'];
                  $tabs_link_to = @$tabs_single_data['tabs_link_to'];
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
                                   <span class="post_cat_list">{{$categories }}</span>
                                  @endif
                                  </div>
                                 
                                 </div>
                            </div>
                      @php
                          } 
                        }
                       @endphp
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
