<?php if(INITIALIZED != 'yes') exit(); ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>西安邮电大学网站评比</title>
    <link rel="stylesheet" href="style/bootstrap.min.css">
    <link rel="stylesheet" href="style/style.css">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=no">
</head>
<body>
    <div class="banner">
        <img src="/style/img/banner.jpg">
    </div>
    <div class="container">
        <table class="table vote-stat hidden-xs">
        <thead>
            <tr>
                <th>候选作品</th>
                <th>投票人次</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><?= getSubmitSum() ?></td>
                <td><?= getVoteSum() ?></td>
            </tr>
        </tbody>
        </table>
        <h1>2017西安邮电大学网站评选投票</h1>
        <div class="introduction">
            <p>为加强我校信息化建设，提高校内各类网站的建设水平，鼓励特色网站及互联网应用的建设和发展，本着“以评促建，以评促管”的原则，学校决定自2017年10月28日开展2017年度各类网站和互联网应用评比活动。</p>
        </div>
        <ul class="nav nav-tabs">
            <li role="presentation" class="active"><a href="#a" data-toggle="tab">互联网应用组</a></li>
            <li role="presentation"><a href="#s" data-toggle="tab">特色网站组</a></li>
            <li role="presentation"><a href="#c" data-toggle="tab">学院组</a></li>
            <li role="presentation"><a href="#d" data-toggle="tab">职能部门组</a></li>
        </ul>
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="a">
                <div class="subbanner">
                    <img src="/style/img/xupt.png">
                    <h2>互联网应用组</h2>
                </div>
                <div class="group-all row" id="group-a">
                <? $GLOBALS['group'] = 'a'; renderView('participatant'); ?>
                </div>
            </div>
            <div role="tabpanel" class="tab-pane" id="s">
                <div class="subbanner">
                    <img src="/style/img/xupt.png">
                    <h2>特色网站组</h2>
                </div>
                <div class="group-all row" id="group-s">
                <? $GLOBALS['group'] = 's'; renderView('participatant'); ?>
                </div>
            </div>
            <div role="tabpanel" class="tab-pane" id="c">
                <div class="subbanner">
                    <img src="/style/img/xupt.png">
                    <h2>学院组</h2>
                </div>
                <div class="group-all row" id="group-c">
                <? $GLOBALS['group'] = 'c'; renderView('participatant'); ?>
                </div>
            </div>
            <div role="tabpanel" class="tab-pane" id="d">
                <div class="subbanner">
                    <img src="/style/img/xupt.png">
                    <h2>职能部门组</h2>
                </div>
                <div class="group-all row" id="group-d">
                <? $GLOBALS['group'] = 'd'; renderView('participatant'); ?>
                </div>
            </div>
        </div>
        <div class="footer">
            <p>&copy; <span class="hidden-xs">2017 </span>西安邮电大学信息中心 <a href="https://zypc.xupt.edu.cn/" target="_blank">智邮普创工作室</a></p>
        </div>
    </div>
    <div class="modal fade" tabindex="-1" role="dialog" id="detailModal">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content" id="modalContent">
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <script src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/postbird-img-glass.js"></script>
    <script src="js/app.js"></script>
</body>
</html>
