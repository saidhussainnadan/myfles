<!DOCTYPE html>
<html>
<head>
	<title>this is test paige</title>
</head>
<body>
	<form action="index.php" method="post">
		Enter Mobile number:<input type="number" name="cell"><br>
Enter Massege:<textarea cols="3" name="msg"></textarea><br>
<input type="submit" name="sub" value="SEND SMS">
</body>
	</form>
<?php

if(isset($_POST['sub'])){
	
        $_objSmsProtocolGsm = new Com("ActiveXperts.SmsProtocolGsm");
        $objMessage   = new Com ("ActiveXperts.SmsMessage");
		$objConstants = new Com ("ActiveXperts.SmsConstants");
       $device       = "GlobeTrotter GI4xx - Modem Interface";
		$speed        = "Default";
		$pincode      = "";
		$recipient    = "+92" . $_POST['cell'];
		$message      = $_POST['msg'];
		$unicode      = "";
		$_objSmsProtocolGsm->Logfile = "C:\SMSMMSToolLog.txt";
		$objMessage->Clear();
				if( $recipient == "" ) die("No recipient address filled in."); 
		$objMessage->Recipient = $recipient;
		
		//fill in the messageformat
		if( $unicode != "" ) $objMessage->Format = $objConstants->asMESSAGEFORMAT_UNICODE;
		
		//fill in the message body
		$objMessage->Data = $message;
		
		//clear the gsm object
		$_objSmsProtocolGsm->Clear();
		
		//fill in the devicename
		$_objSmsProtocolGsm->Device = $device;
		
		//fill in the devicespeed
		if( $speed == "Default" ) $_objSmsProtocolGsm->DeviceSpeed = 0;
		if( $speed != "Default" ) $_objSmsProtocolGsm->DeviceSpeed = $speed;
		
		//fill in the pincode
		if( $pincode != "" ) $_objSmsProtocolGsm->EnterPin( $pincode );
		
		//send the message
		if( $_objSmsProtocolGsm->LastError == 0 ){
        	$_objSmsProtocolGsm->Send( $objMessage );
		}
		
		//get the results
		$LastError        = $_objSmsProtocolGsm->LastError;
		$ErrorDescription = $_objSmsProtocolGsm->GetErrorDescription( $LastError );

		


}
?>
</html>