<?php 
function sendMail($title,$content,$address){
	require './Tool/PHPMailer/PHPMailerAutoload.php';

	$mail = new PHPMailer;

	//$mail->SMTPDebug = 3;                               // Enable verbose debug output

	$mail->isSMTP();                                      //使用smtp协议
	$mail->Host = 'smtp.163.com';  						  // stmp服务器地址
	$mail->SMTPAuth = true;                               // Enable SMTP authentication
	$mail->Username = 'kangkang4ever@163.com';            // SMTP username
	$mail->Password = 'kangbowen123456';                  // SMTP password
	//$mail->SMTPSecure = 'tls';                          // Enable TLS encryption, `ssl` also accepted
	//$mail->Port = 587;                                  // TCP port to connect to

	$mail->setFrom('kangkang4ever@163.com', '康博雯');
	//$mail->addAddress('joe@example.net', 'Joe User');   // Add a recipient
	$mail->addAddress($address);               // Name is optional
	// $mail->addReplyTo('info@example.com', 'Information');
	// $mail->addCC('cc@example.com');
	// $mail->addBCC('bcc@example.com');

	// $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
	// $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
	$mail->isHTML(true);                                  // Set email format to HTML

	$mail->Subject = $title;	//邮件主题
	$mail->Body    = $content;//邮件内容
	//$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';//当邮件主题内容不显示,显示这个内容

	if(!$mail->send()) {
	    return $mail->ErrorInfo;
	} else {
	    return true;
	}
}

//加盐加密函数
function salt($password,$salt){
	$salt = md5($salt);
	$salt = substr($salt,10,10);
	$salt = md5($salt);
	$salt = substr($salt,19,9);
	return md5($passwd.$salt);
}
//造盐函数
function makeSalt(){
	$salt = '';
	//定义随机长度
	$length = rand(4,8);
	//使用sprintf函数根据ascii码产生字符
	//sprintf('%c',ascii码值)
	//0-9 : 48-57
	//a-z : 97-122
	//A-Z : 65-90
	for($i=0;$i<$length;$i++){
		$temp = rand(1,3);
		switch($temp){
			case 1:
				$salt .= sprintf('%c',rand(48,57));
				break;
			case 2:
				$salt .= sprintf('%c',rand(97,122));
				break;
			case 3:
				$salt .= sprintf('%c',rand(65,90));
				break;	
		}
	}	
		return $salt;
}
 ?>