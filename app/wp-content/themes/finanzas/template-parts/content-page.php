<?php
		if(is_page('home')){
			get_template_part( 'template-parts/content', 'home' );
		}else{ ?>
			<!--<button type="button" style="width:93%;" class="ver_home btn btn-default btn-lg"><i class="fa fa-home left"></i> Home</button>-->
			
			<?php
				if(is_page('perfiles')){
					get_template_part( 'template-parts/content', 'perfiles' );
				}

				if(is_page('pagos')){ ?>
					<div>
						<button type="button" style="width:31%;" class="btn btn-default todos_button btn-md">Todas</button>
						<button type="button" style="width:31%;" class="btn btn-default boletas_button btn-md">Boletas</button>
						<button type="button" style="width:31%;" class="btn btn-default facturas_button btn-md">Facturas</button>
						<button type="button" style="width:31%;" class="btn btn-default ver_todas btn-sm">Todas</button>
						<button type="button" style="width:31%;" class="btn btn-default ver_pagadas btn-sm">Pagadas</button>
						<button type="button" style="width:31%;" class="btn btn-default ver_pendientes btn-sm">Pendientes</button>
						<?php get_template_part( 'template-parts/content', 'pagos' );?>
					
					</div> 
			<?php }
				if(is_page('nueva')){
					get_template_part( 'template-parts/content', 'campanas' );
				}
				if(is_page('listado')){
					get_template_part( 'template-parts/content', 'listado-campanas' );
				}
				if(is_page('comentarios')){
					get_template_part( 'template-parts/content', 'comentarios' );
				}
 		}	

?>
