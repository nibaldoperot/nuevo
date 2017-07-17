<?php $temp_query = $wp_query; 
 $user = wp_get_current_user();
        if($user->roles[0] == 'administrator'){

            query_posts( 'category_name=comentarios' ); 
            $blogusers = get_users( 'blog_id=1&orderby=nicename&role=usuario_externo' );
            $array = [];
            foreach ( $blogusers as $user ) {
                array_push($array, $user->user_login);
            }
            
            while ( have_posts() ) : the_post();

            global $post;
            $postcat = get_the_category( $post->ID );
            foreach ($postcat as $category){
                if( in_array($category->name, $array)){
                    $participante = $category->name;
                }
            }
            ?>
                <tr>    
                    <td><small>Campo 1</small></td>                    
                    <td><small>Campo 2</small></td>
                    <td><small>Campo 3</small></td>
                </tr>
            <?php endwhile; ?>
<?php   }else{
        //Vista de usuario_externo

        } ?>



        <?php   $args = array(
                    'post_id' => 947,
                );
                $comments = get_comments( $args );
                var_dump($comments[0]->comment_ID);
                 ?>