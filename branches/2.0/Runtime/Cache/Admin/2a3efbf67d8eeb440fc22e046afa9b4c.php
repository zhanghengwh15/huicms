<?php if (!defined('THINK_PATH')) exit();?>
<style type="text/css">
    .system-message{ padding: 24px 48px; font-family: '微软雅黑'; color: #333; font-size: 16px; }
    .system-message h1{ font-size: 100px; font-weight: normal; line-height: 120px; margin-bottom: 12px; }
    .system-message .jump{ padding-top: 10px}
    .system-message .jump a{ color: #333;}
    .system-message .success,.system-message .error{ line-height: 1.8em; font-size: 36px }
    .system-message .detail{ font-size: 12px; line-height: 20px; margin-top: 12px; display:none}
</style>

<div class="contentRightBox">
    <div class="system-message">
        <?php if(isset($message)): ?><h1 style="font-family: '微软雅黑';">:)</h1>
            <p class="success" id="successMsg"><?php echo($message); ?></p>
            <?php else: ?>
            <h1 style="font-family: '微软雅黑';">:(</h1>
            <p class="error" id="errorMsg"><?php echo($error); ?></p><?php endif; ?>
        <p class="detail"></p>
        <p class="jump">
            页面自动 <a id="href" href="<?php echo($jumpUrl); ?>">跳转</a> 等待时间： <b id="wait"><?php echo($waitSecond); ?></b>
        </p>
    </div>
    <div style="width: 1px; height: 1px; overflow: hidden; visibility: hidden; clear: both;" id="reader"></div>
</div>

<script type="text/javascript">
    (function(){
        var wait = document.getElementById('wait'),href = document.getElementById('href').href;
        var interval = setInterval(function(){
            var time = --wait.innerHTML;
            if(time == 0) {
                location.href = href;
                clearInterval(interval);
            };
        }, 1000);
    })();


    function jumpIt(){
        var wait = document.getElementById('wait'),href = document.getElementById('href').href;
        var interval = setInterval(function(){
            var time = --wait.innerHTML;
            if(time == 0) {
                location.href = href;
                clearInterval(interval);
            };
        }, 1000);
    }
</script>