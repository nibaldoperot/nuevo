<?php 
    $user = wp_get_current_user();
    query_posts( 'category_name=campana' ); 
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
        
        ?>

        <tr data-post-id="<?php echo $post->ID; ?>">

            <td class="columna_campana"><small><?php the_title();?></small></td>
            <td class="columna_participante"><small><?php echo $participante; ?></small></td>
            <td class="columna_valor">
                <small>
                    <input value="<?php if(get_post_meta( $post->ID, 'valor_oc')) echo get_post_meta( $post->ID, 'valor_oc')[0]; ?>" disabled="">
                    <i class="fa fa-edit cambiar_valor_oc" aria-hidden="true"></i>
                    <i class="fa fa-save guardar_valor_oc" aria-hidden="true"></i>
                </small>
            </td>
            <td class="columna_oc">
                <?php if(!$children_oc){ $tipo= 'div';$columna_oc = 'Subir oc';$class="subir_oc";}else{$tipo= 'a';$columna_oc = 'Ver';} ?>
                <small>
                        <<?php echo $tipo;?> href="<?php if($children_oc) echo $children_oc[$number]->guid; ?>" class="<?php echo $class; ?>">
                        <?php echo $columna_oc; ?><<?php echo $tipo;?>/>
                </small>
            </td>
            <td class="columna_status" data-status="<?php echo intval(get_field('pago'))?>">
                <small>
                    <input class="cambiar_status" data-size="mini" data-handle-width="30" data-off-text="Pend" 
                            style="width:100% !important" data-on-text="OK" type="checkbox" name="my-checkbox" 
                            <?php if(get_post_meta( $post->ID, 'pago') && intval(get_post_meta( $post->ID, 'pago')[0])== 1) echo "checked"; ?> >                            
                </small>
            </td>
            <td class="columna_boleta">
                <?php if(!$children_boleta){ $tipo= 'div';$columna_boleta = 'Subir boleta';$class="subir_boleta";}else{$tipo= 'a';$columna_boleta = 'Ver';} ?>
                <small>
                        <<?php echo $tipo;?> href="<?php if($children_boleta) echo $children_boleta[$number]->guid; ?>" class="<?php echo $class; ?>">
                        <?php echo $columna_boleta; ?><<?php echo $tipo;?>/>
                </small>
            </td>
            <!-- Modulo para Agregar Comentarios en Campañas -->
            <!--<td class="tabla_campana_inicial tabla_campana_inicial_primario"><small>
                <button class="muestra_form_comentario">Agregar</button></small></td>
            <td class="tabla_campana_comentario" style="display:none">
                <small>
                    <input type="text" class="comentario" data-post-id="<?php //echo $post->ID;?>" placeholder="Comentario"/>
                    <button class="agrega_comentario">Comentar</button>
                </small>
            </td>-->
            
        </tr>
    <?php endwhile; ?>