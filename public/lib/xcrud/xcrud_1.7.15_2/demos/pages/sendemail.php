<?php
$xcrud = Xcrud::get_instance();

$to = "text_xcrud@mailinator.com";
$subject = "Willow Way Tutoring";

ob_start();
include 'template.php'; //execute the file as php
$emailBody = ob_get_clean();

$xcrud->send_email_public($to, $subject, $emailBody, $cc = array(), true);

//echo $xcrud->render();	

?>