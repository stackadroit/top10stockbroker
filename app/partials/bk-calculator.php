<?php

$newsObj = new Calculator;
class Calculator
{
    private $default_per_page = 10;
    private $default_per_page_sidebar = 4;
    private $default_order_by = 'date_DESC';
    private $date_format = 'd-M-Y';
    private $custome_post_slug = 'state';
    public $feeds = array();
    public $url;
    public $feeds_status = false;
    
    /*
     *
     */
    public function __construct()
    {
        add_action('init', array($this,'create_post_type'));
        add_action('admin_init', array($this,'add_bk_field'));
        add_action('save_post', array($this,'save_bk_field'));
        
        add_action('admin_init', array($this,'add_stamp_fee'));
        add_action('save_post', array($this,'save_stamp_fee'));
        add_action('save_post', array($this,'save_news_post'));
        add_action('admin_menu', array($this,'create_menu'));
        add_action('manage_news_posts_custom_column', array($this,'news_table_column_value'));
        
        add_filter('post_updated_messages', array($this,'news_messages'));
        add_filter('manage_edit-news_columns', array($this,'news_edit_table_columns'));
                        
        add_shortcode('amicus-news-post-side', array( $this, 'shortcode_news_sidebar'));
        add_shortcode('amicus-news-post-list', array( $this, 'shortcode_show_news'));
        add_shortcode('amicus-news-post-detail', array( $this, 'shortcode_show_news_detail'));
    }
    
    
    
    public function add_bk_field()
    {
        add_meta_box('Equity_Delivery_id', 'Equity Delivery', array($this,'add_bk_equity_del_field'), 'brokerage-calculator', 'normal', 'high');
        add_meta_box('Equity_intraday_id', 'Equity intraday', array($this,'add_bk_equity_intraday_field'), 'brokerage-calculator', 'normal', 'high');
        add_meta_box('Equity_futures_id', 'Equity futures', array($this,'add_bk_equity_futures_field'), 'brokerage-calculator', 'normal', 'high');
        add_meta_box('Equity_Options_id', 'Equity Options', array($this,'add_bk_equity_options_field'), 'brokerage-calculator', 'normal', 'high');
        add_meta_box('Currency_futures_id', 'Currency futures', array($this,'add_bk_currency_futures_field'), 'brokerage-calculator', 'normal', 'high');
        add_meta_box('Currency_Options_id', 'Currency Options', array($this,'add_bk_currency_options_field'), 'brokerage-calculator', 'normal', 'high');
        add_meta_box('Commodity_id', 'Commodity', array($this,'add_bk_commodity_field'), 'brokerage-calculator', 'normal', 'high');
        add_meta_box('after_content_id', 'After Calculater Content', array($this,'add_bk_content'), 'brokerage-calculator', 'normal', 'high');
        //add_meta_box('hello_checkbox', 'Check for Broker Hello Bar', array($this,'add_hello_bar'), 'brokerage-calculator', 'normal', 'high');
    }


    public function add_bk_content()
    {
        global $post;
        $get_all_meta_values = get_post_custom($post->ID);
        $after_content=$get_all_meta_values["after_content"][0];
        echo '<label>After Calculater:</label>
		<textarea name="after_content" cols="90" rows="7">'.$after_content.'</textarea>';
    }
    
    public function add_bk_commodity_field()
    {
        global $post;
        $get_all_meta_values = get_post_custom($post->ID);
        $commodity=$get_all_meta_values["commodity"][0];
        $commodity_max=$get_all_meta_values["commodity_max"][0];
        $commodity_tr=$get_all_meta_values["commodity_tr"][0];
        echo '<label>Commodity:</label>
		<input type="text" name="commodity" size="100" value="'.$commodity.'" />';
        echo '<p></p><label>Commodity Maximum:</label>
		<input type="text" name="commodity_max" size="100" value="'.$commodity_max.'" />';
        
        echo '<p></p><label>Commodity Transaction:</label>
		<input type="text" name="commodity_tr" size="100" value="'.$commodity_tr.'" />';
    }
    
