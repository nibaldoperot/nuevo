<?php
$args = array(
	'post_type' => array( 'facturas')
);
$total_facturas=0;
$total_facturas=0;
$total_pagos;
$the_query = new WP_Query( $args );

if ( $the_query->have_posts() ) {
    while ( $the_query->have_posts() ) {
        $the_query->the_post();
        $total_facturas += (int)get_field('valor_factura');
        $total_pagos += (int)get_field('valor_factura');
        $vencimiento = strtotime(get_field('fecha_pago_factura'));
        $d = strtotime(date('d-m-Y'));
        if(get_field('fecha_pago_factura')!='otro'){
            $vencimiento = date('d-m-Y',strtotime(get_field('fecha_creacion_factura').' +'.get_field('fecha_pago_factura')));
        }else{
            $vencimiento = date('d-m-Y',strtotime(get_field('calendario_factura')));
        } 
        $diferencia = strtotime(date('d-m-Y')) - strtotime($vencimiento);
        $status = $diferencia < 0 ? 'Pago Pendiente ': 'Pago Vencido';
    
        ?>
        
        <h4> <?php the_author();?> | <?php echo get_the_title(); ?> | $<?php echo number_format((int)get_field('valor_factura'), 0, '', '.');?>  | <?php echo $status; ?>  </h4> 
        <p>Fecha : <?php echo substr(get_field('fecha_creacion_factura'),6,2);?>-<?php echo substr(get_field('fecha_creacion_factura'),4,2);?>-<?php echo substr(get_field('fecha_creacion_factura'),0,4); ?>  - 
        Pago :  <?php echo $vencimiento; ?>
        </p>
        
        <div class="documento" >
            <small>Documento</small>
            <small><?php the_content();?></small>
        </div>
        
<?php }
wp_reset_postdata();
} else { ?>
    <h3>No se encontraron facturas</h3>
<?php   } ?>

    <div class="total_facturas">
        <h3>Total facturas: <?php echo number_format($total_facturas, 0, '', '.');?></h3>
    </div>

</div>