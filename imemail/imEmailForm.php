<?php
if(substr(basename($_SERVER['PHP_SELF']), 0, 11) == "imEmailForm") {
	include '../res/x5engine.php';
	$form = new ImForm();
	$form->setField('Your Name', $_POST['imObjectForm_2_1'], '', false);
	$form->setField('Organization / Company Name', $_POST['imObjectForm_2_2'], '', false);
	$form->setField('Email Address', $_POST['imObjectForm_2_3'], '', false);
	$form->setField('Contact Number ', $_POST['imObjectForm_2_4'], '', false);
	$form->setField('Fax', $_POST['imObjectForm_2_5'], '', false);
	$form->setField('Address', $_POST['imObjectForm_2_6'], '', false);
	$form->setField('City', $_POST['imObjectForm_2_7'], '', false);
	$form->setField('Country', $_POST['imObjectForm_2_8'], '', false);
	$form->setField('Postal Code', $_POST['imObjectForm_2_9'], '', false);
	$form->setField('Please Describe Your Requirement', $_POST['imObjectForm_2_10'], '', false);

	if(@$_POST['action'] != 'check_answer') {
		if(!isset($_POST['imJsCheck']) || $_POST['imJsCheck'] != 'EB9F09441DB5443455284F7B9B256278' || (isset($_POST['imSpProt']) && $_POST['imSpProt'] != ""))
			die(imPrintJsError());
		$form->mailToOwner('info@naturefreshlanka.com', 'info@naturefreshlanka.com', 'Customer Inquiries', '', false);
		@header('Location: ../contact-us.html');
		exit();
	} else {
		echo $form->checkAnswer(@$_POST['id'], @$_POST['answer']) ? 1 : 0;
	}
}

// End of file