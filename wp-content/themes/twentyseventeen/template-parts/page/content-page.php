<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<div class="pagos-menu">
			<button class="boletas_button">Boletas</button><br/>
			<button class="facturas_button">Facturas</button><br/>
			<button class="todos_button">Todos</button><br/>
		</div>
	</header><!-- .entry-header -->
	<div class="entry-content">
		<?php

			get_template_part( 'template-parts/page/content', 'pagos' );
			/*the_content();

			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'twentyseventeen' ),
				'after'  => '</div>',
			) );*/
		?>
	</div><!-- .entry-content -->
</article><!-- #post-## -->

<script>
	jQuery( document ).ready( function( $ ) {
		// $() will work as an alias for jQuery() inside of this function
		$('.boletas_button').click(function(){
			$('.facturas').hide();
			$('.total').hide();
			$('.boletas').show();
		})

		$('.facturas_button').click(function(){
			$('.boletas').hide();
			$('.total').hide();
			$('.facturas').show();
		})

		$('.todos_button').click(function(){
			$('.facturas').show();
			$('.total').show();
			$('.boletas').show();
		})

	} );
</script>
