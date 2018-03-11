<?php
$data = loadParticipatants($group); 
foreach($data as $item) { ?>
    <div class="col-md-3 participatant">
        <div class="screenshot">
            <? if($item['img_addr'] == '') { ?>
                <img src="http://wzpb.xupt.org/style/img/404.png">
            <? } else {
                $imgAddr = itemImageAddr($item);
                if(file_exists($imgAddr)) { ?>
                <img class="exist" src="<?= $imgAddr ?>" data-src="http://wzpb.xupt.org/<?= $item['img_addr'] ?>">
                <? } else { ?>
                <img class="exist" src="thumb.php?group=<?= $group ?>&itemno=<?= $item['id'] ?>" data-src="http://wzpb.xupt.org/<?= $item['img_addr'] ?>">
                <? }
            } ?>
        </div>
        <div class="work-info">
            <h3><?= $item['a_name'] ?></h3>
            <div class="team-name"><?= $item['u_name'] ?></div>
        </div>
        <div class="row work-stat">
            <div class="col-xs-4">
                <div class="desc">当前票数</div>
                <div class="val-box"><?= $item['ticket'] ?></div>
            </div>
            <div class="col-xs-4">
                <div class="desc">当前名次</div>
                <div class="val-box"><?= $item['rank'] ?></div>
            </div>
            <div class="col-xs-4">
                <div class="desc"></div>
                <div class="btn-box" onclick="showDetail('/?group=<?= $group ?>&itemno=<?= $item['id'] ?>');"><button>详情</button></div>
            </div>
        </div>
    </div>
<? } ?>