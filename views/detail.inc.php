<?php if(INITIALIZED != 'yes') exit(); ?>
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title">参赛作品详情</h4>
</div>
<div class="modal-body detail">
    <div class="row">
        <div class="col-md-4 detail-screenshot">
            <? if($item['img_addr'] == '') { ?>
                <img src="http://wzpb.xupt.org/style/img/404.png">
            <? } else { ?>
                <img src="http://wzpb.xupt.org/<?= $item['img_addr'] ?>">
            <? } ?>
        </div>
        <div class="col-md-8">
            <h3><?= $item['a_name'] ?></h3>
            <p><?= $item['u_name'] ?></p>
            <? if(substr($item['url'], 0, 4) == 'http') { ?>
            <p><a href="<?= $item['url'] ?>" target="_blank"><?= $item['url'] ?></a></p>
            <?} else {?>
            <p><?= $item['url'] ?></p>
            <? } ?>
            <div class="timeline-container">
                <div class="timeline">
                    <div class="title"><span></span><h4>基本情况介绍</h4></div>
                    <p><?= $item['b_position'] ?></p>
                    <div class="title"><span></span><h4>使用情况介绍</h4></div>
                    <p><?= $item['u_position'] ?></p>
                    <div class="title"><span></span><h4>日常管理介绍</h4></div>
                    <p><?= $item['d_position'] ?></p>
                    <div class="title"><span></span><h4>应用特色介绍</h4></div>
                    <p><?= $item['a_position'] ?></p>
                </div>
            </div>
            <div class="col-md-12">
                <p class="text-muted">投票活动已结束。</p>
            </div>
            <div class="">
                 <button type="button" class="btn btn-default btn-lg btn-block" data-dismiss="modal">关闭</button>
            </div>
        </div>
    </div>
</div>
