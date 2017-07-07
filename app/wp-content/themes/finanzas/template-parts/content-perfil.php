<button type="button" style="width:23%;" class="perfil_volver btn btn-default btn-sm ">Volver</button>
<button type="button" style="width:23%;" class="ver_todas btn btn-default btn-sm ">Todas</button>
<button type="button" style="width:23%;" class="ver_pagadas btn btn-default btn-sm ">Pagadas</button>
<button type="button" style="width:23%;" class="ver_pendientes btn btn-default btn-sm ">Pendientes</button>
                        
<?php
$args = array(
    'post_type' => array( 'boletas', 'facturas'),
    'author'    => $_GET['user_id'],
    'order'     => DESC,
);
$the_query = new WP_Query( $args );
$current_user_posts = get_posts( $args );
$current_complete_url = get_permalink().'/?user_id='.$_GET['user_id'];
if ( $the_query->have_posts() && $_GET['user_id']) {

    $total_facturas=0;
    $total_boletas=0;
    $total_pagos=0;?>
    <table class="table table-inverse">
        <thead>
            <tr>
                <th><small>Título</small></th>
                <th style="min-width:55px"><small>Valor</small></th>
                <th ><small>Pago</small></th>
                <th style="min-width:55px"><small>Estado</small></th>
                <th style="min-width:62px"><small>Cambiar</small></th>
            </tr>
        </thead>

        <tbody>

        <?php while ( $the_query->have_posts() ){
            $the_query->the_post();
            

             
            $images = get_attached_media();
            foreach($images as $image) {
                if($link != $current_complete_url)
                $link = $image->guid;
                
            }
            ?>

            <?php if(get_post_type()=='facturas'){
            
                $total_facturas += (int)get_field('valor_factura');
                $status = (int)get_field('pago_factura');
                if(get_field('calendario_factura')){
                    $vencimiento = date('d/m/Y', strtotime(get_field('calendario_factura')));
                }else{
                    $vencimiento = date('d/m/Y',strtotime(get_field('fecha_creacion_factura').' +'.get_field('fecha_pago_factura')));

                }
                $total_pagos += (int)get_field('valor_factura');
                $valor = (int)get_field('valor_factura');
                $fecha_vencimiento = substr(get_field('fecha_creacion_factura'),6,2).'/'.substr(get_field('fecha_creacion_factura'),4,2).'/'.substr(get_field('fecha_creacion_factura'),0,4);
                $d = strtotime(date('d/m/Y'));
                $diferencia = strtotime($d) - strtotime($vencimiento);
                //$status_text = $diferencia> 0 ? 'Pend ': 'OK';
                if($status == 0) $status_text = 'Pend';
                if($status == 1) $status_text = 'OK';
                $tipo='factura';
                }else{

                    if(get_post_type()=='boletas'){

                        $total_boletas += (int)get_field('valor_boleta');
                        $status = (int)get_field('pago_boleta');
                        if(get_field('calendario_pago_boleta')){
                            $vencimiento = date('d/m/Y', strtotime(get_field('calendario_pago_boleta')));
                        }else{
                            $vencimiento = date('d/m/Y',strtotime(get_field('fecha_creacion_boleta').' +'.get_field('fecha_pago_boleta')));

                        }
                        $total_pagos += (int)get_field('valor_boleta');
                        $valor = (int)get_field('valor_boleta');
                        $fecha_vencimiento = substr(get_field('fecha_creacion_boleta'),6,2).'/'.substr(get_field('fecha_creacion_boleta'),4,2).'/'.substr(get_field('fecha_creacion_boleta'),0,4);
                        $d = strtotime(date('d/m/Y'));
                        $diferencia = strtotime($d) - strtotime($vencimiento);
                        // $status_text = $diferencia> 0 ? 'Pend ': 'OK';
                        if($status == 0) $status_text = 'Pend';
                        if($status == 1) $status_text = 'OK';
                        $new_status = $diferencia> 0 ? 'OK ': 'Pend';
                        $tipo='boleta';
                        
                    }

                } ?>
            
                <tr class="<?php if($status == 1){ echo 'pagada'; }else{ echo 'pendiente'; } ?>_content">
                    <td><small><a href="<?php echo $link; ?>"><?php echo get_the_title(); ?></a></small></td>
                    <td><small><?php echo number_format($valor, 0, '', '.'); ?></small></td>
                    <td><small><?php echo $vencimiento; ?></small></td>
                    <td><small><?php echo $status_text; ?></small></td>
                    <td>
                        <div class="material-switch pull-left">
                            <input  id="<?php echo $post->ID; ?>" data="<?php echo $tipo; ?>" status="<?php echo $status; ?>" 
                                    name="estadoActual" type="checkbox" <?php if($status == 1) echo 'checked'; ?>/>
                            <label for="<?php echo $post->ID; ?>" class="label-primary" ></label>
                        </div>
                    </td>
                </tr>
        <?php } ?>

            <tr>
                <td>Total</td>
                <td colspan="5"><?php echo number_format($total_pagos, 0, '', '.');?></td>
            </tr>

        </tbody>
    </table>



    <?php wp_reset_postdata();
} else {
    //No se encontraron posts
}
?>