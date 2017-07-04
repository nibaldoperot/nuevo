<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package MVPWP
 */

?>

  	</div><!-- #content -->
  
  <footer class="footer footer-transparent">
    <div class="container">

     <?php
        $args = array(
          'theme_location' => 'footer',
          'container' => 'nav',
          'container_class' => 'pull-left'
          );
        if (has_nav_menu('footer')) {
          wp_nav_menu($args);
        }
      ?>

        <div class="social-area pull-right">

          <?php $footer_social = get_theme_mod( 'footer_social', '' );

            if (count($footer_social) > '0' ) : 
              foreach ($footer_social as $social) : 
                $social_icon = "{$social['social_icon']}"; 
                $social_url = "{$social['social_url']}";
                
              ?>

              <?php if ($social_icon != '') : ?>
                <a target="_blank" value="<?php echo $user_id ?>"class="btn btn-social btn-just-icon" href="<?php echo $social_url; ?>">
                    <i class="fa fa-<?php echo $social_icon; ?>"></i>
                </a>
              <?php endif; ?>

             <?php endforeach; ?>
            <?php endif; ?>

        </div>
        <!--<div class="copyright">

        <?php $copyright_text = get_theme_mod( 'copyright_text', '' ); 
          if ($copyright_text != '') {
            //echo $copyright_text;
          } else {
            //printf( esc_html__( 'Theme: %1$s by %2$s.', 'mvpwp' ), 'mvpwp', '<a href="http://braginteractive.com" rel="designer">Brad Williams</a>' );
          }
         ?>
        </div>-->
    </div>

    <script>
      jQuery( document ).ready( function( $ ) {
        $('.ver_home').click(function(){
            window.location.href = "<?php echo get_home_url(); ?>"
        })
        
        $('.material-switch input').click(function(){
          // e.preventDefault()
          var str = window.location.href
          if(str.split('perfiles').length == 2){
            var location = str.split('perfiles')
          }else{
            var location = str.split('pagos')
          }
          var ajaxurl = location[0]+'wp-admin/admin-ajax.php'
          var status= true
          var post_id=  $(this).attr('id')
          var tipo=  $(this).attr('data')
          var status=  $(this).attr('status')
          if(status == 0) new_status = 1
          if(status == 1) new_status = 0
          $.ajax({
            url: ajaxurl + "?action=update_pago",
            type: 'post',
            data: {
                post_id: post_id,
                status: new_status,
                tipo: tipo
            },
            success: function(data) {
              window.location.reload()
            },
            error: function(data) {
            }
          })

        })
      })
    </script>
</footer>

</div><!-- #page -->

<?php //wp_footer(); ?>

</body>
</html>
