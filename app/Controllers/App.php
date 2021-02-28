<?php

namespace App\Controllers;

use Sober\Controller\Controller;
use Detection\MobileDetect;

class App extends Controller
{

    public $mobileDetect = null;

    public function siteName()
    {
        return get_bloginfo('name');
    }

    public static function title()
    {
        if (is_home()) {
            if ($home = get_option('page_for_posts', true)) {
                return get_the_title($home);
            }
            return __('Latest Posts', 'stockadroit');
        }
        if (is_archive()) {
            return get_the_archive_title();
        }
        if (is_search()) {
            return sprintf(__('Search Results for %s', 'stockadroit'), get_search_query());
        }
        if (is_404()) {
            return __('Not Found', 'stockadroit');
        }
        return get_the_title();
    }

    public function is_mobile(){

        if (! $this->mobileDetect) {
            $this->mobileDetect = new MobileDetect();
        }
        
        // return $this->mobileDetect->isMobile();
        return false;
    }

    public function hello_bar(){
        global $wp_query;
        $post = $wp_query->post;
        $hello_bar = get_post_meta( $post->ID, 'hello-checkbox', true );
        $hellobar_type = get_post_meta( $post->ID, 'wpcf-hello-bar-type', true );
        switch ($hellobar_type) {
            case 'IPO':
                $data = array(
                    'contactform' => 'wpcf-ipo-form-shortcode', 
                    'form_left_content' => 'wpcf-ipo-popup-left-side-content-on-form', 
                    'form_right_content' => 'wpcf-ipo-popup-right-side-top-content', 
                    'form_mobile_content' => 'wpcf-ipo-mobile-content', 
                    'auto_popup_left_content' => 'wpcf-ipo-auto-popup-left-content', 
                    'auto_popup_right_content' => 'wpcf-ipo-auto-popup-right-content', 
                    'auto_popup_mobile_content' => 'wpcf-ipo-auto-popup-mobile-content', 
                    'custom_hellobar' => 'wpcf-hello-bar-ipo-content',
                );
                break;
            case 'DEMAT':
                $data = array(
                    'contactform' => 'wpcf-demat-form-shortcode', 
                    'form_left_content' => 'wpcf-demat-popup-left-side-content-on-form', 
                    'form_right_content' => 'wpcf-demat-popup-right-side-top-content', 
                    'form_mobile_content' => 'wpcf-demat-mobile-content', 
                    'auto_popup_left_content' => 'wpcf-demat-auto-popup-left-content', 
                    'auto_popup_right_content' => 'wpcf-demat-auto-popup-right-content', 
                    'auto_popup_mobile_content' => 'wpcf-demat-auto-popup-mobile-content', 
                    'custom_hellobar' => 'wpcf-hello-bar-demat-content',
                );
                break;
            case 'FRANCHISE':
                $data = array(
                    'contactform' => 'wpcf-franchise-form-shortcode', 
                    'form_left_content' => 'wpcf-franchise-popup-left-side-content-on-form', 
                    'form_right_content' => 'wpcf-franchise-popup-right-side-top-content', 
                    'form_mobile_content' => 'wpcf-franchise-mobile-content', 
                    'auto_popup_left_content' => 'wpcf-franchise-auto-popup-left-content', 
                    'auto_popup_right_content' => 'wpcf-franchise-auto-popup-right-content', 
                    'auto_popup_mobile_content' => 'wpcf-franchise-auto-popup-mobile-content', 
                    'custom_hellobar' => 'wpcf-hello-bar-franchise-content',
                );
                break;
            case 'Mutual Fund':
                $data = array(
                    'contactform' => 'wpcf-mutual-fund-form-shortcode', 
                    'form_left_content' => 'wpcf-mutual-fund-popup-left-side-content-on-form', 
                    'form_right_content' => 'wpcf-mutual-fund-popup-right-side-top-content', 
                    'form_mobile_content' => 'wpcf-mutual-fund-mobile-content', 
                    'auto_popup_left_content' => 'wpcf-mutual-fund-auto-popup-left-content', 
                    'auto_popup_right_content' => 'wpcf-mutual-fund-auto-popup-right-content', 
                    'auto_popup_mobile_content' => 'wpcf-mutual-fund-auto-popup-mobile-content', 
                    'custom_hellobar' => 'wpcf-hello-bar-mutual-fund-content',
                );
                break; 
            case 'default':
                $data = array(
                    'contactform' => 'wpcf-default-form-shortcode', 
                    'form_left_content' => 'wpcf-popup-left-side-content-on-form', 
                    'form_right_content' => 'wpcf-popup-right-side-top-content', 
                    'form_mobile_content' => 'wpcf-mobile-content', 
                    'auto_popup_left_content' => 'wpcf-auto-popup-left-content', 
                    'auto_popup_right_content' => 'wpcf-auto-popup-right-content', 
                    'auto_popup_mobile_content' => 'wpcf-auto-popup-mobile-content', 
                    'custom_hellobar' => 'wpcf-hello-bar-default-content',
                );
                break;
            default:
                $data = array(
                    'contactform' => '', 
                    'form_left_content' => '', 
                    'form_right_content' => '', 
                    'form_mobile_content' => '', 
                    'auto_popup_left_content' => '', 
                    'auto_popup_right_content' => '', 
                    'auto_popup_mobile_content' => '', 
                    'custom_hellobar' => '',
                );
                break;
        }

        $data['hello_bar'] = $hello_bar;
        $data['post_id'] = $post->ID;
        return $data;

    }
    public function suggestion_menu()
    {
        $tab_id = get_post_meta( get_the_id() , 'tab_filter_id' , true );
        if( !empty( $tab_id ) ) :
            global $wp;
            $get_meta = get_post_meta( $tab_id , 'repeatable_fields' , true );
            $current_url = home_url( add_query_arg( array(), $wp->request ) ).'/';

            return array('current_url' => $current_url,'get_meta' => $get_meta);
        endif;  
    }

    public function footer_about(){
        return 'Top10stockbroker.com & Indianfranchisereview.com are websites under Medmonx Enterprises Private Limited. We are certified stock broker review & comparison website working with multiple partners. ...';
    }
}
