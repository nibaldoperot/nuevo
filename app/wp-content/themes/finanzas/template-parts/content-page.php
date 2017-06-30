<?php
		if(is_page('home')){
			get_template_part( 'template-parts/content', 'home' );
		}else{ ?>
			<button type="button" style="width:93%;" class="ver_home btn btn-default btn-lg"><i class="fa fa-home left"></i> Home</button>
			
			<?php
				if(is_page('perfiles')){
					get_template_part( 'template-parts/content', 'perfiles' );
				}

				if(is_page('pagos')){ ?>
					<div>
						<button type="button" style="width:31%;" class="btn btn-info boletas_button btn-lg">Boletas</button>
						<button type="button" style="width:31%;" class="btn btn-success facturas_button btn-lg">Facturas</button>
						<button type="button" style="width:31%;" class="btn btn-danger todos_button btn-lg">Todos</button>
						<?php get_template_part( 'template-parts/content', 'pagos' );?>
					
					</div> 
			<?php }
 		}	

?>