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
      if ($thisCat->parent != 0) echo('<li>'.get_category_parents($parentCat, TRUE, '').'</li>');
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
      echo '<li>'.get_category_parents($cat, TRUE, '').'</li>';
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
      echo $currentBefore . '此标签下的文章 &#39;';
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


function Bing_get_pagenavi( $query = false, $num = false, $before = '<ul class="uk-pagination uk-pagination-left">', $after = '</ul>', $options = array() ){
    global $wp_query;
    $options = wp_parse_args( $options, array(
        'pages_text' => '共%TOTAL_PAGES%页',
        'current_text' => '%PAGE_NUMBER%',
        'page_text' => '%PAGE_NUMBER%',
        'first_text' => __( '« 首页', 'Bing' ),
        'last_text' => __( '尾页 »', 'Bing' ),
        'next_text' => __( '下一页', 'Bing' ),
        'prev_text' => '上一页',
        'dotright_text' => '...',
        'dotleft_text' => '...',
        'num_pages' => 5,
        'always_show' => 0,
        'num_larger_page_numbers' => 3,
        'larger_page_numbers_multiple' => 10
    ) );
    if( $wp_query->max_num_pages <= 1 || is_single() ) return;
    if( !empty( $query ) ){
        $request = $query->request;
        $numposts = $query->found_posts;
        $max_page = $query->max_num_pages;
        $posts_per_page = intval( $num );
    }else{
        $request = $wp_query->request;
        $numposts = $wp_query->found_posts;
        $max_page = $wp_query->max_num_pages;
        $posts_per_page = intval( get_query_var( 'posts_per_page' ) );
    }
    $paged = intval( get_query_var( 'paged' ) );
    if( empty( $paged ) || $paged == 0 ) $paged = 1;
    $pages_to_show = intval( $options['num_pages'] );
    $larger_page_to_show = intval( $options['num_larger_page_numbers'] );
    $larger_page_multiple = intval( $options['larger_page_numbers_multiple'] );
    $pages_to_show_minus_1 = $pages_to_show - 1;
    $half_page_start = floor( $pages_to_show_minus_1 / 2 );
    $half_page_end = ceil( $pages_to_show_minus_1 / 2 );
    $start_page = $paged - $half_page_start;
    if( $start_page <= 0 ) $start_page = 1;
    $end_page = $paged + $half_page_end;
    if( ( $end_page - $start_page ) != $pages_to_show_minus_1 ) $end_page = $start_page + $pages_to_show_minus_1;
    if( $end_page > $max_page ){
        $start_page = $max_page - $pages_to_show_minus_1;
        $end_page = $max_page;
    }
    if( $start_page <= 0 ) $start_page = 1;
    $larger_per_page = $larger_page_to_show * $larger_page_multiple;
    $larger_start_page_start = ( ( floor( $start_page / 10 ) * 10 ) + $larger_page_multiple ) - $larger_per_page;
    $larger_start_page_end = floor( $start_page / 10 ) * 10 + $larger_page_multiple;
    $larger_end_page_start = floor( $end_page / 10 ) * 10 + $larger_page_multiple;
    $larger_end_page_end = floor( $end_page / 10 ) * 10 + ( $larger_per_page );
    if( $larger_start_page_end - $larger_page_multiple == $start_page ){
        $larger_start_page_start = $larger_start_page_start - $larger_page_multiple;
        $larger_start_page_end = $larger_start_page_end - $larger_page_multiple;
    }
    if( $larger_start_page_start <= 0 ) $larger_start_page_start = $larger_page_multiple;
    if( $larger_start_page_end > $max_page ) $larger_start_page_end = $max_page;
    if( $larger_end_page_end > $max_page ) $larger_end_page_end = $max_page;
    if( $max_page > 1 || intval( $options['always_show'] ) == 1 ){
        $pages_text = str_replace( '%CURRENT_PAGE%', number_format_i18n( $paged ), $options['pages_text'] );
        $pages_text = str_replace( '%TOTAL_PAGES%', number_format_i18n( $max_page ), $pages_text);
        echo $before;
        
        echo '<li class="uk-pagination-previous">';
        previous_posts_link( $options['prev_text'] );
        echo '</li>';
        for( $i = $start_page;$i <= $end_page;$i++ ){                        
            if( $i == $paged ){
                $current_page_text = str_replace( '%PAGE_NUMBER%', number_format_i18n( $i ), $options['current_text'] );
                echo '<li><span class="uk-active">' . $current_page_text . '</span></li>';
            }else{
                $page_text = str_replace( '%PAGE_NUMBER%', number_format_i18n( $i ), $options['page_text'] );
                echo '<li><a href="' . esc_url( get_pagenum_link( $i ) ).'" title="' . $page_text . '">' . $page_text . '</a></li>';
            }
        }
        if( empty( $query ) ) echo '<li id="next-page">';
        next_posts_link( $options['next_text'], $max_page );
        if( empty( $query ) ) echo '</li>';

        if( !empty( $pages_text ) ) echo '<li class="uk-disabled"><span>' . $pages_text . '</span></li>';
        if( $start_page >= 2 && $pages_to_show < $max_page ){
            $first_page_text = str_replace( '%TOTAL_PAGES%', number_format_i18n( $max_page ), $options['first_text'] );
            echo '<li><a href="' . esc_url( get_pagenum_link() ) . '" title="' . $first_page_text . '">' . $first_page_text . '</a></li>';
        }
        if( $larger_page_to_show > 0 && $larger_start_page_start > 0 && $larger_start_page_end <= $max_page ){
            for( $i = $larger_start_page_start;$i < $larger_start_page_end;$i += $larger_page_multiple ){
                $page_text = str_replace( '%PAGE_NUMBER%', number_format_i18n( $i ), $options['page_text'] );
                echo '<li><a href="' . esc_url( get_pagenum_link( $i ) ) . '" title="' . $page_text . '">' . $page_text . '</a></li>';
            }
        }
    }
    if( $larger_page_to_show > 0 && $larger_end_page_start < $max_page ){
        for( $i = $larger_end_page_start;$i <= $larger_end_page_end;$i += $larger_page_multiple ){
            $page_text = str_replace( '%PAGE_NUMBER%', number_format_i18n( $i ), $options['page_text'] );
            echo '<li><a href="' . esc_url( get_pagenum_link( $i ) ).'" title="' . $page_text . '">' . $page_text . '</a></li>';
        }
    }
    if( $end_page < $max_page ){
        $last_page_text = str_replace( '%TOTAL_PAGES%', number_format_i18n( $max_page ), $options['last_text'] );
        echo '<li><a href="' . esc_url( get_pagenum_link( $max_page ) ) . '" title="' . $last_page_text . '">' . $last_page_text . '</a></li>';
    }
    echo $after;
}
?>
