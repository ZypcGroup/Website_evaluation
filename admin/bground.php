<?php

session_start();

require '../mysql_conf.php';

if(!isset($_SESSION['username'])||empty($_SESSION['username'])){
                header('location:login.php');
        }else if($_SESSION['group'] == 'member' || $_SESSION['group'] == 'teacher'){
        	

	$method = $_POST['m'];
	
	if(isset($method)) {
		$method($temp);
	}

}else{
	echo json_encode("no authority");
}

	function select_msg(){
		$a_name = $_POST['a_name'];
		$type = $_POST['type'];

		$sql_1 = 'select count(1) from vote where name=\''.$a_name.'\' and voter_type=1';//老师投票数
		$sql_2 = 'select count(1) from vote where name=\''.$a_name.'\' and voter_type=0';//学生投票数
		$query_1 = mysql_query($sql_1);
		$query_2 = mysql_query($sql_2);
		

		if($type == 1){
			$sql_3 = 'select * from pro_a where a_name=\''.$a_name.'\'';	
		}else if($type == 2){
			$sql_3 = 'select * from pro_s where a_name=\''.$a_name.'\'';
		}else if($type == 3){
			$sql_3 = 'select * from pro_c where a_name=\''.$a_name.'\'';
		}else if($type == 4){
			$sql_3 = 'select * from pro_d where a_name=\''.$a_name.'\'';
		}
		
		if($query_3 = mysql_query($sql_3)){

			$res_1 = mysql_fetch_row($query_1);
			$res_2 = mysql_fetch_row($query_2);
			$msg = mysql_fetch_assoc($query_3);

			$t_ticket = $res_1[0];
			$s_ticket = $res_2[0];

			$arr = array(
				't_ticket' => $t_ticket,
				's_ticket' => $s_ticket,
				'msg' => $msg
			);


			echo json_encode($arr);
		}else{
			echo json_encode("fetch error");
		}

		
	}

	function delete(){
		$a_name = $_POST['a_name'];
		$type = $_POST['type'];
		$dir = '/opt/wzpb/data/'.$a_name;

		if($type == 1){
			$sql = 'delete from pro_a where a_name=\''.$a_name.'\'';
		}else if($type == 2){
			$sql = 'delete from pro_s where a_name=\''.$a_name.'\'';
		}else if($type == 3){
			$sql = 'delete from pro_c where a_name=\''.$a_name.'\'';
		}else if($type == 4){
			$sql = 'delete from pro_d where a_name=\''.$a_name.'\'';
		}

		if($query = mysql_query($sql) && deldir($dir)){
			echo json_encode("ok");
		}else{
			echo json_encode("delete error");
		}

	}

	function deldir($dir) {
	  //先删除目录下的文件：
	  $dh=@opendir($dir);
	  while ($file=@readdir($dh)) {
	    if($file!="." && $file!="..") {
	      $fullpath=$dir."/".$file;
	      if(!is_dir($fullpath)) {
	          unlink($fullpath);
	      } else {
	          deldir($fullpath);
	      }
	    }
	  }
	 
	  @closedir($dh);
	  //删除当前文件夹：
	  if(@rmdir($dir)) {
	    return true;
	  } else {
	    return false;
	  }
	}

	function modify(){
		$a_name = $_POST['a_name'];
		$type = $_POST['type'];
		$change = $_POST['change'];

		if($change == 0){
			if($type == 1){
				$sql = 'update pro_a set deline=1 where a_name=\''.$a_name.'\'';
			}else if($type == 2){
				$sql = 'update pro_s set deline=1 where a_name=\''.$a_name.'\'';
			}else if($type == 3){
				$sql = 'update pro_c set deline=1 where a_name=\''.$a_name.'\'';
			}else if($type == 4){
				$sql = 'update pro_d set deline=1 where a_name=\''.$a_name.'\'';
			}

			if($query = mysql_query($sql)){
				$flag = array(
						'flag' => 1
					);
					echo json_encode($flag);
			}else{
				echo json_encode("modify error1");
			}
		}else if($change == 1){
			if($type == 1){
				$sql = 'update pro_a set deline=0 where a_name=\''.$a_name.'\'';
			}else if($type == 2){
				$sql = 'update pro_s set deline=0 where a_name=\''.$a_name.'\'';
			}else if($type == 3){
				$sql = 'update pro_c set deline=0 where a_name=\''.$a_name.'\'';
			}else if($type == 4){
				$sql = 'update pro_d set deline=0 where a_name=\''.$a_name.'\'';
			}

			if($query = mysql_query($sql)){
				$flag = array(
						'flag' => 0
					);
					echo json_encode($flag);
			}else{
				echo json_encode("modify error2");
			}
		}
		
	}

	function get_ascd(){
   		$type = $_POST['type'];
   	
   		if($type == 1){
   			$sql = 'select * from pro_a';
   			$csql = 'select count(*) from pro_a';
   		}else if($type == 2){
   			$sql = 'select * from pro_s';
   			$csql = 'select count(*) from pro_s';
   		}else if($type == 3){
			$sql = 'select * from pro_c';
			$csql = 'select count(*) from pro_c';
   		}else if($type == 4){
			$sql = 'select * from pro_d';
			$csql = 'select count(*) from pro_d';
   		}
 
   		if($res = mysql_query($sql)){
   			 $count = mysql_num_rows($res);
   			
   			for($i=0;$i<$count;$i++){
   				$result[$i] = mysql_fetch_assoc($res);
   			}
   			echo json_encode($result);
   		}else{
   			echo json_encode("select error");
   		}

   	}

   	function update_msg(){

   		$type = $_POST['type'];
   		$a_name = $_POST['a_name'];

   		$u_name = $_POST['u_name'];
		$url = $_POST['url'];
		$manager = $_POST['manager'];
		$m_phone = $_POST['m_phone'];
		$m_class = $_POST['m_class'];
		$m_id = $_POST['m_id'];
		$time = $_POST['time'];
		$b_position = $_POST['b_position'];
		$u_position = $_POST['u_position'];
		$d_position = $_POST['d_position'];
		$a_position = $_POST['a_position'];
		$flag = $_POST['flag'];

		
			//更新操作
		if($type == 1){
			$sql = "update pro_a set u_name='$u_name',url='$url',manager='$manager',m_phone='$m_phone',m_class='$m_class',m_id='$m_id',time='$time',b_position='$b_position',u_position='$u_position',d_position='$d_position',a_position='$a_position',flag='$flag' where a_name='$a_name'";
		}else if($type == 2){                                      
			$sql = "update pro_s set u_name='$u_name',url='$url',manager='$manager',m_phone='$m_phone',m_class='$m_class',m_id='$m_id',time='$time',b_position='$b_position',u_position='$u_position',d_position='$d_position',a_position='$a_position',flag='$flag' where a_name='$a_name'";
		}else if($type == 3){
			$sql = "update pro_c set u_name='$u_name',url='$url',manager='$manager',m_phone='$m_phone',m_class='$m_class',m_id='$m_id',time='$time',b_position='$b_position',u_position='$u_position',d_position='$d_position',a_position='$a_position',flag='$flag' where a_name='$a_name'";
		}else if($type == 4){
			$sql = "update pro_d set u_name='$u_name',url='$url',manager='$manager',m_phone='$m_phone',m_class='$m_class',m_id='$m_id',time='$time',b_position='$b_position',u_position='$u_position',d_position='$d_position',a_position='$a_position',flag='$flag' where a_name='$a_name'";
		}
		echo $sql;
		if($query = mysql_query($sql)){
			echo json_encode("update ok");
		}else{
			echo json_encode("update error");
		}

   	}

   	function update_img(){

		$dirname = $_POST['n'];
		$type = $_POST['type']; 

		$addr = '/opt/wzpb/data/';
		$real = '/data/';

		// if(deldir($addr.$dirname)){
		// 	echo json_encode("del ok");
		// }else{
		// 	echo json_encode("del dir not exist");
		// }
		deldir($addr.$dirname);

		if(!file_exists($addr.$dirname)){
		  mkdir($addr.$dirname);
		  chmod($addr.$dirname,0777);
		}

		$save_addr = $addr.$dirname."/".$_FILES["file"]["name"];

		 if (($_FILES["file"]["type"] == "image/jpeg")//支持JPG,png,gif
		 || ($_FILES["file"]["type"] == "image/gif")
		 || ($_FILES["file"]["type"] == "image/png")
		 // || ($_FILES["file"]["type"] == "video/x-msvideo")//支持avi,mp4,rmvb格式
		 // || ($_FILES["file"]["type"] == "video/mp4")
		 // || ($_FILES["file"]["type"] == "audio/x-pn-realaudio")
		 && ($_FILES["file"]["size"] < 1024*1024*10))//大小不能超过10M
		  {
		    
		  if ($_FILES["file"]["error"] > 0)
		    {
		    
		    $flag = array(
						'flag' => "Return Code: " . $_FILES["file"]["error"] . "<br />"
					);
		      echo json_encode($flag);
		    }
		  else
		    {
		    // echo "Upload: " . $_FILES["file"]["name"] . "<br />";
		    // echo "Type: " . $_FILES["file"]["type"] . "<br />";
		    // echo "Size: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";
		    // echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br />";

		    if (file_exists("/opt/wzpb/data/" .$dirname.'/'. $_FILES["file"]["name"]))
		      {
		      	$flag = array(
						'flag' => $_FILES["file"]["name"] . " already exists. "
					);
		      echo json_encode($flag);
		      }
		    else
		      {
		      move_uploaded_file($_FILES["file"]["tmp_name"],$save_addr);
		      //echo "Stored in: " . $save_addr;

		      $real = $real.$dirname."/".$_FILES["file"]["name"];
		      //路径存入数据库
		      if($type == 1){
		        $sql = 'update pro_a set img_addr=\''.$real.'\' where a_name=\''.$dirname.'\'';
		      }else if($type == 2){
		        $sql = 'update pro_s set img_addr=\''.$real.'\' where a_name=\''.$dirname.'\'';
		      }else if($type == 3){
		        $sql = 'update pro_c set img_addr=\''.$real.'\' where a_name=\''.$dirname.'\'';
		      }else if($type == 4){
		        $sql = 'update pro_d set img_addr=\''.$real.'\' where a_name=\''.$dirname.'\'';
		      }
		      if($query = mysql_query($sql)){
		      	$flag = array(
						'flag' => "ok"
					);
		        echo $flag;
		      }else{
		        //echo $sql.'<br>';
		        //echo mysql_error();
		        $flag = array(
						'flag' => "error03"
					);
		        echo json_encode($flag);
		      }

		      }
		      }
		    }
		else
		  {
		  	$flag = array(
						'flag' => "Invalid file"
					);
		  echo json_encode($flag);
		  }
	}