<?php
	session_start();

	$client_id = '8204b9e5899d0855bceaea721e944284a60ea5ce7f7473ca30c2dd88f6a25412';  
	$secret    = 'c774bb5128185aec7e3d015f164652ef5a52feb093ea880230d2094abdaddd6a'; 

	

    $code = $_GET["code"];
   
    $get_token_url = 'https://zypc.xupt.edu.cn/oauth/token';
    $post_data = 'grant_type=authorization_code&code='.$code.'&redirect_uri=http%3A%2F%2Fwzpb.xupt.org%2Fadmin%2Foauth.php';
    
    $ch = curl_init();  
	curl_setopt($ch,CURLOPT_URL,$get_token_url);  
	curl_setopt($ch,CURLOPT_HEADER,0);  
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1 );  
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
	curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
	curl_setopt($ch, CURLOPT_USERPWD, $client_id.':'.$secret);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER , false);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST , false);
	$res = curl_exec($ch);  
	//print_r($ch);
	
	curl_close($ch);

	$json_obj = json_decode($res,true);

	$access_token = $json_obj['access_token'];

	$get_user_info_url = 'https://zypc.xupt.edu.cn/oauth/userinfo?access_token='.$access_token.'&client_id='.$client_id.'&secret='.$secret;

	$ch = curl_init();  
	curl_setopt($ch,CURLOPT_URL,$get_user_info_url);  
	curl_setopt($ch,CURLOPT_HEADER,0);  
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1 );  
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10); 
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER , false);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST , false);
	$res = curl_exec($ch);  
	//echo curl_error($ch);
	curl_close($ch);

	
	$user_info = json_decode($res,true);

	$_SESSION['username'] = $user_info['username'];
	$_SESSION['sex'] = $user_info['sex'];
	$_SESSION['group'] = $user_info['group'];
	$_SESSION['student_no'] = $user_info['student_no'];
	if($_SESSION['group'] == "student")
		$_SESSION['realname'] = $user_info['realname'];
	

	
	//echo var_dump($user_info);
	header('Location:admin.html');
