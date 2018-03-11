<?php	
	$client_id = '8204b9e5899d0855bceaea721e944284a60ea5ce7f7473ca30c2dd88f6a25412';  
	$secret    = 'c774bb5128185aec7e3d015f164652ef5a52feb093ea880230d2094abdaddd6a'; 

	$url = 'https://zypc.xupt.edu.cn/oauth/authorize?client_id='.$client_id.'&response_type=code&redirect_uri=http%3A%2F%2Fwzpb.xupt.org%2Fadmin%2Foauth.php&secret='.$secret;
   	header('Location:'.$url);