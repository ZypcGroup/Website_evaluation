<?php if(INITIALIZED != 'yes') exit(); ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>西安邮电大学网站评比</title>
    <link rel="stylesheet" href="style/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1>不好意思 :) 出错啦</h1>
        <p><b>Database Query Error: </b><?= $db->error ?></p>
    </div>
    <script src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>