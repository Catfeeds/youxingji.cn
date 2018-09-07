<div class="home-pannel">
	<div class="os-t">系统信息</div>
    <table class="table" cellpadding="0" cellspacing="0" width="100%">
    	<tr>
        	<td class="w100">服务器</td>
            <td>{{$smarty.server.SERVER_SOFTWARE}} {{$phpversion}}</td>
        </tr>
        <tr><td>PHP 版本</td><td>{{$serverinfo}}</td></tr>
        <tr><td>上传许可</td><td>{{$fileupload}}</td></tr>
        <tr><td>数据库版本</td><td>{{$dbversion}}</td></tr>
        <tr><td>当前数据库占用</td><td>{{$dbsize}}</td></tr>
        <tr><td>主机名</td><td>{{$smarty.server.SERVER_NAME}}({{$smarty.server.SERVER_ADDR}}:{{$smarty.server.SERVER_PORT}})</td></tr>
        <tr><td>magic_quote_gpc</td><td>{{$magic_quote_gpc}}</td></tr>
        <tr><td>allow_url_fopen</td><td>{{$allow_url_fopen}}</td></tr>
        {{if $stat}}
        <tr><td>今日访问：</td><td>{{$visits}}</td></tr>
        <tr><td>今日IP：</td><td>{{$ip}}</td></tr>
        {{else}}
        <tr><td colspan="2">没有开启访问列表 <a href="javascript:;" onclick="Controller.main('{{$_pathroot}}admin/config/basic')">点击开启</a></td></tr>
        {{/if}}
    </table>
</div>
<script type="text/javascript">
$(function(){
    resizeTeam();
    $(window).resize(function(){
        resizeTeam();
    });
})

function resizeTeam(){
    $('.home-team li').css('width', ($(window).width() - 240) / 3);
    $('.home-team').show();
}
</script>