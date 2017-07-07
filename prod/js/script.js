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
        window.location.href = window.location.href + 'campanas'
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

})
