<?php

namespace App\Controllers;

use Sober\Controller\Controller;

class ArchiveNews extends Controller
{
    public function getThumb(){
        if(has_post_thumbnail()){
            return get_the_post_thumbnail();
        }
    }
    public function getCategoryName(){
        $categories = get_the_category();
        $separator = ' ';
        $output = '';
        if ( ! empty( $categories ) ) {
            foreach( $categories as $category ) {
                $output .= '<a href="' . esc_url( get_category_link( $category->term_id ) ) . '" alt="' . esc_attr( sprintf( __( 'View all posts in %s', 'textdomain' ), $category->name ) ) . '">' . esc_html( $category->name ) . '</a>' . $separator;
            }
            
        } 
       return  trim( $output, $separator );
    }
    public function getPostClass(){
        return get_post_class();
    }
}
