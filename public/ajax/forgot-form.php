<?php
require_once (dirname(dirname(__FILE__))."/preload.php");

if(logged){
    echo 'error';
    exit;
}

if(isset($_POST['forgot'])){
    $username = $_POST["username"];
    
    // Make API call to handle the forgot password request
    $info = [
        'forgot' => true,
        'username' => $username,
        'api' => do_config(21)
    ];
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, do_config(127));
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($info));
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    $data = json_decode($response);
    
    if($data && isset($data->status) && $data->status == 'success'){
        // Get user info from the API response
        if(isset($data->user_info)) {
            // Prepare the password reset email
            $resetEmailContent = '
            <div style="font-family: Arial, sans-serif; padding: 15px; background-color: #f7f7f7; border-radius: 8px; margin-bottom: 20px;">
                <h2 style="color: #2c3e50; margin-top: 0; border-bottom: 2px solid #3498db; padding-bottom: 10px;">PASSWORD RESET REQUEST</h2>
                
                <p style="font-size: 16px; color: #333; margin-bottom: 15px;">
                    Hello <strong style="color: #3498db;">' . ($data->user_info->username ?? 'User') . '</strong>,
                </p>
                
                <div style="background-color: #fff; padding: 15px; border-left: 4px solid #3498db; margin-bottom: 15px;">
                    <h3 style="color: #2c3e50; margin-top: 0;">Password Reset Information:</h3>
                    <p style="margin: 5px 0;">We received a request to reset your password. If you did not make this request, please ignore this email.</p>
                </div>
                
                <div style="background-color: #fff; padding: 15px; border-left: 4px solid #e74c3c; margin-bottom: 15px;">
                    <h3 style="color: #2c3e50; margin-top: 0;">Your Reset Token:</h3>
                    <p style="margin: 5px 0; font-size: 18px; font-weight: bold; letter-spacing: 2px; color: #e74c3c;">' . ($data->user_info->token ?? '') . '</p>
                </div>
                
                <div style="text-align: center; margin-top: 20px;">
                    <a href="' . ($data->user_info->reset_link ?? 'https://'.$_SERVER['HTTP_HOST'].'/reset-password') . '" style="background-color: #3498db; color: white; padding: 12px 25px; text-decoration: none; border-radius: 4px; font-weight: bold; display: inline-block;">RESET YOUR PASSWORD</a>
                </div>
                
                <div style="margin-top: 20px; font-size: 14px; color: #7f8c8d; text-align: center;">
                    <p>If the button doesn\'t work, copy and paste this link into your browser:</p>
                    <p style="word-break: break-all;">' . ($data->user_info->reset_link ?? 'https://'.$_SERVER['HTTP_HOST'].'/reset-password?id=' . ($data->user_info->token ?? '')) . '</p>
                </div>
                
                <div style="margin-top: 20px; padding-top: 20px; border-top: 1px solid #e5e7eb; font-size: 14px; color: #7f8c8d; text-align: center;">
                    <p>This link will expire in 24 hours. If you need assistance, please contact support.</p>
                </div>
            </div>
            ';
            
            // Prepare email data
            $array = [
                'm_user' => $data->user_info->username ?? '',
                'm_subject' => "RECOVER YOUR PASSWORD AT " . do_config(1),
                'm_email' => $data->user_info->email ?? '',
                'm_token' => $data->user_info->token ?? '',
                'm_comment' => $resetEmailContent,
            ];
            
            do_maildata('recover', $array);
            
            // Send email using local mailer function
            $mailer = mailer([
                'from' => do_config(32),
                'to' => $data->user_info->email ?? '',
                'subject' => "RECOVER YOUR PASSWORD AT " . do_config(1),
                'msg' => fetch('/public/mail/template.php')
            ]);
        }
        
        // Return "OK" to match the expected value in the JavaScript
        echo "OK";
        exit;
    } elseif(isset($data->status) && $data->status == 'error') {
        echo '<div class="alert alert-danger">' . ($data->message ?? 'An error occurred') . '</div>';
        exit;
    } else {
        echo '<div class="alert alert-danger">Error: Connection problem. Please try again later.</div>';
        exit;
    }
} else {
    echo '<div class="alert alert-danger">Error: Please fill the required fields</div>';
    exit;
}
?>
