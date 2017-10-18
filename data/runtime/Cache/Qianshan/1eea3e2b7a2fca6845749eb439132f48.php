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
	<div class="wrap">
		<ul class="nav nav-tabs">
			<li><a href="<?php echo U('Qianshan/product/index');?>">产品列表</a></li>
			<?php if($proinfo['pid'] > 0): ?><li class="active"><a href="<?php echo U('Qianshan/product/proadd',array('pid'=>$proinfo['pid']));?>">编辑产品</a></li>
				
			<?php else: ?>
				<li class="active"><a href="<?php echo U('Qianshan/product/proadd');?>">增加产品</a></li><?php endif; ?>
			
		</ul>
		<form method="post" class="form-horizontal" action="<?php echo U('Qianshan/product/proadd',array('pid'=>$pid));?>">
			<fieldset>
				<div class="control-group">
					<label class="control-label">产品名称</label>
					<div class="controls">
						<input style="width:800px;" type="text" name="proname" id="proname" value="<?php echo ($proinfo['name']); ?>"/>
					</div>
				</div>
				<!--
				<div class="control-group">
					<label class="control-label">产品描述</label>
					<div class="controls">
						<script type="text/plain" id="content" name="post[post_content]"></script>
					</div>
				</div>
				-->
				<div class="control-group">
					<label class="control-label">贷款期限</label>
					<div class="controls">
						<input style="width:100px;" type="text" name="due_time_from" id="due_time_from" value="<?php echo ($proinfo['due_time_from']); ?>"/>月 至 <input style="width:100px;" type="text" name="due_time_to" id="due_time_to" value="<?php echo ($proinfo['due_time_to']); ?>"/>月
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">贷款额度</label>
					<div class="controls">
						<input style="width:100px;" type="text" name="credit_from" id="credit_from" value="<?php echo ($proinfo['credit_from']); ?>"/>万元 至 <input style="width:100px;" type="text" name="credit_to" id="credit_to" value="<?php echo ($proinfo['credit_to']); ?>"/>万元
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">适用年龄</label>
					<?php foreach ($orther_info['age'] as $k=>$v){ for($agei=1;$agei<4;$agei++){ $agetype_select[$k][$agei] = $v['ptype'] == $agei ? ' selected' : ''; } } ?>
					<div class="controls">
						<select name="agetype[]" style="width:120px;">
							<option value="1" <?php echo ($agetype_select[0][1]); ?>>全部</option>
							<option value="2"  <?php echo ($agetype_select[0][2]); ?>>工薪</option>
							<option value="3"  <?php echo ($agetype_select[0][3]); ?>>自雇 </option>
						</select>
						<input style="width:100px;" type="text" name="age_min[]" id="age_min1" value="<?php echo ($orther_info['age'][0]['data1']); ?>"/>周岁 至 <input style="width:100px;" type="text" name="age_max[]" id="age_max1" value="<?php echo ($orther_info['age'][0]['data2']); ?>"/>周岁
						<br/>
						<select name="agetype[]" style="width:120px;">
							<option value="1" <?php echo ($agetype_select[1][1]); ?>>全部</option>
							<option value="2"  <?php echo ($agetype_select[1][2]); ?>>工薪</option>
							<option value="3"  <?php echo ($agetype_select[1][3]); ?>>自雇 </option>
						</select>
						<input style="width:100px;" type="text" name="age_min[]" id="age_min2" value="<?php echo ($orther_info['age'][1]['data1']); ?>"/>周岁 至 <input style="width:100px;" type="text" name="age_max[]" id="age_max2" value="<?php echo ($orther_info['age'][1]['data2']); ?>"/>周岁
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">贷款利息</label>
					<?php for ($i=0;$i<3;$i++){ for($j=1;$j<5;$j++){ $lixitype_select[$i][$j] = $proinfo['interest'][$i]['lixitype'] == $j ? ' selected' : ''; } $lixidw1_select[$i]['fen'] = $proinfo['interest'][$i]['lixidw1'] == 'fen' ? ' selected' : ''; $lixidw1_select[$i]['li'] = $proinfo['interest'][$i]['lixidw1'] == 'li' ? ' selected' : ''; $lixidw2_select[$i]['fen'] = $proinfo['interest'][$i]['lixidw2'] == 'fen' ? ' selected' : ''; $lixidw2_select[$i]['li'] = $proinfo['interest'][$i]['lixidw2'] == 'li' ? ' selected' : ''; } ?>
					<div class="controls">
						<select name="lixitype[]" style="width:120px;">
							<option value="1" <?php echo ($lixitype_select[0][1]); ?>>等额本息</option>
							<option value="2"  <?php echo ($lixitype_select[0][2]); ?>>等额本金</option>
							<option value="3"  <?php echo ($lixitype_select[0][3]); ?>>先息后本 </option>
							<option value="4"  <?php echo ($lixitype_select[0][4]); ?>>日利息 </option>
						</select>
						<input style="width:100px;" type="text" name="lixi1[]" id="lixi1" value="<?php echo ($proinfo['interest'][0]['lixi1']); ?>"/>
						<select name="lixidw1[]" style="width:50px;">
							<option value="fen" <?php echo ($lixidw1_select[0]['fen']); ?>>分</option>
							<option value="li" <?php echo ($lixidw1_select[0]['li']); ?>>厘</option>
						</select>
						 至 <input style="width:100px;" type="text" name="lixi2[]" id="lixi2" value="<?php echo ($proinfo['interest'][0]['lixi2']); ?>"/>
						<select name="lixidw2[]" style="width:50px;">
							<option value="fen" <?php echo ($lixidw2_select[0]['fen']); ?>>分</option>
							<option value="li" <?php echo ($lixidw2_select[0]['li']); ?>>厘</option>
						</select>
						<br/>
						<select name="lixitype[]" style="width:120px;">
							<option value="1" <?php echo ($lixitype_select[1][1]); ?>>等额本息</option>
							<option value="2"  <?php echo ($lixitype_select[1][2]); ?>>等额本金</option>
							<option value="3"  <?php echo ($lixitype_select[1][3]); ?>>先息后本 </option>
							<option value="4"  <?php echo ($lixitype_select[1][4]); ?>>日利息 </option>
						</select>
						<input style="width:100px;" type="text" name="lixi1[]" id="lixi1" value="<?php echo ($proinfo['interest'][1]['lixi1']); ?>"/>
						<select name="lixidw1[]" style="width:50px;">
							<option value="fen" <?php echo ($lixidw1_select[1]['fen']); ?>>分</option>
							<option value="li" <?php echo ($lixidw1_select[1]['li']); ?>>厘</option>
						</select>
						 至 <input style="width:100px;" type="text" name="lixi2[]" id="lixi2" value="<?php echo ($proinfo['interest'][1]['lixi2']); ?>"/>
						<select name="lixidw2[]" style="width:50px;">
							<option value="fen" <?php echo ($lixidw2_select[1]['fen']); ?>>分</option>
							<option value="li" <?php echo ($lixidw2_select[1]['li']); ?>>厘</option>
						</select>
						<br/>
						<select name="lixitype[]" style="width:120px;">
							<option value="1" <?php echo ($lixitype_select[2][1]); ?>>等额本息</option>
							<option value="2"  <?php echo ($lixitype_select[2][2]); ?>>等额本金</option>
							<option value="3"  <?php echo ($lixitype_select[2][3]); ?>>先息后本 </option>
							<option value="4"  <?php echo ($lixitype_select[2][4]); ?>>日利息 </option>
						</select>
						<input style="width:100px;" type="text" name="lixi1[]" id="lixi1" value="<?php echo ($proinfo['interest'][2]['lixi1']); ?>"/>
						<select name="lixidw1[]" style="width:50px;">
							<option value="fen" <?php echo ($lixidw1_select[2]['fen']); ?>>分</option>
							<option value="li" <?php echo ($lixidw1_select[2]['li']); ?>>厘</option>
						</select>
						 至 <input style="width:100px;" type="text" name="lixi2[]" id="lixi2" value="<?php echo ($proinfo['interest'][2]['lixi2']); ?>"/>
						<select name="lixidw2[]" style="width:50px;">
							<option value="fen" <?php echo ($lixidw2_select[2]['fen']); ?>>分</option>
							<option value="li" <?php echo ($lixidw2_select[2]['li']); ?>>厘</option>
						</select>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">贷款手续费</label>
					<?php $commission_type_select[1] = $proinfo['commission_type'] == 1 ? ' selected' : ''; $commission_type_select[2] = $proinfo['commission_type'] == 2 ? ' selected' : ''; ?>
					<div class="controls">
						<input style="width:50px;" type="text" name="commission" id="commission" value="<?php echo ($proinfo['commission']); ?>"/>
						<select name="commission_type" style="width:60px;">
							<option value="1" <?php echo ($commission_type_select[1]); ?>>%</option>
							<option value="2"  <?php echo ($commission_type_select[2]); ?>>元</option>
						</select>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">申请职业</label>
					<div class="controls">
						<?php $occupation_check_text[1] = in_array('公务员',$proinfo['occupation']) ? ' checked':''; $occupation_check_text[2] = in_array('公立医院',$proinfo['occupation']) ? ' checked':''; $occupation_check_text[3] = in_array('公立学校',$proinfo['occupation']) ? ' checked':''; $occupation_check_text[4] = in_array('事业单位',$proinfo['occupation']) ? ' checked':''; $occupation_check_text[5] = in_array('银行',$proinfo['occupation']) ? ' checked':''; $occupation_check_text[6] = in_array('国企',$proinfo['occupation']) ? ' checked':''; $occupation_check_text[7] = in_array('500强',$proinfo['occupation']) ? ' checked':''; $occupation_check_text[8] = in_array('律师',$proinfo['occupation']) ? ' checked':''; $occupation_check_text[9] = in_array('上市公司',$proinfo['occupation']) ? ' checked':''; ?>
						<input type="checkbox" name="occupation[]"  id="occupation_1" value="公务员" <?php echo ($occupation_check_text[1]); ?> />公务员&nbsp;&nbsp;&nbsp;&nbsp;
						<input type="checkbox" name="occupation[]"  id="occupation_2" value="公立医院" <?php echo ($occupation_check_text[2]); ?> />公立医院&nbsp;&nbsp;&nbsp;&nbsp;
						<input type="checkbox" name="occupation[]"  id="occupation_3" value="公立学校"  <?php echo ($occupation_check_text[3]); ?> />公立学校&nbsp;&nbsp;&nbsp;&nbsp;
						<input type="checkbox" name="occupation[]"  id="occupation_4" value="事业单位"  <?php echo ($occupation_check_text[4]); ?> />事业单位&nbsp;&nbsp;&nbsp;&nbsp;
						<input type="checkbox" name="occupation[]"  id="occupation_5" value="银行"  <?php echo ($occupation_check_text[5]); ?> />银行&nbsp;&nbsp;&nbsp;&nbsp;
						<input type="checkbox" name="occupation[]"  id="occupation_6" value="国企"  <?php echo ($occupation_check_text[6]); ?> />国企&nbsp;&nbsp;&nbsp;&nbsp;
						<input type="checkbox" name="occupation[]"  id="occupation_7" value="500强"  <?php echo ($occupation_check_text[7]); ?> />500强&nbsp;&nbsp;&nbsp;&nbsp;
						<input type="checkbox" name="occupation[]"  id="occupation_8" value="律师"  <?php echo ($occupation_check_text[8]); ?> />律师&nbsp;&nbsp;&nbsp;&nbsp;
						<input type="checkbox" name="occupation[]"  id="occupation_9" value="上市公司"  <?php echo ($occupation_check_text[9]); ?> />上市公司
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">适用地区</label>
					<div class="controls">
						
						<?php if(is_array($provinces)): foreach($provinces as $pk=>$vo): $provs_check_text = $provs_check[$vo['id']] == 1 ? ' checked':''; ?>
							<input type="checkbox" name="province[]" id="province_<?php echo ($pk); ?>" <?php echo ($provs_check_text); ?> value="<?php echo ($vo["id"]); ?>"  onclick="check_prov(<?php echo ($pk); ?>);" /><?php echo ($vo["name"]); ?>&nbsp;&nbsp;&nbsp;&nbsp;<?php endforeach; endif; ?>
						<?php if(is_array($provinces)): foreach($provinces as $pk=>$vo): $provs_display_text = $provs_check[$vo['id']] == 1 ? '':'none'; ?>
							<div id="div_province_<?php echo ($pk); ?>" style="display:<?php echo ($provs_display_text); ?>">
								<hr/><p><?php echo ($vo["name"]); ?></p>
								<?php $crucitys = $citys[$vo['id']]; ?>
								<?php if(is_array($crucitys)): foreach($crucitys as $pk1=>$vo1): $city_check_text = in_array($vo1['id'],$proinfo['city']) ? ' checked':''; ?>
									<input type="checkbox" name="citys[]" id="city_<?php echo ($p); ?>" value="<?php echo ($vo1["id"]); ?>" <?php echo ($city_check_text); ?> /><?php echo ($vo1["name"]); ?>&nbsp;&nbsp;&nbsp;&nbsp;<?php endforeach; endif; ?>	
							</div><?php endforeach; endif; ?>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">申请资料</label>
					<div class="controls">
						<textarea name="apply_material" id="apply_material" rows="5" cols="300"><?php echo ($proinfo['apply_material']); ?></textarea>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">提前还款须知</label>
					<div class="controls">
						
						<textarea name="prepayment_notice" id="prepayment_notice" rows="5" cols="300"><?php echo ($proinfo['prepayment_notice']); ?></textarea>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">逾期还款须知</label>
					<div class="controls">
						
						<textarea name="overdue_repayment_notice" id="overdue_repayment_notice" rows="5" cols="300"><?php echo ($proinfo['overdue_repayment_notice']); ?></textarea>
					</div>
				</div>
				
				
			</fieldset>
			<div class="form-actions">
				<button type="submit" class="btn btn-primary js-ajax-submit"><?php echo L('ADD');?></button>
				<a class="btn" href="javascript:history.back(-1);"><?php echo L('BACK');?></a>
			</div>
		</form>
	</div>
	<script src="/web/daikaun/public/js/common.js"></script>
	<?php $provcount = count($provinces); ?>
	<script type="text/javascript">
		provcount = <?php echo ($provcount); ?>;
		function check_prov(id){
			if(document.getElementById("province_"+id).checked){
				document.getElementById("div_province_"+id).style.display = '';
			    
			}else{
				document.getElementById("div_province_"+id).style.display = 'none';
			}
		}
		
	</script>
</body>
</html>