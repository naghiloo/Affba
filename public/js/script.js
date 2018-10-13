$(document).ready(function(){
    $("#header #linkTitleBar").hide();
    
    $("#swapIcon").click(function(){
        slideout.toggle();
    });
    
    $("#shareBtn").click(function(){
        $("#socialShareList").toggle();    
    });
    
    $("#overlay").click(function () {
       $("#usrNavMenu").hide();
       $("#overlay").hide();
    });
    $("#profileCircleIcon").click(function () {
        $("#usrNavMenu").toggle();
        $("#overlay").toggle();
    });
    $("#btnUrlInput").click(function(){
        $("#header #linkTitleBar").show();
        var CSRF_TOKEN = $('input[name="_token"]').val();
        var dataString = {_token: CSRF_TOKEN, longLink:$("#urlInput").val()};

        /* remind that 'dataString' is the response of the AjaxController */
        doAjax("POST", "/link/create", dataString, false, "#linkTitleBar div", ".registerForm");

    });

});

function copyShortLink(element){
    var $temp = $("<input>");
    $("body").append($temp);
    $temp.val($(element).attr("clipboard")).select();
    document.execCommand("Copy");
    $temp.remove();
}

function doAjax(method, to, dataString, cache, target, targetAppend){
    $.ajax({
        type: method,
        url: to,
        data: dataString,
        cache: cache,
        // for file upload this two lines must be false
        success: function (result) {
            $(target).html(result['shortLinkHtml']);
            if (result["shortLinkValue"] != false) {
                var inputShortLink = '<input name="shortLink[]" hidden value="'+ result["shortLinkValue"] +'">';
                $(targetAppend).append(inputShortLink);
            }
            // Empty Input for New longLink
            $("#urlInput").val("");
        },
        error: function (xhr, status, error) {
            var err = eval("(" + xhr.responseText + ")");
            $("#errorLinkText").text(err.errors.longLink[0]);
            $("#linkAlertHidden").show().delay(4000).fadeOut();
        }
    });
}