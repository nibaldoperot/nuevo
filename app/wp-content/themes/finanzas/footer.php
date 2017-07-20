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

        <?php $copyright_text = get_theme_mod( 'copyright_text', '' ); 
          if ($copyright_text != '') {
            //echo $copyright_text;
          } else {
            //printf( esc_html__( 'Theme: %1$s by %2$s.', 'mvpwp' ), 'mvpwp', '<a href="http://braginteractive.com" rel="designer">Brad Williams</a>' );
          }
         ?>
        </div>
    </div>

    <script charset="utf-8">
      jQuery( document ).ready( function( $ ) {
       
        $("[name='my-checkbox']").bootstrapSwitch();

        $('[name="my-checkbox"]').on('switchChange.bootstrapSwitch', function(event, state) {

          var post_id = $(this).closest( "tr" ).attr('data-post-id')
          var status = $(this).closest( ".columna_status" ).attr('data-status')
          if(status == 0){
            status = false
          }else{
            status = true
          }

          //llamada ajax
          $.ajax({
            url: "http://192.168.0.32/_Finanzas/htdocs/app/" + "wp-admin/admin-ajax.php" + "?action=cambiar_pago",
            type: 'post',
            data: {
                status: status,
                post_id: post_id
            },
            success: function(data) {
              console.log(data)
            },
            error: function(data) {
            }
          })
        
        }); 

      })
    </script>
</footer>

</div><!-- #page -->

<?php //wp_footer(); ?>

</body>
</html>
