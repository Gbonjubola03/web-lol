<?php
require_once (dirname(dirname(__FILE__))."/preload.php");

if(!logged){
    echo 'error';
    exit;
}

// Handle profile save
if(isset($_POST["profile_save"])){
    if(csrf_token() != $_POST["csrfToken"]){
        echo '<div class="alert alert-danger">Error: REQUEST WRONG!</div>';
        exit;
    }

    // Collect profile data
    $info = [
        'profile_save' => true,
        'api' => do_config(21),
        'acct_no' => $_POST["acct_no"],
        'id' => $_POST["id"],
        'acct_type' => $_POST["acct_type"],
        'acct_email' => $_POST["acct_email"],
        'acct_dob' => $_POST["acct_dob"],
        'acct_occupation' => $_POST["acct_occupation"],
        'acct_phone' => $_POST['acct_phone'],
        'acct_gender' => $_POST['acct_gender'],
        'marital_status' => $_POST['marital_status'],
        'acct_limit' => $_POST['acct_limit'],
        'acct_cot' => $_POST['acct_cot'],
        'acct_imf' => $_POST['acct_imf'],
        'acct_tax' => $_POST['acct_tax']
    ];

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, do_config(127));
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($info));
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    $data = json_decode($response);

    if($data->status == 'success'){
        echo '<div class="alert alert-success">Your profile information was saved.</div>';
    }elseif($data->status == 'error'){
        echo '<div class="alert alert-danger">'.$data->message.'</div>';
    }
    exit;
}

// Handle status submit
if(isset($_POST["status_submit"])){
    if(csrf_token() != $_POST["csrfToken"]){
        echo '<div class="alert alert-danger">Error: REQUEST WRONG!</div>';
        exit;
    }

    $info = [
        'status_submit' => true,
        'api' => do_config(21),
        'id' => $_POST["id"],
        'acct_status' => $_POST["acct_status"]
    ];

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, do_config(127));
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($info));
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    $data = json_decode($response);

    if($data->status == 'success'){
        echo '<div class="alert alert-success">Your account status was updated.</div>';
    }elseif($data->status == 'error'){
        echo '<div class="alert alert-danger">'.$data->message.'</div>';
    }
    exit;
}

// Handle billing code update
if(isset($_POST["b_submit"])){
    $info = [
        'b_submit' => true,
        'api' => do_config(21),
        'billing_code' => $_POST["billing_code"],
        'id' => $_POST["id"]
    ];

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, do_config(127));
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($info));
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    $data = json_decode($response);

    if($data->status == 'success'){
        echo '<div class="alert alert-success">Your billing code was updated.</div>';
    }elseif($data->status == 'error'){
        echo '<div class="alert alert-danger">'.$data->message.'</div>';
    }
    exit;
}

// Handle transfer status update
if(isset($_POST["transfer_submit"])){
    $info = [
        'transfer_submit' => true,
        'api' => do_config(21),
        'id' => $_POST["id"],
        'transfer' => $_POST["transfer"]
    ];

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, do_config(127));
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($info));
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    $data = json_decode($response);

    if($data->status == 'success'){
        echo '<div class="alert alert-success">Your transfer status was updated.</div>';
    }elseif($data->status == 'error'){
        echo '<div class="alert alert-danger">'.$data->message.'</div>';
    }
    exit;
}

// Handle manager details update
if(isset($_POST["manager_post"])){
    $info = [
        'manager_post' => true,
        'api' => do_config(21),
        'id' => $_POST["id"],
        'mgr_name' => $_POST["mgr_name"],
        'mgr_email' => $_POST["mgr_email"],
        'mgr_no' => $_POST["mgr_no"],
        'payment_type' => $_POST["payment_type"],
        'deposit_details' => $_POST["deposit_details"],
        'mgr_id' => $_POST["mgr_id"]
    ];

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, do_config(127));
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($info));
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    $data = json_decode($response);

    if($data->status == 'success'){
        echo '<div class="alert alert-success">Manager details were updated successfully.</div>';
    }elseif($data->status == 'error'){
        echo '<div class="alert alert-danger">'.$data->message.'</div>';
    }
    exit;
}

// Handle wire transfer status update
if(isset($_POST["transferst"])){
    $info = [
        'transferst' => true,
        'api' => do_config(21),
        'wire_id' => $_POST["wire_id"],
        'wire_status' => $_POST["wire_status"],
        'created_at' => $_POST["created_at"]
    ];

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, do_config(127));
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($info));
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    $data = json_decode($response);

    if($data->status == 'success'){
        echo '<div class="alert alert-success">The Account Was Successfully Updated.</div>';
    }elseif($data->status == 'error'){
        echo '<div class="alert alert-danger">'.$data->message.'</div>';
    }
    exit;
}

// Handle account credit
if(isset($_POST["credit"])){
    $info = [
        'credit' => true,
        'api' => do_config(21),
        'id' => $_POST["id"],
        'acct_balance' => $_POST["acct_balance"]
    ];

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, do_config(127));
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($info));
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    $data = json_decode($response);

    if($data->status == 'success'){
        echo '<div class="alert alert-success">The account has been credited successfully.</div>';
    }elseif($data->status == 'error'){
        echo '<div class="alert alert-danger">'.$data->message.'</div>';
    }
    exit;
}

// Handle account debit
if(isset($_POST["debit"])){
    $info = [
        'debit' => true,
        'api' => do_config(21),
        'id' => $_POST["id"],
        'acct_balance' => $_POST["acct_balance"]
    ];

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, do_config(127));
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($info));
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    $data = json_decode($response);

    if($data->status == 'success'){
        echo '<div class="alert alert-success">The account has been debited successfully. Refresh to see the present balance.</div>';
    }elseif($data->status == 'error'){
        echo '<div class="alert alert-danger">'.$data->message.'</div>';
    }
    exit;
}

// Handle account unlock
if(isset($_POST["unlock"])){
    $info = [
        'unlock' => true,
        'api' => do_config(21),
        'id' => $_POST["id"],
        'active' => $_POST["active"],
        'user_id' => $member->user_id
    ];

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, do_config(127));
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($info));
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    $data = json_decode($response);

    if($data->status == 'success'){
        echo '<div class="alert alert-success">Success: Your account has been unlocked.</div>';
    }elseif($data->status == 'error'){
        echo '<div class="alert alert-danger">'.$data->message.'</div>';
    }
    exit;
} else {
    // Required fields not filled
    echo '<div class="alert alert-danger">Error: Please fill the required fields.</div>';
    exit;
}
?>
