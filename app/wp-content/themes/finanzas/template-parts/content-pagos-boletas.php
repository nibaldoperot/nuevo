<?php
$args = array(
	'post_type' => array( 'boletas')
);
$total_boletas=0;
$total_boletas=0;
$total_pagos;
$the_query = new WP_Query( $args );

if ( $the_query->have_posts() ) {
    while ( $the_query->have_posts() ) {
        $the_query->the_post();
        $total_boletas += (int)get_field('valor_boleta');
        $total_pagos += (int)get_field('valor_boleta');
        $vencimiento = strtotime(get_field('fecha_pago_boleta'));
        $d = strtotime(date('d-m-Y'));
        if(get_field('fecha_pago_boleta')!='otro'){
            $vencimiento = date('d-m-Y',strtotime(get_field('fecha_creacion_boleta').' +'.get_field('fecha_pago_boleta')));
        }else{
            $vencimiento = date('d-m-Y',strtotime(get_field('calendario_boleta')));
        } 
        $diferencia = strtotime(date('d-m-Y')) - strtotime($vencimiento);
        $status = $diferencia < 0 ? 'Pago Pendiente ': 'Pago Vencido';
    
        ?>
        
        <h4> <?php the_author();?> | <?php echo get_the_title(); ?> | $<?php echo number_format((int)get_field('valor_boleta'), 0, '', '.');?>  | <?php echo $status; ?>  </h4> 
        <p>Fecha : <?php echo substr(get_field('fecha_creacion_boleta'),6,2);?>-<?php echo substr(get_field('fecha_creacion_boleta'),4,2);?>-<?php echo substr(get_field('fecha_creacion_boleta'),0,4); ?>  - 
        Pago :  <?php echo $vencimiento; ?>
        </p>
        
        <div class="documento" >
            <small>Documento</small>
            <small><?php the_content();?></small>
        </div>
        
<?php }
wp_reset_postdata();
} else { ?>
    <h3>No se encontraron boletas</h3>
<?php   } ?>

    <div class="total_boletas">
        <h3>Total boletas: <?php echo number_format($total_boletas, 0, '', '.');?></h3>
    </div>

</div>