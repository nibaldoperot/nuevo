
<?php
$args = array(
	'post_type' => array( 'boletas')
);
$total_boletas=0;
$total_boletas=0;
$total_pagos;
$the_query = new WP_Query( $args );?>

<?php if ( $the_query->have_posts() ) {
    while ( $the_query->have_posts() ) {
        $the_query->the_post();
        $valor = (int)get_field('valor_boleta');
        $vencimiento = strtotime(get_field('fecha_pago_boleta'));
        $d = strtotime(date('d-m-Y'));
        if(get_field('fecha_pago_boleta')!='otro'){
            $vencimiento = date('d-m-Y',strtotime(get_field('fecha_creacion_boleta').' +'.get_field('fecha_pago_boleta')));
        }else{
            $vencimiento = date('d-m-Y',strtotime(get_field('calendario_boleta')));
        } 
        $status = get_field('pago_boleta');
        if($status == 0) $status_text = 'Pend';
        if($status == 1) $status_text = 'OK';
        $tipo = 'boleta';
        ?>

        
            <tr class="<?php if($status == 1){ echo 'pagada'; }else{ echo 'pendiente'; } ?>_content <?php echo $tipo; ?>">
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
        
<?php }
wp_reset_postdata();
} else { ?>
    <h3>No se encontraron boletas</h3>
<?php   } ?>

    <!--<div class="total_boletas">
        <h3>Total boletas: <?php //echo number_format($total_boletas, 0, '', '.');?></h3>
    </div>-->

</div>