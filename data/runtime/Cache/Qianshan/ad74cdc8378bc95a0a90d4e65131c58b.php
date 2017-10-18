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
			<li class="active"><a href="<?php echo U('Qianshan/product/shenqing',array("pid"=>$proinfo["pid"]));?>">申请条件</a></li>
			<!--
			<li><a href="<?php echo U('Qianshan/product/shenqingadd',array("pid"=>$proinfo["pid"]));?>">添加条件</a></li>-->
			<li><a href="<?php echo U('Qianshan/product/index');?>">返回产品列表</a></li>
		</ul>
		<form class="well form-search" name="myform" id="myform" method="post" action="<?php echo U('Qianshan/product/shenqing');?>">
            当前产品为： <?php echo ($proinfo['name']); ?><br/>选项:
            <input type="hidden" name="pid" value="<?php echo ($proinfo["pid"]); ?>" />
            <input type="hidden" name="cid" value="<?php echo ($coninfo["cid"]); ?>" />
            <select name="optionname" style="width:200px;" id="optionname" onchange="xiangmu_change(this.value);">
            	<option value="" ></option>
            	<?php if(is_array($canshus)): foreach($canshus as $key=>$vo): if ($coninfo['optionname'] == $vo['csid']){ $optionname_select = ' selected'; }else{ $optionname_select = ' '; } ?>
            		<option value="<?php echo ($vo["csid"]); ?>" <?php echo ($optionname_select); ?>><?php echo ($vo["csname"]); ?></option><?php endforeach; endif; ?>
            </select>
            <select name="equationtype" style="width:120px;" id="equationtype">
            	<?php if(is_array($ops)): foreach($ops as $key=>$vo): if ($coninfo['equationtype'] == $vo['opid']){ $equationtype_select = ' selected'; }else{ $equationtype_select = ' '; } ?>
            		<option value="<?php echo ($vo["opid"]); ?>" <?php echo ($equationtype_select); ?>><?php echo ($vo["opname"]); ?></option><?php endforeach; endif; ?>
            </select>
            <input type="text" name="content" value="<?php echo ($coninfo["content"]); ?>" id="content"/>
            <span id="occpation_check" style="display:none;">
            	<input name="content1[]" value="民企" type="checkbox">民企
            	<input name="content1[]" value="公务员" type="checkbox">公务员
            	<input name="content1[]" value="事业单位" type="checkbox">事业单位
            	<input name="content1[]" value="公立医院" type="checkbox">公立医院
            	<input name="content1[]" value="公立学校" type="checkbox">公立学校
            	<input name="content1[]" value="银行" type="checkbox">银行
            	<input name="content1[]" value="国企" type="checkbox">国企
            	<input name="content1[]" value="500强" type="checkbox">500强
            	<input name="content1[]" value="律师" type="checkbox">律师
            </span>
            <span id="marry_status_check" style="display:none;">
            	
            	<input name="content1[]" value="未婚" type="checkbox" >未婚
            	<input name="content1[]" value="已婚" type="checkbox">已婚
            	<input name="content1[]" value="离婚" type="checkbox">离婚
            	
            </span>
            <span id="insurance_type_check" style="display:none;">
            	
            	<input name="content1[]" value="分红型" type="checkbox" >分红型
            	<input name="content1[]" value="传统型" type="checkbox">传统型
            	<input name="content1[]" value="万能险" type="checkbox">万能险
            </span>
            <span id="gender_check" style="display:none;">
            	
            	<input name="content1[]" value="男" type="checkbox" >男
            	<input name="content1[]" value="女" type="checkbox">女
            </span>
            <span id="educational_check" style="display:none;">
            	<input name="content1[]" value="本科" type="checkbox" >本科
            	<input name="content1[]" value="硕士" type="checkbox">硕士
           		<input name="content1[]" value="博士" type="checkbox">博士
            </span>
            <span id="car_hand_check" style="display:none;">
            	<input name="content1[]" value="1" type="checkbox" >一手车
            	<input name="content1[]" value="2" type="checkbox">二手车
           		
            </span>
            <span id="educational_check" style="display:none;">
            	<input name="content1[]" value="本科" type="checkbox" >本科
            	<input name="content1[]" value="硕士" type="checkbox">硕士
           		<input name="content1[]" value="博士" type="checkbox">博士
            </span>
            <span id="rental_property_check_check" style="display:none;">
            	<input name="content1[]" value="是" type="checkbox" >是
            	
            </span>
            <span id="company_owner_check" style="display:none;">
            	<input name="content1[]" value="是" type="checkbox" >是
            </span>
            <span id="taobao_credit_line_check" style="display:none;">
            	大于
	            <select name="content1[]" style="width:120px;" >
					<option value="1">1</option>
					<option value="2">2</option>
					<option value="3">3</option>
					<option value="4">4</option>
					<option value="5">5</option>	            	
	            </select>
	            <select name="content1[]" style="width:120px;" >
					<option value="1">星</option>
					<option value="2">钻</option>
					<option value="3">皇冠</option>
	            </select>
            </span>
            
            <span id="jingdong_credit_line_check" style="display:none;">
            	大于
	            <select name="content1[]" style="width:120px;" >
					<option value="1">银牌</option>
					<option value="2">金牌</option>
					
	            </select>
	            <input type="text" name="content1[]" style="width:80px;" />分
            </span>
            <span id="insurance_fee_type_check" style="display:none;">
            	<select name="content1[]" style="width:80px;">
            		<option value="" ></option>
            		<option value="月缴" >月缴</option>
            		<option value="季缴" >季缴</option>
            		<option value="年缴" >年缴</option>
            	</select> 大于
            	<input type="text" name="content1[]" style="width:80px;" />元
            	
            </span>
            <input type="submit" class="btn btn-primary" value="确定" />

        </form>       
		<table class="table table-hover table-bordered">
			<thead>
				<tr>
					<th width="50">ID</th>
					<th>选项</th>
					<th>条件</th>
					<th>内容</th>
					<!--<th><?php echo L('STATUS');?></th>-->
					<th width="120"><?php echo L('ACTIONS');?></th>
				</tr>
			</thead>
			<tbody>
				
				<?php if(is_array($proconlist)): foreach($proconlist as $key=>$vo): ?><tr>
					<td><?php echo ($vo["cid"]); ?></td>
					<td><?php echo ($vo["optionname"]); ?></td>
					<td><?php echo ($vo["equationtype"]); ?></td>
					<td><?php echo ($vo["content"]); ?></td>
					
					<!--<td><?php echo ($user_statuses[$vo['user_status']]); ?></td>-->
					<td>
						
						<a  href="<?php echo U('Qianshan/product/shenqing',array('pid'=>$proinfo['pid'],'cid'=>$vo['cid']));?>"><?php echo L('EDIT');?></a>
						 | <a  href="<?php echo U('Qianshan/product/shenqing',array('type'=>'del','pid'=>$proinfo['pid'],cid=>$vo['cid']));?>"><?php echo L('DELETE');?></a>
						
					</td>
				</tr><?php endforeach; endif; ?>
			</tbody>
		</table>
		<div class="pagination"><?php echo ($page); ?></div>
	</div>
	<script src="/web/daikaun/public/js/common.js"></script>
	<script>

		function xiangmu_change(xiangmuchange){
			//alert(xiangmuchange);//car_hand

			var xms=new Array();
			var orther_dis = true;
			xms[0] = 'occpation';
			xms[1] = 'marry_status';
			xms[2] = 'insurance_type';
			xms[3] = 'insurance_fee_type';
			xms[4] = 'gender';
			xms[5] = 'educational';
			xms[6] = 'rental_property_check';
			xms[7] = 'company_owner';
			xms[8] = 'taobao_credit_line';
			xms[9] = 'jingdong_credit_line';
			xms[10] = 'car_hand';

			
			var arr_c1 = document.getElementsByName("content1[]") ;
			for(var i1=0;i1<arr_c1.length;i1++){
				 if(arr_c1[i1].checked == true)  
				  {  
				  	arr_c1[i1].checked = false; 
				  }  
			}

			for(var i=0;i<xms.length;i++){
				
				document.getElementById(xms[i] + "_check").style.display='none';
				if (xiangmuchange == xms[i]){
					document.getElementById(xms[i] + "_check").style.display='';
					
					orther_dis = false;
				}
			}			

			if (!orther_dis){
				document.getElementById("equationtype").style.display = 'none';
				document.getElementById("content").style.display = 'none';
			}else{
				document.getElementById("equationtype").style.display = '';
				document.getElementById("content").style.display = '';
			}
			
		}
	</script>
</body>
</html>