$(document).ready(function () {

    // Include "scrollTo" attribute to an element in order to the page scroll to it on load
    if($('*[scrollTo]').length)
    {
        if($('*[scrollTo]').attr('scrollTo') == "")
        {
            scrollTo($('*[scrollTo]').last().attr('id'));
        }
        
    }
    function scrollTo(target)
    {
        $('html,body').animate({scrollTop: $('#'+target).offset().top}, 0);
    }
});