    public function add_bk_currency_options_field()
    {
        global $post;
        $get_all_meta_values = get_post_custom($post->ID);
        $currency_options_max=$get_all_meta_values["currency_options_max"][0];
        $currency_options=$get_all_meta_values["currency_options"][0];
        $currency_options_tr=$get_all_meta_values["currency_options_tr"][0];
        echo '<label>Currency Options:</label>
		<input type="text" name="currency_options" size="100" value="'.$currency_options.'" />';
        
        echo '<p></p><label>Currency Options Maximum:</label>
		<input type="text" name="currency_options_max" size="100" value="'.$currency_options_max.'" />';
        
        echo '<p></p><label>Currency Options Transaction:</label>
		<input type="text" name="currency_options_tr" size="100" value="'.$currency_options_tr.'" />';
    }
    
    
    public function add_bk_currency_futures_field()
    {
        global $post;
        $get_all_meta_values = get_post_custom($post->ID);
        $currency_futures=$get_all_meta_values["currency_futures"][0];
        $currency_futures_tr=$get_all_meta_values["currency_futures_tr"][0];
        $currency_futures_max=$get_all_meta_values["currency_futures_max"][0];
        echo '<label>Currency futures:</label>
		<input type="text" name="currency_futures" size="100" value="'.$currency_futures.'" />';
        
        echo '<p></p><label>Currency futures Maximum:</label>
		<input type="text" name="currency_futures_max" size="100" value="'.$currency_futures_max.'" />';
        
        echo '<p></p><label>Currency futures Transaction:</label>
		<input type="text" name="currency_futures_tr" size="100" value="'.$currency_futures_tr.'" />';
    }
    
    public function add_bk_equity_options_field()
    {
        global $post;
        $get_all_meta_values = get_post_custom($post->ID);
        $equity_options=$get_all_meta_values["equity_options"][0];
        $equity_options_max=$get_all_meta_values["equity_options_max"][0];
        $equity_options_tr=$get_all_meta_values["equity_options_tr"][0];
        echo '<label>Equity Options:</label>
		<input type="text" name="equity_options" size="100" value="'.$equity_options.'" />';
        
        echo '<p></p><label>Commodity Maximum:</label>
		<input type="text" name="equity_options_max" size="100" value="'.$equity_options_max.'" />';
        
        echo '<p></p><label>Equity Options Transaction:</label>
		<input type="text" name="equity_options_tr" size="100" value="'.$equity_options_tr.'" />';
    }
    
    
    public function add_bk_equity_futures_field()
    {
        global $post;
        $get_all_meta_values = get_post_custom($post->ID);
        $equity_futures=$get_all_meta_values["equity_futures"][0];
        $equity_futures_max=$get_all_meta_values["equity_futures_max"][0];
        $equity_futures_tr=$get_all_meta_values["equity_futures_tr"][0];
        echo '<label>Equity Futures:</label>
		<input type="text" name="equity_futures" size="100" value="'.$equity_futures.'" />';
        
        echo '<p></p><label>Equity Futures Maximum:</label>
		<input type="text" name="equity_futures_max" size="100" value="'.$equity_futures_max.'" />';
        
        echo '<p></p><label>Equity Futures Transaction:</label>
		<input type="text" name="equity_futures_tr" size="100" value="'.$equity_futures_tr.'" />';
    }
    
    public function add_bk_equity_del_field()
    {
        global $post;
        $get_all_meta_values = get_post_custom($post->ID);
        $equity_delivery=$get_all_meta_values["equity_delivery"][0];
        $equity_delivery_max=$get_all_meta_values["equity_delivery_max"][0];
        $equity_delivery_tr=$get_all_meta_values["equity_delivery_tr"][0];
        echo '<label>Equity Delivery:</label>
		<input type="text" name="equity_delivery" size="100" value="'.$equity_delivery.'" />';
        
        echo '<p></p><label>Equity Delivery Maximum:</label>
		<input type="text" name="equity_delivery_max" size="100" value="'.$equity_delivery_max.'" />';
        
        
        echo '<p></p><label>Equity Delivery Transaction:</label>
		<input type="text" name="equity_delivery_tr" size="100" value="'.$equity_delivery_tr.'" />';
    }
    
    public function add_bk_equity_intraday_field()
    {
        global $post;
        $get_all_meta_values = get_post_custom($post->ID);
        $equity_intraday=$get_all_meta_values["equity_intraday"][0];
        $equity_intraday_max=$get_all_meta_values["equity_intraday_max"][0];
        $equity_intraday_tr=$get_all_meta_values["equity_intraday_tr"][0];
        echo '<label>Equity Intraday:</label>
		<input type="text" name="equity_intraday" size="100" value="'.$equity_intraday.'" />';
        
        echo '<p></p><label>Equity Intraday Maximum:</label>
		<input type="text" name="equity_intraday_max" size="100" value="'.$equity_intraday_max.'" />';
        
        echo '<p></p><label>Equity Intraday Transaction:</label>
		<input type="text" name="equity_intraday_tr" size="100" value="'.$equity_intraday_tr.'" />';
    }


