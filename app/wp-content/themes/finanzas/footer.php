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

        $('.agrega_comentario').click(function(){
          var str = window.location.href
          if(str.split('listado').length == 2){
            var location = str.split('campana/listado')
          }
          var ajaxurl = location[0]+'wp-admin/admin-ajax.php'
          let comment_post_ID = $('.comentario').attr('data-post-id')
          let comment_author = '<?php echo wp_get_current_user()->data->user_nicename;?>'
          let comment_author_email= '<?php echo wp_get_current_user()->data->user_email;?>'
          let comment_content = $('.comentario').val()
          let user_id = '<?php echo wp_get_current_user()->data->ID;?>'

          $.ajax({
            url: ajaxurl + "?action=agrega_comentario",
            type: 'post',
            data: {
                comment_post_ID: comment_post_ID,
                comment_author: comment_author,
                comment_author_email: comment_author_email,
                comment_content: comment_content,
                user_id: user_id
            },
            success: function(data) {
              console.log(data)
            },
            error: function(data) {
            }
          })

          
          $('.tabla_campana_inicial_primario').show()
          $('.tabla_campana_comentario').hide()
          $('.comentario').val('')
        })

      $('.subir_oc').click(function(){
        var id = $(this).attr('id')
        window.location.href = "<?php echo admin_url(); ?>post.php?post="+id+"&action=edit";
      })

      $('.cambiar_valor_oc').click(function(){
        //Cambios en vista
        $(this).siblings('input').prop("disabled", false);
        $(this).siblings('.guardar_valor_oc').show();
        $(this).hide();
      })

      $('.guardar_valor_oc').click(function(){
        //cambios en vista
        $(this).siblings('input').prop("disabled", true);
        $(this).siblings('.cambiar_valor_oc').show();
        $(this).hide();
        
        //variables para funcion
        var valor_oc = $(this).siblings('input').val()
        var post_id = $(this).closest( "tr" ).attr('data-post-id')

        //llamada ajax
        $.ajax({
          url: "http://192.168.0.32/_Finanzas/htdocs/app/" + "wp-admin/admin-ajax.php" + "?action=cambiar_valor_oc",
          type: 'post',
          data: {
              valor_oc: valor_oc,
              post_id: post_id
          },
          success: function(data) {
            console.log(data)
          },
          error: function(data) {
          }
        })
      })


      $('.subir_boleta').click(function(){
        
        //variables para funcion
        var post_id = $(this).closest( "tr" ).attr('data-post-id')

        //llamada ajax
        $.ajax({
          url: "http://192.168.0.32/_Finanzas/htdocs/app/" + "wp-admin/admin-ajax.php" + "?action=agregar_boleta",
          type: 'post',
          data: {
              post_id: post_id
          },
          success: function(data) {
            console.log(data)
          },
          error: function(data) {
          }
        })
      })


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
            //console.log(data)
          },
          error: function(data) {
          }
        })
      
    });
      // $('.columna_status small div').click(function(){
      // })

      $('.muestra_form_comentario').click(function(){
        $('.tabla_campana_inicial_primario').hide();
        $('.tabla_campana_comentario').show();

      })
    

      })
    </script>
</footer>

</div><!-- #page -->

<?php //wp_footer(); ?>

</body>
</html>
