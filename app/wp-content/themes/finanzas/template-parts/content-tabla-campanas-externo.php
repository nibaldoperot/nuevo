<?php 
    $user = wp_get_current_user();
    query_posts( array ('numberposts'	=> -1,
        'post_type'		=> 'post',
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
        }?>

        <tr data-post-id="<?php echo $post->ID; ?>">    
            <td class="columna_campana"><?php   if(get_field('oc')){  ?><small><a href="<?php the_field('oc'); ?>"><?php the_title();?></a></small>
                <?php   }else{ ?> <small><?php the_title();?></small>
                <?php   } ?>  
            </td>
            <td class="columna_valor">
                <small>
                    <?php the_field('valor_oc'); ?>
                </small>
            </td>
            <td class="columna_status" data-status="<?php echo intval(get_field('pago'))?>">
                <small>
                    <input class="cambiar_status" data-size="mini" data-handle-width="30" data-off-text="Pend" 
                            style="width:100% !important" data-on-text="OK" type="checkbox" name="my-checkbox" checked>                            
                </small>
            </td>
            <td class="columna_boleta_">
                <form action="kv-upload.php" method="post" enctype="multipart/form-data" name="front_end_upload" >
                    <?php// if(!get_field('boleta')['url']){ $tipo= 'div';$columna_boleta = 'No Tiene boleta';}else{$tipo= 'a';$columna_boleta = 'Boleta';} ?>
                    <small><input type="file" name="" /><input type="button" value="Subir" class="subir_boleta"/></small>
                </form>

            </td>


            <form action="kv-upload.php" method="post" enctype="multipart/form-data" name="front_end_upload" >

      <label> Attach all your files here :<input type="file" name="kv_multiple_attachments[]"  multiple="multiple" > </label>

      <input type="submit" name="Upload" >

    </form>
            
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