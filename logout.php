<?php
session_start();
unset($_SESSION['username']);
unset($_SESSION['group']);
header('Location: https://zypc.xupt.edu.cn/logout?switch=yes&referer=%2Foauth%2Fauthorize%3Fclient_id%3D8204b9e5899d0855bceaea721e944284a60ea5ce7f7473ca30c2dd88f6a25412%26redirect_uri%3Dhttp%253A%252F%252Fwzpb.xupt.edu.cn%252F%26response_type%3Dcode%26scope%3D');
