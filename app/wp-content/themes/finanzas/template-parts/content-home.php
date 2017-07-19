<?php
        $user = wp_get_current_user();
        if($user->roles[0] == 'administrator'){  ?>
            <button type="button" style="width:48%;" class="btn btn-default ver_campanas btn-lg"> Campañas</button>
            <button type="button" style="width:48%;" class="btn btn-default agregar_campana btn-lg"> Agregar</button>
            <button type="button" style="width:48%;" class="btn btn-default ver_chat btn-lg"> Chat</button>
            <button type="button" style="width:48%;" class="btn btn-default logout btn-lg"> Logout</button>

            
<?php   }else{ ?>
            <button type="button" style="width:48%;" class="btn btn-default ver_campanas btn-lg"> Campañas</button>
            <button type="button" style="width:48%;" class="btn btn-default logout btn-lg"> Logout</button>
            
<?php   } ?>
