<?php 
        $blogusers = get_users( 'role=usuario_externo' );
        // Array of WP_User objects.
        $users = '';
        foreach ( $blogusers as $user ) {
            $users .= $user->user_nicename.',';
        }
        $args = array( 'post_type' => 'campanas', 'posts_per_page' => 10 );
        $loop = new WP_Query( $args );
        while ( $loop->have_posts() ) : $loop->the_post(); ?>

        <form action="" id="primaryPostForm" method="POST">
            <div class="md-form form-sm">
                <label class="active" for="campana">Campaña</label>
                <input type="text" id="campana" name="campana" placeholder="Ingrese el nombre de la campaña" class="form-control">
                <label class="active" for="campana">Descripción</label>
                <input type="text" id="descripcion" name="descripcion" placeholder="Ingrese la descripción de la campaña" class="form-control">
                <div class="ui-widget">
                    <input id="tags" placeholder="escriba un nombre" class="form-control">
                    <button type="button" class="btn btn-default agrega_participantes">Agregar</button>
                </div>
                <label class="active" for="participante">Participantes de la Campaña</label>
                <input type="text" id="participante" name="participante" placeholder="Listado de Participantes" class="form-control">
                <input style="display:none" type="text" class="listado_participantes required" value="<?php echo $users; ?>" placeholder="Actualmente no hay participantes"/>
                <input type="hidden" name="submitted" id="submitted" value="true" />
                <button type="submit" class="btn btn-default" style="width:100%">Agregar Campaña</button>

            </div>
        </form>
<?php   endwhile;?>
<script>
jQuery( document ).ready( function( $ ) {
    const availableTags = $('.listado_participantes').val().split(',')
    $( "#tags" ).autocomplete({
        source: availableTags
    });

    $('.agrega_participantes').click(function(){
        var participante = $('#tags').val()
        var participantes_actuales = $('#participante').val()
        console.log(participantes_actuales.length)
        participantes_actuales.length == 0 ? $('#participante').val(participante+';') : $('#participante').val(participantes_actuales+';'+participante)
        //limpio input
        $('#tags').val('')

    })
})
</script>