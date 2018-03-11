<?php

session_start();
require 'mysql_conf.php';

	$method = $_POST['m'];
	
	if(isset($method)) {
		$method($temp);
	}


	function flag(){
		$a_name = $_POST['a_name'];
		$sql = 'select a_name from pro_a where a_name=\''.$a_name.'\' union all select a_name from pro_c where a_name=\''.$a_name.
				'\' union all select a_name from pro_d where a_name=\''.$a_name.'\' union all select a_name from pro_s where a_name=\''.$a_name.'\'';
		$query = mysql_query($sql);
		if(mysql_num_rows($query)){
			$flag = array(
				'flag' => 1
			);
			echo json_encode($flag);
			
		}else{
			$flag = array(
				'flag' => 0
			);
			echo json_encode($flag);

		}
	}

	//正则检测合法性
	function z_match($str,$preg){
		return preg_match_all($preg,$str)?true:false;
	}

	function set_infor(){//参赛信息入库



		$type = $_POST['type'];
		$u_name = $_POST['u_name'];
		$a_name = $_POST['a_name'];
		$url = $_POST['url'];
		$manager = $_POST['manager'];
		$m_phone = $_POST['m_phone'];
		$m_class = $_POST['m_class'];
		$m_id = $_POST['m_id'];
	
		$employ = $_POST['admin'];
		
		$time = $_POST['time'];
		$b_position = $_POST['b_position'];
		$u_position = $_POST['u_position'];
		$d_position = $_POST['d_position'];
		$a_position = $_POST['a_position'];
		$flager = $_POST['flag'];
		$ticket = $_POST['ticket'];
		$tip = $_POST['tip'];

		$preg_1 = '/^[.\s\S]{1,20}$/';//网站名称
		$preg_2 = '/^[.\s\S]{1,30}$/';//单位名称
		//$preg_3 = '/^(http|https):\/\/([\w-]+\.)+[\w-]+(\/[\w-./?%&=]*)?$|^[a-zA-Z]{1}[-_a-zA-Z0-9]{5,19}$|^[\u4e00-\u9fa5]{1,20}$/';//url或微信号
		$preg_3 = '/^[.\s\S]{1,50}$/';
		$preg_4 = '/^[.\s\S]{1,20}$/';//负责人姓名
		$preg_5 = '/^[.\s\S]{1,10}$/';//学号
		$preg_6 = '/^[.\s\S]{1,20}$/';//部门|班级
		$preg_7 = '/^[.\s\S]{1,11}$/';//联系方式
		$preg_8 = '/^[.\s\S]{1,1000}$/';//介绍


		//再次验证唯一性
		$sql = 'select a_name from pro_a where a_name=\''.$a_name.'\' union all select a_name from pro_c where a_name=\''.$a_name.
				'\' union all select a_name from pro_d where a_name=\''.$a_name.'\' union all select a_name from pro_s where a_name=\''.$a_name.'\'';
		$query = mysql_query($sql);
		if(mysql_num_rows($query)){
			echo json_encode("already exist");
			
		}else{
			


		//if(z_match($u_name,$preg_1)&&z_match($a_name,$preg_2)&&z_match($url,$preg_3)&&z_match($manager,$preg_4)&&z_match($m_phone,$preg_7)&&z_match($m_class,$preg_6)&&z_match($m_id,$preg_5)&&z_match($b_position,$preg_8)&&z_match($u_position,$preg_8)&&z_match($d_position,$preg_8)&&z_match($a_position,$preg_8)){

			if($type == 1){//互联网应用组
			$sql = 'insert into pro_a(u_name,a_name,url,manager,m_phone,m_class,m_id,time,b_position,u_position,d_position,a_position,flag) values(\''.$u_name.'\',\''.$a_name.'\',\''.$url.'\',\''.$manager.'\',\''.$m_phone.'\',\''.$m_class.'\',\''.$m_id.'\',\''.$time.'\',\''.$b_position.'\',\''.$u_position.'\',\''.$d_position.'\',\''.$a_position.'\','.$flager.')';
		}else if($type == 2){//特色网站组
			$sql = 'insert into pro_s(u_name,a_name,url,manager,m_phone,m_class,m_id,time,b_position,u_position,d_position,a_position,flag) values(\''.$u_name.'\',\''.$a_name.'\',\''.$url.'\',\''.$manager.'\',\''.$m_phone.'\',\''.$m_class.'\',\''.$m_id.'\',\''.$time.'\',\''.$b_position.'\',\''.$u_position.'\',\''.$d_position.'\',\''.$a_position.'\','.$flager.')';
		}else if($type == 3){//学院组
			$sql = 'insert into pro_c(u_name,a_name,url,manager,m_phone,m_class,m_id,time,b_position,u_position,d_position,a_position,flag) values(\''.$u_name.'\',\''.$a_name.'\',\''.$url.'\',\''.$manager.'\',\''.$m_phone.'\',\''.$m_class.'\',\''.$m_id.'\',\''.$time.'\',\''.$b_position.'\',\''.$u_position.'\',\''.$d_position.'\',\''.$a_position.'\','.$flager.')';
		}else if($type == 4){//部门组
			$sql = 'insert into pro_d(u_name,a_name,url,manager,m_phone,m_class,m_id,time,b_position,u_position,d_position,a_position,flag) values(\''.$u_name.'\',\''.$a_name.'\',\''.$url.'\',\''.$manager.'\',\''.$m_phone.'\',\''.$m_class.'\',\''.$m_id.'\',\''.$time.'\',\''.$b_position.'\',\''.$u_position.'\',\''.$d_position.'\',\''.$a_position.'\','.$flager.')';
		}

		$num = $employ[count($employ)-1];
		for($i=0;$i<$num;$i++){
			$e_sql = "insert into employ(e_name,e_num,e_class,a_name,type) values('".$employ[0][$i]."','".$employ[1][$i]."','".$employ[2][$i]."','$a_name',$type)";
			if($query = mysql_query($e_sql)){
				$flag = array(
		            'flag' => "ok"
		          );
		        echo json_encode($flag);
			}else{
				$flag = array(
		            'flag' => "error09"
		          );
		        echo json_encode($flag);
			}
		}
		
		if($query = mysql_query($sql)){
			$flag = array(
            'flag' => "ok"
          );
        echo json_encode($flag);
		}else{
			$flag = array(
            'flag' => "error02"
          );
        echo json_encode($flag);
		}

		// }else{
		// 	//echo $employ.'<br>';
		// 	$flag = array(
  //           'flag' => "invaild form"
  //         );
  //       echo json_encode($flag);
		// }

		}
		
	}