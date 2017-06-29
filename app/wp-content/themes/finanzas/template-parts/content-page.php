<?php

	if(is_page('pagos')){ ?>
		<div style="padding: 10px">
			<button class="boletas_button">Boletas</button>
			<button class="facturas_button">Facturas</button>
			<button class="todos_button">Todos</button>
		
		<?php get_template_part( 'template-parts/content', 'pagos' );?>
		
		</div> 
	<?php }

	if(is_page('perfiles')){
		get_template_part( 'template-parts/content', 'perfiles' );
	}

?>
