<?php
        $user = wp_get_current_user();
        if($user->roles[0] == 'administrator'){  ?>
            <button type="button" style="width:48%;" class="btn btn-default ver_campanas btn-lg"><small>Campañas</small></button>
            <button type="button" style="width:48%;" class="btn btn-default agregar_campana btn-lg"><small>Nueva Campaña</small></button>
            <button type="button" style="width:48%;" class="btn btn-default agregar_usuario btn-lg"><small>Nuevo Usuario</small></button>
            <button type="button" style="width:48%;" class="btn btn-default ver_chat btn-lg"><small>Chat</small></button>
            <button type="button" style="width:48%;" class="btn btn-default logout btn-lg"><small>Logout</small></button>

            
<?php   }else{ ?>
            <button type="button" style="width:48%;" class="btn btn-default ver_campanas btn-lg"> Campañas</button>
            <button type="button" style="width:48%;" class="btn btn-default logout btn-lg"> Logout</button>
            
<?php   } ?>
