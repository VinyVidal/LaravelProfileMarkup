$(document).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var context = new PicturePickerContext;

    //fileInput = document.getElementById('photo');

    $('[role=picture-picker]').click(function(e) {
        context.fileInput = document.getElementById(e.target.id+'Input');
        context.picture = document.getElementById(e.target.id);
        console.log(context.picture);
        $('#'+context.fileInput.id).click();
    });

    $('[role=picture-input]').change(function(e) {
        setProfilePicturePreview(context.picture, context.fileInput);
    });

});

function setProfilePicturePreview(picture, input) {
    if (input.files && input.files[0]) {
        $('#'+picture.id).attr('src',
            window.URL.createObjectURL(input.files[0]));
    }
    
}

// Class used to manipute the picture picker activator
class PicturePickerContext
{
    // Stores the Hidden File input element ID
    fileInput;
    // Stores the IMG element on the context
    picture;
}