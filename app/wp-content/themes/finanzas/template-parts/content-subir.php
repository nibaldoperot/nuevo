<form method="post" enctype="multipart/form-data" name="front_end_upload" >
    <label> Adjunta la <?php $_GET['tipo']; ?> <input type="file" name="kv_multiple_attachments[]"  multiple="multiple" > </label>
    <input type="submit" name="Upload" >
    <p>
        <small>Recuerda que la <?php $_GET['tipo'];?> no puede superar los 2MB, ni su nombre contener espacios </small>
    </p>
</form>


<?php


global $post;
$user = wp_get_current_user();
$categories= [];
foreach(get_the_category($_GET['post_id']) as $category){
    array_push($categories, $category->name);
}
if(get_post_type($_GET['post_id']) == 'post'){

    if($user->user_login == 'root' || in_array($user->user_login , $categories) == 1){
        if( 'POST' == $_SERVER['REQUEST_METHOD']  ) {
            if ( $_FILES ) { 
            $files = $_FILES["kv_multiple_attachments"];
            if(preg_match('/\s/',$files['name'][0])!=0){
                foreach ($files['name'] as $key => $value) { 			
                        if ($files['name'][$key]) { 
                            $file = array( 
                                'name' => $files['name'][$key],
                                'type' => $files['type'][$key], 
                                'tmp_name' => $files['tmp_name'][$key], 
                                'error' => $files['error'][$key],
                                'size' => $files['size'][$key]
                            ); 
                            $_FILES = array ("kv_multiple_attachments" => $file); 
                            foreach ($_FILES as $file => $array) {
                                $pid = $_GET['post_id'];
                                var_dump($files['name'][0]);				
                                //$newupload = kv_handle_attachment($file,$pid); 
                            }
                        } 
                    } 
                }
            }else{
                echo 'Los nombres de los archivos no pueden contener espacios';
            }  

        }

    }else{
        die("<script>location.href = '".get_home_url()."'</script>");
    }

}else{
    die("<script>location.href = '".get_home_url()."'</script>");
}

function kv_handle_attachment($file_handler,$post_id){
	if ($_FILES[$file_handler]['error'] !== UPLOAD_ERR_OK) __return_false();

	require_once(ABSPATH . "wp-admin" . '/includes/image.php');
	require_once(ABSPATH . "wp-admin" . '/includes/file.php');
	require_once(ABSPATH . "wp-admin" . '/includes/media.php');

	$attach_id = media_handle_upload( $file_handler, $post_id );

    $my_post = array(
		'ID'           => $post_id,
	);
	wp_update_post( $my_post );
	update_post_meta( $post_id, $_GET['tipo'], $attach_id, '' );
    update_field($_GET['tipo'],$attach_id,$post_id);
    
    die("<script>location.href = '".get_home_url()."'</script>");
}