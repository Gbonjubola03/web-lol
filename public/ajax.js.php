<script>
    $(window).on('load', function() {
        $('#rev_popup').modal('show');
    });
    function Closeannounce() {
        jQuery.ajax({
            url: "<?php echo do_config(14);?>ajax/closeannounce-form",
            data:'close=300',
            type: "POST",
            success:function(data){
                $('#rev_popup').modal('hide');
                //$("#close-announce").show();
            },
            error:function (){}
        });
    }
    function checkAvailability() {
        $("#loader-availability").show();
        jQuery.ajax({
            url: "<?php echo do_config(14); ?>ajax/username-availability",
            data:'username='+$("#username").val(),
            type: "POST",
            success:function(data){
                $("#user-availability-status").html(data);
                $("#loader-availability").hide();
            },
            error:function (){}
        });
    }
    function checkemailAvailability() {
        $("#email-loader-availability").show();
        jQuery.ajax({
            url: "<?php echo do_config(14); ?>ajax/email-availability",
            data:'email='+$("#email").val(),
            type: "POST",
            success:function(data){
                $("#email-availability-status").html(data);
                $("#email-loader-availability").hide();
            },
            error:function (){}
        });
    }
    function advsignupForm() {
        var formData = new FormData($("#signup_form")[0]);
                
                $("#icon-signup-button").hide();
                $("#button-signup-loader").show();
                $("#signup-button").prop("disabled",true);
                $.ajax({
                    url: "<?php echo do_config(14); ?>ajax/advsignup-form",
                    data: formData,
                    type: "POST",
                    processData: false,
                    contentType: false,
                    success:function(data){
                        //console.log(data);
                        var result = $.trim(data);
                        if(result === "OK"){
                            $("#signup-response").html('<div class="alert alert-success"><i class="fa fa-check-circle"></i> Your account was created successfully</div>');
                            window.setTimeout(function() {
                                window.location.href = "<?php echo do_config(14); ?>";
                            }, 2500);
                        }else{
                            $("#signup-response").html(data);
                            $('#signup-button').removeAttr('disabled');
                            $("#button-signup-loader").hide();
                            $("#icon-signup-button").show();
                        }
                    },
                    complete: function (data) {
                    },
                    error:function (){}
                });
    }
    function signupForm() {
        var formData = new FormData($("#signup_form")[0]);
                
                $("#icon-signup-button").hide();
                $("#button-signup-loader").show();
                $("#signup-button").prop("disabled",true);
                $.ajax({
                    url: "<?php echo do_config(14); ?>ajax/signup-form",
                    data: formData,
                    type: "POST",
                    processData: false,
                    contentType: false,
                    success:function(data){
                        //console.log(data);
                        var result = $.trim(data);
                        if(result === "OK"){
                            $("#signup-response").html('<div class="alert alert-success"><i class="fa fa-check-circle"></i> Your account was created successfully</div>');
                            window.setTimeout(function() {
                                window.location.href = "<?php echo do_config(14); ?>";
                            }, 2500);
                        }else{
                            $("#signup-response").html(data);
                            $('#signup-button').removeAttr('disabled');
                            $("#button-signup-loader").hide();
                            $("#icon-signup-button").show();
                        }
                    },
                    complete: function (data) {
                    },
                    error:function (){}
                });
    }
    function signinForm() {
        var formData = new FormData($("#signin_form")[0]);
                
                $("#icon-signin-button").hide();
                $("#button-signin-loader").show();
                $("#signin-button").prop("disabled",true);
                $.ajax({
                    url: "<?php echo do_config(14); ?>ajax/signin-form",
                    data: formData,
                    type: "POST",
                    processData: false,
                    contentType: false,
                    success:function(data){
                        //console.log(data);
                        var result = $.trim(data);
                        if(result === "admin"){
                            $("#signin-response").html("<div class='alert alert-success'><i class='fa fa-check-circle'></i> <b>Logged</b> in successfully</div>");
                            window.setTimeout(function() {
                                window.location.href = "<?php echo do_config(14); ?>";
                            }, 2500);
                        }else if(result === "user"){
                            $("#signin-response").html("<div class='alert alert-success'><i class='fa fa-check-circle'></i> <b>Logged</b> in successfully</div>");
                            window.setTimeout(function() {
                                window.location.href = "<?php echo do_config(14); ?>user/dashboard";
                            }, 2500);
                        }else if(result === "advertiser"){
                            $("#signin-response").html("<div class='alert alert-success'><i class='fa fa-check-circle'></i> <b>Logged</b> in successfully</div>");
                            window.setTimeout(function() {
                                window.location.href = "<?php echo do_config(14); ?>advertiser/dashboard";
                            }, 2500);
                        }else{
                            $("#signin-response").html(data);
                            $('#icon-signin-button').removeAttr('disabled');
                            $('#signin-button').removeAttr('disabled');
                            $("#button-signin-loader").hide();
                            $("#icon-button").show();
                        }
                    },
                    complete: function (data) {
                    },
                    error:function (){}
                });
    }

    function loginForm() {
        var formData = new FormData($("#login_form")[0]);
                
                $("#icon-login-button").hide();
                $("#button-login-loader").show();
                $("#login-button").prop("disabled",true);
                $.ajax({
                    url: "<?php echo do_config(14); ?>ajax/login",
                    data: formData,
                    type: "POST",
                    processData: false,
                    contentType: false,
                    success:function(data){
                        //console.log(data);
                        var result = $.trim(data);
                        if(result === "admin"){
                            $("#login-response").html("<div class='alert alert-success'><i class='fa fa-check-circle'></i> <b>Logged</b> in successfully</div>");
                            window.setTimeout(function() {
                                window.location.href = "admin/dashboard";
                            }, 2500);
                        }else if(result === "user"){
                            $("#login-response").html("<div class='alert alert-success'><i class='fa fa-check-circle'></i> <b>Logged</b> in successfully</div>");
                            window.setTimeout(function() {
                                window.location.href = "admin/dashboard";
                            }, 2500);
                        }else if(result === "advertiser"){
                            $("#login-response").html("<div class='alert alert-success'><i class='fa fa-check-circle'></i> <b>Logged</b> in successfully</div>");
                            window.setTimeout(function() {
                                window.location.href = "<?php echo do_config(14); ?>admin/dashboard";
                            }, 2500);
                        }else{
                            $("#login-response").html(data);
                            $('#icon-login-button').removeAttr('disabled');
                            $('#login-button').removeAttr('disabled');
                            $("#button-login-loader").hide();
                            $("#icon-button").show();
                        }
                    },
                    complete: function() {
           
        },
        error: function() {
            $("#login-response").html("<div class='alert alert-danger'><i class='fa fa-times-circle'></i> An error you already login</div>");
            $('#login-button').removeAttr('disabled');
            $("#button-login-loader").hide();
            $("#icon-login-button").show();
        }
    });
}


