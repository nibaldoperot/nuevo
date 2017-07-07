<button type="button" style="width:48%;" class="btn btn-default ver_perfiles btn-lg"><i class="fa fa-home left"></i> Ver Perfiles</button>
<button type="button" style="width:48%;" class="btn btn-default ver_pagos btn-lg"><i class="fa fa-money left"></i> Ver Pagos</button>
<button type="button" style="width:48%;" class="btn btn-default ver_campanas btn-lg"><i class="fa fa-money left"></i> Ver Campañas</button>
<?php
$user = wp_get_current_user();
var_dump($user->roles);
?>