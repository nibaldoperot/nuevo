<?php
		
		$user = wp_get_current_user();
        if($user->roles[0] == 'administrator'){ 

			if(is_page('home')){
				get_template_part( 'template-parts/content', 'home' );
			}else{
					if(is_page('nueva')){
						get_template_part( 'template-parts/content', 'campanas' );
					}
					if(is_page('listado')){
						get_template_part( 'template-parts/content', 'listado-campanas' );
					}
					if(is_page('subir')){
						get_template_part( 'template-parts/content', 'subir' );
					}
					if(is_page('chat')){
						get_template_part('template-parts/content', 'chat');
					}
			}	
		}else{ 
			if(is_page('home')){
				get_template_part( 'template-parts/content', 'home' );
			}
			if(is_page('subir')){
				get_template_part( 'template-parts/content', 'subir' );
			}
			if(is_page('listado')){
				get_template_part( 'template-parts/content', 'listado-campanas' );
			}else{ 
				
			}
		} 
?>