function newpasswordForm() {
        var formData = new FormData($("#newpassword_form")[0]);
                
                $("#icon-newpassword-button").hide();
                $("#button-newpassword-loader").show();
                $("#newpassword-button").prop("disabled",true);
                $.ajax({
                    url: "<?php echo do_config(14); ?>ajax/newpassword-form",
                    data: formData,
                    type: "POST",
                    processData: false,
                    contentType: false,
                    success:function(data){
                        //console.log(data);
                        var result = $.trim(data);
                        if(result === "OK"){
                            $("#newpassword-response").html("<div class='alert alert-success'><i class='fa fa-check-circle'></i> <b>NEW PASSWORD</b> was setup successfully</div>");
                            window.setTimeout(function() {
                                window.location.href = "<?php echo do_config(14); ?>signin";
                            }, 2500);
                        }else{
                            $("#newpassword-response").html(data);
                            $('#icon-newpassword-button').removeAttr('disabled');
                            $('#newpassword-button').removeAttr('disabled');
                            $("#button-newpassword-loader").hide();
                        }
                    },
                    complete: function (data) {
                    },
                    error:function (){}
                });
    }
    function forgotForm() {
        var formData = new FormData($("#forgot_form")[0]);
                
                $("#icon-forgot-button").hide();
                $("#button-forgot-loader").show();
                $("#forgot-button").prop("disabled",true);
                $.ajax({
                    url: "<?php echo do_config(14); ?>ajax/forgot-form",
                    data: formData,
                    type: "POST",
                    processData: false,
                    contentType: false,
                    success:function(data){
                        //console.log(data);
                        var result = $.trim(data);
                        if(result === "OK"){
                            $("#forgot-response").html("<div class='alert alert-success'><i class='fa fa-check-circle'></i> <b>Message</b> was sent successfully</div>");
                            window.setTimeout(function() {
                                window.location.href = "<?php echo do_config(14); ?>forgot-password";
                            }, 2500);
                        }else{
                            $("#forgot-response").html(data);
                            $('#icon-forgot-button').removeAttr('disabled');
                            $('#forgot-button').removeAttr('disabled');
                            $("#button-forgot-loader").hide();
                            $("#icon-button").show();
                        }
                    },
                    complete: function (data) {
                    },
                    error:function (){}
                });
    }
    function supportForm() {
        var formData = new FormData($("#support_form")[0]);
                
                $("#icon-support-button").hide();
                $("#button-support-loader").show();
                $("#support-button").prop("disabled",true);
                $.ajax({
                    url: "<?php echo do_config(14); ?>ajax/support-form",
                    data: formData,
                    type: "POST",
                    processData: false,
                    contentType: false,
                    success:function(data){
                        console.log(data);
                        var result = $.trim(data);
                        $("#support-response").html(data);
                        $('#support-button').removeAttr('disabled');
                        $("#button-support-loader").hide();
                        $("#icon-support-button").show();
                    },
                    complete: function (data) {
                    },
                    error:function (){}
                });
    }
    

    function commentForm() {
        var formData = new FormData($("#comment_form")[0]);
                
                $("#icon-button").hide();
                $("#button-loader").show();
                $("#comment-button").prop("disabled",true);
                $.ajax({
                    url: "<?php echo do_config(14); ?>ajax/comment-form",
                    data: formData,
                    type: "POST",
                    processData: false,
                    contentType: false,
                    success:function(data){
                        //console.log(data);
                        var result = $.trim(data);
                        if(result === "OK"){
                            $("#comment-response").html('<div class="alert alert-success"> Your comment was posted successfully</div>');
                            window.setTimeout(function() {
                                window.location.reload();
                            }, 2500);
                        }else{
                            $("#comment-response").html(data);
                            $('#comment-button').removeAttr('disabled');
                            $("#button-loader").hide();
                            $("#icon-button").show();
                        }
                    },
                    complete: function (data) {
                    },
                    error:function (){}
                });
    }
    function replyForm(id) {
        var formData = new FormData($("#reply_form_"+id)[0]);
                
                $("#reply-icon-button-"+id).hide();
                $("#reply-button-loader-"+id).show();
                $("#reply-button-"+id).prop("disabled",true);
                $.ajax({
                    url: "<?php echo do_config(14); ?>ajax/reply-form",
                    data: formData,
                    type: "POST",
                    processData: false,
                    contentType: false,
                    success:function(data){
                        //console.log(data);
                        var result = $.trim(data);
                        if(result === "OK"){
                            $("#reply-response-"+id).html('<div class="alert alert-success"> Your reply was posted successfully</div>');
                            window.setTimeout(function() {
                                window.location.reload();
                            }, 2500);
                        }else{
                            $("#reply-response-"+id).html(data);
                            $('#reply-button-'+id).removeAttr('disabled');
                            $("#reply-button-loader-"+id).hide();
                            $("#reply-icon-button-"+id).show();
                        }
                    },
                    complete: function (data) {
                    },
                    error:function (){}
                });
    }
</script>