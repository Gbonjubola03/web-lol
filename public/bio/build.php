<?php require_once dirname(dirname(__FILE__)) . '/preload.php'; ?>
<?php require_once 'header.php'; ?>

<?php
/*  VICTIMS
$downloads  = $query->normal("SELECT count(id) FROM " . dbperfix . "download WHERE user_id='$member->user_id'");
$downloads  = number_format($downloads->fetch_assoc()['count(id)']);
$deposited  = $query->normal("SELECT sum(amount) FROM " . dbperfix . "invoice WHERE user_id='$member->user_id' AND status='1'");
$deposited  = $deposited->fetch_assoc()['sum(amount)'];
*/
?>

<?php do_winfo('BUILD TEMPLATE'); ?>
<?php define('eu_active', 'build'); ?>

<!-- ----------------------------------------------------------------
     STYLES
----------------------------------------------------------------- -->
<style>
    .bodycolor      { height:50px; cursor:pointer; }
    .up-icon        { cursor:pointer; font-size:80px; color:#333 }
    .up-icon:hover  { color:rgb(27 42 78) }

    .template-card        { border-radius:10px; box-shadow:0 4px 8px rgba(0,0,0,.1); transition:.3s; margin-bottom:20px }
    .template-card:hover  { transform:translateY(-5px); box-shadow:0 8px 15px rgba(0,0,0,.2) }

    .template-header      { background:linear-gradient(45deg,#3a7bd5,#00d2ff); color:#fff; padding:15px; border-radius:10px 10px 0 0 }

    .form-section         { border-left:4px solid #3a7bd5; padding-left:15px; margin-bottom:25px }
    .section-title        { font-weight:600; color:#333; margin-bottom:20px; display:flex; align-items:center }
    .section-title i      { margin-right:10px; color:#3a7bd5 }

    .btn-generate         { background:linear-gradient(45deg,#3a7bd5,#00d2ff); border:none; padding:12px 25px;
                            font-weight:600; letter-spacing:1px; border-radius:50px; box-shadow:0 4px 15px rgba(0,0,0,.2); transition:.3s }
    .btn-generate:hover   { transform:translateY(-3px); box-shadow:0 6px 20px rgba(0,0,0,.3);
                            background:linear-gradient(45deg,#00d2ff,#3a7bd5) }

    .form-control         { border-radius:8px; padding:12px 15px; border:1px solid #ddd; transition:.3s }
    .form-control:focus   { border-color:#3a7bd5; box-shadow:0 0 0 .2rem rgba(58,123,213,.25) }

    .form-label           { font-weight:600; color:#555; margin-bottom:8px }

    .color-preview        { width:30px; height:30px; border-radius:50%; display:inline-block; margin-left:10px; border:2px solid #ddd }
    .help-text            { color:#6c757d; font-size:.85rem; margin-top:5px }

    .image-preview        { max-width:100%; height:150px; object-fit:contain; border-radius:8px;
                            border:1px dashed #ddd; margin-top:10px; background:#f8f9fa }

    .custom-select        { appearance:none;
                            background:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='%233a7bd5' viewBox='0 0 16 16'%3E%3Cpath d='M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z'/%3E%3C/svg%3E")
                            no-repeat right 1rem center/16px 12px }

    .template-info        { background:#f8f9fa; border-left:4px solid #17a2b8; padding:15px; margin-bottom:20px; border-radius:0 8px 8px 0 }
    
    .template-option {
        cursor: pointer;
        border: 2px solid #eee;
        border-radius: 8px;
        padding: 15px;
        margin-bottom: 10px;
        transition: all 0.3s ease;
    }
    .template-option:hover {
        border-color: #3a7bd5;
        background-color: #f5f9ff;
    }
    .template-option.selected {
        border-color: #3a7bd5;
        background-color: #f0f7ff;
        box-shadow: 0 0 0 0.2rem rgba(58, 123, 213, 0.25);
    }
    .template-thumbnail {
        width: 100%;
        height: 120px;
        object-fit: cover;
        border-radius: 5px;
        margin-bottom: 10px;
    }
</style>

<title><?php echo SITE_TITLE . ' ' . do_config(8) . ' ' . do_config(1); ?></title>

<!-- ----------------------------------------------------------------
     MAIN CARD
----------------------------------------------------------------- -->
<div class="card template-card">
    <div class="card-header template-header">
        <h4 class="mb-0"><i class="fa fa-paint-brush me-2"></i><?php echo SITE_TITLE; ?> Template Builder</h4>
    </div>

    <div class="card-body">
        <!-- INFO / GUIDE --------------------------------------------------------->
        <div class="template-info mb-4">
            <h5><i class="fa fa-info-circle me-2"></i>Template Builder Guide</h5>
            <p>Create beautiful templates without coding knowledge. Select a template and customize it with your content.</p>
        </div>

        <!-- --------------------------------------------------------------------
             FORM
        -------------------------------------------------------------------- -->
        <form id="build_form" autocomplete="off" method="post">
            <input type="hidden" name="build" value="build">
            <input type="hidden" name="csrfToken" value="<?php echo csrf_token(); ?>">
            <input autocomplete="false" name="hidden" type="text" style="display:none">

            <!-- ================================================================
                 TEMPLATE SELECTION SECTION
            ================================================================= -->
            <div class="form-section">
                <h5 class="section-title"><i class="fa fa-list-alt"></i> Select Template Type</h5>
                
                <div class="row">
                    <div class="col-md-12 mb-4">
                        <select class="form-control custom-select" name="template_type" id="template_type" onchange="changeTemplateType()">
                            <option value="default">Default Profile Template</option>
                            <option value="facebook">Facebook Clone</option>
                            <option value="twitter">Twitter Template</option>
                            <option value="breaking_news">Breaking News Template</option>
                            <option value="gmail">Gmail Template</option>
                            <option value="tiktok">TikTok Template</option>
                            <option value="crypto">Cryptocurrency Earning Template</option>
                            <option value="verification">Link shortener</option>
                            <option value="store">Online Store Template</option>
                        </select>
                        <div class="help-text">Choose the type of template you want to create</div>
                    </div>
                </div>
                
                <div class="row" id="template-previews">
                    <div class="col-md-3 mb-4 template-preview default-preview">
                        <div class="template-option selected" data-template="default" onclick="selectTemplate('default')">
                            <img src="https://via.placeholder.com/200x120?text=Default+Profile" class="template-thumbnail">
                            <h6 class="mb-1">Default Profile</h6>
                            <p class="text-muted small mb-0">Basic social profile layout</p>
                        </div>
                    </div>
                    
                    <div class="col-md-3 mb-4 template-preview facebook-preview" style="display:none">
                        <div class="template-option" data-template="facebook" onclick="selectTemplate('facebook')">
                            <img src="https://via.placeholder.com/200x120?text=Facebook" class="template-thumbnail">
                            <h6 class="mb-1">Facebook Clone</h6>
                            <p class="text-muted small mb-0">Login page design</p>
                        </div>
                    </div>
                    
                    <div class="col-md-3 mb-4 template-preview twitter-preview" style="display:none">
                        <div class="template-option" data-template="twitter" onclick="selectTemplate('twitter')">
                            <img src="https://via.placeholder.com/200x120?text=Twitter" class="template-thumbnail">
                            <h6 class="mb-1">Twitter Template</h6>
                            <p class="text-muted small mb-0">Elegant sign-in page</p>
                        </div>
                    </div>
                    
                    <div class="col-md-3 mb-4 template-preview breaking_news-preview" style="display:none">
                        <div class="template-option" data-template="breaking_news" onclick="selectTemplate('breaking_news')">
                            <img src="https://via.placeholder.com/200x120?text=Breaking+News" class="template-thumbnail">
                            <h6 class="mb-1">Breaking News</h6>
                            <p class="text-muted small mb-0">News site with articles</p>
                        </div>
                    </div>
                    
                    <div class="col-md-3 mb-4 template-preview gmail-preview" style="display:none">
                        <div class="template-option" data-template="gmail" onclick="selectTemplate('gmail')">
                            <img src="https://via.placeholder.com/200x120?text=Gmail" class="template-thumbnail">
                            <h6 class="mb-1">Gmail Template</h6>
                            <p class="text-muted small mb-0">Email login interface</p>
                        </div>
                    </div>
                    
                    <div class="col-md-3 mb-4 template-preview tiktok-preview" style="display:none">
                        <div class="template-option" data-template="tiktok" onclick="selectTemplate('tiktok')">
                            <img src="https://via.placeholder.com/200x120?text=TikTok" class="template-thumbnail">
                            <h6 class="mb-1">TikTok Template</h6>
                            <p class="text-muted small mb-0">Social media app login</p>
                        </div>
                    </div>
                    
                    <div class="col-md-3 mb-4 template-preview crypto-preview" style="display:none">
                        <div class="template-option" data-template="crypto" onclick="selectTemplate('crypto')">
                            <img src="https://via.placeholder.com/200x120?text=Crypto" class="template-thumbnail">
                            <h6 class="mb-1">Cryptocurrency</h6>
                            <p class="text-muted small mb-0">Earnings platform design</p>
                        </div>
                    </div>
                    
                    <div class="col-md-3 mb-4 template-preview verification-preview" style="display:none">
                        <div class="template-option" data-template="verification" onclick="selectTemplate('verification')">
                            <img src="https://via.placeholder.com/200x120?text=Verification" class="template-thumbnail">
                            <h6 class="mb-1">Account Verification</h6>
                            <p class="text-muted small mb-0">Identity verification form</p>
                        </div>
                    </div>
                    
                    <div class="col-md-3 mb-4 template-preview store-preview" style="display:none">
                        <div class="template-option" data-template="store" onclick="selectTemplate('store')">
                            <img src="https://via.placeholder.com/200x120?text=Store" class="template-thumbnail">
                            <h6 class="mb-1">Online Store</h6>
                            <p class="text-muted small mb-0">E-commerce storefront</p>
                        </div>
                    </div>
                </div>
            </div> <!-- /template selection section -->

            <!-- ================================================================
                 BRANDING SECTION
            ================================================================= -->
            <div class="form-section">
                <h5 class="section-title"><i class="fa fa-star"></i> Branding Elements</h5>

                <!-- Verification badge -->
                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="verified_badge" id="verified_badge" value="1">
                                <label class="form-check-label" for="verified_badge">
                                    Show Verification Badge <i class="fas fa-check-circle text-primary"></i>
                                </label>
                            </div>
                            <div class="help-text">Add a verification badge next to the name/title</div>
                        </div>
                    </div>
                </div>

                <!-- Logo & size -------------------------------------------------->
                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label class="form-label">LOGO URL</label>
                            <input type="text" name="preview" class="form-control"
                                   placeholder="Enter logo image URL" onchange="updateLogoPreview(this.value)">
                            <div class="help-text">Enter the full URL to your logo image</div>
                            <img id="logo-preview" class="image-preview mt-2" src="" style="display:none">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label class="form-label">LOGO SIZE</label>
                            <div class="input-group">
                                <span class="input-group-text">Width</span>
                                <input class="form-control" type="number" name="logo_width" placeholder="Width" value="250">
                                <span class="input-group-text">px</span>
                            </div>
                            <div class="mt-2">
                                <div class="input-group">
                                    <span class="input-group-text">Height</span>
                                    <input class="form-control" type="number" name="logo_height" placeholder="Height" value="250">
                                    <span class="input-group-text">px</span>
                                </div>
                            </div>
                            <input type="hidden" name="preview_size" id="preview_size_hidden" value='width="250px" height="250px"'>
                        </div>
                    </div>
                </div>

                <!-- Banner & size ----------------------------------------------->
                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label class="form-label">BACKGROUND IMAGE URL</label>
                            <input type="text" name="banner" class="form-control"
                                   placeholder="Enter background image URL" onchange="updateBackgroundPreview(this.value)">
                            <div class="help-text">Enter the full URL to your background image</div>
                            <img id="background-preview" class="image-preview mt-2" src="" style="display:none">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label class="form-label">BACKGROUND SIZE</label>
                            <div class="input-group">
                                <span class="input-group-text">Width</span>
                                <input class="form-control" type="number" name="banner_width" placeholder="Width" value="250">
                                <span class="input-group-text">px</span>
                            </div>
                            <div class="mt-2">
                                <div class="input-group">
                                    <span class="input-group-text">Height</span>
                                    <input class="form-control" type="number" name="banner_height" placeholder="Height" value="250">
                                    <span class="input-group-text">px</span>
                                </div>
                            </div>
                            <input type="hidden" name="banner_size" id="banner_size_hidden" value='width="250px" height="250px"'>
                        </div>
                    </div>
                </div>

                <!-- Name & description ------------------------------------------>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label class="form-label">TEMPLATE NAME</label>
                            <input class="form-control" type="text" name="name" placeholder="Enter a name for your template">
                            <div class="help-text">Give your template a descriptive name</div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label class="form-label">TEMPLATE DESCRIPTION</label>
                            <input class="form-control" type="text" name="description" placeholder="Enter a description">
                            <div class="help-text">Brief description of your template</div>
                        </div>
                    </div>
                </div>
            </div> <!-- /branding section -->

            <!-- ================================================================
                 COLOR SCHEME SECTION
            ================================================================= -->
            <div class="form-section">
                <h5 class="section-title"><i class="fa fa-palette"></i> Color Scheme</h5>

                <!-- Row 1 ------------------------------------------------------->
                <div class="row">
                    <!-- Body color -->
                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label class="form-label">BODY COLOR</label>
                            <div class="d-flex align-items-center">
                                <input class="form-control bodycolor" type="color" name="body_color" value="#111111"
                                       onchange="updateColorPreview('body-color-preview', this.value)">
                                <div id="body-color-preview" class="color-preview ms-2" style="background:#111111"></div>
                            </div>
                            <div class="help-text">Background color of your template</div>
                        </div>
                    </div>

                    <!-- Button color -->
                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label class="form-label">BUTTON COLOR</label>
                            <div class="d-flex align-items-center">
                                <input class="form-control bodycolor" type="color" name="button_color" value="#125ec3"
                                       onchange="updateColorPreview('button-color-preview', this.value)">
                                <div id="button-color-preview" class="color-preview ms-2" style="background:#125ec3"></div>
                            </div>
                            <div class="help-text">Color of action buttons</div>
                        </div>
                    </div>

                    <!-- Text color -->
                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label class="form-label">TEXT COLOR</label>
                            <div class="d-flex align-items-center">
                                <input class="form-control bodycolor" type="color" name="text_color" value="#ffffff"
                                       onchange="updateColorPreview('text-color-preview', this.value)">
                                <div id="text-color-preview" class="color-preview ms-2" style="background:#ffffff"></div>
                            </div>
                            <div class="help-text">Color of text on buttons</div>
                        </div>
                    </div>
                </div>

                <!-- Row 2 ------------------------------------------------------->
                <div class="row">
                    <!-- Header color -->
                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label class="form-label">HEADER COLOR</label>
                            <div class="d-flex align-items-center">
                                <input class="form-control bodycolor" type="color" name="header_color" value="#222222"
                                       onchange="updateColorPreview('header-color-preview', this.value)">
                                <div id="header-color-preview" class="color-preview ms-2" style="background:#222222"></div>
                            </div>
                            <div class="help-text">Color for header section</div>
                        </div>
                    </div>

                    <!-- Content text color -->
                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label class="form-label">CONTENT TEXT COLOR</label>
                            <div class="d-flex align-items-center">
                                <input class="form-control bodycolor" type="color" name="content_text_color" value="#f5f5f5"
                                       onchange="updateColorPreview('content-text-preview', this.value)">
                                <div id="content-text-preview" class="color-preview ms-2" style="background:#f5f5f5"></div>
                            </div>
                            <div class="help-text">Color for main content text</div>
                        </div>
                    </div>

                    <!-- Accent color -->
                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label class="form-label">ACCENT COLOR</label>
                            <div class="d-flex align-items-center">
                                <input class="form-control bodycolor" type="color" name="accent_color" value="#ff5722"
                                       onchange="updateColorPreview('accent-color-preview', this.value)">
                                <div id="accent-color-preview" class="color-preview ms-2" style="background:#ff5722"></div>
                            </div>
                            <div class="help-text">Highlight color for important elements</div>
                        </div>
                    </div>
                </div>
            </div> <!-- /color scheme section -->

            <!-- ================================================================
                 BUTTON CONFIGURATION
            ================================================================= -->
            <div class="form-section">
                <h5 class="section-title"><i class="fa fa-mouse-pointer"></i> Button Configuration</h5>

                <div class="row">
                    <!-- Button text -->
                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label class="form-label">BUTTON TEXT</label>
                            <input class="form-control" type="text" name="button" value="CONTINUE" placeholder="Button text">
                            <div class="help-text">Text displayed on the button</div>
                        </div>
                    </div>

                    <!-- Button width -->
                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label class="form-label">BUTTON WIDTH</label>
                            <div class="input-group">
                                <input class="form-control" type="number" name="button_width_value" value="200" placeholder="Width"
                                       onchange="updateButtonWidth()">
                                <select class="form-control" name="button_width_unit" onchange="updateButtonWidth()">
                                    <option value="px">px</option>
                                    <option value="%">%</option>
                                    <option value="rem">rem</option>
                                </select>
                            </div>
                            <input type="hidden" name="button_width" id="button_width_hidden" value="200px">
                            <div class="help-text">Width of the button</div>
                        </div>
                    </div>

                    <!-- Button style -->
                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label class="form-label">BUTTON STYLE</label>
                            <select class="form-control custom-select" name="button_style">
                                <option value="rounded">Rounded</option>
                                <option value="pill">Pill Shaped</option>
                                <option value="square">Square</option>
                                <option value="3d">3D Effect</option>
                                <option value="gradient">Gradient</option>
                            </select>
                            <div class="help-text">Visual style of the button</div>
                        </div>
                    </div>
                </div>

                <!-- Row 2 ------------------------------------------------------->
                <div class="row">
                    <!-- Button icon -->
                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label class="form-label">BUTTON ICON</label>
                            <select class="form-control custom-select" name="button_icon">
                                <option value="">No Icon</option>
                                <option value="arrow-right">Arrow Right</option>
                                <option value="check">Check</option>
                                <option value="lock">Lock</option>
                                <option value="user">User</option>
                                <option value="credit-card">Credit Card</option>
                            </select>
                            <div class="help-text">Icon to display on the button</div>
                        </div>
                    </div>

                    <!-- Hover effect -->
                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label class="form-label">HOVER EFFECT</label>
                            <select class="form-control custom-select" name="button_hover">
                                <option value="darken">Darken</option>
                                <option value="lighten">Lighten</option>
                                <option value="grow">Grow</option>
                                <option value="shrink">Shrink</option>
                                <option value="shadow">Shadow</option>
                                <option value="none">None</option>
                            </select>
                            <div class="help-text">Effect when hovering over button</div>
                        </div>
                    </div>

                    <!-- Button position -->
                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label class="form-label">BUTTON POSITION</label>
                            <select class="form-control custom-select" name="button_position">
                                <option value="center">Center</option>
                                <option value="left">Left</option>
                                <option value="right">Right</option>
                            </select>
                            <div class="help-text">Alignment of the button</div>
                        </div>
                    </div>
                </div>
            </div> <!-- /button config -->

            <!-- ================================================================
                 CONTENT CONFIGURATION
            ================================================================= -->
            <div class="form-section">
                <h5 class="section-title"><i class="fa fa-file-alt"></i> Content Configuration</h5>

                <div class="row">
                    <!-- Redirect link -->
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label class="form-label">REDIRECT LINK</label>
                            <input class="form-control" type="text" name="link" placeholder="Enter the URL where users will be redirected">
                            <div class="help-text">Users will be sent here after clicking the button</div>
                        </div>
                    </div>

                    <!-- Page title -->
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label class="form-label">PAGE TITLE</label>
                            <input class="form-control" type="text" name="page_title" value="Secure Login" placeholder="Enter page title">
                            <div class="help-text">Title displayed in browser tab</div>
                        </div>
                    </div>
                </div>

                <!-- Header text -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group mb-3">
                            <label class="form-label">HEADER TEXT</label>
                            <input class="form-control" type="text" name="header_text"
                                   value="Secure Authentication Required" placeholder="Enter header text">
                            <div class="help-text">Main heading on the page</div>
                        </div>
                    </div>
                </div>

                <!-- Main content -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group mb-3">
                            <label class="form-label">MAIN CONTENT</label>
                            <textarea class="form-control" name="main_content" rows="4"
                                      placeholder="Enter the main content text">Please verify your identity to continue to the secure area.</textarea>
                            <div class="help-text">Primary content text</div>
                        </div>
                    </div>
                </div>

                <!-- Footer & font -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label class="form-label">FOOTER TEXT</label>
                            <input class="form-control" type="text" name="footer_text" value="© 2023 All Rights Reserved"
                                   placeholder="Enter footer text">
                            <div class="help-text">Text in the footer area</div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label class="form-label">FONT FAMILY</label>
                            <select class="form-control custom-select" name="font_family">
                                <option value="Arial, sans-serif">Arial</option>
                                <option value="'Helvetica Neue', Helvetica, sans-serif">Helvetica</option>
                                <option value="'Open Sans', sans-serif">Open Sans</option>
                                <option value="'Roboto', sans-serif">Roboto</option>
                                <option value="'Lato', sans-serif">Lato</option>
                                <option value="'Montserrat', sans-serif">Montserrat</option>
                                <option value="Georgia, serif">Georgia</option>
                                <option value="'Times New Roman', Times, serif">Times New Roman</option>
                            </select>
                            <div class="help-text">Font used throughout the template</div>
                        </div>
                    </div>
                </div>
            </div> <!-- /content configuration -->

            <!-- ================================================================
                 ADVANCED OPTIONS
            ================================================================= -->
            <div class="form-section">
                <h5 class="section-title"><i class="fa fa-sliders-h"></i> Advanced Options</h5>

                <div class="row">
                    <!-- Page animation -->
                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label class="form-label">PAGE ANIMATION</label>
                            <select class="form-control custom-select" name="animation">
                                <option value="none">None</option>
                                <option value="fade">Fade In</option>
                                <option value="slide">Slide Up</option>
                                <option value="bounce">Bounce</option>
                                <option value="zoom">Zoom In</option>
                            </select>
                            <div class="help-text">Animation when page loads</div>
                        </div>
                    </div>

                    <!-- Layout style -->
                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label class="form-label">LAYOUT STYLE</label>
                            <select class="form-control custom-select" name="layout_style">
                                <option value="centered">Centered</option>
                                <option value="left-aligned">Left Aligned</option>
                                <option value="right-aligned">Right Aligned</option>
                                <option value="split">Split Screen</option>
                            </select>
                            <div class="help-text">Overall layout arrangement</div>
                        </div>
                    </div>

                    <!-- Responsive behaviour -->
                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label class="form-label">RESPONSIVE BEHAVIOR</label>
                            <select class="form-control custom-select" name="responsive">
                                <option value="full">Fully Responsive</option>
                                <option value="desktop">Desktop Optimized</option>
                                <option value="mobile">Mobile Optimized</option>
                            </select>
                            <div class="help-text">Template adaption</div>
                        </div>
                    </div>
                </div>

                <!-- Custom CSS / JS -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label class="form-label">CUSTOM CSS (ADVANCED)</label>
                            <textarea class="form-control" name="custom_css" rows="3" placeholder="Enter custom CSS styles"></textarea>
                            <div class="help-text">Additional CSS styles</div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label class="form-label">CUSTOM JAVASCRIPT (ADVANCED)</label>
                            <textarea class="form-control" name="custom_js" rows="3" placeholder="Enter custom JavaScript"></textarea>
                            <div class="help-text">Additional JavaScript functionality</div>
                        </div>
                    </div>
                </div>
            </div> <!-- /advanced options -->

            <!-- ================================================================
                 TEMPLATE PREVIEW
            ================================================================= -->
            <div class="form-section">
                <h5 class="section-title"><i class="fa fa-eye"></i> Template Preview</h5>

                <div class="alert alert-info">
                    <i class="fa fa-info-circle me-2"></i> Changes you make will be reflected in the preview after generation.
                </div>

                <div class="text-center p-3 mb-4" style="background:#f8f9fa;border-radius:8px;">
                    <div id="preview-container" style="min-height:200px;display:flex;align-items:center;justify-content:center;">
                        <p class="text-muted">Preview will appear here after generation</p>
                    </div>
                </div>
            </div>

            <!-- ================================================================
                 GENERATE BUTTON
            ================================================================= -->
            <div class="d-grid gap-2 col-md-6 mx-auto mt-4 mb-3">
                <button type="submit" onclick="buildForm();" id="build-button" class="btn btn-generate">
                    <span id="icon-button"><i class="fa fa-magic me-2"></i> GENERATE TEMPLATE</span>
                    <span id="button-loader" style="display:none;">
                        <i class="fa fa-spinner fa-spin me-2"></i> GENERATING...
                    </span>
                </button>
            </div>
        </form>

        <!-- ----------------------------------------------------------------
             RESPONSE AREA
        ---------------------------------------------------------------- -->
        <div class="card mt-4">
            <div class="card-header bg-dark text-white">
                <h5 class="mb-0"><i class="fa fa-code me-2"></i> Generated Template</h5>
            </div>
            <div class="card-body">
                <!-- AJAX response appears here -->
                <span id="build-response" class="text-uppercase"></span>
            </div>
        </div>
    </div>
</div>

<!-- ----------------------------------------------------------------
     SCRIPTS
----------------------------------------------------------------- -->
<script>
/* Template selection functions ---------------------------------------*/
function changeTemplateType() {
    const templateType = document.getElementById('template_type').value;
    
    // Hide all previews first
    document.querySelectorAll('.template-preview').forEach(el => {
        el.style.display = 'none';
    });
    
    // Show selected template preview
    document.querySelectorAll(`.${templateType}-preview`).forEach(el => {
        el.style.display = 'block';
    });
    
    // Update the selected template
    selectTemplate(templateType);
    
    // Update default values based on template type
    updateTemplateDefaults(templateType);
}

function selectTemplate(template) {
    // Remove selected class from all options
    document.querySelectorAll('.template-option').forEach(el => {
        el.classList.remove('selected');
    });
    
    // Add selected class to clicked option
    document.querySelector(`.template-option[data-template="${template}"]`).classList.add('selected');
    
    // Update the dropdown
    document.getElementById('template_type').value = template;
}

function updateTemplateDefaults(templateType) {
    // Set different defaults based on the template type
    switch(templateType) {
        case 'facebook':
            document.querySelector('input[name="button"]').value = 'Log In';
            document.querySelector('input[name="page_title"]').value = 'Facebook - Log In or Sign Up';
            document.querySelector('input[name="body_color"]').value = '#f0f2f5';
            updateColorPreview('body-color-preview', '#f0f2f5');
            document.querySelector('input[name="button_color"]').value = '#1877f2';
            updateColorPreview('button-color-preview', '#1877f2');
            break;
            
        case 'twitter':
            document.querySelector('input[name="button"]').value = 'Sign In';
            document.querySelector('input[name="page_title"]').value = 'Twitter. It\'s what\'s happening';
            document.querySelector('input[name="body_color"]').value = '#000000';
            updateColorPreview('body-color-preview', '#000000');
            document.querySelector('input[name="button_color"]').value = '#1d9bf0';
            updateColorPreview('button-color-preview', '#1d9bf0');
            break;
            
        case 'breaking_news':
            document.querySelector('input[name="button"]').value = 'Read More';
            document.querySelector('input[name="page_title"]').value = 'Breaking News Today';
            document.querySelector('input[name="body_color"]').value = '#f5f5f5';
            updateColorPreview('body-color-preview', '#f5f5f5');
            document.querySelector('input[name="button_color"]').value = '#d32f2f';
            updateColorPreview('button-color-preview', '#d32f2f');
            break;
            
        case 'gmail':
            document.querySelector('input[name="button"]').value = 'Next';
            document.querySelector('input[name="page_title"]').value = 'Gmail: Email by Google';
            document.querySelector('input[name="body_color"]').value = '#ffffff';
            updateColorPreview('body-color-preview', '#ffffff');
            document.querySelector('input[name="button_color"]').value = '#1a73e8';
            updateColorPreview('button-color-preview', '#1a73e8');
            break;
            
        case 'tiktok':
            document.querySelector('input[name="button"]').value = 'Sign Up';
            document.querySelector('input[name="page_title"]').value = 'TikTok | Make Your Day';
            document.querySelector('input[name="body_color"]').value = '#000000';
            updateColorPreview('body-color-preview', '#000000');
            document.querySelector('input[name="button_color"]').value = '#fe2c55';
            updateColorPreview('button-color-preview', '#fe2c55');
            break;
            
        case 'crypto':
            document.querySelector('input[name="button"]').value = 'Start Earning Now';
            document.querySelector('input[name="page_title"]').value = 'Crypto Earnings Platform';
            document.querySelector('input[name="body_color"]').value = '#0f172a';
            updateColorPreview('body-color-preview', '#0f172a');
            document.querySelector('input[name="button_color"]').value = '#3b82f6';
            updateColorPreview('button-color-preview', '#3b82f6');
            break;
            
        case 'verification':
            document.querySelector('input[name="button"]').value = 'Verify Identity';
            document.querySelector('input[name="page_title"]').value = 'Account Verification';
            document.querySelector('input[name="body_color"]').value = '#f8fafc';
            updateColorPreview('body-color-preview', '#f8fafc');
            document.querySelector('input[name="button_color"]').value = '#0284c7';
            updateColorPreview('button-color-preview', '#0284c7');
            break;
            
        case 'store':
            document.querySelector('input[name="button"]').value = 'Shop Now';
            document.querySelector('input[name="page_title"]').value = 'Online Store | Special Offers';
            document.querySelector('input[name="body_color"]').value = '#f5f5f7';
            updateColorPreview('body-color-preview', '#f5f5f7');
            document.querySelector('input[name="button_color"]').value = '#0071e3';
            updateColorPreview('button-color-preview', '#0071e3');
            break;
            
        default:
            document.querySelector('input[name="button"]').value = 'CONTINUE';
            document.querySelector('input[name="page_title"]').value = 'Secure Login';
            document.querySelector('input[name="body_color"]').value = '#111111';
            updateColorPreview('body-color-preview', '#111111');
            document.querySelector('input[name="button_color"]').value = '#125ec3';
            updateColorPreview('button-color-preview', '#125ec3');
    }
}

/* Image previews --------------------------------------------------*/
function updateLogoPreview(url){
    const img=document.getElementById('logo-preview');
    img.src=url; img.style.display=url ? 'block' : 'none';
}
function updateBackgroundPreview(url){
    const img=document.getElementById('background-preview');
    img.src=url; img.style.display=url ? 'block' : 'none';
}

/* Colour preview dots --------------------------------------------*/
function updateColorPreview(id, color){
    document.getElementById(id).style.backgroundColor=color;
}

/* Button width hidden field --------------------------------------*/
function updateButtonWidth(){
    const v=document.querySelector('input[name="button_width_value"]').value;
    const u=document.querySelector('select[name="button_width_unit"]').value;
    document.getElementById('button_width_hidden').value = v + u;
}

/* Logo / banner size hidden fields -------------------------------*/
function updateLogoSize(){
    const w=document.querySelector('input[name="logo_width"]').value;
    const h=document.querySelector('input[name="logo_height"]').value;
    document.getElementById('preview_size_hidden').value=`width="${w}px" height="${h}px"`;
}
function updateBannerSize(){
    const w=document.querySelector('input[name="banner_width"]').value;
    const h=document.querySelector('input[name="banner_height"]').value;
    document.getElementById('banner_size_hidden').value=`width="${w}px" height="${h}px"`;
}

/* Init ------------------------------------------------------------*/
document.addEventListener('DOMContentLoaded', ()=>{
    ['logo_width','logo_height'].forEach(n=>document.querySelector(`input[name="${n}"]`).addEventListener('change',updateLogoSize));
    ['banner_width','banner_height'].forEach(n=>document.querySelector(`input[name="${n}"]`).addEventListener('change',updateBannerSize));
    document.querySelector('input[name="button_width_value"]').addEventListener('change',updateButtonWidth);
    document.querySelector('select[name="button_width_unit"]').addEventListener('change',updateButtonWidth);

    updateLogoSize(); updateBannerSize(); updateButtonWidth();

    /* Pre-filled previews (if any) */
    updateLogoPreview(document.querySelector('input[name="preview"]').value);
    updateBackgroundPreview(document.querySelector('input[name="banner"]').value);
    
    /* Initialize template selection */
    changeTemplateType();
});
</script>

<?php require_once 'ajax.js.php'; ?>
<?php require_once 'footer.php'; ?>

