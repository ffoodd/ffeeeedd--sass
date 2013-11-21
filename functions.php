<?php
/**
 * ffeeeedd--sass : fonctions du thème - communes à l'administration et au front-end - en phase de developpement basé sur Sass
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
*/


  /* == @section Traduction ==================== */
  /**
   * @author Gaël Poupard
   * @see https://twitter.com/ffoodd_fr
   * @note I18n : déclare le domaine et l'emplacement des fichiers de traduction
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
   * @note inspiré du thème Twentytwelve.
   * @see http://wordpress.org/extend/themes/twentytwelve
   * @note Amélioré grâce à l'asutce de Julio Potier
   * @see https://twitter.com/BoiteAWeb
   * @see http://boiteaweb.fr/min-js-min-css-comment-quand-ajouter-minification-jeudiconfession-9-7364.html
   */

  add_action( 'wp_enqueue_scripts', 'ffeeeedd__script' );
  function ffeeeedd__script() {
    wp_register_style( 'all', get_stylesheet_directory_uri().'/style.min.css', false, null, 'all' );
    wp_register_style( 'print', get_stylesheet_directory_uri().'/css/impression.css', false, null, 'all' );
    wp_register_style( 'a11y', get_stylesheet_directory_uri().'/css/a11y.css', false, null, 'all' );
    wp_register_style( 'prototype', get_stylesheet_directory_uri().'/css/prototype.css', false, null, 'all' );
    wp_register_script( 'site', get_stylesheet_directory_uri() . '/script.min.js', false, null, true );
    // On ajoute les fichiers à la queue
    wp_enqueue_style( 'all' );
    //wp_enqueue_style( 'a11y' );
    //wp_enqueue_style( 'prototype' );
    wp_enqueue_style( 'print' );
    wp_enqueue_script( 'site' );
  }
