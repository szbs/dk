<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<title><?php echo ($site_name); ?></title>
<meta name="keywords" content="<?php echo ($site_seo_keywords); ?>" />
<meta name="description" content="<?php echo ($site_seo_description); ?>">
<meta name="author" content="ThinkCMF">
	
	
	<meta name="author" content="ThinkCMF">
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    
    <!-- Set render engine for 360 browser -->
    <meta name="renderer" content="webkit">

   	<!-- No Baidu Siteapp-->
    <meta http-equiv="Cache-Control" content="no-siteapp"/>

    <!-- HTML5 shim for IE8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <![endif]-->
	<link rel="icon" href="/web/daikaun/themes/qianshan/Public/assets/images/favicon.ico" type="image/x-icon">
	<link rel="shortcut icon" href="/web/daikaun/themes/qianshan/Public/assets/images/favicon.ico" type="image/x-icon">
    <link href="/web/daikaun/themes/qianshan/Public/assets/simpleboot/themes/simplebootx/theme.min.css" rel="stylesheet">
    <link href="/web/daikaun/themes/qianshan/Public/assets/simpleboot/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
    <link href="/web/daikaun/themes/qianshan/Public/assets/simpleboot/font-awesome/4.4.0/css/font-awesome.min.css"  rel="stylesheet" type="text/css">
	<!--[if IE 7]>
	<link rel="stylesheet" href="/web/daikaun/themes/qianshan/Public/assets/simpleboot/font-awesome/4.4.0/css/font-awesome-ie7.min.css">
	<![endif]-->
	<link href="/web/daikaun/themes/qianshan/Public/assets/css/style.css" rel="stylesheet">
	<style>
		/*html{filter:progid:DXImageTransform.Microsoft.BasicImage(grayscale=1);-webkit-filter: grayscale(1);}*/
		#backtotop{position: fixed;bottom: 50px;right:20px;display: none;cursor: pointer;font-size: 50px;z-index: 9999;}
		#backtotop:hover{color:#333}
		#main-menu-user li.user{display: none}
	</style>
	
</head>

<body class="body-white">
	<?php echo hook('body_start');?>
