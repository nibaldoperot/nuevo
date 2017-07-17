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
        }?>

        <tr data-post-id="<?php echo $post->ID; ?>">    
            <td class="columna_campana"><?php   if(get_field('oc')){  ?><small><a href="<?php the_field('oc'); ?>"><?php the_title();?></a></small>
                <?php   }else{ ?> <small><?php the_title();?></small>
                <?php   } ?>  
            </td>
            <td class="columna_participante"><small><?php echo $participante; ?></small></td>
            <td class="columna_valor">
                <small>
                    <input value="<?php the_field('valor_oc'); ?>" disabled="">
                    <i class="fa fa-edit cambiar_valor_oc" aria-hidden="true"></i>
                    <i class="fa fa-save guardar_valor_oc" aria-hidden="true"></i>
                </small>
            </td>
            <td class="columna_oc">
                <small><i class="fa fa-edit subir_oc" id="<?php echo $post->ID;?>" aria-hidden="true"></i></small>
            </td>
            <td class="columna_status" data-status="<?php echo intval(get_field('pago'))?>">
                <small>
                    <input class="cambiar_status" data-size="mini" data-handle-width="30" data-off-text="Pend" 
                            style="width:100% !important" data-on-text="OK" type="checkbox" name="my-checkbox" checked>                            
                </small>
            </td>
            <td class="columna_boleta">
                <?php if(!get_field('boleta')['url']){ $tipo= 'div';$columna_boleta = 'No Tiene boleta';}else{$tipo= 'a';$columna_boleta = 'Boleta';} ?>
                <small><<?php echo $tipo;?> href="<?php echo get_field('boleta')['url']; ?>"><?php echo $columna_boleta; ?><<?php echo $tipo;?>/></small>
            </td>
            <td class="columna_status">
                <small><?php echo intval(get_field('pago'))?></small>
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