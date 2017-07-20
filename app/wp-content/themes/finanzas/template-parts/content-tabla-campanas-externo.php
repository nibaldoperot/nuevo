<?php 
    $user = wp_get_current_user();
    query_posts( array ('numberposts'	=> -1,
        '   post_type'		=> 'post',
        'meta_key'		=> 'participante',
        'meta_value'	=> $user->user_nicename));


    $blogusers = get_users( 'blog_id=1&orderby=nicename&role=usuario_externo' );
    $array = [];

    foreach ( $blogusers as $user ) {
        array_push($array, $user->user_login);
    } 

    while ( have_posts() ) : the_post(); 

        global $post;
        $postcat = get_the_category( $post->ID );
        foreach ($postcat as $category){
            if( in_array($category->name, $array)){
                $participante = $category->name;
            }
        }
        
        if(get_post_meta( $post->ID, 'oc')){
            $args = array(
                'post_parent' => $post->ID,
                'post_type'   => 'any', 
                'numberposts' => -1,
                'post_status' => 'any' 
            );
            $number = intval(get_post_meta( $post->ID, 'oc')[0]);
            $children_oc = get_children( $args );
        }else{
            $children_oc = null;
        }

        if(get_post_meta( $post->ID, 'boleta')){
            $args = array(
                'post_parent' => $post->ID,
                'post_type'   => 'any', 
                'numberposts' => -1,
                'post_status' => 'any' 
            );
            $number = intval(get_post_meta( $post->ID, 'boleta')[0]);
            $children_boleta = get_children( $args );
        }else{
            $children_boleta = null;
        }

        if(get_post_meta( $post->ID, 'status')){
            $args = array(
                'post_parent' => $post->ID,
                'post_type'   => 'any', 
                'numberposts' => -1,
                'post_status' => 'any' 
            );
            $status = intval(get_post_meta( $post->ID, 'status')[0]);
        }else{
            $status = 0;
        }
        
        if(get_post_meta( $post->ID, 'pago')){
            $args = array(
                'post_parent' => $post->ID,
                'post_type'   => 'any', 
                'numberposts' => -1,
                'post_status' => 'any' 
            );
            $pago = intval(get_post_meta( $post->ID, 'pago')[0]);
        }else{
            $pago = 0;
        }

        if($status == 1){ ?>

        <tr data-post-id="<?php echo $post->ID; ?>">

            <td class="columna_campana"><small><?php the_title();?></small></td>
            <td class="columna_valor">
                <small>
                    <input value="<?php if(get_post_meta( $post->ID, 'valor_oc')) echo get_post_meta( $post->ID, 'valor_oc')[0]; ?>" disabled="">       
                </small>
            </td>
            <td class="columna_oc">
            <?php if($children_oc){$tipo= 'a';$columna_oc = 'Ver'; }else{$tipo= 'div';$columna_oc="No se ha subido";} ?>
                <small>
                        <<?php echo $tipo;?> href="<?php echo $children_oc[$number]->guid ?>" class="<?php echo $class; ?>">
                        <?php echo $columna_oc; ?><<?php echo $tipo;?>/>
                </small>
            </td>
             <td class="columna_boleta">
            <?php if(!$children_oc) {
                    $tipo= 'div';
                    $columna_boleta = 'No hay OC';
                  }else{ 
                    if(!$children_boleta){ 
                        $tipo= 'div';
                        $columna_boleta = 'Subir boleta';
                        $class="subir_boleta";
                    }else{
                        $tipo= 'a';
                        $columna_boleta = 'Ver';
                    } 

                  } ?>
                <small>
                        <<?php echo $tipo;?> href="<?php echo $children[$number]->guid ?>" class="<?php echo $class; ?>">
                        <?php echo $columna_boleta; ?><<?php echo $tipo;?>/>
                </small>
            </td>
            <td class="columna_pago">
                <small>
                    <input style="width:100% !important" name="my-checkbox" data-size="mini" data-handle-width="30" 
                           data-off-text="Pend" data-on-text="OK" type="checkbox" name="my-checkbox"  <?php if($pago == 1) echo "checked"; ?> >                            
                </small>
            </td>
        </tr>

<?php }?>
        
    <?php endwhile; ?>