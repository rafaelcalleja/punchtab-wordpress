//nothing for now
jQuery(document).ready(function($) {
    $("#signup").click (function () {
        $("#dialog").dialog({ height: 300 ,width: 600, modal: true});
    });
    $("form[name=punchtab_signup_form]").submit(function (){

        var data = $(this).serialize();

        $("#domain_error").html("");
        $("#email_error").html("");
        $.ajax({
            url:'https://api.punchtab.com/v1/publisher?method=POST&src=dwp', 
            data: data,
            dataType: 'jsonp',
            success: function(data) {
                //if there is an error
                if (!data.status) {
                    var error_msg = "";
                    for (var error in JSON.parse(data.data).error) {
                        $("#"+error+"_error").html(JSON.parse(data.data).error[error][0]);
                    }
                } else {
                    $("#punchtab_key").val(data.data.publisher.key);
                    $("#key-holder").css('background-color','#FFFBCC');
                    setTimeout(function() {
                        $("#key-holder").css('background-color','');
                    },10000);

                    $("#dialog").dialog("close");
                }
            }
        });
        return false;
    });
});
