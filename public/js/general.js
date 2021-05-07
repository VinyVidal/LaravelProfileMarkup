

$(document).ready(function () {
    triggerEvents();
});

/**
 * Checks if there's a <trigger> element and if so, force the click event of the element
 * which ID value is equal to the <trigger>'s button-click value
 */
function triggerEvents()
{
    if($('trigger[click]').length) {
        let trigger = $('trigger[click]');
        let button = $('#' + trigger.attr('click'));
        button.click();
    }

    if($('trigger[function]').length) {
        let trigger = $('trigger[function]');
        let errors = typeof $('#errors').html() != 'undefined' ? $('#errors').html() : null;
        let callback = trigger.attr('function');
        let args = '';
        if(typeof trigger.attr('function-args') != 'undefined' && trigger.attr('function-args').length) {
            args = trigger.attr('function-args');
            window[callback](args, errors);
        } else {
            window[callback];
        }
    }
}