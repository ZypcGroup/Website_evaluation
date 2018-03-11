    function showDetail(url) {
        $.get(url, function(resp) {
            document.getElementById('modalContent').innerHTML = resp;
            $('#detailModal').modal();
        });
    }
    function getime() {
        var EndTime = new Date('2017/11/4 00:00:00');
        var NowTime = new Date();
        var t = EndTime.getTime() - NowTime.getTime();
        var d = 0;
        var h = 0;
        var m = 0;
        var s = 0;

        if (t >= 0) {
            d = Math.floor(t / 1000 / 60 / 60 / 24);
            h = Math.floor(t / 1000 / 60 / 60 % 24);
            m = Math.floor(t / 1000 / 60 % 60);
            s = Math.floor(t / 1000 % 60);
        }
        var fina_time = d + "天" + h + "小时" + m + "分" + s + "秒";
        $('#now_date').text(fina_time);
    }
    PostbirdImgGlass.init({
                        domSelector:".screenshot img.exist",
                        animation:true
                    });
    function windowHeight() {
        return (document.compatMode == "CSS1Compat")?
            document.documentElement.clientHeight : document.body.clientHeight;
    }
    /*var loadingMore = false;
    $(window).on('scroll',function(){
        if(Math.max(document.body.scrollTop, document.documentElement.scrollTop) + windowHeight() >=
           (Math.max(document.body.scrollHeight,document.documentElement.scrollHeight) - 50)){
            if(!loadingMore) {
                loadingMore = true;
                alert('正在加载...');
            }
        }
    });*/

    function reloadGroup(group) {
        $.get('/?group=' + group, function(resp) {
            document.getElementById('group-' + group).innerHTML = resp;
        });
    }

    function voteFor(group, no) {
        if(confirm('你真的要为这个作品投上一票吗？这将消耗掉一次你在本参赛组投票的机会。')) {
            $.post('vote.php', { group: group, itemno: no }, function(resp) {
                var ret = JSON.parse(resp);
                alert(ret.status);
                $('#detailModal').modal('hide');
                reloadGroup(group);
            });
        }
    }
