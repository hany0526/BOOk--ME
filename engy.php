<form action="sendmail.php" method="post">
<b>yourname:</b><input type="text"name="name"><br>
<b>your e-mail:</b><input type="text"name="e-mail"><br>
<b>message:</b><textarea name="message"></textarea><br>
<input type="submit" value="send">
<input type="reset" value="clear">
</form>

<?php
$name=$_post['name'];
$email=$_post['email'];
$message=$_post['message'];
$formcontent="visitor name=".$name ;
$recipient="you@yourdomain.com";
$subject="contact form";
$mailheader="form.$email\\r\\n";
$mailheader.="reply to.$email\\r\\n";
$mailheader.="mime-version:1.0\\r\\n";
 mail($recipient,$subject,$formcontent,$mailheader) or die("failure");
echo"thank you";