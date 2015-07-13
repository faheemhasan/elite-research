<?php include('Crypto.php') ?>
<?php

//	error_reporting(0);
	
	$workingKey='5D506FFB912F04ECA517E1573B95D95A';		//Working Key should be provided here.
	$encResponse=$_POST["encResp"];			//This is the response sent by the CCAvenue Server
	$rcvdString=decrypt($encResponse,$workingKey);		//Crypto Decryption used as per the specified working key.
	$order_status="";
	$decryptValues=explode('&', $rcvdString);
	$dataSize=sizeof($decryptValues);

	for($i = 0; $i < $dataSize; $i++){
		$information=explode('=',$decryptValues[$i]);
		if($i==3)	$order_status=$information[1];
	}

	if($order_status==="Success"){
		$redirect = 'http://eliteresearch.co/payment?status=success';
	}else if($order_status==="Aborted"){
		$redirect = 'http://eliteresearch.co/payment?status=aborted';
	}else if($order_status==="Failure"){
		$redirect = 'http://eliteresearch.co/payment?status=failure';
	}else{
		$redirect = 'http://eliteresearch.co/payment?status=security';
	}

	// this informations are about transaction
	// for($i = 0; $i < $dataSize; $i++) {
	// 	$information=explode('=',$decryptValues[$i]);
	//     	echo '<tr><td>'.$information[0].'</td><td>'.$information[1].'</td></tr>';
	// }

?>

<script>
	window.location.href = "<?php echo $redirect; ?>";
</script>