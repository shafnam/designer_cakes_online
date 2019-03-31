<?php
    require_once 'config.php';
    require_once 'class.crud.php';

    $tiers = new Tier();
    $order = new Order();
    

    // define variables and set to empty values
    $flavour = $sub_flavour = $filling = $tier = $multiple_tier = $size = $shape = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
        $flavour = $_POST["flavour"];
        if(isset( $_POST["sub_flavour"] )){
            $sub_flavour = $_POST["sub_flavour"];
        }
        $filling = $_POST["filling"];
        $tier = $_POST["tiers"];
        $tier_name = $tiers->viewTierInfo($tier);
        if($tier_name['slug'] == 'multiple'){
            // multiple tiers
            $multiple_tier =  $_POST["multiple_tier"];
        }
        $size = $_POST["size"];
        $shape = $_POST["shape"];

        // Insert Data to DB
        if( !empty($flavour) && !empty($filling) && !empty($tier) && !empty($size) && !empty($shape) ){
            $db_result = $order->insertOrderData($flavour,$sub_flavour,$filling,$tier,$multiple_tier,$size,$shape);
        }

        // Send Email

        $to = 'shafi.2288@gmail.com';

        $subject = 'Cake Quotation Request';

        $headers = "From: " . $email . "\r\n";
        $headers .= "Reply-To: ". $email . "\r\n";
        //$headers .= "CC: " . $email . "\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
        $headers .= "X-Priority: 3\r\n";

        $message = '<html><body>';
        $message .= '<img src="http://demo.ibo.lk/assets/front/images/logo.png" alt="Cake Quotation Request" />';
        $message .= '<table rules="all" style="border-color: #666;" cellpadding="10">';
        $message .= '<tr><td valign="top"><div style="color:#888888; font-size: 14px; font-weight: bold;">Customer Name: </div></td><td valign="top"><div style="color:#696767; font-size: 13px; ">' . $name . '</div></td></tr>';
        $message .= '<tr><td valign="top"><div style="color:#888888; font-size: 14px; font-weight: bold;">Customer Phone:</div></td><td valign="top"><div style="color:#696767; font-size: 13px;">' . $phone . '</div></td></tr>';
        $message .= '<tr><td valign="top"><div style="color:#888888; font-size: 14px; font-weight: bold;">Customer Email:</div></td><td valign="top"><div style="color:#696767; font-size: 13px; ">' . $email . '</div></td></tr>';
        $message .= '<tr><td valign="top"><div style="color:#888888; font-size: 14px; font-weight: bold;">Installation Delivery Address:</div></td><td valign="top"><div style="color:#696767; font-size: 13px; ">' . $address1 . '</div></td></tr>';						
        $message .= '<tr><td valign="top"><div style="color:#888888; font-size: 14px; font-weight: bold;">Note:</div></td> <td valign="top"><div style="color:#696767; font-size: 13px; ">' . $note . '</div></td></tr>';
        $message .= '<tr><td valign="top"><div style="color:#888888; font-size: 14px; font-weight: bold;">IBO Name: </div></td><td valign="top"><div style="color:#696767; font-size: 13px; ">' . $ibo_detail['ibo_first_name']  .' '. $ibo_detail['ibo_last_name'] .'</div></td></tr>';
        $message .= '<tr><td valign="top"><div style="color:#888888; font-size: 14px; font-weight: bold;">IBO Phone: </div></td><td valign="top"><div style="color:#696767; font-size: 13px; ">' . $ibo_detail['ibo_mobile']  . '</div></td></tr>';
        $message .= '<tr><td valign="top"><div style="color:#888888; font-size: 14px; font-weight: bold;">IBO Site Url: </div></td><td valign="top"><div style="color:#696767; font-size: 13px; ">' . $url . '</div></td></tr>';
        $message .= '</table>';
        $message .= '<div style="background: #e6e5e5; padding: 10px; margin-top: 30px; text-align: center;">';
        $message .= '<h3 style="color: #003751; margin-top: 5px; margin-bottom: 10px;">ibo.lk</h3>';
        $message .= '<p style="margin: 0px; font-size: 12px; color: #4e4d4d;">IBO.LK<br> 446, <br> Galle Rd, <br> Ratmalana</p>';
        $message .= '<p style="margin-bottom: 0px; margin-top: 5px; font-size: 12px; color: #4e4d4d;">011 3 010005</p>';
        $message .= '</div>';
        $message .= '</body></html>';

        $mail = mail($to, $subject, $message, $headers);


    }

?>