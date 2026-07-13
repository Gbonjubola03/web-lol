<?php require_once (dirname(dirname(__FILE__)).'/preload.php'); ?>
<?php require_once 'header.php';?>
<?php

  if (!isset($_GET["id"])) {
    echo '<div class="alert alert-danger">Error: Something went wrong, Please try again.</div>';
    exit;
  }
  
  $account = fetch_account($_GET["id"]) ?: $_SESSION['user']['account'];
  if (!is_object($account)) {
    echo '<div class="alert alert-danger">Error: Something went wrong, Please try again.</div>';
    exit;
  }
  // At the beginning of your PHP file
error_log("POST data: " . print_r($_POST, true));

// Handle account unlock
if (isset($_POST["unlock"])) {
    error_log("Unlock form submitted with data: " . print_r($_POST, true));
    
    // Rest of your code...
}
?>
<?php do_winfo('EDIT CLIENT ACCOUNT'); ?>
<?php define('eu_active','users'); ?>
   <title><?php echo SITE_TITLE.' '.do_config(8).' '.do_config(1); ?></title>
    <!-- BREADCRUMB -->
    <nav class="bg-dark d-md-none">
      <div class="container-md">
        <div class="row align-items-center">
          <div class="col">
          </div>
          <div class="col-auto">
           
          </div>
        </div> <!-- / .row -->
      </div> <!-- / .container -->
    </nav>
  
    <div class="col-12 col-md-9">
    <!-- Card -->
    <h4 class="card-header"> EDIT CLIENT ACCOUNT #<?php echo $_GET["id"]; ?></h4>
    <div class="card-body">
        <div class="res">
            <div class="col-md-12">
               
                
                <style>
                    body {
                        font-family: Arial, sans-serif;
                        background-color: #f8f9fa;
                        margin: 0;
                        padding: 20px;
                    }

                    .card-header {
                        background-color: #007bff;
                        color: white;
                        padding: 15px;
                        border-radius: 5px;
                        margin-bottom: 20px;
                    }

                    .table {
                        width: 100%;
                        margin-bottom: 1rem;
                        color: #212529;
                        border-collapse: collapse;
                    }

                    .table th, .table td {
                        padding: 12px;
                        vertical-align: top;
                        border: 1px solid #dee2e6;
                    }

                    .table th {
                        background-color: #007bff;
                        color: white;
                    }

                    .form-control {
                        width: 100%;
                        padding: 10px;
                        border: 1px solid #ced4da;
                        border-radius: 4px;
                        margin-bottom: 10px;
                    }

                    .btn {
                        background-color: #007bff;
                        color: white;
                        padding: 10px 15px;
                        border: none;
                        border-radius: 5px;
                        cursor: pointer;
                    }

                    .btn:hover {
                        background-color: #0056b3;
                    }

                    .alert {
                        padding: 15px;
                        margin-bottom: 20px;
                        border: 1px solid transparent;
                        border-radius: 5px;
                    }

                    .alert-danger {
                        color: #721c24;
                        background-color: #f8d7da;
                        border-color: #f5c6cb;
                    }

                    .section-header h1 {
                        font-size: 24px;
                        margin-bottom: 20px;
                    }
                </style>

                <!--  BEGIN CONTENT AREA  -->
                <div id="content" class="main-content">
                    <div class="layout-px-spacing">
                        <div class="account-tbl_settings-container layout-top-spacing">

                            <div class="account-content">
                                <div class="scrollspy-example" data-spy="scroll" data-target="#account-tbl_settings-scroll" data-offset="-100">
                                    <div class="row">
                                        <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">
                                        <form id="udetails_form" autocomplete="off" method="post">
                                    <input type="hidden" name="profile_save" value="profile_save" />
                                    <input type="hidden" name="csrfToken" value="<?php echo csrf_token(); ?>"/>
                                    <input type="hidden" name="id" value="<?php echo $account->id;?>"/>
                                    <input autocomplete="false" name="hidden" type="text" style="display:none;">
                                                <div class="info">
                                                    <h6 class="">General Information</h6>
                                                    <div class="form-group row">
                                                    <?php if ($account->active == 1) { ?>
                                                <div class="col-xl-10 col-lg-12 col-md-8 mt-md-0 mt-4">
                                                    <div class="form">
                                                        <div class="row">
                                                            <div class="col-sm-6">
                                                                <div class="form-group">
                                                                    <label for="fullName">Account No</label>
                                                                    <input type="text" class="form-control mb-4" placeholder="Account number" value="<?php echo $account->acct_no;?>" name="acct_no" >
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <div class="form-group">
                                                                    <label for="profession">Account Type</label>
                                                                    <div class="input-group">
                                                                        <select name="acct_type" class="form-control basic" required>
                                                                            <option value="<?php echo $account->acct_type;?>"><?php echo $account->acct_type;?></option>
                                                                            <option value="Savings">Savings Account</option>
                                                                            <option value="Current">Current Account</option>
                                                                            <option value="Checking">Checking Account</option>
                                                                            <option value="Fixed Deposit">Fixed Deposit</option>
                                                                            <option value="Non Resident">Non Resident Account</option>
                                                                            <option value="Online Banking">Online Banking</option>
                                                                            <option value="Domicilary Account">Domicilary Account</option>
                                                                            <option value="Joint Account">Joint Account</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-sm-6">
                                                                <div class="form-group">
                                                                    <label for="fullName">Email</label>
                                                                    <input type="text" class="form-control mb-4" id="fullName" placeholder="Full Name" value="<?php echo $account->acct_email; ?>" name="acct_email">
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <div class="form-group">
                                                                    <label for="profession">Date Of Birth</label>
                                                                    <input type="date" class="form-control mb-4" id="profession" placeholder="Date Of Birth" value="<?php echo $account->acct_dob; ?>" name="acct_dob">
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="res">
                                                            <div class="col-sm-6">
                                                                <div class="form-group">
                                                                    <label for="fullName">Occupation</label>
                                                                    <input type="text" class="form-control mb-4" placeholder="Occupation" value="<?php echo $account->acct_occupation; ?>" name="acct_occupation">
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <div class="form-group">
                                                                    <label for="profession">Phone Number</label>
                                                                    <input type="text" class="form-control mb-4" placeholder="Phone Number" value="<?php echo $account->acct_phone; ?>" name="acct_phone">
                                                                </div>
                                                            </div>
                                                        </div>
                                                       
                                                        <div class="row">
                                                            <div class="col-sm-6">
                                                                <div class="form-group">
                                                                    <label for="fullName">COT code</label>
                                                                    <input type="text" class="form-control mb-4" placeholder="Occupation" value="<?php echo $account->acct_cot; ?>" name="acct_cot">
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <div class="form-group">
                                                                    <label for="profession">IMF code</label>
                                                                    <input type="text" class="form-control mb-4" placeholder="IMF code" value="<?php echo $account->acct_imf; ?>" name="acct_imf">
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-sm-6">
                                                                <div class="form-group">
                                                                    <label for="fullName">Gender</label>
                                                                    <select name="acct_gender" class="form-control basic" id="">
                                                                        <option value="<?php echo $account->acct_gender; ?>"><?php echo $account->acct_gender; ?></option>
                                                                        <option value="male">Male</option>
                                                                        <option value="female">Female</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <div class="form-group">
                                                                    <label for="profession">Marital Status</label>
                                                                    <input type="text" class="form-control mb-4 text-capitalize" id="profession" placeholder="Marital Status" value="<?php echo $account->marital_status; ?>" name="marital_status">
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="row">
                                                                    <div class="col-md-4">
                                                                        <label for="profession">Account Balance</label><br>
                                                                        <button class="btn btn-danger disabled col-md-12"><?php echo $account->acct_balance; ?></button>
                                                                    </div>
                                                                    <div class="col-md-8">
                                                                        <div class="form-group">
                                                                            <label for="profession">Account Transfer Limit</label>
                                                                            <input type="text" class="form-control mb-4" name="acct_limit" placeholder="<?php echo $account->acct_limit; ?>" value="<?php echo $account->acct_limit; ?>">
                                                                            <input type="text" name="acct_balance" hidden value="<?php echo $account->acct_balance; ?>">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="profession">TAX code</label>
                                                                    <input type="text" class="form-control mb-4" value="<?php echo $account->acct_tax; ?>" name="acct_tax">
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <p for="profession">remember otp do change always refresh your app to get new ones</p>
                                                                <label for="profession">OTP CODE</label>
                                                                <input type="text" class="form-control mb-4" value="<?php echo $account->acct_otp; ?>" disabled>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="profession">pin</label>
                                                
                                                                <input type="text" class="form-control mb-4" value="<?php echo $account->acct_pin; ?>" disabled>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="profession">ssn or tin tax</label>
                                                                <input type="text" class="form-control mb-4" value="<?php echo $account->ssn; ?>" disabled>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- ALERTS RESPONSE HERE-->
                                            <span id="udetails-response"></span>
                                            <!-- ALERTS RESPONSE END HERE -->
                                            <div class="col-md-12">
                                                <button type="submit" onclick="udetailsForm();" id="udetails-button" class="btn w-100 btn-primary">
                                                    <span id="icon-button"><i class="fa fa-plus-circle"></i></span>
                                                    <span id="button-loader" style="display:none;">
                                                        <i class="fa fa-spinner fa-spin"></i>
                                                    </span>
                                                    SAVE
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">
                        <form id="status_form" autocomplete="off" method="post">
                            <input type="hidden" name="status_submit" value="status_submit" />
                            <input type="hidden" name="csrfToken" value="<?php echo csrf_token(); ?>"/>
                            <input type="hidden" name="id" value="<?php echo $account->id;?>"/>
                            <input autocomplete="false" name="hidden" type="text" style="display:none;">
                            <div class="info">
                                <h5 class="">ACTIVE / HOLD & BILLING CODE</h5>
                                <div class="row">
                                    <div class="col-md-4 mx-auto">
                                        <div class="form-group">
                                            <button class="btn btn-danger mb-4 disabled">CURRENT STATUS: <b><?php echo ucwords($account->acct_status); ?></b></button><br>
                                            <label for="">SELECT TYPE IF HOLD OR ACTIVE</label>
                                            <select name="acct_status" id="" class="form-control basic">
                                                <option value="">Select</option>
                                                <option value="active">ACTIVE</option>
                                                <option value="hold">HOLD</option>
                                            </select>
                                        </div>
                                        <!-- ALERTS RESPONSE HERE-->
                                        <span id="status-response"></span>
                                        <!-- ALERTS RESPONSE END HERE -->
                                        <div class="text-center mb-3">
                                            <button type="submit" onclick="statusForm();" id="status-button" class="btn w-100 btn-primary">
                                                <span id="icon-button"><i class="fa fa-plus-circle"></i></span>
                                                <span id="button-loader" style="display:none;">
                                                    <i class="fa fa-spinner fa-spin"></i>
                                                </span>
                                                SUBMIT
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    
                    <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">
                        <div class="col-md-4 mx-auto">
                            <div class="form-group">
                                <form id="billing_form" autocomplete="off" method="post">
                                    <input type="hidden" name="b_submit" value="b_submit" />
                                    <input type="hidden" name="id" value="<?php echo $account->id; ?>"/>
                                    <input autocomplete="false" name="hidden" type="text" style="display:none;">

                                    <button class="btn btn-danger mb-4 disabled">BILLING CODE STATUS: <b><?php echo ucwords($account->billing_code); ?></b></button><br>
                                    <label for="billing_code">SELECT BILLING CODE</label>
                                    <select class="form-control" name="billing_code">
                                        <option value="1" <?php echo ($account->billing_code == '1') ? 'selected' : ''; ?>>active</option>
                                        <option value="0" <?php echo ($account->billing_code == '0') ? 'selected' : ''; ?>>deactivate</option>
                                    </select>
                            </div>
                            
                            <!-- ALERTS RESPONSE HERE -->
                            <span id="billing-response"></span>
                            <!-- ALERTS RESPONSE END HERE -->

                            <div class="text-center">
                                <button type="button" onclick="billingForm();" id="billing-button" class="btn w-100 btn-primary">
                                    <span id="icon-button"><i class="fa fa-plus-circle"></i></span>
                                    <span id="button-loader" style="display:none;">
                                        <i class="fa fa-spinner fa-spin"></i>
                                    </span>
                                    UPDATE BILLING CODE
                                </button>
                            </div>
                            </form>
                        </div>
                    </div>

                    <div class="col-md-4 mx-auto">
                        <form id="transfer_form" autocomplete="off" method="post">
                            <input type="hidden" name="transfer_submit" value="transfer_submit" />
                            <input type="hidden" name="csrfToken" value="<?php echo csrf_token(); ?>"/>
                            <input type="hidden" name="id" value="<?php echo $account->id;?>"/>
                            <div class="form-group">
                                <button class="btn btn-danger mb-4 disabled">TRANSFER CODE STATUS: <b><?php echo ucwords($account->transfer); ?></b></button><br>
                                <label for="">SELECT TRANSFER STATUS</label>
                                <select name="transfer" class="form-control basic">
                                    <option value="<?php echo $account->transfer; ?>">Select</option>
                                    <option value="1">ACTIVE</option>
                                    <option value="0">DEACTIVATE</option>
                                </select>
                            </div>
                            <!-- ALERTS RESPONSE HERE -->
                            <span id="transfer-response"></span>
                            <!-- ALERTS RESPONSE END HERE -->
                            <div class="text-center">
                                <button type="button" onclick="transferForm();" id="transfer-button" class="btn w-100 btn-primary">
                                    <span id="icon-button"><i class="fa fa-plus-circle"></i></span>
                                    <span id="button-loader" style="display:none;">
                                        <i class="fa fa-spinner fa-spin"></i>
                                    </span>
                                    UPDATE Transfer
                                </button>
                            </div>
                        </form>
                    </div>

                    <br>
                    <div class="account-content">
                        <div class="scrollspy-example" data-spy="scroll" data-target="#account-tbl_settings-scroll" data-offset="-100">
                            <div class="row">
                                <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">
                                    <form id="manager_form" autocomplete="off" method="post">
                                        <input type="hidden" name="manager_post" value="manager_post" />
                                        <input type="hidden" name="csrfToken" value="<?php echo csrf_token(); ?>"/>
                                        <input type="hidden" name="id" value="<?php echo $account->id;?>"/>
                                        <input autocomplete="false" name="hidden" type="text" style="display:none;">
                                        <div class="info">
                                            <h6 class="">Manager and Deposit details like bank or balance</h6>
                                            <div class="form-group row">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label for="fullName">Manager Name</label>
                                                        <input type="text" class="form-control mb-4" id="fullName" placeholder="Full Name" value="<?php echo $account->mgr_name; ?>" name="mgr_name">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label for="fullName">Manager Email</label>
                                                        <input type="text" class="form-control mb-4" id="fullName" placeholder="Manager Email" value="<?php echo $account->mgr_email; ?>" name="mgr_email">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label for="profession">Manager phone Number</label>
                                                        <input type="text" class="form-control mb-4" id="profession" placeholder="Manager phone Number" value="<?php echo $account->mgr_no; ?>" name="mgr_no">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="res">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label for="fullName">payment type</label>
                                                        <input type="text" class="form-control mb-4" placeholder="payment type" value="<?php echo $account->payment_type; ?>" name="payment_type">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label for="profession">Account details</label>
                                                        <input type="text" class="form-control mb-4" placeholder="Account details" value="<?php echo $account->deposit_details; ?>" name="deposit_details">
                                                    </div>
                                                </div>
                                            </div>
                                                       
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <p>put any id</p>
                                                        <label for="Manager id">manager id</label>
                                                        <input type="text" class="form-control mb-4" placeholder="manager id" value="<?php echo $account->mgr_id; ?>" name="mgr_id">
                                                    </div>
                                                    <!-- ALERTS RESPONSE HERE -->
                                                    <span id="manager-response"></span>
                                                    <!-- ALERTS RESPONSE END HERE -->
                                                    <div class="text-center">
                                                        <button type="button" onclick="managerForm();" id="manager-button" class="btn w-100 btn-primary">
                                                            <span id="icon-button"><i class="fa fa-plus-circle"></i></span>
                                                            <span id="button-loader" style="display:none;">
                                                                <i class="fa fa-spinner fa-spin"></i>
                                                            </span>
                                                            UPDATE
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <br><br>

                            <h4 class="card-header"> CREDIT CLIENT ACCOUNT</h4>
                            <!--  BEGIN CONTENT AREA  -->
                            <div id="content" class="main-content">
                                <div class="layout-px-spacing">
                                    <div class="row layout-top-spacing">
                                        <div id="basic" class="col-lg-12 layout-spacing">
                                            <div class="statbox widget box box-shadow">
                                                <div class="widget-header">
                                                    <div class="row">
                                                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                                            <h4>Credit Users</h4>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="widget-content widget-content-area">
                                                    <div class="row">
                                                        <div class="col-lg-10 col-12 mx-auto">
                                                            <div class="col-md-6">
                                                                <div class="form-group mb-4">
                                                                    <form id="credit_form" autocomplete="off" method="post">
                                                                        <input type="hidden" name="credit" value="credit" />
                                                                        <input type="hidden" name="csrfToken" value="<?php echo csrf_token(); ?>"/>
                                                                        <input type="hidden" name="id" value="<?php echo $account->id;?>"/>
                                                                        <input autocomplete="false" name="hidden" type="text" style="display:none;">
                                                                        <div class="row">
                                                                            <div class="col-md-6">
                                                                                <div class="form-group mb-4">
                                                                                    <label for="">Amount</label>
                                                                                    <input value="" type="number" name="acct_balance" class="form-control" id="acct_balance" placeholder="amount" required>
                                                                                </div>
                                                                            </div>

                                                                            <!-- ALERTS RESPONSE HERE-->
                                                                            <span id="credit-response"></span>
                                                                            <!-- ALERTS RESPONSE END HERE -->
                                                                            <div class="row">
                                                                                <div class="col-md-12">
                                                                                    <button type="submit" onclick="creditForm();" id="credit-button" class="btn w-100 btn-primary">
                                                                                        <span id="icon-button"><i class="fa fa-plus-circle"></i></span>
                                                                                        <span id="button-loader" style="display:none;">
                                                                                            <i class="fa fa-spinner fa-spin"></i>
                                                                                        </span>
                                                                                        CREDIT CLIENT
                                                                                    </button>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <br><br>

                                        <h4 class="card-header"> DEBIT CLIENT ACCOUNT</h4>
                                        <div class="layout-px-spacing">
                                            <div class="row layout-top-spacing">
                                                <div id="basic" class="col-lg-12 layout-spacing">
                                                    <div class="statbox widget box box-shadow">
                                                        <div class="widget-header">
                                                            <div class="row">
                                                                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                                                    <h4>debit Users</h4>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="widget-content widget-content-area">
                                                            <div class="row">
                                                                <div class="col-lg-10 col-12 mx-auto">
                                                                    <div class="col-md-6">
                                                                        <div class="form-group mb-4">
                                                                            <form id="debit_form" autocomplete="off" method="post">
                                                                                <input type="hidden" name="debit" value="debit" />
                                                                                <input type="hidden" name="csrfToken" value="<?php echo csrf_token(); ?>"/>
                                                                                <input type="hidden" name="id" value="<?php echo $account->id;?>"/>
                                                                                <input autocomplete="false" name="hidden" type="text" style="display:none;">
                                                                                <div class="col-md-6">
                                                                                    <div class="form-group mb-4">
                                                                                        <label for="">Amount</label>
                                                                                        <input value="" type="number" name="acct_balance" class="form-control" id="acct_balance" placeholder="amount" required>
                                                                                    </div>
                                                                                </div>

                                                                                <!-- ALERTS RESPONSE HERE-->
                                                                                <span id="debit-response"></span>
                                                                                <!-- ALERTS RESPONSE END HERE -->
                                                                                <div class="row">
                                                                                    <div class="col-md-12">
                                                                                        <button type="submit" onclick="debitForm();" id="debit-button" class="btn w-100 btn-primary">
                                                                                            <span id="icon-button"><i class="fa fa-plus-circle"></i></span>
                                                                                            <span id="button-loader" style="display:none;">
                                                                                                <i class="fa fa-spinner fa-spin"></i>
                                                                                            </span>
                                                                                            DEBIT CLIENT
                                                                                        </button>
                                                                                    </div>
                                                                                </div>
                                                                            </form>
                                                                            <?php } else { ?>
    <!-- Show a message when account is not active -->
    <div class="col-xl-10 col-lg-12 col-md-8 mt-md-0 mt-4">
        <div class="alert alert-warning">
            <p>Account details are not available until the account is activated.</p>
            <p>Please activate the account to view and edit details.</p>
        </div>
    </div>
<?php } 

