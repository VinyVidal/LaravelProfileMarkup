
$(document).ready(function () {

    $('#editCommentModal').on('show.bs.modal', function (ev) {
        button = $(ev.relatedTarget);
        url = button.data('url');
    
        loadCommentEditModalContent(url, null);
    })

    $('#editCommentModal').on('hidden.bs.modal', function (ev) {
        $('#editCommentModalContent').html('Carregando...');
    })
});

function loadCommentEditModalContent(url, errors) {
    AJAXrequest(url, null, function(result) {
        $('#editCommentModalContent').html(result.view);
        if(errors) {
            $('#editCommentModalErrors').html(errors);
        }
    }, 'get');
}