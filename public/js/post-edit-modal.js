
$(document).ready(function () {

    $('#editPostModal').on('show.bs.modal', function (ev) {
        button = $(ev.relatedTarget);
        url = button.data('url');
    
        loadEditModalContent(url, null);
    })

    $('#editPostModal').on('hidden.bs.modal', function (ev) {
        $('#editPostModalContent').html('Carregando...');
    })
});

function loadEditModalContent(url, errors) {
    AJAXrequest(url, null, function(result) {
        $('#editPostModalContent').html(result.view);
        if(errors) {
            $('#editPostModalErrors').html(errors);
        }
    }, 'get');
}