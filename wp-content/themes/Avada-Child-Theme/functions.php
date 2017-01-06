<?php

// Cria a url do theme child

function get_template_directory_child() {    

    $directory_child = get_template_directory_uri() . '-Child-Theme';

    return $directory_child;

}



function theme_enqueue_styles() {

    wp_enqueue_style( 'avada-parent-stylesheet', get_template_directory_uri() . '/style.css' );



    /*-------Font DroidSerif-------*/

    wp_enqueue_style( 'DroidSerif-stylesheet', get_template_directory_child(). '/assets/fonts/DroidSerif/stylesheet.css' );

    

    /*-------Font DroidSerif-Bold-------*/

    wp_enqueue_style( 'DroidSerif-Bold-stylesheet', get_template_directory_child(). '/assets/fonts/DroidSerif-Bold/stylesheet.css' );



    /*-------Font DroidSerif-BoldItalic-------*/

    wp_enqueue_style( 'DroidSerif-BoldItalic-stylesheet', get_template_directory_child(). '/assets/fonts/DroidSerif-BoldItalic/stylesheet.css' );



    /*-------Font DroidSerif-Italic-------*/

    wp_enqueue_style( 'DroidSerif-Italic-stylesheet', get_template_directory_child(). '/assets/fonts/DroidSerif-Italic/stylesheet.css' );

    

    /*------Custom style-------*/

    wp_enqueue_style( 'avada-custom-stylesheet', get_template_directory_child() . '/assets/css/custom-style.css' );



}

add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );



function avada_lang_setup() {

	$lang = get_stylesheet_directory() . '/languages';

	load_child_theme_textdomain( 'Avada', $lang );

}

add_action( 'after_setup_theme', 'avada_lang_setup' );

