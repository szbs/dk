<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<!-- Set render engine for 360 browser -->
	<meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- HTML5 shim for IE8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <![endif]-->

	<link href="/web/daikaun/public/simpleboot/themes/<?php echo C('SP_ADMIN_STYLE');?>/theme.min.css" rel="stylesheet">
    <link href="/web/daikaun/public/simpleboot/css/simplebootadmin.css" rel="stylesheet">
    <link href="/web/daikaun/public/js/artDialog/skins/default.css" rel="stylesheet" />
    <link href="/web/daikaun/public/simpleboot/font-awesome/4.4.0/css/font-awesome.min.css"  rel="stylesheet" type="text/css">
    <style>
		form .input-order{margin-bottom: 0px;padding:3px;width:40px;}
		.table-actions{margin-top: 5px; margin-bottom: 5px;padding:0px;}
		.table-list{margin-bottom: 0px;}
	</style>
	<!--[if IE 7]>
	<link rel="stylesheet" href="/web/daikaun/public/simpleboot/font-awesome/4.4.0/css/font-awesome-ie7.min.css">
	<![endif]-->
	<script type="text/javascript">
	//全局变量
	var GV = {
	    ROOT: "/web/daikaun/",
	    WEB_ROOT: "/web/daikaun/",
	    JS_ROOT: "public/js/",
	    APP:'<?php echo (MODULE_NAME); ?>'/*当前应用名*/
	};
	</script>
    <script src="/web/daikaun/public/js/jquery.js"></script>
    <script src="/web/daikaun/public/js/wind.js"></script>
    <script src="/web/daikaun/public/simpleboot/bootstrap/js/bootstrap.min.js"></script>
    <script>
    	$(function(){
    		$("[data-toggle='tooltip']").tooltip();
    	});
    </script>
<?php if(APP_DEBUG): ?><style>
		#think_page_trace_open{
			z-index:9999;
		}
	</style><?php endif; ?>
</head>
<body>
	<div class="wrap js-check-wrap">
		<ul class="nav nav-tabs">
			<li class="active"><a href="<?php echo U('Qianshan/product/index');?>">产品列表</a></li>
			<li><a href="<?php echo U('Qianshan/product/proadd');?>">增加产品</a></li>
		</ul>
        <form class="well form-search" method="post" action="<?php echo U('User/index');?>">
            产品名称:
            <input type="text" name="user_login" style="width: 100px;" value="<?php echo I('request.user_login/s','');?>" placeholder="产品名称">
            
            <input type="submit" class="btn btn-primary" value="搜索" />
            <a class="btn btn-danger" href="<?php echo U('User/index');?>">清空</a>
        </form>
		<form method="post" class="js-ajax-form" action="<?php echo U('Qianshan/product/index');?>">
		<table class="table table-hover table-bordered">
			<thead>
				<tr>
					<th width="30">ID</th>
					<th width="50">排序</th>
					<th>产品名称</th>
					<th>贷款期限</th>
					<th>贷款额度</th>
					<th>贷款利息</th>
					<th>手续费</th>
					<th width="30">状态</th>
					<th width="120">添加时间</th>
					<th width="120">操作</th>
				</tr>
			</thead>
			<tbody>
				<?php if(is_array($lists)): foreach($lists as $key=>$vo): ?><tr>
					<td><?php echo ($vo["pid"]); ?></td>
					<td><input name='displayorders[<?php echo ($vo["pid"]); ?>]' type='text' size='3' value='<?php echo ($vo["displayorder"]); ?>' class='input input-order'></td>
					<td><?php echo ($vo["name"]); ?></td>
					<td><?php echo ($vo["due_time_from"]); ?>－<?php echo ($vo["due_time_to"]); ?>月</td>
					<td><?php echo ($vo["credit_from"]); ?>－<?php echo ($vo["credit_to"]); ?>万元</td>
					<td>
						<?php $lixitypes = array('等额本息','等额本金','先息后本','日利息'); foreach($vo['interest'] as $k1=>$v1){ if ($v1['lixi1']>0){ echo $lixitypes[$v1['lixitype']-1]; echo $v1['lixi1']; echo $v1['lixidw1'] == 'fen' ? '分':'厘'; echo '——'; echo $v1['lixi2'] >0 ? $v1['lixi2'] : $v1['lixi1']; echo $v1['lixidw2'] == 'fen' ? '分':'厘'; echo '<br/>'; } } ?>



						</td>
					<td><?php echo ($vo["commission"]); ?></td>
					<td><input type="checkbox" name="status[<?php echo ($vo["pid"]); ?>]" value="1" <?php if($vo['status']): ?>checked="checked"<?php endif; ?> /></td>
					<td><?php echo date('Y-m-d H:i:s', $vo['createtime']);?></td>
					<td>
						<a href='<?php echo U("Qianshan/product/proadd",array("pid"=>$vo["pid"]));?>'>编辑</a>&nbsp;&nbsp;
						<!--<a href='<?php echo U("Qianshan/product/promod",array("pid"=>$vo["pid"]));?>'>属性</a>&nbsp;&nbsp;-->
						<a href='<?php echo U("Qianshan/product/shenqing",array("pid"=>$vo["pid"]));?>'>申请条件</a>
					</td>
				</tr><?php endforeach; endif; ?>
			</tbody>
		</table>
		<div class="pagination"><?php echo ($Page); ?></div>
		<div class="table-actions">
			<button type="submit" class="btn btn-primary btn-small js-ajax-submit">排序</button>
		</div>
		</form>
	</div>
	<script src="/web/daikaun/public/js/common.js"></script>
</body>
</html>