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
			<li class="active"><a href="<?php echo U('Qianshan/product/user');?>">用户列表</a></li>
			<li><a href="<?php echo U('Qianshan/product/useradd');?>">添加用户</a></li>
		</ul>
       
		<table class="table table-hover table-bordered">
			<thead>
				<tr>
					<th width="50">ID</th>
					<th>用户名</th>
					<th><?php echo L('LAST_LOGIN_IP');?></th>
					<th><?php echo L('LAST_LOGIN_TIME');?></th>
					<th><?php echo L('EMAIL');?></th>
					<th><?php echo L('STATUS');?></th>
					<th width="120"><?php echo L('ACTIONS');?></th>
				</tr>
			</thead>
			<tbody>
				<?php $user_statuses=array("0"=>L('USER_STATUS_BLOCKED'),"1"=>L('USER_STATUS_ACTIVATED'),"2"=>L('USER_STATUS_UNVERIFIED')); ?>
				<?php if(is_array($users)): foreach($users as $key=>$vo): ?><tr>
					<td><?php echo ($vo["id"]); ?></td>
					<td><?php if($vo['user_url']): ?><a href="<?php echo ($vo["user_url"]); ?>" target="_blank" title="<?php echo ($vo["signature"]); ?>"><?php echo ($vo["user_login"]); ?></a><?php else: echo ($vo["user_login"]); endif; ?></td>
					<td><?php echo ($vo["last_login_ip"]); ?></td>
					<td>
						<?php if($vo['last_login_time'] == 0): echo L('USER_HAVENOT_LOGIN');?>
						<?php else: ?>
							<?php echo ($vo["last_login_time"]); endif; ?>
					</td>
					<td><?php echo ($vo["user_email"]); ?></td>
					<td><?php echo ($user_statuses[$vo['user_status']]); ?></td>
					<td>
						<?php if($vo['id'] == 1 || $vo['id'] == sp_get_current_admin_id()): ?><font color="#cccccc"><?php echo L('EDIT');?></font> | <font color="#cccccc"><?php echo L('DELETE');?></font> |
							<?php if($vo['user_status'] == 1): ?><font color="#cccccc"><?php echo L('BLOCK_USER');?></font>
							<?php else: ?>
								<font color="#cccccc"><?php echo L('ACTIVATE_USER');?></font><?php endif; ?>
						<?php else: ?>
							<a href='<?php echo U("user/edit",array("id"=>$vo["id"]));?>'><?php echo L('EDIT');?></a> |
							<?php if($vo['user_status'] == 1): ?><a href="<?php echo U('user/ban',array('id'=>$vo['id']));?>" class="js-ajax-dialog-btn" data-msg="<?php echo L('BLOCK_USER_CONFIRM_MESSAGE');?>"><?php echo L('BLOCK_USER');?></a> | 
							<?php else: ?>
								<a href="<?php echo U('user/cancelban',array('id'=>$vo['id']));?>" class="js-ajax-dialog-btn" data-msg="<?php echo L('ACTIVATE_USER_CONFIRM_MESSAGE');?>"><?php echo L('ACTIVATE_USER');?></a> |<?php endif; ?>
							<a class="js-ajax-delete" href="<?php echo U('user/delete',array('id'=>$vo['id']));?>"><?php echo L('DELETE');?></a><?php endif; ?>
					</td>
				</tr><?php endforeach; endif; ?>
			</tbody>
		</table>
		<div class="pagination"><?php echo ($page); ?></div>
	</div>
	<script src="/web/daikaun/public/js/common.js"></script>
</body>
</html>