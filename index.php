<?php
include_once('config.inc.php');
if(isset($_GET['code'])) {
    $result = requestAccessToken($_GET['code']);
    if(isset($result['access_token'])) {
        $token = $result['access_token'];
        $result = loadUrl('https://zypc.xupt.edu.cn/oauth/userinfo?access_token=' . $token);
        $_SESSION['username'] = $result['username'];
        $_SESSION['student_no'] = $result['student_no'];
        $_SESSION['group'] = $result['group'];
        header('Location: /');
    } else {
        echo('授权失败：' . $result['error_description']);
    }
} else {
    if(isset($_GET['group'])) {
        $group = substr($_GET['group'], 0, 1);
        if(isset($_GET['itemno'])) {
            $item = loadParticipatantDetail($group, intval($_GET['itemno']));
            if(isset($item)) {
                renderView('detail');
            } else {
                 echo 'Not found!';
            }
        } else {
            renderView('participatant');
        }
    } else {
        renderView('index');
    }
}
