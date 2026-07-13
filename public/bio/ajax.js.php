<script>
     function SetMax(){
           $("#chat_box").show();
           $("#chat").hide();
        }
     function SetMin(){
         //var x = get_cookie("_slide_sl");
           $("#chat_box").hide();
           $("#chat").show();
        }
    function copy(element_id,copy_id){
        var aux = document.createElement("div");
        aux.setAttribute("contentEditable", true);
        aux.innerHTML = document.getElementById(element_id).innerHTML;
        aux.setAttribute("onfocus", "document.execCommand('selectAll',false,null)"); 
        document.body.appendChild(aux);
        aux.focus();
        document.execCommand("copy");
        document.body.removeChild(aux);
        $("#copy-"+copy_id).hide();
        $("#copied-"+copy_id).show();
    }
    function uploadFile(type) {
              var formData = new FormData($("#"+type+"_form")[0]);
                
                $("#progress").show();
                $.ajax({
                    xhr: function() {
                        var xhr = new window.XMLHttpRequest();
                        xhr.upload.addEventListener("progress", function(evt) {
                            if (evt.lengthComputable) {
                                var percentComplete = evt.loaded / evt.total;
                                percentComplete = parseInt(percentComplete * 100);
                                $('.progress-bar').width(percentComplete+'%');
                                $('.progress-bar').html(percentComplete+'%');
                            }
                        }, false);
                        return xhr;
                    },
                    url: "<?php echo do_config(14);?>ajax/files-upload",
                    data: formData,
                    type: "POST",
                    processData: false,
                    contentType: false,
                    beforeSend: function() {
                    },
                    success:function(data){
                        //$("#upload-files-preview").hide();
                    },
                    complete: function (data) {
                        $("#progress").hide();
                        
                        $("#status-response").html('<div class="alert alert-success text-uppercase"><i class="fa fa-cloud-upload"></i> File was uploaded successfully!</div>');
                        $("#preview-response").html(data['responseText']);
                        $("#banner-response").html(data['responseText']);
                        //$('.submitBtn').removeAttr('disabled');
                        //GrabePreviewOrder();
                    },
                    error:function (){}
                });
    }
    function priceData(type) {
        $("#price-data").hide();
        $("#loader-price").show();
        jQuery.ajax({
            url: "<?php echo do_config(14);?>ajax/campaign-price",
            data:'order='+$("#order").val()+'&type='+type+'&cost='+$("#cost").val()+'&method='+$("#method").val(),
            type: "POST",
            success:function(data){
                $("#price-data").show();
                $("#price-data").html(data);
                $("#loader-price").hide();
            },
            error:function (){}
        });
    }
    function grabeCountry(val) {
        $.ajax({
            type: "POST",
            url: "<?php echo do_config(14);?>ajax/grabe-countries",
            data:'country-type='+val,
            success: function(data){
                $("#countries-data").html(data);
            }
        });
    }
    function neworderForm() {
           var formData = new FormData($("#neworder_form")[0]);
                
                $("#icon-button").hide();
                $("#button-loader").show();
                $("#neworder-button").prop("disabled",true);
                $.ajax({
                    url: "<?php echo do_config(14);?>ajax/neworder-form",
                    data: formData,
                    type: "POST",
                    processData: false,
                    contentType: false,
                    success:function(data){
                        //console.log(data);
                        //scroolll();
                        var result = $.trim(data);
                        
                        $("#neworder-response").html(data);
                            window.setTimeout(function() {
                                window.location.reload();
                            }, 2100);
                        $('#neworder-button').removeAttr('disabled');
                        $("#button-loader").hide();
                        $("#icon-button").show();
                    },
                    complete: function (data) {
                    },
                    error:function (){}
                });
    }
    function withdrawForm() {
        var formData = new FormData($("#withdraw_form")[0]);
                
                $("#icon-button").hide();
                $("#button-loader").show();
                $("#withdraw-button").prop("disabled",true);
                $.ajax({
                    url: "<?php echo do_config(14);?>ajax/withdraw-form",
                    data: formData,
                    type: "POST",
                    processData: false,
                    contentType: false,
                    success:function(data){
                        console.log(data);
                        $("#withdraw-response").html(data);
                        $('#withdraw-button').removeAttr('disabled');
                        $("#button-loader").hide();
                        $("#icon-button").show();
                    },
                    complete: function (data) {
                    },
                    error:function (){}
                });
    }
    function profileForm() {
        var formData = new FormData($("#profile_form")[0]);
                
                $("#icon-button").hide();
                $("#button-loader").show();
                $("#profile-button").prop("disabled",true);
                $.ajax({
                    url: "<?php echo do_config(14);?>ajax/profile-form",
                    data: formData,
                    type: "POST",
                    processData: false,
                    contentType: false,
                    success:function(data){
                        console.log(data);
                        $("#profile-response").html(data);
                        $('#profile-button').removeAttr('disabled');
                        $("#button-loader").hide();
                        $("#icon-button").show();
                    },
                    complete: function (data) {
                    },
                    error:function (){}
                });
    }
    function ChangPasswordForm() {
        var formData = new FormData($("#password_form")[0]);
                
                $("#password-icon-button").hide();
                $("#password-button-loader").show();
                $("#password-button").prop("disabled",true);
                $.ajax({
                    url: "<?php echo do_config(14);?>ajax/changepass-form",
                    data: formData,
                    type: "POST",
                    processData: false,
                    contentType: false,
                    success:function(data){
                        console.log(data);
                        $("#password-response").html(data);
                        $('#password-button').removeAttr('disabled');
                        $("#password-button-loader").hide();
                        $("#password-icon-button").show();
                    },
                    complete: function (data) {
                    },
                    error:function (){}
                });
    }
    function invoicePaidForm() {
        var formData = new FormData($("#invoicePaid_form")[0]);
                
                $("#invoicePaid-icon-button").hide();
                $("#invoicePaid-button-loader").show();
                $("#invoicePaid-button").prop("disabled",true);
                $.ajax({
                    url: "<?php echo do_config(14);?>ajax/invoicepaid-form",
                    data: formData,
                    type: "POST",
                    processData: false,
                    contentType: false,
                    success:function(data){
                        //console.log(data);
                        var result = $.trim(data);
                        if(result === "OK"){
                            $("#invoicepaid-response").html("<div class='alert alert-success'><i class='fa fa-check-circle'></i> Your request to check invoice was successfully sent.</div>");
                            window.setTimeout(function() {
                                window.location.href = '<?php echo do_config(14);?>user/deposit';
                            }, 1500);                          
                        }else{
                            $("#invoicepaid-response").html(data);
                            $('#invoicePaid-button').removeAttr('disabled');
                            $("#invoicePaid-button-loader").hide();
                            $("#invoicePaid-icon-button").show();
                        }
                    },
                    complete: function (data) {
                    },
                    error:function (){}
                });
    }
    function priceData(type) {
        $("#price-data").hide();
        $("#loader-price").show();
        jQuery.ajax({
            url: "<?php echo do_config(14);?>ajax/campaign-price",
            data:'order='+$("#order").val()+'&type='+type+'&cost='+$("#cost").val(),
            type: "POST",
            success:function(data){
                $("#price-data").show();
                $("#price-data").html(data);
                $("#loader-price").hide();
            },
            error:function (){}
        });
    }
    function depositForm(id) {
        var formData = new FormData($("#deposit_form_"+id)[0]);
                
                $("#icon-button-"+id).hide();
                $("#button-loader-"+id).show();
                $("#deposit-button-"+id).prop("disabled",true);
                $.ajax({
                    url: "<?php echo do_config(14);?>ajax/deposit-form",
                    data: formData,
                    type: "POST",
                    processData: false,
                    contentType: false,
                    success:function(data){
                        var result = $.trim(data);
                        
                        if(result.startsWith("<div")){
                            $("#deposit-button-"+id).removeAttr('disabled');
                            $("#button-loader-"+id).hide();
                            $("#icon-button-"+id).show();
                            $("#deposit-response-"+id).html(result);
                        }else{
                            $("#deposit-response-"+id).html('<div class="alert alert-success"><i class="fa fa-refresh"></i> Please wait... Redirect to invoice.</div>');
                            window.setTimeout(function() {
                                window.location.href = result;
                            }, 2500);
                        }
                    },
                    complete: function (data) {
                    },
                    error:function (){}
                });
    }
    function checkoutForm() {
        var formData = new FormData($("#checkout_form")[0]);
                
                $("#checkout-icon-button").hide();
                $("#checkout-button-loader").show();
                $("#checkout-button").prop("disabled",true);
                $.ajax({
                    url: "<?php echo do_config(14);?>ajax/checkout-form",
                    data: formData,
                    type: "POST",
                    processData: false,
                    contentType: false,
                    success:function(data){
                        var result = $.trim(data);
                        
                        if(result.startsWith("<div")){
                            $('#checkout-button').removeAttr('disabled');
                            $("#checkout-button-loader").hide();
                            $("#checkout-icon-button").show();
                            $("#checkout-response").html(result);
                        }else{
                        console.log(result);
                            $("#checkout-response").html('<div class="alert alert-success"><i class="fa fa-check-circle"></i> Please wait... Redirect to checkout.</div>');
                            window.setTimeout(function() {
                                window.location.href = result;
                            }, 2500);
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
                    url: "<?php echo do_config(14);?>ajax/support-form",
                    data: formData,
                    type: "POST",
                    processData: false,
                    contentType: false,
                    success:function(data){
                        //console.log(data);
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
    function buildForm() {
        var formData = new FormData($("#build_form")[0]);
                
                $("#icon-button").hide();
                $("#button-loader").show();
                $("#build-button").prop("disabled",true);
                $.ajax({
                    url: "<?php echo do_config(14);?>ajax/build-form",
                    data: formData,
                    type: "POST",
                    processData: false,
                    contentType: false,
                    success:function(data){
                        //console.log(data);
                        $("#build-response").html(data);
                        $('#build-button').removeAttr('disabled');
                        $("#button-loader").hide();
                        $("#icon-button").show();
                       /* window.setTimeout(function() {
                            window.location.reload();
                        }, 2500);*/
                    },
                    complete: function (data) {
                    },
                    error:function (){}
                });
    }
    function editbuildForm() {
        var formData = new FormData($("#editbuild_form")[0]);
                
                $("#icon-button").hide();
                $("#button-loader").show();
                $("#editbuild-button").prop("disabled",true);
                $.ajax({
                    url: "<?php echo do_config(14);?>ajax/editbuild-form",
                    data: formData,
                    type: "POST",
                    processData: false,
                    contentType: false,
                    success:function(data){
                        //console.log(data);
                        $("#editbuild-response").html(data);
                        $('#editbuild-button').removeAttr('disabled');
                        $("#button-loader").hide();
                        $("#icon-button").show();
                       /* window.setTimeout(function() {
                            window.location.reload();
                        }, 2500);*/
                    },
                    complete: function (data) {
                    },
                    error:function (){}
                });
    }
</script>