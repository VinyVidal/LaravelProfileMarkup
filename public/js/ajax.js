function AJAXrequest(url, postedData, callback, type = 'POST', dataType = 'json') {
    $.ajax({
        type: type,
        url: url,
        data: postedData,
        dataType: dataType,
        success: callback,
        error: function(jqXHR, textStatus) {console.log(jqXHR.responseText)}
    });
}