<?php get_header(); ?>
<?php $image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full'); ?>

<div class="header header-filter" style="background-image: url('<?php echo $image[0];?>');">
    <div class="container">
      <div class="row">
        <div class="col-md-6 col-md-offset-3">
          <?php //the_title( '<h1 class="title text-center">', '</h1>' ); ?>
        </div>
    </div>
  </div>
</div>


<div class="main main-raised">
  <div class="section">
    <div class="container">
      <div id="content" class="row">

      	<div id="primary" class="col-md-8 col-md-offset-2">
      		<main id="main" class="site-main" role="main" data-home-url="<?php echo get_home_url(); ?>" data-logout-url="<?php echo wp_logout_url(); ?>">
            <?php get_template_part( 'template-parts/content', 'page' );?>
          </main><!-- #main -->
        </div><!-- #primary -->
      </div><!-- .wrap -->
    </div>
  </div>
</div>
<?php get_footer();
