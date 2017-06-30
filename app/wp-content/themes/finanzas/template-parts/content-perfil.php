<a class="perfil_volver btn btn-default"><i class="fa fa-arrow-left left"></i> Volver</a>

<?php
$args = array(
    'post_type' => array( 'boletas', 'facturas'),
    'author'    => $_GET['user_id'],
    'order'     => DESC
);
$the_query = new WP_Query( $args );
$current_user_posts = get_posts( $args );

if ( $the_query->have_posts() && $_GET['user_id']) {

    $total_facturas=0;
    $total_boletas=0;
    $total_pagos=0;?>
    <table class="table table-inverse">
        <thead>
            <tr>
                <th><small>Título</small></th>
                <th><small>$</small></th>
                <th><small>Factura</small></th>
                <th><small>Pago</small></th>
                <th><small>Estado</small></th>
                <th><small>Acción</small></th>
                <!--<th>Archivo</th>-->
            </tr>
        </thead>

        <tbody>

        <?php while ( $the_query->have_posts() ){
            $the_query->the_post();
            
            ?>

            <?php if(get_post_type()=='facturas'){
            
                $total_facturas += (int)get_field('valor_factura');
                $vencimiento = date('d/m/Y',strtotime(get_field('fecha_creacion_factura').' +'.get_field('fecha_pago_factura')));
                $total_pagos += (int)get_field('valor_factura');
                $valor = (int)get_field('valor_factura');
                $fecha_vencimiento = substr(get_field('fecha_creacion_factura'),6,2).'/'.substr(get_field('fecha_creacion_factura'),4,2).'/'.substr(get_field('fecha_creacion_factura'),0,4);
                $d = strtotime(date('d/m/Y'));
                $diferencia = strtotime($d) - strtotime($vencimiento);
                $status = $diferencia> 0 ? 'Pend ': 'OK';
                
                }else{

                    if(get_post_type()=='boletas'){

                        $total_boletas += (int)get_field('valor_boleta');
                        $vencimiento = date('d/m/Y',strtotime(get_field('fecha_creacion_boleta').' +'.get_field('fecha_pago_boleta')));
                        $total_pagos += (int)get_field('valor_boleta');
                        $valor = (int)get_field('valor_boleta');
                        $fecha_vencimiento = substr(get_field('fecha_creacion_boleta'),6,2).'/'.substr(get_field('fecha_creacion_boleta'),4,2).'/'.substr(get_field('fecha_creacion_boleta'),0,4);
                        $d = strtotime(date('d/m/Y'));
                        $diferencia = strtotime($d) - strtotime($vencimiento);
                        $status = $diferencia> 0 ? 'Pend ': 'OK';
                        $new_status = $diferencia> 0 ? 'OK ': 'Pend';
                    }

                } ?>
            
                <tr>
                    <td><small><?php echo get_the_title(); ?></small></td>
                    <td><small><?php echo number_format($valor, 0, '', '.'); ?></small></td>
                    <td><small><?php echo $fecha_vencimiento; ?></small></td>
                    <td><small><?php echo $vencimiento; ?></small></td>
                    <td><small><?php echo $status; ?></small></td>
                    <td><button type="button" class="btn btn-default btn-sm cambiar_estado"><?php echo $new_status; ?></button></td>
                    <!--<td><?php //the_content();?></td>-->
                </tr>
        <?php } ?>

            <tr>
                <td>Total</td>
                <td colspan="5"><?php echo number_format($total_pagos, 0, '', '.');?></td>
                <!--<td></td>-->
            </tr>

        </tbody>
    </table>
    <?php wp_reset_postdata();
} else {
    //No se encontraron posts
}
?>