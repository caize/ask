<?php
require("class.phpmailer.php");

$mail = new PHPMailer();

$mail->IsSMTP();                   // ����ʹ�� SMTP
$mail->Host = "61.172.255.101";          // ָ���� SMTP ��������ַ
$mail->SMTPAuth = true;                // ����Ϊ��ȫ��֤��ʽ
$mail->Username = "service@kaible.com";             // SMTP ���ʼ��˵��û���
$mail->Password = "kaibleservice";             // SMTP ����

$mail->From = "service@kaible.com";
$mail->FromName = "������";
$mail->AddAddress("xiahui@kaible.com");
//$mail->AddAddress("terryxiahui@yahoo.com.cn","dalilng");
//$mail->AddAddress("xiahui@kaible.com","daling");  // ��ѡ
//$mail->AddReplyTo("xiahui@kaible.com", "TERRY2");

$mail->WordWrap = 50;                 // set word wrap to 50 characters
//$mail->AddAttachment("/var/tmp/file.tar.gz");     // �Ӹ���
//$mail->AddAttachment("/tmp/image.jpg", "new.jpg");  // ������Ҳ��ѡ����������
$mail->IsHTML(true);                  // �����ʼ���ʽΪ HTML

$mail->Subject = "��Ѹ�ٸ��һ��ʼ�,��ô";     // ����
$mail->Body  = '<B>�ʼ�����Ϊ��</B>'; // ����
//$mail->AltBody = "This is the body in plain text for non-HTML mail clients"; // ��������

if(!$mail->Send())
{
  echo "Message could not be sent. <p>";
  echo "Mailer Error: " . $mail->ErrorInfo;
  exit;
}

echo "Message has been sent";
?>

