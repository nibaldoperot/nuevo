<?php
$args = array(
    'post_type' => array( 'boletas', 'facturas'),
    'author'    => $_GET['user_id'],
    'order'     => DESC
);
$the_query = new WP_Query( $args );
$current_user_posts = get_posts( $args );

if ( $the_query->have_posts() ) {

    $total_facturas=0;
    $total_boletas=0;
    $total_pagos=0;?>
    <buttton class="perfil_volver">Volver</buttton>
    <table class="bordered">
        <thead>
            <tr>
                <th>Descripción</th>
                <th>Valor</th>
                <th>Fecha en Factura</th>
                <th>Fecha de Pago</th>
                <th>Estado</th>
                <th>Archivo</th>
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
                $status = $diferencia> 0 ? 'Pendiente ': 'Vencido';
                
                }else{

                    if(get_post_type()=='boletas'){

                        $total_boletas += (int)get_field('valor_boleta');
                        $vencimiento = date('d/m/Y',strtotime(get_field('fecha_creacion_boleta').' +'.get_field('fecha_pago_boleta')));
                        $total_pagos += (int)get_field('valor_boleta');
                        $valor = (int)get_field('valor_boleta');
                        $fecha_vencimiento = substr(get_field('fecha_creacion_boleta'),6,2).'/'.substr(get_field('fecha_creacion_boleta'),4,2).'/'.substr(get_field('fecha_creacion_boleta'),0,4);
                        $d = strtotime(date('d/m/Y'));
                        $diferencia = strtotime($d) - strtotime($vencimiento);
                        $status = $diferencia> 0 ? 'Pendiente ': 'Vencido';
                    }

                } ?>
            
                <tr>
                    <td><?php echo get_the_title(); ?></td>
                    <td><?php echo number_format($valor, 0, '', '.'); ?></td>
                    <td><?php echo $fecha_vencimiento; ?></td>
                    <td><?php echo $vencimiento; ?></td>
                    <td><?php echo $status; ?></td>
                    <td><?php the_content();?></td>
                </tr>
        <?php } ?>

            <tr>
                <td>Total</td>
                <td><?php echo number_format($total_pagos, 0, '', '.');?></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>

        </tbody>
    </table>
    <?php wp_reset_postdata();
} else {
    //No se encontraron posts
}
?>