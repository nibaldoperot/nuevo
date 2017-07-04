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
    <!--<div class="factura">-->
        <?php get_template_part( 'template-parts/content', 'pagos-facturas' ); ?>
    <!--</div>-->
    <!--<div class="boleta">-->
        <?php get_template_part( 'template-parts/content', 'pagos-boletas' ); ?>
    <!--</div>-->
    </tbody>
</table>