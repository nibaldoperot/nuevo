<?php
if(!$_GET['user_id']){
    $blogusers = get_users( 'orderby=nicename&role=usuario_externo' );
    the_title( '<h3>', '</h3>' ); ?>  

    <div class="perfiles">
        <?php foreach ( $blogusers as $user ) { ?>
            <p class="perfil" id="<?php echo $user->ID; ?>" > <?php echo esc_html( $user->display_name ); ?></p>
        <?php } ?>
    </div>

<?php }else{
        if(is_page('perfiles')){
            get_template_part( 'template-parts/content', 'perfil' );
        }

        } 
?>