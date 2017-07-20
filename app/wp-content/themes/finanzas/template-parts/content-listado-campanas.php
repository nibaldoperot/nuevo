<style>
.active{
    background-color:#FA5858;    
}
th, td {
    max-width:50px !important;
}
.guardar_valor_oc{
    display:none;
}
.columna_oc, .columna_status, .columna_boleta{
    display:none;
}
input{
    max-width:50px !important;
}
.columna_status{
    width:30% !important;
}
</style>
        <button type="button" style="width:48%;" class="btn btn-default ver_home btn-lg"> Home</button>
        <button type="button" style="width:48%;" class="btn btn-default logout btn-lg"> Logout</button>
<?php
        $user = wp_get_current_user();
        if($user->roles[0] == 'administrator'){ ?>

            <table class="table table-inverse">
                <thead>
                    <tr>
                        <th class="columna_campana"><small>Campaña</small></th>
                        <th class="columna_participante"><small>Participante</small></th>
                        <th class="columna_valor"><small>Valor</small></th>
                        <th class="columna_oc"><small>OC</small></th>
                        <th class="columna_status"><small>Status</small></th>   
                        <th class="columna_boleta"><small>Boleta</small></th>
                        <!--<th class="tabla_campana_inicial_primario"><small>Comentario</small></th>  btn para agregar comentario -->
                        <!--<th class="tabla_campana_comentario" style="display:none"><small></small></th>  formulario comentario -->
                    </tr>
                </thead>
                <tbody>
                <div class="listado_campanas">
                <ul class="nav nav-tabs tabs-2 red" role="tablist">
                    <li class="nav-item active">
                        <a class="nav-link filtro_valor" data-toggle="tab" role="tab">Valor</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link filtro_oc" data-toggle="tab" role="tab">OC</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link filtro_status" data-toggle="tab" role="tab">Status</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link filtro_boleta" data-toggle="tab" role="tab">Boletas</a>
                    </li>
                </ul>
                    <?php //get_template_part( 'template-parts/content', 'tabla-campanas' ); ?>
                    <?php get_template_part( 'template-parts/content', 'tabla-campanas-admin' ); ?>
                        
                </div>
                </tbody>
            </table>
<?php   }else{
                if($user->roles[0] == 'usuario_externo'){ ?>
                     <table class="table table-inverse">
                        <thead>
                            <tr>
                                <th class="columna_campana"><small>Campaña</small></th>
                                <th class="columna_valor"><small>Valor</small></th>
                                <th class="columna_oc"><small>OC</small></th>
                                <th class="columna_boleta"><small>Boleta</small></th>
                            </tr>
                        </thead>
                        <tbody>
                        <div class="listado_campanas">
                        <ul class="nav nav-tabs tabs-2 red" role="tablist">
                            <li class="nav-item active">
                                <a class="nav-link filtro_valor" data-toggle="tab" role="tab">Valor</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link filtro_oc" data-toggle="tab" role="tab">OC</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link filtro_boleta" data-toggle="tab" role="tab">Boletas</a>
                            </li>
                        </ul>
                            <?php get_template_part( 'template-parts/content', 'tabla-campanas-externo' ); ?>
                                
                        </div>
                        </tbody>
                    </table>
                    

        <?php   }
        }
?>