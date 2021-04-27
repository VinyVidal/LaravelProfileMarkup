
$(document).ready(function () {
    
    var context = new ConfirmModalContext;

    $('button[data-confirm]').on('click', function(ev) {
        context.button = $(ev.target);
        context.url = context.button.data('url');
        $('#confirmModal').modal('show');
    })

    $('#confirmModal').on('show.bs.modal', function (ev) {
        let button = context.button;
        console.log(button);
        let text = typeof button.data('confirm') != 'undefined' ? button.data('confirm').split('||') : '';
        let contentClass = button.data('class');

        let modal = $(this);

        if(Array.isArray(text) && text.length == 2) {
            modal.find('.modal-title#modal-confirm-title').text(text[0]);
            modal.find('.modal-body p#modal-confirm-content').text(text[1]);
        } else {
            modal.find('.modal-body p#modal-confirm-content').text(text);
        }

        if(typeof contentClass != 'undefined' && contentClass.trim().length > 0) {
            modal.find('.modal-body p#modal-confirm-content').attr('class', contentClass);
        }
    })

    $('#confirmModal').on('hidden.bs.modal', function (ev) {
        let modal = $(this);

        modal.find('.modal-title#modal-confirm-title').text('Atenção');
        modal.find('.modal-body p#modal-confirm-content').text('Deseja realizar a ação?');
        modal.find('.modal-body p#modal-confirm-content').removeAttr('class');
    })

    $('#modal-confirm-yes').on('click', function (ev) {
        if(typeof context.url != 'undefined') {
            window.location.href = context.url;
        }
        
    })
});

class ConfirmModalContext {
    button;
    url;
}