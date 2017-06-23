<div class="boletas">
<?php
// The Query

$args = array(
	'post_type' => array( 'boletas')
);
$total_facturas=0;
$total_boletas=0;
$total_pagos;
$the_query = new WP_Query( $args );

// The Loop
        if ( $the_query->have_posts() ) {
            while ( $the_query->have_posts() ) {
                $the_query->the_post(); 
                $total_boletas += (int)get_field('valor_boleta');
                $total_pagos += (int)get_field('valor_boleta');?>
                <h4><?php echo get_the_title(); ?> ( <?php the_author();?> )</h4>
                <p>Emisión:  $<?php the_field('valor_boleta'); ?></p> 
                <p>Fecha : <?php echo substr(get_field('fecha_creacion_boleta'),6,2);?>/<?php echo substr(get_field('fecha_creacion_boleta'),4,2);?>/<?php echo substr(get_field('fecha_creacion_boleta'),0,4); ?>  - 
                Pago :  <?php the_field('calendario_boleta'); ?>
                <?php 
                    if(get_field('fecha_pago_boleta')!='otro'){
                        $dias = substr(get_field('fecha_pago_boleta'),0,2);
                        echo date('d/m/Y', strtotime(get_field('fecha_creacion_boleta').' +'.get_field('fecha_pago_boleta')));
                    }else{
                        echo 'fecha indicada';
                    }  
                ?>
                </p>
                <small><?php the_content();?></small>
                
      <?php }
	    /* Restore original Post Data */
	    wp_reset_postdata();
        } else { ?>
	        <h3>No se encontraron boletas</h3>
<?php   } ?>

    <div class="total_boletas">
    Total Boletas: <?php echo $total_boletas;?>
    </div>

</div>


<div class="facturas">
<?php
// The Query

$args = array(
	'post_type' => array( 'facturas')
);

$the_query = new WP_Query( $args );

// The Loop
        if ( $the_query->have_posts() ) {
            while ( $the_query->have_posts() ) {
                $the_query->the_post();
                $total_facturas += (int)get_field('valor_factura');
                $total_pagos += (int)get_field('valor_factura');?>
                <h4><?php echo get_the_title(); ?> ( <?php the_author();?> )</h4>
                <p>Emisión:  $<?php the_field('valor_factura'); ?></p> 
                <p>Fecha : <?php echo substr(get_field('fecha_creacion_factura'),6,2);?>/<?php echo substr(get_field('fecha_creacion_factura'),4,2);?>/<?php echo substr(get_field('fecha_creacion_factura'),0,4); ?>  - 
                Pago :  <?php the_field('calendario_factura'); ?>
                <?php 
                    if(get_field('fecha_pago_factura')!='otro'){
                        $dias = substr(get_field('fecha_pago_factura'),0,2);
                        echo date('d/m/Y', strtotime(get_field('fecha_creacion_factura').' +'.get_field('fecha_pago_factura')));
                    }else{
                        echo 'fecha indicada';
                    }  
                ?>
                </p>
                <small><?php the_content();?></small>
                
      <?php }
	    /* Restore original Post Data */
	    wp_reset_postdata();
        } else { ?>
	        <h3>No se encontraron facturas</h3>
<?php   } ?>

    <div class="total_facturas">
    Total Facturas: <?php echo $total_facturas;?>
    </div>

</div>

<div class="total">
TOTAL : <?php echo $total_pagos;?>
</div>