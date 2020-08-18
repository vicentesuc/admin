function notificaciones(titulo, mensaje, tipomensaje) {
    $.gritter.add({
        title: titulo,
        text: mensaje,
        class_name: tipomensaje + (!$('#gritter-light').get(0).checked ? ' gritter-light' : '')
    });
    return false;
}


function messages(rp) {
    $.gritter.add({
        title: rp.title,
        text: rp.msg,
        class_name: 'gritter-' + rp.event + (!$('#gritter-light').get(0).checked ? ' gritter-light' : '')
    });
    return false;
}


function limitar_caracteres(id_object, typeform) {
    $('#' + id_object + ' ' + typeform + ' limited').inputlimiter({
        remText: '%n character%s remaining...',
        limitText: 'max allowed : %n.'
    });
}

function resetform(id_object) {
    $('#' + id_object).each(function () {
        this.reset();
    });
}