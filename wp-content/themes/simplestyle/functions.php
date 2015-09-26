<?php

if ( function_exists('register_sidebar-1') ) {
    register_sidebar();
}

if(function_exists('register_nav_menus')){
    register_nav_menus( array(
        'header-menu' => __( 'topnav' )
    ) );
}

?>