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
        
        return $this->mobileDetect->isMobile();
    }


}
