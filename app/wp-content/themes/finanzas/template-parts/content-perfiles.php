<?php
if(!$_GET['user_id']){
    $blogusers = get_users( 'orderby=nicename&role=usuario_externo' );
    //the_title( '<h3>', '</h3>' ); ?>  

    <div class="perfiles">
        <ul class="list-group">
            
        <?php foreach ( $blogusers as $user ) { ?>

            <li class="list-group-item justify-content-between">
            <span class="perfil" id="<?php echo $user->ID; ?>" > <?php echo esc_html( $user->display_name ); ?></span>

        <?php } ?>
        </ul>
    </div>

<?php   }else{
            if(is_page('perfiles')){
                get_template_part( 'template-parts/content', 'perfil' );
            }

        } 
?>