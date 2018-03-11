<?php

function renderView($viewName) {
    extract($GLOBALS); 
    include("views/$viewName.inc.php");
}

function loadParticipatants($groupName) {
    global $db;
    $groupName = $db->escape_string($groupName);
    $result = $db->query("SELECT * FROM pro_$groupName WHERE deline = 1 ORDER BY ticket DESC");
    if($result == false) {
        renderView('dberror');
        exit();
    }
    $result = $result->fetch_all(MYSQLI_ASSOC);
    $tickets = array();
    foreach($result as &$item) {
        array_push($tickets, $item['ticket']);
    }
    rsort($tickets);
    foreach($result as &$item) {
        $item['rank'] = array_search($item['ticket'], $tickets) + 1;
    }
    return $result;
}

function loadParticipatantDetail($groupName, $itemNo) {
    global $db;
    $groupName = $db->escape_string($groupName);
    $itemNo = intval($itemNo);
    $result = $db->query("SELECT * FROM pro_$groupName WHERE id = $itemNo AND deline = 1");
    if($result == false) {
        renderView('dberror');
        exit();
    }
    if($result->num_rows == 0) {
        return NULL;
    }
    return $result->fetch_assoc();
}

function itemImageAddr($item) {
    return 'thumbs/' . md5($item['img_addr']) . '.jpg';
}

function checkSession() {
    if(!isset($_SESSION['username']) || !isset($_SESSION['group'])) {
        header('Location: https://zypc.xupt.edu.cn/oauth/authorize?client_id=8204b9e5899d0855bceaea721e944284a60ea5ce7f7473ca30c2dd88f6a25412&redirect_uri=http%3A%2F%2Fwzpb.xupt.edu.cn%2F&response_type=code&scope=');
        exit();
    }
}

function queryFirst($sql, $resulttype = MYSQLI_NUM) {
    global $db;
    $result = $db->query($sql);
    if($result == false) {
        renderView('dberror');
        exit();
    }
    return $result->fetch_array($resulttype);
}

function getSubmitSum() {
    $sum_a = queryFirst('SELECT COUNT(1) FROM pro_a')[0];
    $sum_s = queryFirst('SELECT COUNT(1) FROM pro_s')[0];
    $sum_c = queryFirst('SELECT COUNT(1) FROM pro_c')[0];
    $sum_d = queryFirst('SELECT COUNT(1) FROM pro_d')[0];
    return $sum_a + $sum_s + $sum_c + $sum_d;
}

function getVoteSum() {
    return queryFirst('SELECT COUNT(1) FROM votes')[0];
}

function prepareStmt($sql) {
    global $db;
    $stmt = $db->stmt_init();
    if(!$stmt->prepare($sql)) {
        renderView('dberror');
        exit();
    }
    return $stmt;
}

function isSpecialUser() {
	global $granted_users, $granted_sno;
	if(in_array($_SESSION['username'], $granted_users)) { return true; }
	if(in_array($_SESSION['student_no'], $granted_sno)) { return true; }
	return false;
}

function voteChanceLeft($group) {
    return 0;
    if(!isSpecialUser() && ($group == 'c' || $group == 'd')) {
        return 0;
    }
    $stmt = prepareStmt("SELECT COUNT(1) FROM votes WHERE voter = ? AND type = ?");
    $stmt->bind_param("ss", $_SESSION['username'], $group);
    $stmt->execute();
    $stmt->bind_result($count);
    $stmt->fetch();
    $stmt->close();
    if(isSpecialUser()) {
        if($group == 'a' || $group == 's') {
            if($count > 0) {
                return 0;
            } else {
                return 1;
            }
        } elseif ($group == 'c') {
            return 6 - $count;
        } elseif ($group == 'd') {
            return 7 - $count;
        } else {
            return 0;
        }
    } else {
        if($count > 0) {
            return 0;
        } else {
            return 1;
        }
    }
}

function hasVotedFor($group, $id){
    $stmt = prepareStmt("SELECT COUNT(1) FROM votes WHERE voter = ? AND type = ? AND pro_id = ?");
    $stmt->bind_param("ssi", $_SESSION['username'], $group, $id);
    $stmt->execute();
    $stmt->bind_result($count);
    $stmt->fetch();
    $stmt->close();
    return $count > 0;
}

function loadUrl($url, $post_data = '', $auth = '') {
    $ch = curl_init();  
	curl_setopt($ch, CURLOPT_URL, $url);  
	curl_setopt($ch, CURLOPT_HEADER, 0);  
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);  
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
    if($post_data) {
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
    }
    if($auth) {
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($ch, CURLOPT_USERPWD, $auth);
    }
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER , false);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST , false);
	$resp = curl_exec($ch);  
	curl_close($ch);
    return json_decode($resp, 1);
}

function requestAccessToken($code) {
    $post_data = 'grant_type=authorization_code&code=' . $code.'&redirect_uri=http%3A%2F%2F' . $_SERVER['HTTP_HOST'] . '%2F';
    $resp = loadUrl('https://zypc.xupt.edu.cn/oauth/token', $post_data, OAUTH_CLNTID.':'.OAUTH_SECRET);
    return $resp;
}