?>
                                                                        
                        </div><?php if ($account->active == 0) { ?>
    <div class="col-md-12">
        <div class="form-group">
        <form id="unlock_form" autocomplete="off" method="post">
    <input type="hidden" name="unlock" value="unlock" />
    <input type="hidden" name="csrfToken" value="<?php echo csrf_token(); ?>"/>
    <input type="hidden" name="id" value="<?php echo $account->id;?>"/>
    <input type="hidden" name="user_id" value="<?php echo isset($_SESSION['user']) && isset($_SESSION['user']['id']) ? $_SESSION['user']['id'] : $account->user_id; ?>"/>
    <input type="hidden" value="1" name="active" class="form-control" required>
    
    <div class="alert alert-success text-center">
        <b><?php echo do_amount(do_config(123)); ?> (<?php echo do_rate(do_config(123));?>$)</b>
    </div>
    
    <hr>
    <h6>make payment to activate account</h6>
    
    <!-- ALERTS RESPONSE HERE-->
    <span id="unlock-response"></span>
    <!-- ALERTS RESPONSE END HERE -->
    
    <div class="col-12 col-md-auto">
        <!-- Button -->
        <button type="button" onclick="unlockForm();" id="unlock-button" class="btn w-100 btn-primary">
            <span id="icon-button"><i class="fa fa-plus-circle"></i></span>
            <span id="button-loader" style="display:none;">
                <i class="fa fa-spinner fa-spin"></i>
            </span>
            PAY NOW
        </button>
    </div>
</form>




        </div>
    </div>
<?php } ?>

</section>
</div>
</div>

<?php require_once 'ajax.js.php';?>
<?php require_once 'footer.php';?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

