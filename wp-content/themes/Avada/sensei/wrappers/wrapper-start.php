<?php
/**
 * Content wrappers
 *
 * @author 		WooThemes
 * @package 	Sensei/Templates
 * @version	 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit;

$template = get_option('template');

ob_start();
Avada()->layout->add_class( 'content_class' );
$content_class = ob_get_clean();

ob_start();
Avada()->layout->add_style( 'content_style' );
$content_css = ob_get_clean();

switch( $template ) {

	// IF Twenty Eleven
	case 'twentyeleven' :
		echo '<div id="primary"><div id="content" role="main">';
		break;

	// IF Twenty Twelve
	case 'twentytwelve' :
		echo '<div id="primary" class="site-content"><div id="content" role="main">';
		break;

	// IF Twenty Fourteen
	case 'twentyfourteen' :
		echo '<div id="main-content" class="main-content"><div id="primary" class="content-area"><div id="content" class="site-content" role="main">';
		break;

	// IF Canvas
	case 'canvas' :
		echo '<div id="content" class="col-full"><div id="main-sidebar-container"><div id="main">';
		break;

	// Default
	default :
		echo '<div class="sensei-container"><div id="content" ' . $content_class . ' ' . $content_css . '>';
		break;
}

// Omit closing PHP tag to avoid "Headers already sent" issues.