<div class="navbar navbar-fixed-top">
   <div class="navbar-inner">
     <div class="container">
       <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
         <span class="icon-bar"></span>
         <span class="icon-bar"></span>
         <span class="icon-bar"></span>
       </a>
       <a class="brand" href="/web/daikaun/"><img src="/web/daikaun/themes/qianshan/Public/assets/images/logo.png"/></a>
       <div class="nav-collapse collapse" id="main-menu">
       	<?php
 $effected_id="main-menu"; $filetpl="<a href='\$href' target='\$target'>\$label</a>"; $foldertpl="<a href='\$href' target='\$target' class='dropdown-toggle' data-toggle='dropdown'>\$label <b class='caret'></b></a>"; $ul_class="dropdown-menu" ; $li_class="li-class" ; $style="nav"; $showlevel=6; $dropdown='dropdown'; echo sp_get_menu("main",$effected_id,$filetpl,$foldertpl,$ul_class,$li_class,$style,$showlevel,$dropdown); ?>
		
		<ul class="nav pull-right" id="main-menu-user">
			<!-- <li class="user login" style="margin-left: 5px;">
	            <a class="dropdown-toggle user notifactions" href="<?php echo U('user/notification/index');?>">
	            <i class="fa fa-envelope"></i>
	            <span class="count">0</span>
	            </a>
          	</li> -->
			<li class="dropdown user login">
	            <a class="dropdown-toggle user" data-toggle="dropdown" href="#">
	            <img src="/web/daikaun/themes/qianshan/Public/assets/images/headicon.png" class="headicon"/>
	            <span class="user-nicename"></span><b class="caret"></b></a>
	            <ul class="dropdown-menu pull-right">
	               <li><a href="<?php echo U('user/profile/password');?>"><i class="fa fa-user"></i> &nbsp;修改密码</a></li>
	               <li class="divider"></li>
	               <li><a href="<?php echo U('user/index/logout');?>"><i class="fa fa-sign-out"></i> &nbsp;退出</a></li>
	            </ul>
          	</li>
          	<li class="dropdown user offline">
          		<!--
	            <a class="dropdown-toggle user" data-toggle="dropdown" href="#">
	           		<img src="/web/daikaun/themes/qianshan/Public/assets/images/headicon.png" class="headicon"/>登录<b class="caret"></b>
	            </a>
	        -->
	            <ul class="dropdown-menu pull-right">
	            	<!--
	               <li><a href="<?php echo U('api/oauth/login',array('type'=>'sina'));?>"><i class="fa fa-weibo"></i> &nbsp;微博登录</a></li>
	               <li><a href="<?php echo U('api/oauth/login',array('type'=>'qq'));?>"><i class="fa fa-qq"></i> &nbsp;QQ登录</a></li>-->
	               <li><a href="<?php echo leuu('user/login/index');?>"><i class="fa fa-sign-in"></i> &nbsp;登录</a></li>
	               <li class="divider"></li>
	               <!--<li><a href="<?php echo leuu('user/register/index');?>"><i class="fa fa-user"></i> &nbsp;注册</a></li>-->
	            </ul>
          	</li>
		</ul>
		<!--
		<div class="pull-right">
        	<form method="post" class="form-inline" action="<?php echo U('portal/search/index');?>" style="margin:18px 0;">
				 <input type="text" class="" placeholder="Search" name="keyword" value="<?php echo I('get.keyword');?>"/>
				 <input type="submit" class="btn btn-info" value="Go" style="margin:0"/>
			</form>
		</div>-->
       </div>
     </div>
   </div>
 </div>
	<div class="container tc-main">
        <div class="row">
            <div class="span3">
                <div class="list-group">
	<!--<a class="list-group-item" href="<?php echo U('user/profile/edit');?>"><i class="fa fa-list-alt fa-fw"></i> 修改资料</a>-->
	<a class="list-group-item" href="<?php echo U('Qianshan/index/userlist');?>"><i class="fa fa-user fa-fw"></i> 用户列表</a>
	<a class="list-group-item" href="<?php echo U('Qianshan/index/useredit');?>"><i class="fa fa-user fa-fw"></i> 增加用户</a>
	<a class="list-group-item" href="<?php echo U('user/profile/password');?>"><i class="fa fa-lock fa-fw"></i> 修改密码</a>
	<!--
	<a class="list-group-item" href="<?php echo U('user/profile/avatar');?>"><i class="fa fa-user fa-fw"></i> 编辑头像</a>
	<a class="list-group-item" href="<?php echo U('user/profile/bang');?>"><i class="fa fa-exchange fa-fw"></i> 绑定账号</a>
	<a class="list-group-item" href="<?php echo U('user/favorite/index');?>"><i class="fa fa-star-o fa-fw"></i> 我的收藏</a>
	 <a class="list-group-item" href="<?php echo U('portal/user/articles');?>"><i class="fa fa-file-text fa-fw"></i> 我的文章</a> 
	<a class="list-group-item" href="<?php echo U('comment/comment/index');?>"><i class="fa fa-comments-o fa-fw"></i> 我的评论</a>-->
	
	<!--
	<a class="list-group-item" href="<?php echo U('Qianshan/index/prolist');?>"><i class="fa fa-user fa-fw"></i> 我的产品</a>
	<a class="list-group-item" href="<?php echo U('Qianshan/index/proedit');?>"><i class="fa fa-user fa-fw"></i> 增加产品</a>-->

</div>
            </div>
            <div class="span8">
				<div class="wrap js-check-wrap">
					<ul class="nav nav-tabs">
						<li class="active"><a href="<?php echo U('Qianshan/Index/userlist');?>">用户列表</a></li>
					</ul>
				
					<form method="post" class="js-ajax-form" action="<?php echo U('Qianshan/product/index');?>">
						<table class="table table-hover table-bordered">
							<thead>
								<tr>
									<th width="30">ID</th>
									<th>姓名</th>
									<th>身份证号</th>
									<th>手机</th>
									<th>添加时间</th>
									<th width="80">操作</th>
								</tr>
							</thead>
							<tbody>
								<?php if(is_array($lists)): foreach($lists as $key=>$vo): ?><tr>
									<td><?php echo ($vo["id"]); ?></td>
									<td><?php echo ($vo["name"]); ?></td>
									<td><?php echo ($vo["idno"]); ?></td>
									<td><?php echo ($vo["mobile"]); ?></td>
									<!--
									<td><input type="checkbox" name="status[<?php echo ($vo["pid"]); ?>]" value="1" <?php if($vo['status']): ?>checked="checked"<?php endif; ?> /></td>-->
									<td><?php echo date('Y-m-d H:i:s', $vo['createtime']);?></td>
									<td>
										<a href='<?php echo U("Qianshan/Index/useredit",array("id"=>$vo["id"]));?>'>编辑</a>&nbsp;&nbsp;
										<a href='<?php echo U("Qianshan/Index/prolist",array("id"=>$vo["id"]));?>'>产品</a>
									</td>
								</tr><?php endforeach; endif; ?>
							</tbody>
						</table>
						<div class="pagination"><?php echo ($page); ?></div>
						<div class="table-actions">
							<button type="submit" class="btn btn-primary btn-small js-ajax-submit">排序</button>
						</div>
					</form>


				</div>
          </div>
		</div>

		<br>
