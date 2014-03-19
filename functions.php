<?php
/**
 * ffeeeedd--sass : fonctions du thème - communes à l’administration et au front-end basé sur Sass
 * @author                Gaël Poupard
 * @link                  www.ffoodd.fr
 *
 * @package               WordPress
 * @subpackage            ffeeeedd
 * @since                 ffeeeedd 1.0
 */

/* ----------------------------- */
/* Sommaire */
/* ----------------------------- */
/*
  == Traduction
  == Injection des scripts et styles
  == Compression du HTML
*/


  /* == @section Traduction ==================== */
  /**
   * @author Gaël Poupard
   * @see https://twitter.com/ffoodd_fr
   * @note I18n : déclare le domaine et l’emplacement des fichiers de traduction
   * @see Twentytwelve - Thème WordPress par défaut.
   * @link http://codex.wordpress.org/Child_Themes#Internationalization
  */
  add_action( 'after_setup_theme', 'ffeeeedd__sass__setup' );
  function ffeeeedd__sass__setup() {
    load_child_theme_textdomain( 'ffeeeedd--sass', get_stylesheet_directory() . '/lang' );
  }


  /* == @section Injection des scripts et styles ==================== */
  /**
   * @author Gaël Poupard
   * @see https://twitter.com/ffoodd_fr
   */
  add_action( 'wp_enqueue_scripts', 'ffeeeedd__script' );
  function ffeeeedd__script() {

    // À décommenter si besoin de jquery
    if( !is_admin() ) {
      wp_deregister_script('jquery');
      wp_register_script(
        'jquery',
        '/wp-includes/js/jquery/jquery.js',
        false,
        null,
        true
      );
      wp_enqueue_script('jquery');
    }

    wp_register_style(
      'all',
      get_stylesheet_directory_uri().'/style.min.css',
      false,
      filemtime( get_stylesheet_directory() . '/style.min.css' ),
      'all'
    );
    wp_register_style(
      'print',
      get_stylesheet_directory_uri().'/css/impression.css',
      false,
      filemtime( get_stylesheet_directory() . '/css/impression.css' ),
      'print'
    );
    wp_register_script(
      'site',
      get_stylesheet_directory_uri() . '/script.min.js',
      false,
      filemtime( get_stylesheet_directory() . '/script.min.js' ),
      true
    );
    // On ajoute les fichiers à la queue
    wp_enqueue_style( 'all' );
    wp_enqueue_style( 'print' );
    wp_enqueue_script( 'site' );
  }


  /* == @section Compression du HTML ==================== */
  /**
   * @author Gaël Poupard
   * @see https://twitter.com/ffoodd_fr
   * @author Jonathan Buttigieg
   * @see https://twitter.com/GeekPressFR
   * @see http://www.geekpress.fr/wordpress/astuce/minifier-html-sans-plugin-1566/
   */
  function ffeeeedd__minification__debut() {
      ob_start( 'ffeeeedd__minification__fin' );
  }

  function ffeeeedd__minification__fin( $html ) {
     // Suppression des commentaires HTML, sauf les commentaires conditionnels pour IE
     $html = preg_replace( '/<!--(?!s*(?:[if [^]]+]|!|>))(?:(?!-->).)*-->/s', '', $html );

     // Suppression des espaces vides
     $html = str_replace( array( "\r\n", "\r", "\n", "\t" ), '', $html );
     while( stristr( $html, '  ' ) ) {
         $html = str_replace( '  ', ' ', $html );
     }
     return $html;
  }

  add_action( 'get_header', 'ffeeeedd__minification__debut' );