    public function save_bk_field()
    {
        $post_type = get_post_type(get_the_id());
        if ($post_type == 'brokerage-calculator') {
            global $post;
            update_post_meta($post->ID, "equity_delivery_tr", $_POST["equity_delivery_tr"]);
            update_post_meta($post->ID, "equity_delivery", $_POST["equity_delivery"]);
            update_post_meta($post->ID, "equity_delivery_max", $_POST["equity_delivery_max"]);
            update_post_meta($post->ID, "equity_intraday", $_POST["equity_intraday"]);
            update_post_meta($post->ID, "equity_intraday_tr", $_POST["equity_intraday_tr"]);
            update_post_meta($post->ID, "equity_intraday_max", $_POST["equity_intraday_max"]);
            update_post_meta($post->ID, "equity_options", $_POST["equity_options"]);
            update_post_meta($post->ID, "equity_options_tr", $_POST["equity_options_tr"]);
            update_post_meta($post->ID, "equity_options_max", $_POST["equity_options_max"]);
            update_post_meta($post->ID, "currency_futures", $_POST["currency_futures"]);
            update_post_meta($post->ID, "currency_futures_tr", $_POST["currency_futures_tr"]);
            update_post_meta($post->ID, "currency_futures_max", $_POST["currency_futures_max"]);
            update_post_meta($post->ID, "currency_options_tr", $_POST["currency_options_tr"]);
            update_post_meta($post->ID, "currency_options", $_POST["currency_options"]);
            update_post_meta($post->ID, "currency_options_max", $_POST["currency_options_max"]);
            update_post_meta($post->ID, "commodity", $_POST["commodity"]);
            update_post_meta($post->ID, "commodity_tr", $_POST["commodity_tr"]);
            update_post_meta($post->ID, "commodity_max", $_POST["commodity_max"]);
            update_post_meta($post->ID, "equity_futures", $_POST["equity_futures"]);
            update_post_meta($post->ID, "equity_futures_tr", $_POST["equity_futures_tr"]);
            update_post_meta($post->ID, "equity_futures_max", $_POST["equity_futures_max"]);
            update_post_meta($post->ID, "after_content", $_POST["after_content"]);
            //	update_post_meta($post->ID, "hello-checkbox", $_POST["hello-checkbox"]);
        }
    }
    
    public function add_stamp_fee()
    {
        add_meta_box('stamp_fee_id', 'Stamp FEE', array($this,'add_stamp_fee_field'), 'state', 'normal', 'high');
    }

    public function add_stamp_fee_field()
    {
        global $post;
        $get_all_meta_values = get_post_custom($post->ID);
        $stamp_fee=$get_all_meta_values["stamp_fee_id"][0];
        echo '<label>Stamp Fee:</label>
		<input type="text" name="stamp_fee_id" size="100" value="'.$stamp_fee.'" />';
    }


    public function save_stamp_fee()
    {
        global $post;
        $post_type = get_post_type(get_the_id());
        if ($post_type == 'brokerage_calculator') {
            update_post_meta($post->ID, "stamp_fee_id", $_POST["stamp_fee_id"]);
        }
    }
    /*
     * @create menu
     */
    public function create_menu()
    {
        add_options_page('BK setting', 'BK setting', 'manage_options', 'bk_setting', array($this,'bk_setting'));
        // add_submenu_page( 'edit.php?post_type=state','State','State' ,'manage_options', 'bk-state', array($this,'news_setting'));
      //  add_submenu_page( 'edit.php?post_type=bk_calculator','Third Party News','Third Party News' ,'manage_options', 'amicus-third-party-news', array($this,'third_party_news_form'));
    }
    
 
       
    /**
     * @function for show the the custom message for news section
     * @Params: An array
     * @return: An array with custom message
     */
     
    public function news_messages($messages)
    {
        $messages['news'] = array(
                    0 => '',
                    1 => 'News updated.',
                    2 => 'Custom field updated.',
                    3 => 'Custom field deleted.',
                    4 => 'News updated.',
                    5 => isset($_GET['revision']) ? sprintf(__('News restored to revision from %s'), wp_post_revision_title((int) $_GET['revision'], false)) : false,
                    6 => 'News published.',
                    7 => 'News saved.',
                    8 => 'News submitted.',
                    9 => 'News scheduled',
                    10 => 'News draft updated.',
            );
        return $messages;
    }

    /**
     * @function for show the the customise table heading
     * @Params: An array
     * @return: An array with custom heading name
     */
    public function news_edit_table_columns($defaults)
    {
        unset($defaults['author']);
        unset($defaults['comments']);
        unset($defaults['date']);
        $defaults['author']  = 'Author';
        $defaults['date']  = 'Date';
        return $defaults;
    }

    /**
     * @function for show the the value of custom column
     * @Params: Column name
     * @return: A value of column name
     */
     
