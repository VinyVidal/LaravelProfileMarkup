

$(document).ready(function () {
    triggerClickEvent();
});

/**
 * Checks if there's a <trigger> element and if so, force the click event of the element
 * which ID value is equal to the <trigger>'s button-click value
 */
function triggerClickEvent()
{
    if($('trigger[click]').length) {
        let trigger = $('trigger[click]');
        let button = $('#' + trigger.attr('click'));
        button.click();
    }
}