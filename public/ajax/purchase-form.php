<?php
require_once (dirname(dirname(__FILE__))."/preload.php");

if(!logged){
    echo 'error';
    exit;
}

if(isset($_POST["purchase"])){
    $service_id = $_POST["service_id"];
    
    if(empty(str_replace(' ', '', trim($service_id)))){
        echo '<div class="alert alert-danger">Error: Please fill the required fields</div>';
        exit;
    }
    
    $info = [
        'purchase' => true,
        'user_id' => $member->user_id,
        'service_id' => $service_id,
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
    
    if($data->status == 'success'){
       
        if(isset($data->product_info)) {
            $user_id = $member->user_id;
            $seller_id = $data->product_info->seller_id;
            $no_title = $data->product_info->order_title;
            
           
            $orderMessage = '
            <div style="font-family: Arial, sans-serif; padding: 15px; background-color: #f7f7f7; border-radius: 8px; margin-bottom: 20px;">
                <h2 style="color: #2c3e50; margin-top: 0; border-bottom: 2px solid #3498db; padding-bottom: 10px;">NEW ORDER NOTIFICATION</h2>
                
                <p style="font-size: 16px; color: #333; margin-bottom: 15px;">
                    You have received a new order from <strong style="color: #3498db;">' . ($data->product_info->buyer_username ?? 'Customer') . '</strong>
                </p>
                
                <div style="background-color: #fff; padding: 15px; border-left: 4px solid #3498db; margin-bottom: 15px;">
                    <h3 style="color: #2c3e50; margin-top: 0;">Order Details:</h3>
                    <p style="margin: 5px 0;"><strong>Product:</strong> ' . ($data->product_info->product_name ?? 'Product') . '</p>
                </div>
                
                <div style="background-color: #fff; padding: 15px; border-left: 4px solid #27ae60; margin-bottom: 15px;">
                    <h3 style="color: #2c3e50; margin-top: 0;">Buyer Contact Information:</h3>
                    <p style="margin: 5px 0;"><strong>Name:</strong> ' . ($data->product_info->buyer_username ?? 'N/A') . '</p>
                    ' . (isset($data->product_info->buyer_phone) ? '<p style="margin: 5px 0;"><strong>Phone:</strong> <a href="tel:' . $data->product_info->buyer_phone . '" style="color: #3498db; text-decoration: none;">' . $data->product_info->buyer_phone . '</a></p>' : '') . '
                    ' . (isset($data->product_info->buyer_whatsapp) ? '<p style="margin: 5px 0;"><strong>WhatsApp:</strong> <a href="https://wa.me/' . preg_replace('/[^0-9]/', '', $data->product_info->buyer_whatsapp) . '" style="color: #25d366; text-decoration: none;" target="_blank">' . $data->product_info->buyer_whatsapp . '</a></p>' : '') . '
                </div>
                
                <div style="background-color: #fff; padding: 15px; border-left: 4px solid #e74c3c; margin-bottom: 15px;">
                    <h3 style="color: #2c3e50; margin-top: 0;">Action Required:</h3>
                    <p style="margin: 5px 0;">Please login to your account to deliver this order as soon as possible.</p>
                </div>
                
                <div style="text-align: center; margin-top: 20px;">
                    <a href="https://'.$_SERVER['HTTP_HOST'].'/signin" style="background-color: #3498db; color: white; padding: 12px 25px; text-decoration: none; border-radius: 4px; font-weight: bold; display: inline-block;">LOGIN TO YOUR ACCOUNT</a>
                </div>
            </div>
            ';
            
            $array = [
                'm_user' => $data->product_info->seller_username ?? '',
                'm_subject' => $no_title ?? '',
                'm_comment' => $orderMessage,
            ];
            
            do_maildata('message', $array);
            
            $mailer = mailer([
                'from' => do_config(32),
                'to' => $data->product_info->seller_email ?? '',
                'subject' => $no_title ?? '',
                'msg' => fetch('/public/mail/template.php')
            ]);
        }
        
        // Return "OK" to match the expected value in the JavaScript
        echo "OK";
        exit;
    }elseif($data->status == 'error'){
        echo '<div class="alert alert-danger">'.$data->message.'</div>';
        exit;
    }
}else{
    echo '<div class="alert alert-danger">Error: Please fill the required fields</div>';
    exit;
}
?>
