 <?php 
//print_r($_POST);  exit;
if(isset($_POST['weinqValid']) && $_POST['weinqValid'] == 'validData' && isset($_POST['wespmCheckr']) && $_POST['wespmCheckr'] == '')
{

     /**************** Get current URL ***************/
    $protocol = empty($_SERVER['HTTPS']) ? 'http' : 'https';
    $domain = $_SERVER['SERVER_NAME'];
    $url = "${protocol}://${domain}";
    /**************** Get current URL ***************/
    
    require 'lib/PHPMailerAutoload.php';
	
    $mail = new PHPMailer;
    $mail->isSMTP();
//    $mail->isMAIL();
    
    $mail->Host = "smtp.gmail.com";
	// $mail->SMTPDebug = 2;
    $mail->Port = 587;
	$mail->SMTPSecure = 'tls';
    $mail->SMTPAuth = true;
    $mail->Username = "garima294@mail.com"; 
    $mail->Password = "oneplus16";  
    
    $mail->setFrom('garima294@mail.com', $_POST['name']);
    $mail->addReplyTo($_POST['email'], $_POST['name']);
	$mail->addAddress('garima294@mail.com');
//	$mail->AddBCC('garima@ifwworld.com');
    
    $mail->Subject = sprintf('Enquiry - %s', $_POST['name']);
    
    $content = '<html><body>';
    $content .= '<table border="0" cellpadding="0" cellspacing="1" style="font:normal 13px arial; width:100%; max-width:750px;">';
	
    $content .= '<tr><td colspan="2" align="center" style="border:1px solid #bb8525; background:#bb8525;"><h2 style="color:#fff; margin:8px 0;">Enquiry Details</h2></td></tr></br>';
    $content .= '<tr><td style="border:1px solid #e8e8e8; padding:10px; color:#444; background:#f9f9f9;"><strong>Name</strong></td><td style="border:1px solid #e8e8e8; padding:10px;">&nbsp;'.$_POST['name'].'</td></tr></br>';
    $content .= '<tr><td style="border:1px solid #e8e8e8; padding:10px; color:#444; background:#f9f9f9;"><strong>Email</strong></td><td style="border:1px solid #e8e8e8; padding:10px;">&nbsp;'.$_POST['email'].'</td></tr></br>';
	
	$content .= '<tr><td style="border:1px solid #e8e8e8; padding:10px; color:#444; background:#f9f9f9;"><strong>Message</strong></td><td style="border:1px solid #e8e8e8; padding:10px;">&nbsp;'.$_POST['message'].'</td></tr></br>';
    $content .= '</table>';
    $content .= '<br /><br /><strong>Regards</strong><br />'.$_POST['name'];
    $content .= '</body></html>';
    $content .= '</body></html>';
    
    $mail->msgHTML($content);
    
    if(!$mail->send())
    {
        echo '<div class="alert alert-danger" role="alert" id="error_message">Failed <i class="fa fa-thumbs-down"></i></div>';
    }
    else
    {
		
        echo '<div class="alert alert-success" role="alert" id="success_message">Thanks! Your details have been submitted.</div>';
    }
}