    public function news_table_column_value($column_name)
    {
        global $post;
        /*
        if ($column_name == 'news_language') {
            $news_language = get_post_meta( $post->ID, 'news_language', true );
            echo $news_language;
        }
        */
    }
    
    /**
     * @function for save the language type of news
     * @Params: PostID
     * @return: Null
     */
    public function save_news_post($post_id)
    {
        global $wpdb;
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return;
        }

        if (!isset($_POST['news_box_content_nonce']) ||  !wp_verify_nonce($_POST['news_box_content_nonce'], plugin_basename(__FILE__))) {
            return;
        }

        $news_fromdate = isset($_POST['news_fromdate'])?$_POST['news_fromdate']:'';
        $news_todate = isset($_POST['news_todate'])?$_POST['news_todate']:'';
        update_post_meta($post_id, 'news_fromdate', $news_fromdate);
        update_post_meta($post_id, 'news_todate', $news_todate);
        //Check newid exist on news order table
    }
    
    public function shortcode_news_sidebar()
    {
        global $wpdb;
        
        $sort = get_option('amicus_news_order_by', $this->default_order_by);
        $sort = explode('_', $sort);
        $sort =array($sort[0]=>$sort[1]);
          
        $query = new WP_Query(array(
            'post_type' => $this->custome_post_slug,
            'posts_per_page'=>get_option('amicus_news_per_page_side', $this->default_per_page_sidebar),
            'order_by'=>$sort,
        ));
        
        if ($query->have_posts()):
           
            while ($query->have_posts()) :
            $query->the_post();
 
 
        echo
            '<div class="nwz-box">
                <div class="nwz-img">'. get_the_post_thumbnail(null, array(80,80)) .'</div>
                <div class="nwz-details">
                   <h3>'. get_the_title() .'</h3>
                    <p>'. strip_tags(get_the_excerpt() .'<a><b><i><strong>') .'</p>
                    <div class="nwz-button"><a href="'.get_permalink().'">Read More</a></div>
                </div>
            </div>';

        endwhile;
        
        endif;
    }
    
    public function shortcode_show_news()
    {
        global $wpdb;
        
        $sort = get_option('amicus_news_order_by', $this->default_order_by);
        $sort = explode('_', $sort);
        $sort =array($sort[0]=>$sort[1]);
          
        $query = new WP_Query(array(
            'post_type' => $this->custome_post_slug,
            'posts_per_page'=>get_option('amicus_news_per_page', $this->default_per_page),
            'order_by'=>$sort,
        ));
        
        if ($query->have_posts()):
           
            while ($query->have_posts()) :
            $query->the_post();
 
 
        echo
            '<div class="date-box">'.  get_the_date($this->date_format) .'</div>
            <div class="bigg-nwz-box">
                <div class=" col-lg-2 col-md-2 col-sm-2 big-nwz-img">'.get_the_post_thumbnail(null, 'thumbnail').'</div>	
                <div class=" col-lg-10 col-md-10 col-sm-10 big-nwz-details">
                    <h3>'.get_the_title().'</h3>
                    <p>'. strip_tags(get_the_excerpt() .'<a><b><i><strong>') .'</p>
                    <div class="big-nwz-button"><a href="'.get_permalink().'">Read More</a></div>
                </div>	
            </div>';
            
        endwhile;
            
        endif;
    }
        
    public function bk_setting()
    {
        if (isset($_POST['bk_calculater_setting'])) {
            $this->bk_save_setting();
        }
        $stt = get_option('stt');
        $gst = get_option('gst');
        $sebi = get_option('sebi'); ?>
		<form name="add_user" action="" method="post" >
			<input type="hidden" name="bk_calculater_setting" value="33" />
            <table>
                <tr>
                    <td>STT</td>
                    <td><input type="text" name="stt" value="<?php echo $stt; ?>" />%</td>
                </tr>
                <tr>
                    <td>GST</td>
                    <td><input type="text" name="gst" value="<?php echo $gst; ?>" width="277" height="28"/>%</td>
                </tr>
                <tr>
                    <td>SEBI</td>
                    <td><input type="text" name="sebi" value="<?php echo $sebi; ?>" />%</td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td><input type="submit" name="submit" value="Save" /></td>
                </tr>
            </table>
		</form>
		<?php
    }

    public function bk_save_setting()
    {
        if ($_POST['stt']!="") {
            update_option('stt', $_POST['stt']);
        }
        if ($_POST['gst']!="") {
            update_option('gst', $_POST['gst']);
        }
        if ($_POST['sebi']!="") {
            update_option('sebi', $_POST['sebi']);
        }
    }
}
