<?php
    require_once 'config.php';
    require_once 'class.crud.php';

    $tiers = new Tier();
    $order = new Order();    

    // define variables and set to empty values
    $flavour = $sub_flavour = $filling = $tier = $multiple_tier = $size = $shape = "";
    $product_name = null; $product = null;

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
        // cake design 
        $design_option = $_POST["design_option"];

        if($design_option == 'design'){
            //from gallery
            $product = $_POST["product"];
        } else if($design_option == 'upload') {
            //from upload
            $product_name = $_POST["upload_name"]; // product name
            $file_name = $_FILES['input_upload']['name'];
            $file_tmp =$_FILES['input_upload']['tmp_name'];
            // upload image
            move_uploaded_file($file_tmp,"../img/client_designs/".$file_name);
        } else if($design_option == 'custom') {
            //from custom
            $product_name = $_POST["input_custom"];
        }

        $flavour = $_POST["flavour"];
        if(isset( $_POST["sub_flavour"] )){
            $sub_flavour = $_POST["sub_flavour"];
        } else {
            $sub_flavour = null;
        }
        $filling = $_POST["filling"];
        $tier = $_POST["tiers"];
        $tier_name = $tiers->viewTierInfo($tier);
        
        if($tier_name['slug'] == 'multiple'){            
            // multiple tiers
            $multiple_tier =  $_POST["multiple_tiers"];
            // print_r($multiple_tier);
            // die();
        } else {
            $multiple_tier = null;
        }
        $size = $_POST["size"];
        $shape = $_POST["shape"];

        // personal details
        $f_name = $_POST["f_name"];
        $l_name = $_POST["l_name"];
        $email  = $_POST["email"];
        $phone  = $_POST["phone"];
        $delivery_date = strtotime($_POST['delivery_date']); 
        $delivery_date = date("Y-m-d",$delivery_date);
        $method = $_POST["method"];
        if($method == 'deliver'){
            $venue_address  = $_POST["venue_address"];
        }   else {
            $venue_address = null;
        }
        if(isset($_POST["add_details_on_cake"])){
            $add_details_on_cake    = 1;
            $cake_name  = $_POST["cake_name"];
            $cake_age   = $_POST["cake_age"];
        } else {
            $add_details_on_cake    = 0;
            $cake_name  = null;
            $cake_age   = null;
        }        

        // Insert Data to DB
        if( !empty($flavour) && !empty($filling) && !empty($tier) && !empty($size) && !empty($shape) ){
            $db_result = $order->insertOrderData($design_option,$product,$product_name,$flavour,$sub_flavour,$filling,$tier,$multiple_tier,$size,$shape,$f_name,$l_name,$email,$phone,$delivery_date,$method,$venue_address,$add_details_on_cake,$cake_name,$cake_age);
            
            if($db_result){
                header('Location: ../order-thank-you-page.php');
            }
        }

        // Send Email

        $to = 'shafi.2288@gmail.com';

        $subject = 'Cake Quotation Request';

        $headers = "From: " . $email . "\r\n";
        $headers .= "Reply-To: ". $email . "\r\n";
        $headers .= "CC: " . $email . "\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
        $headers .= "X-Priority: 3\r\n";

        $message = '<!DOCTYPE html>
        <html lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">
        <head>
          <meta charset="utf-8">
          <meta name="viewport" content="width=device-width">
          <meta http-equiv="X-UA-Compatible" content="IE=edge">
          <meta name="x-apple-disable-message-reformatting">
          <title></title>
          <link href="https://fonts.googleapis.com/css?family=Poppins:400,400i,600,600i,700,700i,900,900i" rel="stylesheet">	
          <link href="http://fonts.googleapis.com/css?family=Dancing+Script:700|EB+Garamond" rel="stylesheet" type="text/css" />
          <style>
            html,
            body {
                margin: 0 auto !important;
                padding: 0 !important;
                height: 100% !important;
                width: 100% !important;
                background: #f1f1f1;
            }
            * {
                -ms-text-size-adjust: 100%;
                -webkit-text-size-adjust: 100%;
            }
            div[style*="margin: 16px 0"] {
                margin: 0 !important;
            }
            table,
            td {
                mso-table-lspace: 0pt !important;
                mso-table-rspace: 0pt !important;
            }
            table {
                border-spacing: 0 !important;
                border-collapse: collapse !important;
                table-layout: fixed !important;
                margin: 0 auto !important;
            }
            img {
                -ms-interpolation-mode:bicubic;
            }
            a {
                text-decoration: none;
            }
            *[x-apple-data-detectors],  /* iOS */
            .unstyle-auto-detected-links *,
            .aBn {
                border-bottom: 0 !important;
                cursor: default !important;
                color: inherit !important;
                text-decoration: none !important;
                font-size: inherit !important;
                font-family: inherit !important;
                font-weight: inherit !important;
                line-height: inherit !important;
            }
            .a6S {
                display: none !important;
                opacity: 0.01 !important;
            }
            .im {
                color: inherit !important;
            }
            img.g-img + div {
                display: none !important;
            }
            @media only screen and (min-device-width: 320px) and (max-device-width: 374px) {
                u ~ div .email-container {
                    min-width: 320px !important;
                }
            }
            @media only screen and (min-device-width: 375px) and (max-device-width: 413px) {
                u ~ div .email-container {
                    min-width: 375px !important;
                }
            }
            @media only screen and (min-device-width: 414px) {
                u ~ div .email-container {
                    min-width: 414px !important;
                }
            }
          </style>
          <style>
            .primary{
              background: #f3a333;
            }
            .bg_white{
              background: #ffffff;
            }
            .bg_light{
              background: #fafafa;
            }
            .bg_black{
              background: #000000;
            }
            .bg_dark{
              background: rgba(0,0,0,.8);
            }
            .email-section{
              padding:2.5em;
            }
            .btn{
              padding: 10px 15px;
            }
            .btn.btn-primary{
              border-radius: 30px;
              background: #f3a333;
              color: #ffffff;
            }
            h1,h2,h3,h4,h5,h6{
              font-family: "Dancing Script", cursive;
              color: #000000;
              margin-top: 0;
            }
            body{
              font-family: "EB Garamond", serif;
              font-weight: 400;
              font-size: 15px;
              line-height: 1.8;
              color: rgba(0,0,0,.65);
            }
            a{
              color: #f3a333;
            }
            table{
            }
            .logo h1{
              margin: 0;
            }
            .logo h1 a{
              color: #000;
              font-size: 20px;
              font-weight: 700;
              text-transform: uppercase;
              font-family: "EB Garamond", serif;
            }
            .hero{
              position: relative;
            }
            .hero img{
            }
            .hero .text{
              color: rgba(255,255,255,.8);
            }
            .hero .text h2{
              color: #000;
              font-size: 30px;
              margin-bottom: 0;
            }
            .heading-section{
            }
            .heading-section h2{
              color: #000000;
              font-size: 28px;
              margin-top: 0;
              line-height: 1.4;
            }
            .heading-section .subheading{
              margin-bottom: 20px !important;
              display: inline-block;
              font-size: 13px;
              text-transform: uppercase;
              letter-spacing: 2px;
              color: rgba(0,0,0,.4);
              position: relative;
            }
            .heading-section .subheading::after{
              position: absolute;
              left: 0;
              right: 0;
              bottom: -10px;
              content: '';
              width: 100%;
              height: 2px;
              background: #f3a333;
              margin: 0 auto;
            }
            .heading-section-white{
              color: rgba(255,255,255,.8);
            }
            .heading-section-white h2{
              font-size: 28px;
              font-family: 
              line-height: 1;
              padding-bottom: 0;
            }
            .heading-section-white h2{
              color: #ffffff;
            }
            .heading-section-white .subheading{
              margin-bottom: 0;
              display: inline-block;
              font-size: 13px;
              text-transform: uppercase;
              letter-spacing: 2px;
              color: rgba(255,255,255,.4);
            }
            .icon{
              text-align: center;
            }
            .icon img{
            }
            .text-services{
              padding: 10px 10px 0; 
              text-align: center;
            }
            .text-services h3{
              font-size: 20px;
            }
            .text-services .meta{
              text-transform: uppercase;
              font-size: 14px;
            }
            .img{
              width: 100%;
              height: auto;
              position: relative;
            }
            .img .icon{
              position: absolute;
              top: 50%;
              left: 0;
              right: 0;
              bottom: 0;
              margin-top: -25px;
            }
            .img .icon a{
              display: block;
              width: 60px;
              position: absolute;
              top: 0;
              left: 50%;
              margin-left: -25px;
            }
            .footer{
              color: rgba(255,255,255,.5);
            }
            .footer .heading{
              color: #ffffff;
              font-size: 20px;
            }
            .footer ul{
              margin: 0;
              padding: 0;
            }
            .footer ul li{
              list-style: none;
              margin-bottom: 10px;
            }
            .footer ul li a{
              color: rgba(255,255,255,1);
            }
            @media screen and (max-width: 500px) {
              .icon{
                text-align: left;
              }
              .text-services{
                padding-left: 0;
                padding-right: 20px;
                text-align: left;
              }
            }
          </style>
        </head>        
        <body width="100%" style="margin: 0; padding: 0 !important; mso-line-height-rule: exactly; background-color: #222222;">
            <center style="width: 100%; background-color: #f1f1f1;">
            
                <div style="display: none; font-size: 1px;max-height: 0px; max-width: 0px; opacity: 0; overflow: hidden; mso-hide: all; font-family: sans-serif;">
                &zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;
                </div>
            
                <div style="max-width: 750px; margin: 0 auto;" class="email-container">
            
                    <table align="center" role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="margin: auto;">
                        <tr>
                            <td class="bg_white logo" style="padding: 1em 2.5em; text-align: center">
                                <h1><a href="#">Designer Cakes Toowoomba</a></h1>
                            </td>
                        </tr>
                        <tr>
                            <td valign="middle" class="hero" style="background-image: url(images/bg_1.jpg); background-size: cover; height: 400px;">
                                <table>
                                    <tr>
                                        <td>
                                            <div class="text" style="padding: 0 3em; text-align: center;">
                                                <h2>Thank you for ordering with <br/>DCT</h2>
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td class="bg_white">
                                <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
                                    <tr>
                                        <td class="bg_white email-section">
                                            <div class="heading-section" style="text-align: center; padding: 0 30px;">
                                                <h2>Order Details</h2>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="bg_light email-section" style="padding: 0; width: 100%;">
                                            <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%">
                                                <tr>
                                                    <td valign="middle" width="50%">
                                                        <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
                                                            <tr>
                                                                <td>
                                                                    <img src="images/single_tier_cake.jpg" alt="" style="width: 100%; max-width: 600px; height: auto; margin: auto; display: block;">
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                    <td valign="middle" width="50%">
                                                        <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
                                                            <tr>
                                                                <td class="text-services" style="text-align: left; padding: 20px 30px;">
                                                                    <div class="heading-section">
                                                                        <h2 style="font-size: 22px;">Emma Wiggles Cake</h2>
                                                                        <p>Number of Tiers: 2</p>
                                                                        <p>Cake Size: 6,10 Inch</p>
                                                                        <p>Cake Shape: Round</p>
                                                                        <p>Approximate Cake Servings: 49 People</p>
                                                                        <p>Cake Flavour: Sponge Cake - Vanilla</p>
                                                                        <p>Cake Filling: Butterscotch Flavoured</p>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="bg_white email-section">
                                            <div class="heading-section" style="text-align: left; padding: 0 30px;">
                                                <h2>Customer Details</h2>
                                                <p>Customer Name: Shafna</p>
                                                <p>Email: Round</p>
                                                <p>Phone Number: 49 People</p>
                                                <p>Pick Up/Delivery Date: Sponge Cake - Vanilla</p>
                                                <p>Method: Butterscotch Flavoured</p>
                                                <p>Venue Address: Butterscotch Flavoured</p>
                                                <p>Need to add name and age on cake: Butterscotch Flavoured</p>
                                                <p>Name on Cake:</p>
                                                <p>Age on Cake:</p>
                                            </div>
                                        </td>
                                    </tr>  
                                </table>
                            </td>
                        </tr>
                    </table>

                    <!-- Footer -->
                    <table align="center" role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="margin: auto;">
                        <tr>
                            <td valign="middle" class="bg_black footer email-section">
                                <table>
                                    <tr>
                                        <td valign="top" width="33.333%" style="padding-top: 20px;">
                                            <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
                                                <tr>
                                                    <td style="text-align: left; padding-right: 10px;">
                                                        <h3 class="heading">RestoBar</h3>
                                                        <p>A small river named Duden flows by their place and supplies it with the necessary regelialia.</p>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                        <td valign="top" width="33.333%" style="padding-top: 20px;">
                                            <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
                                                <tr>
                                                    <td style="text-align: left; padding-left: 5px; padding-right: 5px;">
                                                        <h3 class="heading">Contact Info</h3>
                                                        <ul>
                                                            <li><span class="text">203 Fake St. Mountain View, San Francisco, California, USA</span></li>
                                                            <li><span class="text">+2 392 3929 210</span></a></li>
                                                        </ul>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                        <td valign="top" width="33.333%" style="padding-top: 20px;">
                                            <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
                                                <tr>
                                                    <td style="text-align: left; padding-left: 10px;">
                                                        <h3 class="heading">Useful Links</h3>
                                                        <ul>
                                                            <li><a href="#">Breakfast</a></li>
                                                            <li><a href="#">Lunch</a></li>
                                                            <li><a href="#">Dinner</a></li>
                                                            <li><a href="#">Dessert</a></li>
                                                        </ul>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td valign="middle" class="bg_black footer email-section">
                                <table>
                                    <tr>
                                        <td valign="top" width="33.333%">
                                            <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
                                                <tr>
                                                    <td style="text-align: left; padding-right: 10px;">
                                                        <p>&copy; 2018 Restobar. All Rights Reserved</p>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table> 

                </div> 

            </center>
        </body>
        </html>';

        $mail = mail($to, $subject, $message, $headers);
        
        // $message = '<html><body>';
        // $message .= '<img src="http://demo.ibo.lk/assets/front/images/logo.png" alt="Cake Quotation Request" />';
        // $message .= '<table rules="all" style="border-color: #666;" cellpadding="10">';
        // $message .= '<tr><td valign="top"><div style="color:#888888; font-size: 14px; font-weight: bold;">Customer Name: </div></td><td valign="top"><div style="color:#696767; font-size: 13px; ">' . $name . '</div></td></tr>';
        // $message .= '<tr><td valign="top"><div style="color:#888888; font-size: 14px; font-weight: bold;">Customer Phone:</div></td><td valign="top"><div style="color:#696767; font-size: 13px;">' . $phone . '</div></td></tr>';
        // $message .= '<tr><td valign="top"><div style="color:#888888; font-size: 14px; font-weight: bold;">Customer Email:</div></td><td valign="top"><div style="color:#696767; font-size: 13px; ">' . $email . '</div></td></tr>';
        // $message .= '<tr><td valign="top"><div style="color:#888888; font-size: 14px; font-weight: bold;">Installation Delivery Address:</div></td><td valign="top"><div style="color:#696767; font-size: 13px; ">' . $address1 . '</div></td></tr>';						
        // $message .= '<tr><td valign="top"><div style="color:#888888; font-size: 14px; font-weight: bold;">Note:</div></td> <td valign="top"><div style="color:#696767; font-size: 13px; ">' . $note . '</div></td></tr>';
        // $message .= '<tr><td valign="top"><div style="color:#888888; font-size: 14px; font-weight: bold;">IBO Name: </div></td><td valign="top"><div style="color:#696767; font-size: 13px; ">' . $ibo_detail['ibo_first_name']  .' '. $ibo_detail['ibo_last_name'] .'</div></td></tr>';
        // $message .= '<tr><td valign="top"><div style="color:#888888; font-size: 14px; font-weight: bold;">IBO Phone: </div></td><td valign="top"><div style="color:#696767; font-size: 13px; ">' . $ibo_detail['ibo_mobile']  . '</div></td></tr>';
        // $message .= '<tr><td valign="top"><div style="color:#888888; font-size: 14px; font-weight: bold;">IBO Site Url: </div></td><td valign="top"><div style="color:#696767; font-size: 13px; ">' . $url . '</div></td></tr>';
        // $message .= '</table>';
        // $message .= '<div style="background: #e6e5e5; padding: 10px; margin-top: 30px; text-align: center;">';
        // $message .= '<h3 style="color: #003751; margin-top: 5px; margin-bottom: 10px;">ibo.lk</h3>';
        // $message .= '<p style="margin: 0px; font-size: 12px; color: #4e4d4d;">IBO.LK<br> 446, <br> Galle Rd, <br> Ratmalana</p>';
        // $message .= '<p style="margin-bottom: 0px; margin-top: 5px; font-size: 12px; color: #4e4d4d;">011 3 010005</p>';
        // $message .= '</div>';
        // $message .= '</body></html>';


    }

?>