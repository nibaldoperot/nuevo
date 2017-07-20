jQuery( document ).ready( function( $ ) {
    $('.perfil').click(function(e){
        var id = e.target.id
        window.location.href = window.location.href + '?user_id=' +id
    })
    $('.perfil_volver').click(function(){
        window.location.href = window.location.href.split('?user_id')[0]
    })

    $('.boletas_button').click(function(){
        $('.factura').hide()
        $('.boleta').show()
        $('h1').text('Boletas')
    })

    $('.facturas_button').click(function(){
        $('.boleta').hide()
        $('.factura').show()
        $('h1').text('Facturas')
    })

    $('.todos_button').click(function(){
        $('.factura').show()
        $('.boleta').show()
        $('h1').text('Pagos')
    })

    $('.ver_pagos').click(function(){
        window.location.href = window.location.href + 'pagos'
    })

    $('.ver_perfiles').click(function(){
        window.location.href = window.location.href + 'perfiles'
    })

    $('.ver_campanas').click(function(){
        window.location.href = window.location.href + 'campana/listado'
    })

    $('.ver_chat').click(function(){
        window.location.href = window.location.href + 'chat'
    })

    $('.agregar_usuario').click(function(){
        window.location.href = window.location.href + 'usuario'
    })

    $('.ver_comentarios').click(function(){
        window.location.href = window.location.href + 'comentarios'
    })

    $('.agregar_campana').click(function(){
        window.location.href = window.location.href + 'campanas/nueva'
    })

    $('.ver_todas').click(function(){
        var seleccion_tipo = $('.btn-success').text().slice(0,-1).toLowerCase()
        console.log(seleccion_tipo)
        if(seleccion_tipo){
            
            $('.'+seleccion_tipo+'.pagada_content').show()
            $('.'+seleccion_tipo+'.pendiente_content').show()
            
        }else{
            $('.pagada_content').show()
            $('.pendiente_content').show()
        } 
    })

    $('.ver_pagadas').click(function(){
        var seleccion_tipo = $('.btn-success').text().slice(0,-1).toLowerCase()
        if(seleccion_tipo){
            $('.'+seleccion_tipo+'.pendiente_content').hide()
            $('.'+seleccion_tipo+'.pagada_content').show()
            
        }else{
            $('.pendiente_content').hide()
            $('.pagada_content').show()
        }      
        
    })

    $('.ver_pendientes').click(function(){
        var seleccion_tipo = $('.btn-success').text().slice(0,-1).toLowerCase()
        if(seleccion_tipo){
            $('.'+seleccion_tipo+'.pagada_content').hide()
            $('.'+seleccion_tipo+'.pendiente_content').show()
            
        }else{
            $('.pagada_content').hide()
            $('.pendiente_content').show()
        }      
    })

    

    $('.btn-sm').click(function(){
        $(this).removeClass('btn-default')        
        $(this).siblings().removeClass('btn-danger')        
        $(this).siblings().addClass('btn-default')        
        $(this).addClass('btn-danger')
    })

    $('.btn-md').click(function(){
        $(this).removeClass('btn-default')        
        $(this).siblings().removeClass('btn-success btn-danger')        
        $(this).siblings().addClass('btn-default')        
        $(this).addClass('btn-success')

    })

    $('.filtro_valor').click(function(){
        $(this).parent().siblings().removeClass('active')       
        $(this).parent().addClass('active')       
        $('.columna_oc').hide()
        $('.columna_status').hide()
        $('.columna_boleta').hide()
        $('.columna_pago').hide()
        $('.columna_valor').show()
    })

    $('.filtro_oc').click(function(){
        $(this).parent().siblings().removeClass('active')       
        $(this).parent().addClass('active')
        $('.columna_valor').hide()
        $('.columna_status').hide()
        $('.columna_boleta').hide()
        $('.columna_pago').hide()
        $('.columna_oc').show()
    })

    $('.filtro_status').click(function(){
        $(this).parent().siblings().removeClass('active')
        $(this).parent().addClass('active')
        $('.columna_valor').hide()
        $('.columna_oc').hide()
        $('.columna_boleta').hide()
        $('.columna_pago').hide()
        $('.columna_status').show()
    })

    $('.filtro_boleta').click(function(){
        $(this).parent().siblings().removeClass('active')
        $(this).parent().addClass('active')
        $('.columna_valor').hide()
        $('.columna_oc').hide()
        $('.columna_status').hide()
        $('.columna_pago').hide()
        $('.columna_boleta').show()
    })

    $('.filtro_pago').click(function(){
        $(this).parent().siblings().removeClass('active')
        $(this).parent().addClass('active')
        $('.columna_valor').hide()
        $('.columna_oc').hide()
        $('.columna_status').hide()
        $('.columna_boleta').hide()
        $('.columna_pago').show()
    })


    var home_url = $("#main").attr("data-home-url")
    var logout_url = $("#main").attr("data-logout-url")
        
    // $("[name='my-checkbox']").bootstrapSwitch();
        
    $('.ver_home').click(function(){
        window.location.href = home_url
    })
    
     $('.subir_oc').click(function(){
        var post_id = $(this).closest( "tr" ).attr('data-post-id')
        window.location.href = home_url+"/campana/subir?post_id="+post_id+"&tipo=oc"
    })

    $('.logout').click(function(){
        window.location.href = logout_url
    })


    $('.subir_boleta').click(function(){
        var post_id = $(this).closest( "tr" ).attr('data-post-id')
        window.location.href = home_url+"/campana/subir?post_id="+post_id+"&tipo=boleta"
    })

    $('.cambiar_valor_oc').click(function(){
        //Cambios en vista
        $(this).siblings('input').prop("disabled", false);
        $(this).siblings('.guardar_valor_oc').show();
        $(this).hide();
    })

    $('.guardar_valor_oc').click(function(){
        //cambios en vista
        $(this).siblings('input').prop("disabled", true);
        $(this).siblings('.cambiar_valor_oc').show();
        $(this).hide();
        
        //variables para funcion
        var valor_oc = $(this).siblings('input').val()
        var post_id = $(this).closest( "tr" ).attr('data-post-id')

        //llamada ajax
        $.ajax({
        url: "http://192.168.0.32/_Finanzas/htdocs/app/" + "wp-admin/admin-ajax.php" + "?action=cambiar_valor_oc",
        type: 'post',
        data: {
            valor_oc: valor_oc,
            post_id: post_id
        },
        success: function(data) {
            console.log(data)
        },
        error: function(data) {
        }
        })
    })
    

})
