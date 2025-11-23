$('.icono-de-ver-tareas').on('click', function () {
    var tarea_id = $(this).attr('data-icon');
    var celda = $('td.' + tarea_id);

    if ($(this).html() == 'visibility') {
        $(this).html('visibility_off');
        $(this).removeClass('icono-verde');
        $(this).addClass('icono-rojo');
        celda.css('padding','0');
        celda.fadeIn(300);
    } else {
        $(this).html('visibility');
        $(this).addClass('icono-verde');
        $(this).removeClass('icono-rojo');
        celda.fadeOut(300);
    }
});
