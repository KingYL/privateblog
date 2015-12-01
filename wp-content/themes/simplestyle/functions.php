<?php

if ( function_exists('register_sidebar-1') ) {
  register_sidebar();
}

if(function_exists('register_nav_menus')){
  register_nav_menus( array(
    'header-menu' => __( 'topnav' )
    ) );
}

//边栏彩色标签
function colorCloud($text) {
  $text = preg_replace_callback('|<a (.+?)>|i','colorCloudCallback', $text);
  return $text;
}
function colorCloudCallback($matches) {
  $text = $matches[1];
  $color = dechex(rand(0,16777215));
  $pattern = '/style=(\'|\”)(.*)(\'|\”)/i';
  $text = preg_replace($pattern, "style=\"background-color:#{$color};$2;\"", $text);
  return "<a $text>";
}
add_filter('wp_tag_cloud', 'colorCloud', 1);


/*面包屑导航*/
function dimox_breadcrumbs() {

  $delimiter = '&raquo;';
  $name = '首页'; //text for the 'Home' link
  $currentBefore = '<li class="uk-active"><span>';
  $currentAfter = '</span></li>';

  if ( !is_home() && !is_front_page() || is_paged() ) {

    echo '<ul class="uk-breadcrumb">';

    global $post;
    $home = get_bloginfo('url');
    echo '<li><a href="'.$home.'">' . $name . '</a></li>';

    if ( is_category() ) {
      global $wp_query;
      $cat_obj = $wp_query->get_queried_object();
      $thisCat = $cat_obj->term_id;
      $thisCat = get_category($thisCat);
      $parentCat = get_category($thisCat->parent);
      if ($thisCat->parent != 0) echo(get_category_parents($parentCat, TRUE, ' ' . $delimiter . ' '));
      echo $currentBefore . '分类 &quot;';
      single_cat_title();
      echo '&quot;' . $currentAfter;

    } elseif ( is_day() ) {
      echo '' . get_the_time('Y') . ' ' . $delimiter . ' ';
      echo '' . get_the_time('F') . ' ' . $delimiter . ' ';
      echo $currentBefore . get_the_time('d') . $currentAfter;

    } elseif ( is_month() ) {
      echo '' . get_the_time('Y') . ' ' . $delimiter . ' ';
      echo $currentBefore . get_the_time('F') . $currentAfter;

    } elseif ( is_year() ) {
      echo $currentBefore . get_the_time('Y') . $currentAfter;

    } elseif ( is_single() ) {
      $cat = get_the_category(); $cat = $cat[0];
      echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
      echo $currentBefore;
      the_title();
      echo $currentAfter;

    } elseif ( is_page() && !$post->post_parent ) {
      echo $currentBefore;
      the_title();
      echo $currentAfter;

    } elseif ( is_page() && $post->post_parent ) {
      $parent_id  = $post->post_parent;
      $breadcrumbs = array();
      while ($parent_id) {
        $page = get_page($parent_id);
        $breadcrumbs[] = '' . get_the_title($page->ID) . '';
        $parent_id  = $page->post_parent;
      }
      $breadcrumbs = array_reverse($breadcrumbs);
      foreach ($breadcrumbs as $crumb) echo $crumb . ' ' . $delimiter . ' ';
      echo $currentBefore;
      the_title();
      echo $currentAfter;

    } elseif ( is_search() ) {
      echo $currentBefore . '&quot;' . get_search_query() . '&quot; 的搜索结果如下：' . $currentAfter;

    } elseif ( is_tag() ) {
      echo $currentBefore . 'Posts tagged &#39;';
      single_tag_title();
      echo '&#39;' . $currentAfter;

    } elseif ( is_author() ) {
     global $author;
     $userdata = get_userdata($author);
     echo $currentBefore . 'Articles posted by ' . $userdata->display_name . $currentAfter;

   } elseif ( is_404() ) {
    echo $currentBefore . 'Error 404' . $currentAfter;
  }

  if ( get_query_var('paged') ) {
    if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' (';
      echo __('Page') . ' ' . get_query_var('paged');
      if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';
}

echo '</ul>';

}
}

/*阅读量显示*/
function getPostViews($postID){   
  $count_key = 'post_views_count';   
  $count = get_post_meta($postID, $count_key, true);   
  if($count==''){   
    delete_post_meta($postID, $count_key);   
    add_post_meta($postID, $count_key, '0');   
    return "阅读 0";   
  }   
  return '阅读 '.$count;   
}   
function setPostViews($postID) {   
  $count_key = 'post_views_count';   
  $count = get_post_meta($postID, $count_key, true);   
  if($count==''){   
    $count = 0;   
    delete_post_meta($postID, $count_key);   
    add_post_meta($postID, $count_key, '0');   
  }else{   
    $count++;   
    update_post_meta($postID, $count_key, $count);   
  }   
}  

//加入自定义的css文件和javascript文件
function myScript (){
  wp_enqueue_script('jquery', get_stylesheet_directory_uri().'/js/jquery-2.1.4.min.js');
  wp_enqueue_script('myfns', get_stylesheet_directory_uri().'/js/js_fns.js');
  wp_enqueue_script('uikit', get_stylesheet_directory_uri().'/js/uikit.min.js');
  wp_enqueue_style('header', get_stylesheet_directory_uri().'/css/header.css');
  wp_enqueue_style('default', get_stylesheet_directory_uri().'/css/default.css');
  wp_enqueue_style('uikit', get_stylesheet_directory_uri().'/css/uikit.min.css');
}
add_action('wp_enqueue_scripts', 'myScript');

?>