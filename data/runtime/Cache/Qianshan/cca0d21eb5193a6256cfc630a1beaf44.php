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
			<li class="active"><a href="<?php echo U('Qianshan/User/userlist');?>">普通用户列表</a></li>
			<li><a href="<?php echo U('Qianshan/User/useredit');?>">增加普通用户</a></li>
		</ul>
		需要贷款金额 ： <?php echo ($uesrprofile["required_load_amount"]); ?>万元 需要贷款时间 ：<?php echo ($uesrprofile["required_load_term"]); ?>月<br/>
		
		<form method="post" class="js-ajax-form" action="<?php echo U('Qianshan/product/index');?>">
		<table class="table table-hover table-bordered">
			<thead>
				<tr>
					<th>产品名称</th>
					<th>贷款期限</th>
					<th>贷款金额</th>
					<th>贷款利息</th>
					<th>还款情况</th>
					<th>手续费</th>
				</tr>
			</thead>
			<tbody>
				<?php if(is_array($voList)): foreach($voList as $key=>$vo): ?><tr>
					<td><?php echo ($vo["name"]); ?></td>
					<td><?php echo ($vo["due_time_from"]); ?>－<?php echo ($vo["due_time_to"]); ?>月</td>
					<td><?php echo ($vo["credit_from"]); ?>－<?php echo ($vo["credit_to"]); ?>万元</td>
					<td><?php echo ($vo["interest_text"]); ?></td>
					<td><?php echo ($vo["interest_month"]); ?></td>
					<td><?php echo ($vo["commission"]); ?></td>
				</tr><?php endforeach; endif; ?>
			</tbody>
		</table>
		<div class="pagination"><?php echo ($page); ?></div>
		<!--
		<div class="table-actions">
			<button type="submit" class="btn btn-primary btn-small js-ajax-submit">排序</button>
		</div>-->
		</form>
	</div>
	<script src="/web/daikaun/public/js/common.js"></script>
</body>
</html>