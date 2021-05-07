// Script for activating the file input after pressing a custom button designed for it
// Additionally this script can show a preview for the chosen file
//
// Usage: just need to include the templates/form/file.blade.php view
// and the templates/form/media-previewer.blade.php view if you're using previews,
// everything there is ready for use. Remember to pass an unique ID value when including
// the view as this is needed to the code to function correctly.
// Pass the exact same id to the media-previewer view

$(document).ready(function() {

    var context = new FileInputContext;

    $('body').on('click', '[role=file-button]', function(e) {
        context.fileInput = document.getElementById(e.target.id+'Input');
        context.preview = document.getElementById(e.target.id+'Preview');
        context.closeButton = document.getElementById(context.preview.id+"Close");
        $('#'+context.fileInput.id).click();
    });


    $('body').on('change', '[role=file-input]', function(e) {
        setMediaPreview(context.closeButton, context.preview, context.fileInput);
        $('#'+context.closeButton.id).closest('.preview-container').show();
    });

    $('body').on('click', '.preview-close', function() {
        $(this).closest('.preview-container').fadeOut();
        context.fileInput.value = '';
    });

});

// Set the image preview and close button
function setMediaPreview(closeButton, preview, input) {
    if (input.files && input.files[0]) {
        var img = $('#'+preview.id);
        img.attr('src',
            window.URL.createObjectURL(input.files[0]));
        img.on('load', function() {
            $('#'+closeButton.id).show();
            $('#'+closeButton.id).css('left', img.position().left + img.width()-24+'px');
        });        
    }
    
}

// Class used to manipute the context
class FileInputContext
{
    // Stores close button for the preview
    closeButton;
    // Stores the Hidden File input element
    fileInput;
    // Stores the custom button on the context
    preview;
}