<br>
<br>
<!-- Footer ================================================== -->
<hr>
<?php echo hook('footer');?>
<div id="footer">
	<div class="links">
		<?php $links=sp_getlinks(); ?>
		<?php if(is_array($links)): foreach($links as $key=>$vo): if(!empty($vo["link_image"])): ?><!-- <img src="<?php echo sp_get_image_url($vo['link_image']);?>"> --><!-- 如果想加个友链图片可以取消注释 --><?php endif; ?>
			<a href="<?php echo ($vo["link_url"]); ?>" target="<?php echo ($vo["link_target"]); ?>"><?php echo ($vo["link_name"]); ?></a><?php endforeach; endif; ?>
	</div>
	<p>
		Made by <a href="http://www.thinkcmf.com" target="_blank">ThinkCMF</a>
		Code licensed under the 
		<a href="http://www.apache.org/licenses/LICENSE-2.0" rel="nofollow" target="_blank">Apache License v2.0</a>.
		<br />
		Based on 
		<a href="http://getbootstrap.com/2.3.2/" target="_blank">Bootstrap</a>.
		Icons from 
		<a href="http://fortawesome.github.com/Font-Awesome/" target="_blank">Font Awesome</a>
	</p>
</div>
<div id="backtotop">
	<i class="fa fa-arrow-circle-up"></i>
</div>
<?php echo ($site_tongji); ?>


	</div>
	<!-- /container -->

	<script type="text/javascript">
//全局变量
var GV = {
    ROOT: "/web/daikaun/",
    WEB_ROOT: "/web/daikaun/",
    JS_ROOT: "public/js/"
};
</script>
   <!-- Placed at the end of the document so the pages load faster -->
   <script src="/web/daikaun/public/js/jquery.js"></script>
   <script src="/web/daikaun/public/js/wind.js"></script>
   <script src="/web/daikaun/themes/qianshan/Public/assets/simpleboot/bootstrap/js/bootstrap.min.js"></script>
   <script src="/web/daikaun/public/js/frontend.js"></script>
<script>
$(function(){
	$('body').on('touchstart.dropdown', '.dropdown-menu', function (e) { e.stopPropagation(); });
	
	$("#main-menu li.dropdown").hover(function(){
		$(this).addClass("open");
	},function(){
		$(this).removeClass("open");
	});
	
	$.post("<?php echo U('user/index/is_login');?>",{},function(data){
		if(data.status==1){
			if(data.user.avatar){
				$("#main-menu-user .headicon").attr("src",data.user.avatar.indexOf("http")==0?data.user.avatar:"<?php echo sp_get_image_url('[AVATAR]','!avatar');?>".replace('[AVATAR]',data.user.avatar));
			}
			
			$("#main-menu-user .user-nicename").text(data.user.user_nicename!=""?data.user.user_nicename:data.user.user_login);
			$("#main-menu-user li.login").show();
			
		}
		if(data.status==0){
			$("#main-menu-user li.offline").show();
		}
		
		/* $.post("<?php echo U('user/notification/getLastNotifications');?>",{},function(data){
			$(".nav .notifactions .count").text(data.list.length);
		}); */
		
	});	
	;(function($){
		$.fn.totop=function(opt){
			var scrolling=false;
			return this.each(function(){
				var $this=$(this);
				$(window).scroll(function(){
					if(!scrolling){
						var sd=$(window).scrollTop();
						if(sd>100){
							$this.fadeIn();
						}else{
							$this.fadeOut();
						}
					}
				});
				
				$this.click(function(){
					scrolling=true;
					$('html, body').animate({
						scrollTop : 0
					}, 500,function(){
						scrolling=false;
						$this.fadeOut();
					});
				});
			});
		};
	})(jQuery); 
	
	$("#backtotop").totop();
	
	
});
</script>


</body>
</html>