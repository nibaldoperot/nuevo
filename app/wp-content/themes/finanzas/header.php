<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package MVPWP
 */
if ( !is_user_logged_in() ) {
   auth_redirect();
}

  //Identifico POST
$postTitleError = '';
 
if ( isset( $_POST['submitted'] ) ) {
 
    if ( trim( $_POST['campana'] ) === '' ) {
        $postTitleError = 'Please enter a title.';
        $hasError = true;
    }
    
    
    
    $participantes = $_POST['participante'];
    if (strpos($participantes, ';') !== false) {
        $array_participantes = explode(';',$participantes);
        $cantidad_participantes = count($array_participantes);
        wp_insert_term(
            $_POST['campana'], // the term 
            'category', // the taxonomy
            array(
                'parent'=> 'campana'
            )
        );
        $category_campana = get_cat_ID( $_POST['campana']);
        foreach($array_participantes as $participante){
            wp_insert_term(
                $participante, // the term 
                'category', // the taxonomy
                array(
                    'parent'=> 'campana'
                )
            );
            $category = get_cat_ID( $participante);
            if($category != 0){
                $post_information = array(
                    'post_title' => wp_strip_all_tags( $_POST['campana'] ),
                    'post_content' => $_POST['descripcion'],
                    'post_type' => 'post',
                    'post_status' => 'publish',
                    'post_category' => array(2,$category, $category_campana)
                );
                wp_insert_post( $post_information );

            }
        }
    }else{
        wp_insert_term(
            $participantes, // the term 
            'category', // the taxonomy
            array(
                'parent'=> 'campana'
            )
        );
        $category = get_cat_ID( $participantes);
        wp_insert_term(
            $_POST['campana'], // the term 
            'category', // the taxonomy
            array(
                'parent'=> 'campana'
            )
        );
        $category_campana = get_cat_ID( $_POST['campana']);
        $post_information = array(
            'post_title' => wp_strip_all_tags( $_POST['campana'] ),
            'post_content' => $_POST['descripcion'],
            'post_type' => 'post',
            'post_status' => 'publish',
            'post_category' => array(2,$category, $category_campana)
        );        
        wp_insert_post( $post_information );

    }

}

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">

	<header id="masthead" class="site-header" role="banner">
    <nav role="navigation" id="navbar-main">
    </nav>
  </header><!-- #masthead -->
  <div class="wrapper">
