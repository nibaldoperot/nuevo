<?php
        $user = wp_get_current_user();
        if($user->roles[0] == 'administrator'){ ?>
            <!--<button type="button" style="width:48%;" class="btn btn-default ver_perfiles btn-lg"><i class="fa fa-home left"></i> Ver Perfiles</button>
            <button type="button" style="width:48%;" class="btn btn-default ver_pagos btn-lg"><i class="fa fa-money left"></i> Ver Pagos</button>-->
            <button type="button" style="width:48%;" class="btn btn-default ver_campanas btn-lg"><i class="fa fa-money left"></i> Listado Campañas</button>
            <button type="button" style="width:48%;" class="btn btn-default agregar_campana btn-lg"><i class="fa fa-money left"></i> Agregar Campaña</button>
            <button type="button" style="width:48%;" class="btn btn-default ver_comentarios btn-lg"><i class="fa fa-money left"></i> Comentarios</button>
<?php   }else { 
            if($user->roles[0] == 'usuario_externo'){ ?>
                <button type="button" style="width:48%;" class="btn btn-default ver_campanas btn-lg"><i class="fa fa-money left"></i> Listado Campañas</button>
                <button type="button" style="width:48%;" class="btn btn-default agregar_campana btn-lg"><i class="fa fa-money left"></i> Agregar Campaña</button> 
    <?php   }
        } 
?>