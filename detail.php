<?php
session_start();

require 'mysql_conf.php';

if(!isset($_SESSION['username'])||empty($_SESSION['username'])){
                header('location:login.php');
        }else{

	$method = $_POST['m'];
	
	if(isset($method)) {
		$method($temp);
	}

}

	// function flag(){
	// 	$a_name = $_POST['a_name'];
	// 	$sql = 'select a_name from pro_a where a_name=\''.$a_name.'\' union all select a_name from pro_c where a_name=\''.$a_name.
	// 			'\' union all select a_name from pro_d where a_name=\''.$a_name.'\' union all select a_name from pro_s where a_name=\''.$a_name.'\'';
	// 	$query = mysql_query($sql);
	// 	if(mysql_num_rows($query)){
	// 		$flag = array(
	// 			'flag' => 1
	// 		);
	// 		echo json_encode($flag);
			
	// 	}else{
	// 		$flag = array(
	// 			'flag' => 0
	// 		);
	// 		echo json_encode($flag);

	// 	}
	// }

	// //正则检测合法性
	// function z_match($str,$preg){
	// 	return preg_match($preg,$str)?true:false;
	// }

	// function set_infor(){//参赛信息入库


	// 	$type = $_POST['type'];
	// 	$u_name = $_POST['u_name'];
	// 	$a_name = $_POST['a_name'];
	// 	$url = $_POST['url'];
	// 	$manager = $_POST['manager'];
	// 	$m_phone = $_POST['m_phone'];
	// 	$m_class = $_POST['m_class'];
	// 	$m_id = $_POST['m_id'];
	
	// 	$employ = $_POST['admin'];
		
	// 	$time = $_POST['time'];
	// 	$b_position = $_POST['b_position'];
	// 	$u_position = $_POST['u_position'];
	// 	$d_position = $_POST['d_position'];
	// 	$a_position = $_POST['a_position'];
	// 	$flag = $_POST['flag'];
	// 	$ticket = $_POST['ticket'];
	// 	$tip = $_POST['tip'];

	// 	$preg_1 = '^[\u4E00-\u9FA5A-Za-z0-9_]{1,10}$';//网站名称
	// 	$preg_2 = '^[\u4E00-\u9FA5A-Za-z0-9_]{1,30}$';//单位名称
	// 	$preg_3 = '^http://([\w-]+\.)+[\w-]+(/[\w-./?%&=]*)?|[a-zA-Z]{1}[-_a-zA-Z0-9]{5,19}$';//url或微信号
	// 	$preg_4 = '^[\u4e00-\u9fa5]{1,10}$';//负责人姓名
	// 	$preg_5 = '^[0-9]{1,10}$';//学号
	// 	$preg_6 = '^[\u4e00-\u9fa50-9]{1,20}$';//部门|班级
	// 	$preg_7 = '^(13[0-9]|14[5|7]|15[0|1|2|3|5|6|7|8|9]|18[0|1|2|3|5|6|7|8|9])\d{8}$';//联系方式

	// 	if(z_match($u_name,$preg_1)&&z_match($a_name,$preg_2)&&z_match($url,$preg_3)&&z_match($manager,$preg_4)&&z_match($m_phone,$preg_7)&&z_match($m_class,$preg_6)&&z_match($m_id,$preg_5)){

	// 		if($type == 1){//互联网应用组
	// 		$sql = 'insert into pro_a(u_name,a_name,url,manager,m_phone,m_class,m_id,time,b_position,u_position,d_position,a_position,flag) values(\''.$u_name.'\',\''.$a_name.'\',\''.$url.'\',\''.$manager.'\',\''.$m_phone.'\',\''.$m_class.'\',\''.$m_id.'\',\''.$time.'\',\''.$b_position.'\',\''.$u_position.'\',\''.$d_position.'\',\''.$a_position.'\','.$flag.')';
	// 	}else if($type == 2){//特色网站组
	// 		$sql = 'insert into pro_s(u_name,a_name,url,manager,m_phone,m_class,m_id,time,b_position,u_position,d_position,a_position,flag) values(\''.$u_name.'\',\''.$a_name.'\',\''.$url.'\',\''.$manager.'\',\''.$m_phone.'\',\''.$m_class.'\',\''.$m_id.'\',\''.$time.'\',\''.$b_position.'\',\''.$u_position.'\',\''.$d_position.'\',\''.$a_position.'\','.$flag.')';
	// 	}else if($type == 3){//学院组
	// 		$sql = 'insert into pro_c(u_name,a_name,url,manager,m_phone,m_class,m_id,time,b_position,u_position,d_position,a_position,flag) values(\''.$u_name.'\',\''.$a_name.'\',\''.$url.'\',\''.$manager.'\',\''.$m_phone.'\',\''.$m_class.'\',\''.$m_id.'\',\''.$time.'\',\''.$b_position.'\',\''.$u_position.'\',\''.$d_position.'\',\''.$a_position.'\','.$flag.')';
	// 	}else if($type == 4){//部门组
	// 		$sql = 'insert into pro_d(u_name,a_name,url,manager,m_phone,m_class,m_id,time,b_position,u_position,d_position,a_position,flag) values(\''.$u_name.'\',\''.$a_name.'\',\''.$url.'\',\''.$manager.'\',\''.$m_phone.'\',\''.$m_class.'\',\''.$m_id.'\',\''.$time.'\',\''.$b_position.'\',\''.$u_position.'\',\''.$d_position.'\',\''.$a_position.'\','.$flag.')';
	// 	}

	// 	$num = $employ[count($employ)-1];
	// 	for($i=0;$i<$num;$i++){
	// 		$e_sql = "insert into employ(e_name,e_num,e_class,a_name,type) values('".$employ[0][$i]."','".$employ[1][$i]."','".$employ[2][$i]."','$a_name',$type)";
	// 		if($query = mysql_query($e_sql)){
	// 			echo json_encode("ok");
	// 		}else{
	// 			echo json_encode("error09");
	// 		}
	// 	}
		
	// 	if($query = mysql_query($sql)){
	// 		echo json_encode("ok");
	// 	}else{
	// 		echo json_encode("error02");
	// 	}

	// 	}else{
	// 		echo json_encode("invalid form");
	// 	}

		
		
	// }
		
	function set_employ(){
		$employ = $_POST['admin'];
		$arr = json_decode($employ);
		echo var_dump($arr);
	}

	function ident(){
		if($_SESSION['group']=='teacher'){
			$flag = array(
				'flag' => 0
			);
			echo json_encode($flag);
		}else{
			$flag = array(
				'flag' => 1
			);
			echo json_encode($flag);
		}
	}


	function get_sum(){

		$sql_1 = 'select count(1) from pro_a';
		$sql_2 = 'select count(1) from pro_s';
		$sql_3 = 'select count(1) from pro_c';
		$sql_4 = 'select count(1) from pro_d';
		$sql_5 = 'select count(1) from vote';
		$query_1 = mysql_query($sql_1);
		$query_2 = mysql_query($sql_2);
		$query_3 = mysql_query($sql_3);
		$query_4 = mysql_query($sql_4);
		$query_5 = mysql_query($sql_5);

		$all_pro[0] = mysql_fetch_row($query_1);
		$all_pro[1] = mysql_fetch_row($query_2);
		$all_pro[2] = mysql_fetch_row($query_3);
		$all_pro[3] = mysql_fetch_row($query_4);

		$all_ticket = mysql_fetch_row($query_5);
		$data = array(
			'all_pro' => $all_pro[0][0]+$all_pro[1][0]+$all_pro[2][0]+$all_pro[3][0],
			'all_ticket' => $all_ticket[0]
		);
		echo json_encode($data);
	}
	//请求展示页详细信息
	function get_infor(){
		$p = $_POST['p'];
		$type = $_POST['type'];

		$p = $_POST['p'];//若未设页数则默认第一页
		$page = 1;
		if(isset($p)){
			$page = $p;
		}

		$num = 6;
		if($type == 1){//分类取数据
			$sql = 'select img_addr,a_name,u_name,manager,ticket,type from pro_a where deline=1 order by ticket desc,id asc limit '.($page-1)*$num.','.$num;	
		}else if($type ==2){
			$sql = 'select img_addr,a_name,u_name,manager,ticket,type from pro_s where deline=1 order by ticket desc,id asc limit '.($page-1)*$num.','.$num;
		}else if($type ==3){
			$sql = 'select img_addr,a_name,u_name,manager,ticket,type from pro_c where deline=1 order by ticket desc,id asc limit '.($page-1)*$num.','.$num;
		}else if($type ==4){
			$sql = 'select img_addr,a_name,u_name,manager,ticket,type from pro_d where deline=1 order by ticket desc,id asc limit '.($page-1)*$num.','.$num;
		}

		if($query = mysql_query($sql)){
			if($temp = mysql_num_rows($query)){
				for($i=0;$i<$temp;$i++){
					$result[$i] = mysql_fetch_assoc($query);
				}
				echo json_encode($result);
			}else{
				$flag = array(
					'result' => false
				);
				echo json_encode($flag);
			}
			
		}else{
			echo json_encode("error04");
		}
	}

	//请求详细信息
	function get_detail(){
		$a_name = $_POST['a_name'];
		$type = $_POST['type'];

		if($type == 1){//分类取数据
			$sql = 'select img_addr,a_name,manager,u_name,url,b_position,u_position,d_position,a_position from pro_a where a_name=\''.$a_name.'\'';	
		}else if($type == 2){
			$sql = 'select img_addr,a_name,manager,u_name,url,b_position,u_position,d_position,a_position from pro_s where a_name=\''.$a_name.'\'';
		}else if($type == 3){
			$sql = 'select img_addr,a_name,manager,u_name,url,b_position,u_position,d_position,a_position from pro_c where a_name=\''.$a_name.'\'';
		}else if($type == 4){
			$sql = 'select img_addr,a_name,manager,u_name,url,b_position,u_position,d_position,a_position from pro_d where a_name=\''.$a_name.'\'';
		}

		if($query = mysql_query($sql)){
			$result = mysql_fetch_assoc($query);
			echo json_encode($result);
		}else{
			echo json_encode("error04");
		}
	}
	
	//初始化投票人票数
	function init_ticket(){

		// //假数据
		// $flag = 1;
		// if($flag == 1){
		// 	$_SESSION['group'] = 'teacher';
		// 	$_SESSION['username'] = '吕老师';
		// }else{
		// 	$_SESSION['group'] = 'student';
		// 	$_SESSION['username'] = '王沛楠';
		// }

		if($_SESSION['group'] == 'teacher'){
			$sql = 'select t_name from teacher_ticket where t_name=\''.$_SESSION['username'].'\'';
		}else{
			$sql = 'select s_name from student_ticket where s_name=\''.$_SESSION['username'].'\'';
		}

		if($query = mysql_query($sql)){
			if(!mysql_num_rows($query)){
				if($_SESSION['group'] == 'teacher'){
					//$sql = 'insert into teacher_ticket(t_name,a_ticket,s_ticket,c_ticket,d_ticket) values(\''.$_SESSION['username'].'\',1,1,6,7)';
					//展示时暂时关闭投票，初始化票数为0
					$sql = 'insert into teacher_ticket(t_name,a_ticket,s_ticket,c_ticket,d_ticket) values(\''.$_SESSION['username'].'\',0,0,0,0)';
				}else{
					//$sql = 'insert into student_ticket(s_name,a_ticket,s_ticket) values(\''.$_SESSION['username'].'\',1,1)';
					//展示时暂时关闭投票，初始化票数为0
					$sql = 'insert into student_ticket(s_name,a_ticket,s_ticket) values(\''.$_SESSION['username'].'\',0,0)';
				}
				
				if($query = mysql_query($sql)){
					echo $_SESSION['username'];
					echo json_encode("initok");
				}else{
					echo json_encode("error12");
				}
			}
		}else{
			//echo $sql;
			echo json_encode("error11");
		}

	}

	
	//获取名次
	function get_rank(){
		$type = $_POST['type'];
		$a_name = $_POST['a_name'];
		if($type == 1){
			$sql = "select count(1) as rank from pro_a where deline=1 and ticket > (select ticket from pro_a where deline=1 and a_name='".$a_name."')";
		}else if($type == 2){
			$sql = "select count(1) as rank from pro_s where deline=1 and ticket > (select ticket from pro_s where deline=1 and a_name='".$a_name."')";
		}else if($type == 3){
			$sql = "select count(1) as rank from pro_c where deline=1 and ticket > (select ticket from pro_c where deline=1 and a_name='".$a_name."')";
		}else if($type == 4){
			$sql = "select count(1) as rank from pro_d where deline=1 and ticket > (select ticket from pro_d where deline=1 and a_name='".$a_name."')";
		}
		if($query = mysql_query($sql)){
			
			$result = mysql_fetch_assoc($query);
				$rank = array(
					'rank' => $result['rank']+1
				);
			echo json_encode($rank);
		}else{
			echo json_encode("error06");
		}

	}

	function teac_vote(){
		//检测是否已用完票数

		$a_name = $_POST['a_name'];
		$type = $_POST['type'];
		
		// //假数据
		// $flage = 1;
		// if($flage == 1){
		// 	$_SESSION['group'] = 'teacher';
		// 	$_SESSION['username'] = '吕老师';
		// }else{
		// 	$_SESSION['group'] = 'student';
		// 	$_SESSION['username'] = '王沛楠';
		// }

		if($_SESSION['group'] == 'teacher'){//老师部分
			if($type == 1){
				$sql = 'select a_ticket from teacher_ticket where t_name=\''.$_SESSION['username'].'\'';
			}else if($type == 2){
				$sql = 'select s_ticket from teacher_ticket where t_name=\''.$_SESSION['username'].'\'';
			}else if($type == 3){
				$sql = 'select c_ticket from teacher_ticket where t_name=\''.$_SESSION['username'].'\'';
			}else if($type == 4){	
				$sql = 'select d_ticket from teacher_ticket where t_name=\''.$_SESSION['username'].'\'';
			}

			if($query = mysql_query($sql)){
				$result = mysql_fetch_row($query);

				if($result[0] == 0){
					$flag = array(
						'flag' => 0//用完且不能投票
					);
					echo json_encode($flag);
				}else{
					if(!$temp = check_vote($a_name)){
						$flag = array(
							'flag' => 1//未用完可以投票
						);
						echo json_encode($flag);
					}else{
						$flag = array(
							'flag' => 0//未用完但已投过该项目不能投票
						);
						echo json_encode($flag);
					}
					
				}
			}else{
				echo json_encode("error05");
			}

		}else{//学生部分
			 
			if($type == 1){
				$sql = 'select a_ticket from student_ticket where s_name=\''.$_SESSION['username'].'\'';
			}else if($type == 2){
				$sql = 'select s_ticket from student_ticket where s_name=\''.$_SESSION['username'].'\'';
			}else{
				$flag = array(
					'flag' => 0//不能投票
				);
				echo json_encode($flag);
			}
		
			if($type == 1||$type == 2){

				if($query = mysql_query($sql)){
				$result = mysql_fetch_row($query);

				if($result[0] == 0){
					$flag = array(
						'flag' => 0//用完且不能投票
					);
					echo json_encode($flag);
				}else if($result[0] == 1){
					$flag = array(
						'flag' => 1//未用完可以投票
					);
					echo json_encode($flag);
				}
			}else{
				echo "error08";
			}

			}//else{
			// 	echo 'no authority';
			// }
		}
	}

	function vote(){
		//检测是否已用完票数

		$a_name = $_POST['a_name'];
		$type = $_POST['type'];
		
		// //假数据
		// $flage = 1;
		// if($flage == 1){
		// 	$_SESSION['group'] = 'teacher';
		// 	$_SESSION['username'] = '吕老师';
		// }else{
		// 	$_SESSION['group'] = 'student';
		// 	$_SESSION['username'] = '王沛楠';
		// }


		if($_SESSION['group'] == 'teacher'){//老师部分
			if($type == 1){
				$sql = 'select a_ticket from teacher_ticket where t_name=\''.$_SESSION['username'].'\'';
			}else if($type == 2){
				$sql = 'select s_ticket from teacher_ticket where t_name=\''.$_SESSION['username'].'\'';
			}else if($type == 3){
				$sql = 'select c_ticket from teacher_ticket where t_name=\''.$_SESSION['username'].'\'';
			}else if($type == 4){	
				$sql = 'select d_ticket from teacher_ticket where t_name=\''.$_SESSION['username'].'\'';
			}

			if($query = mysql_query($sql)){
				$result = mysql_fetch_row($query);

				if($result[0] == 0){
					$flag = array(
						'flag' => 0//用完且不能投票
					);
					echo json_encode($flag);
				}else{
					if(!$temp = check_vote($a_name)){
						// $flag = array(
						// 	'flag' => 1//未用完可以投票
						// );
						// echo json_encode($flag);

		///////////////////////////////////////////////////////////////////////////////////		
						if($type == 1){
							$sql_1 = 'update pro_a set ticket=ticket+1 where a_name=\''.$a_name.'\'';
							
						}else if($type == 2){
							$sql_1 = 'update pro_s set ticket=ticket+1 where a_name=\''.$a_name.'\'';
						
						}else if($type == 3){
							$sql_1 = 'update pro_c set ticket=ticket+1 where a_name=\''.$a_name.'\'';
							
						}else if($type == 4){
							$sql_1 = 'update pro_d set ticket=ticket+1 where a_name=\''.$a_name.'\'';
				
						}

						$sql_2 = "insert into vote(name,type,voter,time,voter_type) values('".$a_name."',".$type.",'".$_SESSION['username']."',now(),1)";

						if($query_1 = mysql_query($sql_1) && $query_2 = mysql_query($sql_2)){
							$flag = array(
								'flag' => 1
							);
							echo json_encode($flag);//投票成功！;
						}else{
							echo json_encode("error06.1");
						}
		//////////////////////////////////////////////////////////////////////
						//投完票减去所持票数
						if($_SESSION['group'] == 'teacher'){
							if($type == 1){
								$sql_3 = "update teacher_ticket set a_ticket=a_ticket-1 where t_name='".$_SESSION['username']."'";
							}else if($type == 2){
								$sql_3 = "update teacher_ticket set s_ticket=s_ticket-1 where t_name='".$_SESSION['username']."'";
							}else if($type == 3){
								$sql_3 = "update teacher_ticket set c_ticket=c_ticket-1 where t_name='".$_SESSION['username']."'";
							}else if($type == 4){
								$sql_3 = "update teacher_ticket set d_ticket=d_ticket-1 where t_name='".$_SESSION['username']."'";
							}
						}else{
							if($type == 1){
								$sql_3 = "update student_ticket set a_ticket=a_ticket-1 where s_name='".$_SESSION['username']."'";
							}else if($type == 2){
								$sql_3 = "update student_ticket set s_ticket=s_ticket-1 where s_name='".$_SESSION['username']."'";
							}
						}
						if(!$query_3 = mysql_query($sql_3)){
							echo json_encode("error10");
						}

				//////////////////////////////////////////////////////////////////////
					}else{
						$flag = array(
							'flag' => 0//未用完但已投过该项目不能投票
						);
						echo json_encode($flag);
					}
					
				}
			}else{
				echo json_encode("error05");
			}

		}else{//学生部分
			if($type == 1){
				$sql = 'select a_ticket from student_ticket where s_name=\''.$_SESSION['username'].'\'';
			}else if($type == 2){
				$sql = 'select s_ticket from student_ticket where s_name=\''.$_SESSION['username'].'\'';
			}else{
				$flag = array(
					'flag' => 0//不能投票
				);
				echo json_encode($flag);
			}

			if($query = mysql_query($sql)){
				$result = mysql_fetch_row($query);
				if($result[0] == 0){
					$flag = array(
						'flag' => 0//用完且不能投票
					);
					echo json_encode($flag);
				}else if($result[0] == 1){
					// $flag = array(
					// 	'flag' => 1//未用完可以投票
					// );
					// echo json_encode($flag);
//////////////////////////////////////////////////////////////////////////////////////////
					if($type == 1){
						$sql_1 = 'update pro_a set ticket=ticket+1 where a_name=\''.$a_name.'\'';
						
					}else if($type == 2){
						$sql_1 = 'update pro_s set ticket=ticket+1 where a_name=\''.$a_name.'\'';
					}

					$sql_2 = "insert into vote(name,type,voter,time,voter_type) values('".$a_name."',".$type.",'".$_SESSION['username']."',now(),0)";

					if($query_1 = mysql_query($sql_1) && $query_2 = mysql_query($sql_2)){
						$flag = array(
							'flag' => 1
						);
						echo json_encode($flag);//投票成功！
					}else{
						echo json_encode("error06.2");
					}
/////////////////////////////////////////////////////////////////////////////////////////////////////

					//投完票减去所持票数
					if($_SESSION['group'] == 'teacher'){
						if($type == 1){
							$sql_3 = "update teacher_ticket set a_ticket=a_ticket-1 where t_name='".$_SESSION['username']."'";
						}else if($type == 2){
							$sql_3 = "update teacher_ticket set s_ticket=s_ticket-1 where t_name='".$_SESSION['username']."'";
						}else if($type == 3){
							$sql_3 = "update teacher_ticket set c_ticket=c_ticket-1 where t_name='".$_SESSION['username']."'";
						}else if($type == 4){
							$sql_3 = "update teacher_ticket set d_ticket=d_ticket-1 where t_name='".$_SESSION['username']."'";
						}
					}else{
						if($type == 1){
							$sql_3 = "update student_ticket set a_ticket=a_ticket-1 where s_name='".$_SESSION['username']."'";
						}else if($type == 2){
							$sql_3 = "update student_ticket set s_ticket=s_ticket-1 where s_name='".$_SESSION['username']."'";
						}
					}
					if(!$query_3 = mysql_query($sql_3)){
						echo json_encode("error10");
					}
					////////////////////////////////////////////////

				}
			}else{
				echo "error08";
			}
		}
	}


	//检测教师是否投过某个项目
	function check_vote($a_name){
		//$type = $_POST['type'];
		//$a_name = $_POST['a_name'];

		$sql = 'select name,voter from vote where name=\''.$a_name.'\' and voter=\''.$_SESSION['username'].'\'';
		if($query = mysql_query($sql)){
			if($result = mysql_num_rows($query)){
				return 1;//已投该项目
			}else{
				return 0;//未投该项目
			}

		}else{
			echo "error07";
		}
	}


	// //投票
	// function vote(){
	// 	$type = $_POST['type'];
	// 	$a_name = $_POST['a_name'];
		
	// 	//假数据
	// 	$flage = 1;
	// 	if($flage == 1){
	// 		$_SESSION['group'] = 'teacher';
	// 		$_SESSION['username'] = '吕老师';
	// 	}else{
	// 		$_SESSION['group'] = 'student';
	// 		$_SESSION['username'] = '王沛楠';
	// 	}




	// 	if($_SESSION['group'] == 'teacher'){//老师投票
	// 		if($type == 1){
	// 			$sql_1 = 'update pro_a set ticket=ticket+1 where a_name=\''.$a_name.'\'';
				
	// 		}else if($type == 2){
	// 			$sql_1 = 'update pro_s set ticket=ticket+1 where a_name=\''.$a_name.'\'';
			
	// 		}else if($type == 3){
	// 			$sql_1 = 'update pro_c set ticket=ticket+1 where a_name=\''.$a_name.'\'';
				
	// 		}else if($type == 4){
	// 			$sql_1 = 'update pro_d set ticket=ticket+1 where a_name=\''.$a_name.'\'';
	
	// 		}

	// 		$sql_2 = "insert into vote(name,type,voter,time) values('".$a_name."',".$type.",'".$_SESSION['username']."',now())";

	// 		if($query_1 = mysql_query($sql_1) && $query_2 = mysql_query($sql_2)){
	// 			$flag = array(
	// 				'flag' => 1
	// 			);
	// 			echo json_encode($flag);//投票成功！;
	// 		}else{
	// 			echo json_encode("error06.1");
	// 		}
	// 	}else{//学生投票
	// 		if($type == 1){
	// 			$sql_1 = 'update pro_a set ticket=ticket+1 where a_name=\''.$a_name.'\'';
				
	// 		}else if($type == 2){
	// 			$sql_1 = 'update pro_s set ticket=ticket+1 where a_name=\''.$a_name.'\'';
	// 		}

	// 		$sql_2 = "insert into vote(name,type,voter,time) values('".$_SESSION['username']."',".$type.",'".$_SESSION['group']."',now())";

	// 		if($query_1 = mysql_query($sql_1) && $query_2 = mysql_query($sql_2)){
	// 			$flag = array(
	// 				'flag' => 1
	// 			);
	// 			echo json_encode($flag);//投票成功！
	// 		}else{
	// 			echo json_encode("error06.2");
	// 		}
	// 	}
		

		

	// 	//投完票减去所持票数
	// 	if($_SESSION['group'] == 'teacher'){
	// 		if($type == 1){
	// 			$sql_3 = "update teacher_ticket set a_ticket=a_ticket-1 where t_name='".$_SESSION['username']."'";
	// 		}else if($type == 2){
	// 			$sql_3 = "update teacher_ticket set s_ticket=s_ticket-1 where t_name='".$_SESSION['username']."'";
	// 		}else if($type == 3){
	// 			$sql_3 = "update teacher_ticket set c_ticket=c_ticket-1 where t_name='".$_SESSION['username']."'";
	// 		}else if($type == 4){
	// 			$sql_3 = "update teacher_ticket set d_ticket=d_ticket-1 where t_name='".$_SESSION['username']."'";
	// 		}
	// 	}else{
	// 		if($type == 1){
	// 			$sql_3 = "update student_ticket set a_ticket=a_ticket-1 where s_name='".$_SESSION['username']."'";
	// 		}else if($type == 2){
	// 			$sql_3 = "update student_ticket set s_ticket=s_ticket-1 where s_name='".$_SESSION['username']."'";
	// 		}
	// 	}
	// 	if(!$query_3 = mysql_query($sql_3)){
	// 		echo json_encode("error10");
	// 	}

			
	// }
		

	
	
