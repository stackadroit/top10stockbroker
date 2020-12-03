<!doctype html>
<html {!! get_language_attributes() !!}>
  @include('partials.head')
  <style type="text/css">
    .edu_about {display: flex;align-items: center;flex-wrap: wrap;padding: 25px 15px;background: #f5f5f5;margin-bottom: 80px;margin-top: 30px;box-shadow: 2px 2px 15px rgb(0 0 0 / 20%);}
    .edu_about .col-6 {max-width: 50%;flex: 0 0 50%;padding: 0 15px;
    }
    .edu_img {text-align: center;}
    .edu_img img {margin: 0;}
    .v_tabs_wrapper {width: 100%;text-align: center;margin: 0 auto;background: transparent;padding: 0 15px 15px;}
    #content ul.v_tabs {padding: 0 !important;}
    ul.v_tabs {
    display: inline-block;vertical-align: top;        position: relative;z-index: 10;margin: 0;width: 25%;       min-width: 175px;list-style: none;-ms-transition: all 0.3s ease;
    -webkit-transition: all 0.3s ease;transition: all 0.3s ease;
    }
    ul.v_tabs li {margin: 0;cursor: pointer;padding: 8px 10px;position: relative;color: #232323;font-size: 13px;border-radius: 30px;text-align: left;background: #fff;
    -ms-transition: all 0.3s ease;
    -webkit-transition: all 0.3s ease;
    transition: all 0.3s ease;display: flex;
    align-items: center;box-shadow: 2px 2px 10px rgb(0 0 0 / 48%);
    }
    ul.v_tabs li:not(:last-child) {margin-bottom: 15px;}
    ul.v_tabs li i {position: absolute;top: 50%;right: 15px;
    transform: translateY(-50%);font-size: 20px;color: #e55025;
    }
    ul.v_tabs li img {width: 30px;margin-bottom: 0;margin-right: 10px;}
    ul.v_tabs li:hover {background: #e55025;color: #fff;       -ms-transition: all 0.3s ease;
    -webkit-transition: all 0.3s ease;
    transition: all 0.3s ease;}
    ul.v_tabs li.v_active {background: #e55025;color: #fff;        -ms-transition: all 0.3s ease;
    -webkit-transition: all 0.3s ease;transition: all 0.3s ease;}
    ul.v_tabs li.v_active i, ul.v_tabs li:hover i {color: #fff;}
    .v_tab_container {display: inline-block;vertical-align: top;position: relative;z-index: 20;left: 0;width: 75%;     min-width: 10px;text-align: left;}
    .v_tab_content {padding: 0 15px 20px 30px;height: 100%;       display: none;
    }
    .v_tab_drawer_heading {display: none;}
    .nested_tabs .tabHeader {border-bottom: 2px solid #e55025 !important;text-align: center;}
    .nested_tabs .tabHeader li a {padding: 25px 35px;margin: 0;font-size: 18px;font-weight: 500;background: #f5f5f5;color: rgb(35 35 35 / 65%);
    border-left: 2px solid #2323232b;}
    .nested_tabs .tabHeader li.active a {background: #ffc958;
    color: #232323;
    }
    .nested_tabs .easy_tabs_wrapper {height: 60px;}
    .nested_tabs .tab_content {background: transparent;padding: 15px 0 0;}
    .nested_tabs .next, .nested_tabs .previous {top: 10px;}
    .dots {display: flex;align-items: center;margin-bottom: 30px;
    }
    .dots p {margin: 0;padding-left: 15px;}
    .dots p strong {border: 3px solid #ffc958;border-radius: 50%;margin-right: 7px;display: inline-block;}
    #content ul.list-content {display: flex;flex-wrap: wrap;background: #ffffff;box-shadow: 2px 2px 10px rgb(0 0 0 / 17%);padding: 0 !important;margin: 0;}
    ul.list-content li {width: 31%;padding: 10px 0 10px 25px;list-style: none;position: relative;border-bottom: 1px dotted #23232352;margin-right: 2%;font-size: 18px;}
    ul.list-content li:before {content: '\f0da';font-family: 'fontawesome';color: hsl(13deg 79% 52%);display: block;position: absolute;left: 12px;font-size: 14px;top: 14px;}
    ul.list-content li a {color: #232323;}
    @media screen and (max-width: 781px) {.nested_tabs .tab_content {padding: 20px 0 0;}
    .nested_tabs .tabHeader li a {padding: 18px 15px;font-size: 13px;}
    .nested_tabs .easy_tabs_wrapper {height: 45px;}
    ul.list-content{border-radius: 5px;box-shadow: 0px 0px 5px rgb(0 0 0/17%);}
    .nested_tabs .next, .nested_tabs .previous {top: 6px;}
    ul.list-content li {width: 48%;margin-right: 2%;}
    .edu_about .col-6 {max-width: 100%;flex: 0 0 100%;           padding: 0;}
    .edu_img {display: none;}
    ul.v_tabs {display: none;}
    .v_tabs_wrapper{padding: 0 5px 15px;}
    .v_tab_content {padding: 5px;margin-bottom: 10px;}       .v_tab_container {display: block;margin: 0 auto;width: 100%;border-top: none;border-radius: 0;background: white;}
    .v_tab_drawer_heading {background: #fff;border-radius: 30px; box-shadow: 0 0 5px rgb(0 0 0 / 48%);color: #232323 !important;margin: 0 0 10px 0 !important;padding: 7px 12px !important;display: flex;align-items: center;font-size: 13px !important;cursor: pointer;-webkit-touch-callout: none;-webkit-user-select: none;
    -khtml-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;position: relative;}<
    .v_tab_drawer_heading i {position: absolute;top: 50%;right: 20px;transform: translateY(-50%) rotateZ(90deg);          font-size: 20px;display: block;transition: all 0.3s ease;color: #e55025;}
    .v_tab_drawer_heading.d_active i {transform: translateY(-50%) rotateZ(0deg);color: #fff;}
    .v_tab_drawer_heading img {width: 28px;margin-bottom: 0;margin-right: 10px;}
    .v_tab_drawer_heading:hover {background: #e55025;color: #fff !important;}
    .v_tab_drawer_heading:hover i{color: #fff;}        .v_tab_drawer_heading.d_active {background: #e55025;color: #fff !important;
    }
    }
  </style>
  <body @php body_class() @endphp>
    @php do_action('get_header') @endphp
    @include('partials.header')
    <div class="wrap container" id="main-content" role="document">
      <div id="content" class="content row">
        <main class="main col-lg-12 order-lg-1">
          @include('partials.ajax.widget-market')
          @yield('content')
        </main>
        
      </div>
    </div>
    @php do_action('get_footer') @endphp
    @include('partials.footer')
    @php wp_footer() @endphp
  </body>
</html>
