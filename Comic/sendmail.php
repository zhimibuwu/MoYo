<?php
$to_address = $_POST['to_address'];
$from_address = $_POST['from_address'];
$subject = $_POST['subject'];
$message = $_POST['message'];

$headers = array();
$headers = 'MIME-Version: 1.0';
$headers = 'Content-type: text/html; charset=iso-8859-1';
$headers = 'Content-Transfer-Encoding: 7bit';
$headers = 'From: ' . $from_address . "\r\n";
?>
<html>
	<head>
		<title>Mail Sent!</title>
	</head>
	<body>
	<?php 
	$success = mail($to_address, $subject, $message, join("\r\n",$headers));
	if ($success) {
		echo '<h1>Congratulations!</h1>';
		echo '<p>The following message has been sent: <br/><br/>';
		echo '<b>To:</b> ' . $to_address . '<br/>';
		echo '<b>From:</b> ' . $from_address . '<br/>';
		echo '<b>Subject:</b> ' . $subject . '<br/>';
		echo '<b>Message:</b></p>';
		echo nl2br($message);
	} else {
		echo '<p><strong>There was an error sending your message.</strong></p>';
	}
	?>
</body>
</html>