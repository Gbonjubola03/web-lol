<script>
    function upOption(type){
        if(type === 'user'){
            $("#admin-option").fadeOut();
        }else if(type === 'admin'){
            $("#admin-option").fadeIn();
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
                        //$('.submitBtn').removeAttr('disabled');
                        //GrabePreviewOrder();
                    },
                    error:function (){}
                });
    }
    function activateForm(id) {
        var formData = new FormData($("#activate_form")[0]);
                
                $("#activate-icon-button-"+id).hide();
                $("#activate-loader-"+id).show();
                $("#activate-button-"+id).prop("disabled",true);
                $.ajax({
                    url: "<?php echo do_config(14);?>ajax/activate-form?id="+id,
                    data: formData,
                    type: "POST",
                    processData: false,
                    contentType: false,
                    success:function(data){
                        $("#activate-response").html(data);
                        window.setTimeout(function() {
                        window.location.reload();
                        }, 1200);
                        $("#activate-button"+id).removeAttr('disabled');
                        $("#activate-loader-"+id).hide();
                        $("#activate-icon-button-"+id).show();
                    },
                    complete: function (data) {
                    },
                    error:function (){}
                });
    }
    function deactivateForm(id) {
        var formData = new FormData($("#deactivate_form")[0]);
                
                $("#icon-button-"+id).hide();
                $("#deactivate-loader-"+id).show();
                $("#deactivate-button-"+id).prop("disabled",true);
                $.ajax({
                    url: "<?php echo do_config(14);?>ajax/deactivate-form?id="+id,
                    data: formData,
                    type: "POST",
                    processData: false,
                    contentType: false,
                    success:function(data){
                        $("#deactivate-response").html(data);
                        window.setTimeout(function() {
                        window.location.reload();
                        }, 1200);
                        $("#deactivate-button"+id).removeAttr('disabled');
                        $("#deactivate-loader-"+id).hide();
                        $("#icon-button-"+id).show();
                    },
                    complete: function (data) {
                    },
                    error:function (){}
                });
    }
    function addscriptForm() {
        var formData = new FormData($("#addscript_form")[0]);
                
                $("#icon-button").hide();
                $("#button-loader").show();
                $("#addscript-button").prop("disabled",true);
                $.ajax({
                    url: "<?php echo do_config(14);?>ajax/addscript-form",
                    data: formData,
                    type: "POST",
                    processData: false,
                    contentType: false,
                    success:function(data){
                        console.log(data);
                        $("#addscript-response").html(data);
                        $('#addscript-button').removeAttr('disabled');
                        $("#button-loader").hide();
                        $("#icon-button").show();
                    },
                    complete: function (data) {
                    },
                    error:function (){}
                });
    }
    function addipForm() {
        var formData = new FormData($("#addip_form")[0]);
                
                $("#icon-button").hide();
                $("#button-loader").show();
                $("#addip-button").prop("disabled",true);
                $.ajax({
                    url: "<?php echo do_config(14);?>ajax/addip-form",
                    data: formData,
                    type: "POST",
                    processData: false,
                    contentType: false,
                    success:function(data){
                        $("#addip-response").html(data);
                        $('#addip-button').removeAttr('disabled');
                        $("#button-loader").hide();
                        $("#icon-button").show();
                    },
                    complete: function (data) {
                    },
                    error:function (){}
                });
    }
    function adduserForm() {
        var formData = new FormData($("#adduser_form")[0]);
                
                $("#icon-button").hide();
                $("#button-loader").show();
                $("#adduser-button").prop("disabled",true);
                $.ajax({
                    url: "<?php echo do_config(14);?>ajax/adduser-form",
                    data: formData,
                    type: "POST",
                    processData: false,
                    contentType: false,
                    success:function(data){
                        $("#adduser-response").html(data);
                        $('#adduser-button').removeAttr('disabled');
                        $("#button-loader").hide();
                        $("#icon-button").show();
                    },
                    complete: function (data) {
                    },
                    error:function (){}
                });
    }
    function addpageForm() {
        var formData = new FormData($("#addpage_form")[0]);
                
                $("#icon-button").hide();
                $("#button-loader").show();
                $("#addpage-button").prop("disabled",true);
                $.ajax({
                    url: "<?php echo do_config(14);?>ajax/addpage-form",
                    data: formData,
                    type: "POST",
                    processData: false,
                    contentType: false,
                    success:function(data){
                        $("#addpage-response").html(data);
                            window.setTimeout(function() {
                                window.location.href = '<?php echo do_config(14);?>admin/pages';
                            }, 1500);
                        $('#addpage-button').removeAttr('disabled');
                        $("#button-loader").hide();
                        $("#icon-button").show();
                    },
                    complete: function (data) {
                    },
                    error:function (){}
                });
    }
    function addannouncementForm() {
        var formData = new FormData($("#addannouncement_form")[0]);
                
                $("#icon-button").hide();
                $("#button-loader").show();
                $("#addannouncement-button").prop("disabled",true);
                $.ajax({
                    url: "<?php echo do_config(14);?>ajax/addannouncement-form",
                    data: formData,
                    type: "POST",
                    processData: false,
                    contentType: false,
                    success:function(data){
                        $("#addannouncement-response").html(data);
                            window.setTimeout(function() {
                                window.location.href = '<?php echo do_config(14);?>admin/announcements';
                            }, 1500);
                        $('#addannouncement-button').removeAttr('disabled');
                        $("#button-loader").hide();
                        $("#icon-button").show();
                    },
                    complete: function (data) {
                    },
                    error:function (){}
                });
    }
    function addarticleForm() {
        var formData = new FormData($("#addarticle_form")[0]);
                
                $("#icon-button").hide();
                $("#button-loader").show();
                $("#addarticle-button").prop("disabled",true);
                $.ajax({
                    url: "<?php echo do_config(14);?>ajax/addarticle-form",
                    data: formData,
                    type: "POST",
                    processData: false,
                    contentType: false,
                    success:function(data){
                        $("#addarticle-response").html(data);
                            window.setTimeout(function() {
                                window.location.href = '<?php echo do_config(14);?>admin/articles';
                            }, 1500);
                        $('#addarticle-button').removeAttr('disabled');
                        $("#button-loader").hide();
                        $("#icon-button").show();
                    },
                    complete: function (data) {
                    },
                    error:function (){}
                });
    }
    function generalForm() {
        var formData = new FormData($("#general_form")[0]);
                
                $("#general-icon-button").hide();
                $("#general-button-loader").show();
                $("#general-button").prop("disabled",true);
                $.ajax({
                    url: "<?php echo do_config(14);?>ajax/config-form",
                    data: formData,
                    type: "POST",
                    processData: false,
                    contentType: false,
                    success:function(data){
                        console.log(data);
                        $("#general-response").html(data);
                            window.setTimeout(function() {
                                window.location.href = '<?php echo do_config(14);?>admin/settings#general';
                            }, 1500);
                        $('#general-button').removeAttr('disabled');
                        $("#general-button-loader").hide();
                        $("#general-icon-button").show();
                    },
                    complete: function (data) {
                    },
                    error:function (){}
                });
    }
   function designForm() {
        var formData = new FormData($("#design_form")[0]);
                
                $("#design-icon-button").hide();
                $("#design-button-loader").show();
                $("#design-button").prop("disabled",true);
                $.ajax({
                    url: "<?php echo do_config(14);?>ajax/config-form",
                    data: formData,
                    type: "POST",
                    processData: false,
                    contentType: false,
                    success:function(data){
                        console.log(data);
                        $("#design-response").html(data);
                            window.setTimeout(function() {
                                window.location.href = '<?php echo do_config(14);?>admin/settings#design';
                            }, 1500);
                        $('#design-button').removeAttr('disabled');
                        $("#design-button-loader").hide();
                        $("#design-icon-button").show();
                    },
                    complete: function (data) {
                    },
                    error:function (){}
                });
    }
     function integrationForm() {
        var formData = new FormData($("#integration_form")[0]);
                
                $("#integration-icon-button").hide();
                $("#integration-button-loader").show();
                $("#integration-button").prop("disabled",true);
                $.ajax({
                    url: "<?php echo do_config(14);?>ajax/config-form",
                    data: formData,
                    type: "POST",
                    processData: false,
                    contentType: false,
                    success:function(data){
                        console.log(data);
                        $("#integration-response").html(data);
                            window.setTimeout(function() {
                                window.location.href = '<?php echo do_config(14);?>admin/settings#integration';
                            }, 1500);
                        $('#integration-button').removeAttr('disabled');
                        $("#integration-button-loader").hide();
                        $("#integration-icon-button").show();
                    },
                    complete: function (data) {
                    },
                    error:function (){}
                });
    }
     function captchaForm() {
        var formData = new FormData($("#captcha_form")[0]);
                
                $("#captcha-icon-button").hide();
                $("#captcha-button-loader").show();
                $("#captcha-button").prop("disabled",true);
                $.ajax({
                    url: "<?php echo do_config(14);?>ajax/config-form",
                    data: formData,
                    type: "POST",
                    processData: false,
                    contentType: false,
                    success:function(data){
                        console.log(data);
                        $("#captcha-response").html(data);
                            window.setTimeout(function() {
                                window.location.href = '<?php echo do_config(14);?>admin/settings#captcha';
                            }, 1500);
                        $('#captcha-button').removeAttr('disabled');
                        $("#captcha-button-loader").hide();
                        $("#captcha-icon-button").show();
                    },
                    complete: function (data) {
                    },
                    error:function (){}
                });
    }
     function systemForm() {
        var formData = new FormData($("#system_form")[0]);
                
                $("#system-icon-button").hide();
                $("#system-button-loader").show();
                $("#system-button").prop("disabled",true);
                $.ajax({
                    url: "<?php echo do_config(14);?>ajax/config-form",
                    data: formData,
                    type: "POST",
                    processData: false,
                    contentType: false,
                    success:function(data){
                        console.log(data);
                        $("#system-response").html(data);
                            window.setTimeout(function() {
                                window.location.href = '<?php echo do_config(14);?>admin/settings#system';
                            }, 1500);
                        $('#system-button').removeAttr('disabled');
                        $("#system-button-loader").hide();
                        $("#system-icon-button").show();
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






     function adsForm() {
        var formData = new FormData($("#ads_form")[0]);
                
                $("#ads-icon-button").hide();
                $("#ads-button-loader").show();
                $("#ads-button").prop("disabled",true);
                $.ajax({
                    url: "<?php echo do_config(14);?>ajax/config-form",
                    data: formData,
                    type: "POST",
                    processData: false,
                    contentType: false,
                    success:function(data){
                        console.log(data);
                        $("#ads-response").html(data);
                            window.setTimeout(function() {
                                window.location.href = '<?php echo do_config(14);?>admin/settings#ads';
                            }, 1500);
                        $('#ads-button').removeAttr('disabled');
                        $("#ads-button-loader").hide();
                        $("#ads-icon-button").show();
                    },
                    complete: function (data) {
                    },
                    error:function (){}
                });
    }
     function adsconfigForm() {
        var formData = new FormData($("#adsconfig_form")[0]);
                
                $("#adsconfig-icon-button").hide();
                $("#adsconfig-button-loader").show();
                $("#adsconfig-button").prop("disabled",true);
                $.ajax({
                    url: "<?php echo do_config(14);?>ajax/config-form",
                    data: formData,
                    type: "POST",
                    processData: false,
                    contentType: false,
                    success:function(data){
                        console.log(data);
                        $("#adsconfig-response").html(data);
                            window.setTimeout(function() {
                                window.location.href = '<?php echo do_config(14);?>admin/settings#adsconfig';
                            }, 1500);
                        $('#adsconfig-button').removeAttr('disabled');
                        $("#adsconfig-button-loader").hide();
                        $("#adsconfig-icon-button").show();
                    },
                    complete: function (data) {
                    },
                    error:function (){}
                });
     }
     function depositsForm() {
        var formData = new FormData($("#deposits_form")[0]);
                
                $("#deposits-icon-button").hide();
                $("#deposits-button-loader").show();
                $("#deposits-button").prop("disabled",true);
                $.ajax({
                    url: "<?php echo do_config(14);?>ajax/config-form",
                    data: formData,
                    type: "POST",
                    processData: false,
                    contentType: false,
                    success:function(data){
                        console.log(data);
                        $("#deposits-response").html(data);
                            window.setTimeout(function() {
                                window.location.href = '<?php echo do_config(14);?>admin/settings#deposits';
                            }, 1500);
                        $('#deposits-button').removeAttr('disabled');
                        $("#deposits-button-loader").hide();
                        $("#deposits-icon-button").show();
                    },
                    complete: function (data) {
                    },
                    error:function (){}
                });
    }
     function emailForm() {
        var formData = new FormData($("#email_form")[0]);
                
                $("#email-icon-button").hide();
                $("#email-button-loader").show();
                $("#email-button").prop("disabled",true);
                $.ajax({
                    url: "<?php echo do_config(14);?>ajax/config-form",
                    data: formData,
                    type: "POST",
                    processData: false,
                    contentType: false,
                    success:function(data){
                        console.log(data);
                        $("#email-response").html(data);
                            window.setTimeout(function() {
                                window.location.href = '<?php echo do_config(14);?>admin/settings#email';
                            }, 1500);
                        $('#email-button').removeAttr('disabled');
                        $("#email-button-loader").hide();
                        $("#email-icon-button").show();
                    },
                    complete: function (data) {
                    },
                    error:function (){}
                });
    }
    function configwbForm() {
        var formData = new FormData($("#configwb_form")[0]);
                
                $("#icon-button").hide();
                $("#button-loader").show();
                $("#configwb-button").prop("disabled",true);
                $.ajax({
                    url: "<?php echo do_config(14);?>ajax/configwb-form",
                    data: formData,
                    type: "POST",
                    processData: false,
                    contentType: false,
                    success:function(data){
                        console.log(data);
                        $("#configwb-response").html(data);
                        $('#configwb-button').removeAttr('disabled');
                        $("#button-loader").hide();
                        $("#icon-button").show();
                    },
                    complete: function (data) {
                    },
                    error:function (){}
                });
    }
    function editcampaignForm() {
        var formData = new FormData($("#editcampaign_form")[0]);
                
                $("#icon-button").hide();
                $("#button-loader").show();
                $("#editcampaign-button").prop("disabled",true);
                $.ajax({
                    url: "<?php echo do_config(14);?>ajax/editcampaign-form",
                    data: formData,
                    type: "POST",
                    processData: false,
                    contentType: false,
                    success:function(data){
                        console.log(data);
                        $("#editcampaign-response").html(data);
                            window.setTimeout(function() {
                                window.location.reload();
                            }, 1500);
                        $('#editcampaign-button').removeAttr('disabled');
                        $("#button-loader").hide();
                        $("#icon-button").show();
                    },
                    complete: function (data) {
                    },
                    error:function (){}
                });
    }
    function editshortForm() {
        var formData = new FormData($("#editshort_form")[0]);
                
                $("#icon-button").hide();
                $("#button-loader").show();
                $("#editshort-button").prop("disabled",true);
                $.ajax({
                    url: "<?php echo do_config(14);?>ajax/editshort-form",
                    data: formData,
                    type: "POST",
                    processData: false,
                    contentType: false,
                    success:function(data){
                        console.log(data);
                        $("#editshort-response").html(data);
                            window.setTimeout(function() {
                                window.location.reload();
                            }, 1500);
                        $('#editshort-button').removeAttr('disabled');
                        $("#button-loader").hide();
                        $("#icon-button").show();
                    },
                    complete: function (data) {
                    },
                    error:function (){}
                });
    }
    function editpageForm() {
        var formData = new FormData($("#editpage_form")[0]);
                
                $("#icon-button").hide();
                $("#button-loader").show();
                $("#editpage-button").prop("disabled",true);
                $.ajax({
                    url: "<?php echo do_config(14);?>ajax/editpage-form",
                    data: formData,
                    type: "POST",
                    processData: false,
                    contentType: false,
                    success:function(data){
                        console.log(data);
                        $("#editpage-response").html(data);
                            window.setTimeout(function() {
                                window.location.reload();
                            }, 1500);
                        $('#editpage-button').removeAttr('disabled');
                        $("#button-loader").hide();
                        $("#icon-button").show();
                    },
                    complete: function (data) {
                    },
                    error:function (){}
                });
    }
    function editserviceForm() {
        var formData = new FormData($("#editservice_form")[0]);
                
                $("#icon-button").hide();
                $("#button-loader").show();
                $("#editservice-button").prop("disabled",true);
                $.ajax({
                    url: "<?php echo do_config(14);?>ajax/editservice-form",
                    data: formData,
                    type: "POST",
                    processData: false,
                    contentType: false,
                    success:function(data){
                        console.log(data);
                        $("#editservice-response").html(data);
                            window.setTimeout(function() {
                                window.location.reload();
                            }, 1500);
                        $('#editservice-button').removeAttr('disabled');
                        $("#button-loader").hide();
                        $("#icon-button").show();
                    },
                    complete: function (data) {
                    },
                    error:function (){}
                });
    }
    function editscriptForm() {
        var formData = new FormData($("#editscript_form")[0]);
                
                $("#icon-button").hide();
                $("#button-loader").show();
                $("#editscript-button").prop("disabled",true);
                $.ajax({
                    url: "<?php echo do_config(14);?>ajax/editscript-form",
                    data: formData,
                    type: "POST",
                    processData: false,
                    contentType: false,
                    success:function(data){
                        console.log(data);
                        $("#editscript-response").html(data);
                            window.setTimeout(function() {
                                window.location.reload();
                            }, 1500);
                        $('#editscript-button').removeAttr('disabled');
                        $("#button-loader").hide();
                        $("#icon-button").show();
                    },
                    complete: function (data) {
                    },
                    error:function (){}
                });
    }
    function edituserForm() {
        var formData = new FormData($("#edituser_form")[0]);
                
                $("#icon-button").hide();
                $("#button-loader").show();
                $("#edituser-button").prop("disabled",true);
                $.ajax({
                    url: "<?php echo do_config(14);?>ajax/edituser-form",
                    data: formData,
                    type: "POST",
                    processData: false,
                    contentType: false,
                    success:function(data){
                        console.log(data);
                        $("#edituser-response").html(data);
                            window.setTimeout(function() {
                                window.location.reload();
                            }, 1500);
                        $('#edituser-button').removeAttr('disabled');
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
    function convertBalanceForm() {
        var formData = new FormData($("#convertbal_form")[0]);
                
                $("#convertbal-icon-button").hide();
                $("#convertbal-button-loader").show();
                $("#convertbal-button").prop("disabled",true);
                $.ajax({
                    url: "<?php echo do_config(14);?>ajax/convertbalance-form",
                    data: formData,
                    type: "POST",
                    processData: false,
                    contentType: false,
                    success:function(data){
                        //console.log(data);
                        var result = $.trim(data);
                        if(result === "OK"){
                            $("#convertbal-response").html("<div class='alert alert-success'><i class='fa fa-check-circle'></i> Your balance was converted successfully.</div>");
                            window.setTimeout(function() {
                                window.location.reload();
                            }, 1300);
                        }else{
                            $("#convertbal-response").html(data);
                            $('#convertbal-button').removeAttr('disabled');
                            $("#convertbal-button-loader").hide();
                            $("#convertbal-icon-button").show();
                        }
                    },
                    complete: function (data) {
                    },
                    error:function (){}
                });
    }
    function withdrawalForm() {
           var formData = new FormData($("#withdrawal_form")[0]);
                
                $("#withdrawal-icon-button").hide();
                $("#withdrawal-button-loader").show();
                $("#withdrawal-button").prop("disabled",true);
                $.ajax({
                    url: "<?php echo do_config(14);?>ajax/withdrawal-form",
                    data: formData,
                    type: "POST",
                    processData: false,
                    contentType: false,
                    success:function(data){
                        //console.log(data);
                        var result = $.trim(data);
                        if(result === "OK"){
                            $("#withdrawal-response").html("<div class='alert alert-success'><i class='fa fa-check-circle'></i> Your withdrawal proccess started successfully.</div>");
                            window.setTimeout(function() {
                                window.location.reload();
                            }, 1300);
                        }else{
                            $("#withdrawal-response").html(data);
                            $('#withdrawal-button').removeAttr('disabled');
                            $("#withdrawal-button-loader").hide();
                            $("#withdrawal-icon-button").show();
                        }
                    },
                    complete: function (data) {
                    },
                    error:function (){}
                });
    }
    function faucetForm() {
        var formData = new FormData($("#faucet_form")[0]);
                
                $("#icon-button").hide();
                $("#button-loader").show();
                $("#faucet-button").prop("disabled",true);
                $.ajax({
                    url: "<?php echo do_config(14);?>ajax/faucet-form",
                    data: formData,
                    type: "POST",
                    processData: false,
                    contentType: false,
                    success:function(data){
                        console.log(data);
                        $("#faucet-response").html(data);
                        $('#faucet-button').removeAttr('disabled');
                        $("#button-loader").hide();
                        $("#icon-button").show();
                    },
                    complete: function (data) {
                    },
                    error:function (){}
                });
    }
</script>