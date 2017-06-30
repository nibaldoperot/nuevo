<?php
if(!$_GET['user_id']){
    $blogusers = get_users( 'orderby=nicename&role=usuario_externo' );
    //the_title( '<h3>', '</h3>' ); ?>  
    <div class="perfiles list-group">
            
        <?php foreach ( $blogusers as $user ) { ?>

            <a href="?user_id=<?php echo $user->ID; ?>" class="list-group-item perfil" id="<?php echo $user->ID; ?>">
                <h4 class="list-group-item-heading"> <?php echo esc_html( $user->display_name ); ?></h4>
            </a>

        <?php } ?>
    </div>

<?php   }else{
            if(is_page('perfiles')){
                get_template_part( 'template-parts/content', 'perfil' );
            }

        } 
?>
