<?php
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
function SendEmail($to,$subject,$body,$attachment='')
{
require_once('phpmailer.php');
$from = "asmakamel494@gmail.com";
ini_set("SMTP","ssl://smtp.gmail.com"); 
ini_set("smtp_port","465");
$fromName="XXXXX Adminstration";
$mail = new PHPMailer(true); // the true param means it will throw exceptions on errors, which we need to catch

$mail->IsSMTP(); // telling the class to use SMTP

try {
  $mail->Host       = "smtp.gmail.com"; // SMTP server
  $mail->SMTPDebug  = 1;                     // enables SMTP debug information (for testing)
  $mail->SMTPAuth   = true;                  // enable SMTP authentication
  $mail->SMTPSecure = 'ssl';
  $mail->Port       = 465;                    // set the SMTP port for the GMAIL server
  $mail->Username   = "asmakamel494@gmail.com"; // SMTP account username
  $mail->Password   = "pass";        // SMTP account password
 
  $mail->AddAddress($to, $to);
  $mail->SetFrom($from, $from);
  //$mail->AddReplyTo($from, $fromName);
  $mail->Subject = $subject;
  //$mail->AltBody = $body; // optional - MsgHTML will create an alternate automatically
  $mail->MsgHTML($body);
  $mail->CharSet='utf-8';
  //$mail->AddAttachment('images/phpmailer.gif');      // attachment
  //$mail->AddAttachment('images/phpmailer_mini.gif'); // attachment
  $mail->Send();
         echo "Message Sent OK</p>\n";
  //echo $e->getMessage(); //Boring error messages from anything else!
}


 catch (phpmailerException $e) {
  echo $e->errorMessage(); //Pretty error messages from PHPMailer
} 
}
?>

<table >
    <form name="enableForm" method="POST" accept-charset="utf-8">

	<tr>
		<th>Email sending to</th>
                <td>
                    <input type="text" name="em_sub"  required="" placeholder="Write Email Adress" id="em_sub">
                </td></tr>
        <tr>
		<th>Email Body</th>
                <td>
                    <textarea  rows="10" cols="40" placeholder="Write Email Content" name="em_b" id="em_b" required=""></textarea>
                   
                </td></tr>
       
        <tr><td colspan=2 align='center' width='195'> <input type='submit' name='Submit' value='Send Email' >

                </form>
</table><br><br>

