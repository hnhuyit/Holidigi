<?php
// Cria a url do theme child
function get_template_directory_child() {    
    $directory_child = get_template_directory_uri() . '-Child-Theme';
    return $directory_child;
}

function theme_enqueue_styles() {
    wp_enqueue_style( 'avada-parent-stylesheet', get_template_directory_uri() . '/style.css' );

    /* Font font-museo-100 */
    wp_enqueue_style( 'avada-font-museo-100-stylesheet', get_template_directory_child(). '/assets/fonts/font-museo-100/stylesheet.css' );

    /* Font MuseoSansCyrl-700 */
    wp_enqueue_style( 'avada-MuseoSansCyrl-700-stylesheet', get_template_directory_child(). '/assets/fonts/MuseoSansCyrl-700/stylesheet.css' );

    /* Font myriad-pro */
    wp_enqueue_style( 'avada-myriad-pro-stylesheet', get_template_directory_child(). '/assets/fonts/myriad-pro/stylesheet.css' );

    /* Font raleway */
    wp_enqueue_style( 'avada-raleway-stylesheet', get_template_directory_child(). '/assets/fonts/raleway/stylesheet.css' );
    
    /*------Custom style-------*/
    wp_enqueue_style( 'avada-custom-stylesheet', get_template_directory_child() . '/assets/css/custom-style.css' );

}
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );

function avada_lang_setup() {
	$lang = get_stylesheet_directory() . '/languages';
	load_child_theme_textdomain( 'Avada', $lang );
}
add_action( 'after_setup_theme', 'avada_lang_setup' );
