jQuery( document ).ready( function( $ ) {
    $('.perfil').click(function(e){
        var id = e.target.id
        window.location.href = window.location.href + '?user_id=' +id
    })
    $('.perfil_volver').click(function(){
        window.location.href = window.location.href.split('?user_id')[0];
    })

    $('.boletas_button').click(function(){
        $('.facturas').hide();
        $('.boletas').show();
        $('h1').text('Boletas');
    })

    $('.facturas_button').click(function(){
        $('.boletas').hide();
        $('.facturas').show();
        $('h1').text('Facturas');
    })

    $('.todos_button').click(function(){
        $('.facturas').show();
        $('.boletas').show();
        $('h1').text('Pagos');
    })

    $('.ver_pagos').click(function(){
        window.location.href = window.location.href + 'pagos'
    })

    $('.ver_perfiles').click(function(){
        window.location.href = window.location.href + 'perfiles'
    })
});
