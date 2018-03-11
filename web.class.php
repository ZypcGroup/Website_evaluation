<?php

include 'mysql_conf.php';

$img_addr = 'http://cdn.zypc.org/usr/local/cdn/img/';

class web{
	public $Id = '';
	public $Name = '';
	public $User = '';
	public $College = '';
	public $Words = '';
	public $Ticket = 0;
	public $Url = '';
	public $Auth = 0;

	public function get_Id(){
		return $this->$Id;
	}

	public function get_Name(){
		return $this->$Name;
	}

	public function get_User(){
		return $this->$User;
	}

	public function get_College(){
		return $this->$College;
	}

	public function get_Words(){
		return $this->$Words;
	}

	public function get_Ticket(){
		return $this->$Ticket;
	}

	public function get_Url(){
		return $this->$Url;
	}

	public function get_Auto(){
		return $this->$Auth;
	}

	public function set_Id($name){
		$sql = 'select id from web where name='.$this->$Name;
		$query = mysql_query($sql);
		$result = mysql_fetch_assoc($query);
		$this->$Id = $result['name'];
	}

	public function set_Name($name){
		$Name = $name;
		$this->$Name = $Name;
		$sql = 'insert into web(name) values(\''.$Name.'\')';
		$query = mysql_query($sql);
		echo '123';
	}

	public function set_User($user,$name){
		$User = $user;
		$this->$User = $User;
		$sql = 'insert into web(provider) values(\''.$User.'\') where name='.$name;
		$query = mysql_query($sql);
	}

	public function set_Words($words,$name){
		$Words = $words;
		$this->$Words = $Words;
		$sql = 'update web set intro='.$Words.'where name='.$name;
		$query = mysql_query($sql);
	}

	public function set_College($college,$name){
		$College = $college;
		$this->$College = $College;
		$sql = 'update web set intro='.$College.'where name='.$name;
		$query = mysql_query($sql);
	}

	public function set_Ticket($ticket,$name){
		$Ticket = $ticket;
		$this->$Ticket = $Ticket;
		$sql = 'update web set ticket='.$Ticket.'where name='.$name;
		$query = mysql_query($sql);
	}

	public function set_Url($url,$name){
		$Url = $url;
		$this->$Url = $Url;
		$sql = 'update web set url='.$Url.'where name='.$name;
		$query = mysql_query($sql);
	}

	public function set_Auth($auth,$name){
		$Auth = $auth;
		$this->$Auth = $Auth;
		$sql = 'update web set auth='.$Auth.'where name='.$name;
		$query = mysql_query($sql);
	}

	//获取封面图片
	public function get_index_img(){
		$index_img = $img_addr.$this->$Name.'/index.jpg';
		echo json_encode($index_img);
	}
	//获取所有资源
	public function get_all(){
		$dir = $img_addr.$this->$Name."/";
		$file=scandir($dir);
		for($i=2;$i<=count($file);$i++){
			$file[$i] = $dir.$file[$i];
		}
		echo json_encode($file);//[2]开始是第一个地址
	}



	//投票
	public function vote($web_id,$voter){
		$sql = 'select flag from voter where name='.$voter;
		$query = mysql_query($sql);
		$result = mysql_fetch_assoc($query);
		if($result['flag'] == 0 && $result != null){

		if($_SESSION['group'] == 'teacher'){
			$sql_1 = 'update web set ticket=ticket+1 where id='.$web_id;
			$sql_2 = "insert into voter(name,type,flag) values('".$_SESSION['username']."','".$_SESSION['group']."',1)";
			$query_1 = mysql_query($sql_1);
			$query_2 = mysql_query($sql_2);
		}else if($_SESSION['group'] != 'teacher' && $this->$Auth == 0){
			$sql_1 = 'update web set ticket=ticket+1 where id='.$web_id;
			$sql_2 = "insert into voter(name,type,flag) values('".$_SESSION['username']."','".$_SESSION['group']."',1)";
			$query_1 = mysql_query($sql_1);
			$query_2 = mysql_query($sql_2);
			}
		}else{
			echo "<script>alert('已经投过票！')</script>";
		}
		
	}

}


