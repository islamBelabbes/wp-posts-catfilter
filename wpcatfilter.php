<?php
/*
 * Plugin Name: wp-cat-filter
 * Plugin URI: 
 * Description: Test Page. 
 * Version: 0.0.1
 * Author:
 * Author URI: 
 */

 function wp_cat_main(){
    // enqueue //
    wp_enqueue_script( 'wp-cat-mainscript', plugin_dir_url( __FILE__ ) . 'inc/script.js',true );
    wp_enqueue_style( 'wp-cat-mainstyle', plugin_dir_url( __FILE__ ) . 'inc/style.css');
    include("inc/main.php");
 }
 add_shortcode("wpcatfilter","wp_cat_main");
 // custom rest api endpoint //
// making custom api end point //
function wp_cat_callback(){
    $max_posts = 20;
    $args = array( 
        'post_type'   => 'post',
        'posts_per_page' => $max_posts, 
    );
    $posts = get_posts($args);
    $datapost = array();
    foreach ($posts as $post) {
        $catidarr = array();
        $catnamearr = array();
        foreach (get_the_category($post->ID) as $cat){
   $catidarr[] = $cat->term_id;
   $catnamearr[] = $cat->name;
        }
        $datapost[] = array(
            'id' => $post->ID,
            'title' => $post->post_title,
            'date' => $post->post_date,
            'content' => $post->post_content,
            'permalink' => get_permalink($post->ID),
            'img' =>get_the_post_thumbnail_url( $post->ID ),
            'cat_id' => $catidarr,
            'cat_name' => $catnamearr,
            
        );
    }
    print_r(json_encode($datapost , true));
    exit();
}
add_action( 'rest_api_init', function () {
    register_rest_route( 'wpcatfilter', '/v2', array(
      'methods' => 'GET',
      'callback' => 'wp_cat_callback',
    ) );
  } );