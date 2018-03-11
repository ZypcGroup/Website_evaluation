<?php
require 'mysql_conf.php';

//上传参赛图片

$dirname = $_POST['n'];
$type = $_POST['m']; 
//echo 'name:'.$dirname.'<br>';
//echo 'type'.$type;
$addr = '/opt/wzpb/data/';
$real = '/data/';
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
 && ($_FILES["file"]["size"] < 1024*1024*5))//大小不能超过5M
  {
    
  if ($_FILES["file"]["error"] > 0)
    {
    echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
    }
  else
    {
    // echo "Upload: " . $_FILES["file"]["name"] . "<br />";
    // echo "Type: " . $_FILES["file"]["type"] . "<br />";
    // echo "Size: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";
    // echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br />";

    if (file_exists("/opt/wzpb/data/" .$dirname.'/'. $_FILES["file"]["name"]))
      {
      echo $_FILES["file"]["name"] . " already exists. ";
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
        echo json_encode($flag);
      }else{
        echo $sql.'<br>';
        echo mysql_error();
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
            'flag' => "invaild"
          );
  echo json_encode($flag);
  }
