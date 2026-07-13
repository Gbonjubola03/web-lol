<?php
require_once (dirname(dirname(__FILE__)).'/preload.php');
global $mail_data; // Access the global mail_data array
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="color-scheme" content="light">
    <meta name="supported-color-schemes" content="light">
    <title><?php echo $mail_data['m_subject'] ?? 'Notification'; ?></title>
    <style type="text/css">
        /* CLIENT-SPECIFIC STYLES */
        body, table, td, a { -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; }
        table, td { mso-table-lspace: 0pt; mso-table-rspace: 0pt; }
        img { -ms-interpolation-mode: bicubic; }
        /* RESET STYLES */
        img { border: 0; height: auto; line-height: 100%; outline: none; text-decoration: none; }
        table { border-collapse: collapse !important; }
        body { height: 100% !important; margin: 0 !important; padding: 0 !important; width: 100% !important; }
        /* iOS BLUE LINKS */
        a[x-apple-data-detectors] {
            color: inherit !important;
            text-decoration: none !important;
            font-size: inherit !important;
            font-family: inherit !important;
            font-weight: inherit !important;
            line-height: inherit !important;
        }
        /* GMAIL BLUE LINKS */
        u + #body a {
            color: inherit;
            text-decoration: none;
            font-size: inherit;
            font-family: inherit;
            font-weight: inherit;
            line-height: inherit;
        }
        /* SAMSUNG MAIL BLUE LINKS */
        #MessageViewBody a {
            color: inherit;
            text-decoration: none;
            font-size: inherit;
            font-family: inherit;
            font-weight: inherit;
            line-height: inherit;
        }
        /* Universal styles */
        body {
            background-color: #f4f4f4;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            -webkit-font-smoothing: antialiased;
            font-size: 16px;
            line-height: 1.6;
            margin: 0;
            padding: 0;
            -ms-text-size-adjust: 100%;
            -webkit-text-size-adjust: 100%;
        }
        /* Main container */
        .email-container {
            max-width: 600px;
            margin: 0 auto;
        }
        /* Content styling */
        .content-block {
            padding: 30px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
        /* Button styling */
        .button {
            background-color: #3498db;
            border-radius: 4px;
            color: #ffffff;
            display: inline-block;
            font-size: 16px;
            font-weight: bold;
            line-height: 1.2;
            padding: 12px 30px;
            text-decoration: none;
            text-align: center;
            margin: 20px 0;
            -webkit-text-size-adjust: none;
            mso-hide: all;
        }
        /* Hover effect for modern clients */
        .button:hover {
            background-color: #2980b9 !important;
        }
        /* Header styling */
        .header {
            background-color: #2c3e50;
            padding: 20px;
            text-align: center;
            border-top-left-radius: 8px;
            border-top-right-radius: 8px;
        }
        /* Footer styling */
        .footer {
            background-color: #f8f9fa;
            padding: 20px;
            text-align: center;
            font-size: 14px;
            color: #6c757d;
            border-top: 1px solid #e9ecef;
            border-bottom-left-radius: 8px;
            border-bottom-right-radius: 8px;
        }
        /* Support section */
        .support-section {
            background-color: #f1f8ff;
            border-left: 4px solid #3498db;
            padding: 15px;
            margin-top: 20px;
            border-radius: 4px;
        }
        /* WhatsApp button */
        .whatsapp-button {
            background-color: #25D366;
            border-radius: 4px;
            color: #ffffff !important;
            display: inline-block;
            font-size: 16px;
            font-weight: bold;
            line-height: 1.2;
            padding: 12px 30px;
            text-decoration: none;
            text-align: center;
            margin: 10px 0;
        }
        /* Animation for modern clients */
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        .animate {
            animation-duration: 1s;
            animation-fill-mode: both;
            animation-name: fadeIn;
        }
        /* Responsive styles */
        @media screen and (max-width: 600px) {
            .email-container {
                width: 100% !important;
                margin: auto !important;
            }
            .content-block {
                padding: 20px !important;
            }
            .responsive-table {
                width: 100% !important;
            }
            .mobile-center {
                text-align: center !important;
            }
        }
    </style>
</head>
<body id="body" style="margin: 0; padding: 0; background-color: #f4f4f4; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">
    <!-- Preheader text (hidden) -->
    <div style="display: none; max-height: 0px; overflow: hidden;">
        <?php echo $mail_data['m_subject'] ?? 'Important notification from ' . do_config(1); ?>
    </div>
   
    <!-- Prevent Gmail trimming -->
    <div style="display: none; max-height: 0px; overflow: hidden;">
        &nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;
    </div>
    <center style="width: 100%; background-color: #f4f4f4; padding: 30px 0;">
        <div class="email-container" style="max-width: 600px; margin: 0 auto;">
            <!-- Header with Logo -->
            <table border="0" cellpadding="0" cellspacing="0" width="100%" class="header" style="background-color: #2c3e50; border-top-left-radius: 8px; border-top-right-radius: 8px;">
                <tr>
                    <td align="center" valign="top" style="padding: 20px;">
                        <a href="https://<?php echo $_SERVER['HTTP_HOST']; ?>/" target="_blank" style="text-decoration: none;">
                       
                        <img src="<?php echo do_config(27); ?>" alt="<?php echo do_config(1); ?>" width="220" height="60" style="display: block; border: 0; max-width: 100%;" class="animate" onerror="this.style.display='none';">
                        </a>
                    </td>
                </tr>
            </table>
            <!-- Main Content -->
            <table border="0" cellpadding="0" cellspacing="0" width="100%" class="content-block" style="background-color: #ffffff;">
                <tr>
                    <td style="padding: 30px;">
                        <table border="0" cellpadding="0" cellspacing="0" width="100%">
                            <tr>
                                <td>
                                    <h1 style="color: #2c3e50; font-size: 24px; margin-top: 0; margin-bottom: 20px; font-weight: bold;">Hello <?php echo $mail_data['m_user'] ?? 'User'; ?>,</h1>
                                   
                                    <?php if (isset($mail_data['m_role']) && $mail_data['m_role'] == 'message'): ?>
                                        <p style="margin-bottom: 20px;"><strong><?php echo $mail_data['m_subject'] ?? ''; ?></strong></p>
                                        <div style="margin-bottom: 20px;"><?php echo $mail_data['m_comment'] ?? ''; ?></div>
                                   
                                    <?php elseif(isset($mail_data['m_role']) && $mail_data['m_role'] == 'support'): ?>
                                        <p style="margin-bottom: 20px;"><strong><?php echo $mail_data['m_subject'] ?? ''; ?></strong></p>
                                        <div style="margin-bottom: 20px;"><?php echo $mail_data['m_comment'] ?? ''; ?></div>
                                   
                                    <?php elseif(isset($mail_data['m_role']) && $mail_data['m_role'] == 'activate'): ?>
                                        <p style="margin-bottom: 20px;"><strong><?php echo $mail_data['m_subject'] ?? ''; ?></strong></p>
                                        <p style="margin-bottom: 20px;">Please take a second to confirm your email address by clicking the button below:</p>
                                        <table border="0" cellpadding="0" cellspacing="0" class="responsive-table">
                                            <tr>
                                                <td align="center">
                                                    <a href="https://<?php echo $_SERVER['HTTP_HOST']; ?>/verify/<?php echo $mail_data['m_token'] ?? ''; ?>/" class="button" style="background-color: #3498db; border-radius: 4px; color: #ffffff; display: inline-block; font-size: 16px; font-weight: bold; line-height: 1.2; padding: 12px 30px; text-decoration: none; text-align: center; margin: 20px 0; -webkit-text-size-adjust: none; mso-hide: all;">
                                                        Confirm Email Address
                                                    </a>
                                                </td>
                                            </tr>
                                        </table>
                                        <p style="margin-bottom: 20px;">Once you do, your account will be active.</p>
                                        <p style="margin-bottom: 20px;"><small>Confirm your account at <?php echo do_config(1); ?></small></p>
                                   
                                    <?php elseif(isset($mail_data['m_role']) && $mail_data['m_role'] == 'recover'): ?>
                                        <p style="margin-bottom: 20px;">We have received a request to reset your password at <?php echo do_config(1); ?></p>
                                        <p style="margin-bottom: 20px;">If you initiated this action, please click the button below to reset your password:</p>
                                        <table border="0" cellpadding="0" cellspacing="0" class="responsive-table">
                                            <tr>
                                                <td align="center">
                                                    <a href="https://<?php echo $_SERVER['HTTP_HOST']; ?>/forgot-password?id=<?php echo $mail_data['m_token'] ?? ''; ?>" class="button" style="background-color: #3498db; border-radius: 4px; color: #ffffff; display: inline-block; font-size: 16px; font-weight: bold; line-height: 1.2; padding: 12px 30px; text-decoration: none; text-align: center; margin: 20px 0; -webkit-text-size-adjust: none; mso-hide: all;">
                                                        Reset Password
                                                    </a>
                                                </td>
                                            </tr>
                                        </table>
                                        <p style="margin-bottom: 20px;"><small>Once you confirm your email, your password will be reset.</small></p>
                                    <?php endif; ?>
                                    <!-- Support Section with WhatsApp -->
                                    <div class="support-section" style="background-color: #f1f8ff; border-left: 4px solid #3498db; padding: 15px; margin-top: 20px; border-radius: 4px;">
                                        <h3 style="color: #2c3e50; margin-top: 0; margin-bottom: 10px;">Need Help?</h3>
                                        <p style="margin-bottom: 10px;">Our support team is always ready to assist you. Contact us via WhatsApp for quick responses.</p>
                                        <table border="0" cellpadding="0" cellspacing="0" class="responsive-table">
                                            <tr>
                                                <td align="center">
                                                    <a href="https://wa.me/<?php echo preg_replace('/[^0-9]/', '', do_config(2)); ?>" class="whatsapp-button" style="background-color: #25D366; border-radius: 4px; color: #ffffff; display: inline-block; font-size: 16px; font-weight: bold; line-height: 1.2; padding: 12px 30px; text-decoration: none; text-align: center; margin: 10px 0;">
                                                        <img src="https://cdn.jsdelivr.net/npm/simple-icons@v5/icons/whatsapp.svg" alt="WhatsApp" width="20" height="20" style="vertical-align: middle; margin-right: 8px; filter: invert(100%);">
                                                        Contact Support
                                                    </a>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
            <!-- Footer -->
            <table border="0" cellpadding="0" cellspacing="0" width="100%" class="footer" style="background-color: #f8f9fa; border-bottom-left-radius: 8px; border-bottom-right-radius: 8px;">
                <tr>
                    <td align="center" style="padding: 20px; color: #6c757d; font-size: 14px;">
                        <p style="margin-bottom: 10px;">&copy; <?php echo date('Y'); ?> <?php echo do_config(1); ?>. All rights reserved.</p>
                        <p style="margin-bottom: 10px;">This email was sent to you because you are a registered user at <?php echo do_config(1); ?>.</p>
                        <p style="margin-bottom: 10px;">Please do not reply to this email as it was sent from an unmonitored address.</p>
                        <p style="margin-bottom: 10px;">
                            <a href="https://<?php echo $_SERVER['HTTP_HOST']; ?>/terms" style="color: #3498db; text-decoration: underline;">Terms of Service</a> |
                            <a href="https://<?php echo $_SERVER['HTTP_HOST']; ?>/privacy" style="color: #3498db; text-decoration: underline;">Privacy Policy</a>
                        </p>
                    </td>
                </tr>
            </table>
           
            <!-- Email verification - helps prevent spam classification -->
            <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px; margin-top: 20px;">
                <tr>
                    <td align="center" style="padding: 0 20px 20px 20px; color: #999999; font-size: 12px; line-height: 18px;">
                        <p style="margin: 0;">To ensure delivery to your inbox, please add <?php echo do_config(32); ?> to your address book.</p>
                    </td>
                </tr>
            </table>
        </div>
    </center>
    <!-- Schema.org markup for Gmail -->
    <script type="application/ld+json">
    {
        "@context": "http://schema.org",
        "@type": "EmailMessage",
        "potentialAction": {
            "@type": "ViewAction",
            "url": "https://<?php echo $_SERVER['HTTP_HOST']; ?>/",
            "name": "View Website"
        },
        "description": "View our website"
    }
    </script>
   
    <!-- Microdata for email clients -->
    <div itemscope itemtype="http://schema.org/EmailMessage" style="display:none;">
        <div itemprop="potentialAction" itemscope itemtype="http://schema.org/ViewAction">
            <meta itemprop="name" content="View Website"/>
            <meta itemprop="url" content="https://<?php echo $_SERVER['HTTP_HOST']; ?>/"/>
        </div>
        <meta itemprop="description" content="View our website"/>
    </div>
</body>
</html>
