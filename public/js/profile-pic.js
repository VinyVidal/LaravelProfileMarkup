$(document).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var fileInput = document.getElementById('photo');

    $('#profile-picture').click(function(e) {
        $('#photo').click();
    });

    $('#photo').change(function(e) {
        setProfilePicturePreview(fileInput);
    });

});

function setProfilePicturePreview(that) {
    if (that.files && that.files[0]) {
        $('#profile-picture').attr('src',
            window.URL.createObjectURL(that.files[0]));
    }
}