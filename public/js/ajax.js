function AJAXrequest(url, postedData, callback) {
    $.ajax({
        type: 'POST',
        url: url,
        data: postedData,
        dataType: 'json',
        success: callback
    });
}