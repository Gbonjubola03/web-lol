<script>
   function upOption(type){
        if(type === 'access_link'){
            $("#tools-option").fadeIn();
            $("#email-option").fadeOut();
        }else if(type === 'email'){
            $("#email-option").fadeIn();
            $("#tools-option").fadeOut();
        }
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
                        $("#backcard-response").html(data['responseText']);
                        //$('.submitBtn').removeAttr('disabled');
                        //GrabePreviewOrder();
                    },
                    error:function (){}
                });
    }
  









    function newserviceForm() {
    var formData = new FormData($("#newservice_form")[0]);
    
    // Log form data for debugging
    var formDataObj = {};
    for (var pair of formData.entries()) {
        formDataObj[pair[0]] = pair[1];
    }
    console.log("Form data being submitted:", formDataObj);
    
    $("#icon-button").hide();
    $("#button-loader").show();
    $("#newservice-button").prop("disabled", true);
    
    $.ajax({
        url: "<?php echo do_config(14);?>ajax/newservice-form",
        data: formData,
        type: "POST",
        processData: false,
        contentType: false,
        success: function(data) {
            var result = $.trim(data);
            
            console.log("Raw response:", data);
            console.log("Trimmed response:", result);
            
            // Try to parse as JSON
            try {
                var jsonResponse = JSON.parse(result);
                
                if (jsonResponse.status === 'success') {
                    $("#newservice-response").html(jsonResponse.message || '<div class="alert alert-success"><i class="fa fa-check-circle"></i> Service added successfully</div>');
                    if (jsonResponse.redirect_url) {
                        window.setTimeout(function() {
                            window.location.href = jsonResponse.redirect_url;
                        }, 1800);
                    }
                } else if (jsonResponse.status === 'error') {
                    $("#newservice-response").html(jsonResponse.message || '<div class="alert alert-danger">Unknown error</div>');
                }
                
                $("#button-loader").hide();
                $("#icon-button").show();
                $("#newservice-button").prop("disabled", false);
            } catch (e) {
                console.log("Not valid JSON, displaying raw response");
                $("#newservice-response").html(result);
                $("#button-loader").hide();
                $("#icon-button").show();
                $("#newservice-button").prop("disabled", false);
            }
        },
        error: function(xhr, status, error) {
            console.error("AJAX error:", status, error);
            console.error("Response text:", xhr.responseText);
            $("#newservice-response").html('<div class="alert alert-danger">Error: ' + error + '</div>');
            $("#button-loader").hide();
            $("#icon-button").show();
            $("#newservice-button").prop("disabled", false);
        }
    });
    
    return false;
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
    $("#checkout-button").prop("disabled", true);
    
    $.ajax({
        url: "<?php echo do_config(14);?>ajax/checkout-form",
        data: formData,
        type: "POST",
        processData: false,
        contentType: false,
        success: function(data) {
            console.log("Response:", data);
            
            try {
                // Try to parse the response as JSON
                var jsonResponse;
                if (typeof data === 'string') {
                    jsonResponse = JSON.parse(data);
                } else {
                    jsonResponse = data;
                }
                
                // Handle success response with checkout URL
                if (jsonResponse.status === "success" && jsonResponse.checkout_url) {
                    $("#checkout-response").html('<div class="alert alert-success"><i class="fa fa-check-circle"></i> Please wait... Redirecting to checkout.</div>');
                    window.setTimeout(function() {
                        window.location.href = jsonResponse.checkout_url;
                    }, 2500);
                } 
                // Handle error response
                else if (jsonResponse.status === "error" && jsonResponse.message) {
                    $('#checkout-button').removeAttr('disabled');
                    $("#checkout-button-loader").hide();
                    $("#checkout-icon-button").show();
                    $("#checkout-response").html('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ' + jsonResponse.message + '</div>');
                }
                // Fallback for unexpected response format
                else {
                    $('#checkout-button').removeAttr('disabled');
                    $("#checkout-button-loader").hide();
                    $("#checkout-icon-button").show();
                    $("#checkout-response").html('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> Unexpected response from server</div>');
                }
            } catch (e) {
                console.error("Error parsing response:", e);
                
                // If it's HTML content (starts with <div)
                if (typeof data === 'string' && data.trim().startsWith("<div")) {
                    $('#checkout-button').removeAttr('disabled');
                    $("#checkout-button-loader").hide();
                    $("#checkout-icon-button").show();
                    $("#checkout-response").html(data);
                } else {
                    // Fallback error message
                    $('#checkout-button').removeAttr('disabled');
                    $("#checkout-button-loader").hide();
                    $("#checkout-icon-button").show();
                    $("#checkout-response").html('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> Invalid response from server</div>');
                }
            }
        },
        error: function(xhr, status, error) {
            console.error("AJAX Error:", status, error);
            $('#checkout-button').removeAttr('disabled');
            $("#checkout-button-loader").hide();
            $("#checkout-icon-button").show();
            $("#checkout-response").html('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> Connection error. Please try again.</div>');
        }
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
    function udetailsForm() {
        var formData = new FormData($("#udetails_form")[0]);
                
                $("#icon-button").hide();
                $("#button-loader").show();
                $("#udetails-button").prop("disabled",true);
                $.ajax({
                    url: "<?php echo do_config(14);?>ajax/udetails-form",
                    data: formData,
                    type: "POST",
                    processData: false,
                    contentType: false,
                    success:function(data){
                        console.log(data);
                        var result = $.trim(data);
                        if($.isNumeric( result )){
                            $("#udetails-response").html("<div class='alert alert-success'><i class='fa fa-check-circle'></i> client account updated successfully</div>");
                            window.setTimeout(function() {
                                window.location.href = "#";
                            }, 2000);
                        }else{
                            $("#udetails-response").html(data);
                            $('#udetails-button').removeAttr('disabled');
                            $("#button-loader").hide();
                            $("#icon-button").show();
                        }
                    },
                    complete: function (data) {
                    },
                    error:function (){}
                });
    }



    function edittrackForm() {
        var formData = new FormData($("#edittrack_form")[0]);
                
                $("#icon-button").hide();
                $("#button-loader").show();
                $("#verification-button").prop("disabled",true);
                $.ajax({
                    url: "<?php echo do_config(14);?>ajax/edittrack-form",
                    data: formData,
                    type: "POST",
                    processData: false,
                    contentType: false,
                    success:function(data){
                        console.log(data);
                        var result = $.trim(data);
                        if($.isNumeric( result )){
                            $("#edittrack-response").html("<div class='alert alert-success'><i class='fa fa-check-circle'></i>SHIPMENT UPDATED SUCCESSFULLY</div>");
                            window.setTimeout(function() {
                                window.location.href = "<?php echo do_config(14); ?>user/shipment";
                            }, 2000);
                        }else{
                            $("#edittrack-response").html(data);
                            $('#edittrack-button').removeAttr('disabled');
                            $("#button-loader").hide();
                            $("#icon-button").show();
                        }
                    },
                    complete: function (data) {
                    },
                    error:function (){}
                });
    }




    function statusForm() {
        var formData = new FormData($("#status_form")[0]);
                
                $("#icon-button").hide();
                $("#button-loader").show();
                $("#status-button").prop("disabled",true);
                $.ajax({
                    url: "<?php echo do_config(14);?>ajax/udetails-form",
                    data: formData,
                    type: "POST",
                    processData: false,
                    contentType: false,
                    success:function(data){
                        console.log(data);
                        var result = $.trim(data);
                        if($.isNumeric( result )){
                            $("#status-response").html("<div class='alert alert-success'><i class='fa fa-check-circle'></i> client status update successfully.</div>");
                            window.setTimeout(function() {
                                window.location.href = "#";
                            }, 4000);
                        }else{
                            $("#status-response").html(data);
                            $('#status-button').removeAttr('disabled');
                            $("#button-loader").hide();
                            $("#icon-button").show();
                        }
                    },
                    complete: function (data) {
                    },
                    error:function (){}
                });
    }



    function billingForm() {
        var formData = new FormData($("#billing_form")[0]);
                
                $("#icon-button").hide();
                $("#button-loader").show();
                $("#billing-button").prop("disabled",true);
                $.ajax({
                    url: "<?php echo do_config(14);?>ajax/udetails-form",
                    data: formData,
                    type: "POST",
                    processData: false,
                    contentType: false,
                    success:function(data){
                        console.log(data);
                        var result = $.trim(data);
                        if($.isNumeric( result )){
                            $("#billing-response").html("<div class='alert alert-success'><i class='fa fa-check-circle'></i> billing code have been update.</div>");
                            window.setTimeout(function() {
                                window.location.href = "#";
                            }, 4000);
                        }else{
                            $("#billing-response").html(data);
                            $('#billing-button').removeAttr('disabled');
                            $("#button-loader").hide();
                            $("#icon-button").show();
                        }
                    },
                    complete: function (data) {
                    },
                    error:function (){}
                });
    }




    function transferForm() {
        var formData = new FormData($("#transfer_form")[0]);
                
                $("#icon-button").hide();
                $("#button-loader").show();
                $("#transfer-button").prop("disabled",true);
                $.ajax({
                    url: "<?php echo do_config(14);?>ajax/udetails-form",
                    data: formData,
                    type: "POST",
                    processData: false,
                    contentType: false,
                    success:function(data){
                        console.log(data);
                        var result = $.trim(data);
                        if($.isNumeric( result )){
                            $("#transfer-response").html("<div class='alert alert-success'><i class='fa fa-check-circle'></i> billing code have been update.</div>");
                            window.setTimeout(function() {
                                window.location.href = "#";
                            }, 4000);
                        }else{
                            $("#transfer-response").html(data);
                            $('#transfer-button').removeAttr('disabled');
                            $("#button-loader").hide();
                            $("#icon-button").show();
                        }
                    },
                    complete: function (data) {
                    },
                    error:function (){}
                });
    }




    function managerForm() {
        var formData = new FormData($("#manager_form")[0]);
                
                $("#icon-button").hide();
                $("#button-loader").show();
                $("#manager-button").prop("disabled",true);
                $.ajax({
                    url: "<?php echo do_config(14);?>ajax/udetails-form",
                    data: formData,
                    type: "POST",
                    processData: false,
                    contentType: false,
                    success:function(data){
                        console.log(data);
                        var result = $.trim(data);
                        if($.isNumeric( result )){
                            $("#manager-response").html("<div class='alert alert-success'><i class='fa fa-check-circle'></i> billing code have been update.</div>");
                            window.setTimeout(function() {
                                window.location.href = "#";
                            }, 4000);
                        }else{
                            $("#manager-response").html(data);
                            $('#manager-button').removeAttr('disabled');
                            $("#button-loader").hide();
                            $("#icon-button").show();
                        }
                    },
                    complete: function (data) {
                    },
                    error:function (){}
                });
    }


    function acctstatusForm() {
        var formData = new FormData($("#acctstatus_form")[0]);
                
                $("#icon-button").hide();
                $("#button-loader").show();
                $("#acctstatus-button").prop("disabled",true);
                $.ajax({
                    url: "<?php echo do_config(14);?>ajax/udetails-form",
                    data: formData,
                    type: "POST",
                    processData: false,
                    contentType: false,
                    success:function(data){
                        console.log(data);
                        var result = $.trim(data);
                        if($.isNumeric( result )){
                            $("#acctstatus-response").html("<div class='alert alert-success'><i class='fa fa-check-circle'></i> transfer status have been updated.</div>");
                            window.setTimeout(function() {
                                window.location.href = "#";
                            }, 4000);
                        }else{
                            $("#acctstatus-response").html(data);
                            $('#acctstatus-button').removeAttr('disabled');
                            $("#button-loader").hide();
                            $("#icon-button").show();
                        }
                    },
                    complete: function (data) {
                    },
                    error:function (){}
                });
    }

    function creditForm() {
        var formData = new FormData($("#credit_form")[0]);
                
                $("#icon-button").hide();
                $("#button-loader").show();
                $("#credit-button").prop("disabled",true);
                $.ajax({
                    url: "<?php echo do_config(14);?>ajax/udetails-form",
                    data: formData,
                    type: "POST",
                    processData: false,
                    contentType: false,
                    success:function(data){
                        console.log(data);
                        var result = $.trim(data);
                        if($.isNumeric( result )){
                            $("#credit-response").html("<div class='alert alert-success'><i class='fa fa-check-circle'></i> client status have been credited.</div>");
                            window.setTimeout(function() {
                                window.location.href = "#";
                            }, 4000);
                        }else{
                            $("#credit-response").html(data);
                            $('#credits-button').removeAttr('disabled');
                            $("#button-loader").hide();
                            $("#icon-button").show();
                        }
                    },
                    complete: function (data) {
                    },
                    error:function (){}
                });
    }

    function debitForm() {
        var formData = new FormData($("#debit_form")[0]);
                
                $("#icon-button").hide();
                $("#button-loader").show();
                $("#debit-button").prop("disabled",true);
                $.ajax({
                    url: "<?php echo do_config(14);?>ajax/udetails-form",
                    data: formData,
                    type: "POST",
                    processData: false,
                    contentType: false,
                    success:function(data){
                        console.log(data);
                        var result = $.trim(data);
                        if($.isNumeric( result )){
                            $("#debit-response").html("<div class='alert alert-success'><i class='fa fa-check-circle'></i> client status have been credited.</div>");
                            window.setTimeout(function() {
                                window.location.href = "#";
                            }, 4000);
                        }else{
                            $("#debit-response").html(data);
                            $('#debits-button').removeAttr('disabled');
                            $("#button-loader").hide();
                            $("#icon-button").show();
                        }
                    },
                    complete: function (data) {
                    },
                    error:function (){}
                });
    }



    function unlockForm() {
    // Get values directly
    var id = $("input[name='id']").val();
    var active = $("input[name='active']").val();
    var csrfToken = $("input[name='csrfToken']").val();
    var user_id = $("input[name='user_id']").val(); // Add this line to get user_id
   
    console.log("ID:", id);
    console.log("Active:", active);
    console.log("CSRF:", csrfToken);
    console.log("User ID:", user_id); // Log user_id for debugging
   
    $("#icon-button").hide();
    $("#button-loader").show();
    $("#unlock-button").prop("disabled", true);
   
    $.ajax({
        url: "<?php echo do_config(14);?>ajax/udetails-form",
        data: {
            unlock: "unlock",
            id: id,
            active: active,
            csrfToken: csrfToken,
            user_id: user_id // Add user_id to the data being sent
        },
        type: "POST",
        success: function(data) {
            console.log("Response data:", data);
            var result = $.trim(data);
            if ($.isNumeric(result)) {
                $("#unlock-response").html("<div class='alert alert-success'><i class='fa fa-check-circle'></i> client unlock, refresh the account number is the id.</div>");
                window.setTimeout(function() {
                    window.location.href = "#";
                }, 4000);
            } else {
                $("#unlock-response").html(data);
                $('#unlock-button').removeAttr('disabled');
                $("#button-loader").hide();
                $("#icon-button").show();
            }
        },
        error: function(xhr, status, error) {
            console.error("AJAX Error:", status, error);
            $("#unlock-response").html("<div class='alert alert-danger'>An error occurred during submission.</div>");
            $('#unlock-button').removeAttr('disabled');
            $("#button-loader").hide();
            $("#icon-button").show();
        }
    });
}

function trackForm() {
        var formData = new FormData($("#track_form")[0]);
                
                $("#icon-button").hide();
                $("#button-loader").show();
                $("#verification-button").prop("",true);
                $.ajax({
                    url: "<?php echo do_config(14);?>ajax/track-form",
                    data: formData,
                    type: "POST",
                    processData: false,
                    contentType: false,
                    success:function(data){
                        console.log(data);
                        var result = $.trim(data);
                        if($.isNumeric( result )){
                            $("#track-response").html("<div class='alert alert-success'><i class='fa fa-check-circle'></i> Your shipment created successfully.</div>");
                            window.setTimeout(function() {
                                window.location.href = "<?php echo do_config(14); ?>user/shipment";
                            }, 2000);
                        }else{
                            $("#track-response").html(data);
                            $('#track-button').removeAttr('disabled');
                            $("#button-loader").hide();
                            $("#icon-button").show();
                        }
                    },
                    complete: function (data) {
                    },
                    error:function (){}
                });
    }
    function verificationForm() {
        var formData = new FormData($("#verification_form")[0]);
                
                $("#icon-button").hide();
                $("#button-loader").show();
                $("#verification-button").prop("disabled",true);
                $.ajax({
                    url: "<?php echo do_config(14);?>ajax/verification-form",
                    data: formData,
                    type: "POST",
                    processData: false,
                    contentType: false,
                    success:function(data){
                        console.log(data);
                        var result = $.trim(data);
                        if($.isNumeric( result )){
                            $("#verification-response").html("<div class='alert alert-success'><i class='fa fa-check-circle'></i> Your verification was sent, we will review.</div>");
                            window.setTimeout(function() {
                                window.location.href = "<?php echo do_config(14); ?>user/verification";
                            }, 2000);
                        }else{
                            $("#verification-response").html(data);
                            $('#verification-button').removeAttr('disabled');
                            $("#button-loader").hide();
                            $("#icon-button").show();
                        }
                    },
                    complete: function (data) {
                    },
                    error:function (){}
                });
    }
</script>
