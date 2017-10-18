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
			<li><a href="<?php echo U('Qianshan/User/userlist');?>">普通用户列表</a></li>
			<li class="active"><a href="<?php echo U('Qianshan/User/useredit');?>">增加普通用户</a></li>
		</ul>
        		<form method="post" class="form-horizontal" action="<?php echo U('Qianshan/User/useredit',array('id'=>$userinfo['id']));?>">

        			<table class="table table-hover table-bordered">
        				<thead>
							<tr style="background:#3e5771; color:#FFF;"><th colspan="6">客户登记表</th></tr>
						</thead>
						<tbody>
							<tr>
								<td>信贷经理</td>
								<td>
									<select name="loan_manager_id" style="width:200px;">
										<?php if(is_array($lists)): foreach($lists as $key=>$vo): ?><option value="<?php echo ($vo["id"]); ?>"><?php echo ($vo["relname"]); ?></option><?php endforeach; endif; ?>
									</select>
								</td>
								<td>姓名*</td>
								<td><input style="width:80px;" type="text" name="name" id="name" value="<?php echo ($userinfo['name']); ?>"/></td>
								<td>身份证号码*</td>
								<td><input style="width:180px;" type="text" name="idno" id="idno" value="<?php echo ($userinfo['idno']); ?>"/></td>
							</tr>
							<tr>
								<td>生日*</td>
								<td>
									<input style="width:100px;" type="text" name="birthday" id="birthday" class="js-date" value="<?php echo ($userinfo['birthday']); ?>"/>
								</td>
								<td>婚姻状况</td>
								<td colspan="3">
									<select name="marry_status" style="width:100px;" onchange="marry_date_select(this.value);">
										<?php $marry_status_select[1] = $userinfo['marry_status'] == 1 ? 'selected':''; $marry_status_select[2] = $userinfo['marry_status'] == 2 ? 'selected':''; $marry_status_select[3] = $userinfo['marry_status'] == 3 ? 'selected':''; $marry_date_span_display = $userinfo['marry_status'] == 2 ? '':'none'; ?>
										<option value="1" <?php echo ($marry_status_select[1]); ?>>未婚</option>
										<option value="2" <?php echo ($marry_status_select[2]); ?>>已婚</option>
										<option value="3" <?php echo ($marry_status_select[3]); ?>>离婚</option>
									</select>
									<span id="marry_date_span" style="display:<?php echo ($marry_date_span_display); ?>;">
								结婚日期<input style="width:100px;" type="text" name="marry_date" id="marry_date" class="js-date" value="<?php echo ($userinfo['marry_date']); ?>"/></span></td>
							</tr>
							<tr>
								<td>性别</td>
								<td>
									<select name="gender" style="width:60px;">
										<?php $gender_select[1] = $userinfo['gender'] == 1 ? 'selected':''; $gender_select[2] = $userinfo['gender'] == 2 ? 'selected':''; ?>
										<option value="1" <?php echo ($gender_select[1]); ?>>男</option>
										<option value="2" <?php echo ($gender_select[2]); ?>>女</option>
									</select>
								</td>
								<td>学历</td>
								<td colspan="3">
									<select name="educational" style="width:100px;">
										<?php $educational_select[1] = $userinfo['educational'] == 1 ? 'selected':''; $educational_select[2] = $userinfo['educational'] == 2 ? 'selected':''; $educational_select[3] = $userinfo['educational'] == 3 ? 'selected':''; ?>
										<option value="1" <?php echo ($educational_select[1]); ?>>本科</option>
										<option value="2" <?php echo ($educational_select[2]); ?>>硕士</option>
										<option value="3" <?php echo ($educational_select[3]); ?>>博士</option>
									</select>
								毕业年限<input style="width:100px;" type="text" name="graduation_after_time" id="graduation_after_time" value="<?php echo ($userinfo['graduation_after_time']); ?>"/>月</td>
							</tr>
							<tr>
								<td>手机号码</td>
								<td>
									<input style="width:100px;" type="text" name="mobile" id="mobile" value="<?php echo ($userinfo['mobile']); ?>"/>
								</td>
								<td>所在城市</td>
								<td colspan="3">
									<select name="province" style="width:130px;" onchange="getCity(this.selectedIndex)">
										<option value="0">请选择</option>
										<?php if(is_array($provinces)): foreach($provinces as $pk=>$vo): $province_select = ''; if ($userinfo['province'] == $vo['id']){ $province_select = 'selected'; } ?>
											<option value="<?php echo ($vo["id"]); ?>" <?php echo ($province_select); ?>><?php echo ($vo["name"]); ?></option><?php endforeach; endif; ?>
									</select>
									<select name="city" style="width:130px;" id='city_sel'>
										<option value="0">请选择</option>
										<?php if($userinfo['city']): $city_selects = $citys[$userinfo['province']]; ?>
											<?php if(is_array($city_selects)): foreach($city_selects as $pk1=>$vo1): $city_select = ''; if ($userinfo['city'] == $vo1['name']){ $city_select = 'selected'; } ?>
												<option value="<?php echo ($vo1["name"]); ?>" <?php echo ($city_select); ?>><?php echo ($vo1["name"]); ?></option><?php endforeach; endif; endif; ?>
									</select>									
								</td>
							</tr>
							<tr>
								<td>需要贷款金额</td>
								<td colspan="2">
									<input style="width:100px;" type="text" name="required_load_amount" id="required_load_amount" value="<?php echo ($userinfo['required_load_amount']); ?>"/>万元
								</td>
								<td>需要贷款时间</td>
								<td colspan="2">
									<input style="width:100px;" type="text" name="required_load_term" id="required_load_term" value="<?php echo ($userinfo['required_load_term']); ?>"/>月							
								</td>
							</tr>
						</tbody>
        				<thead>
							<tr style="background:#3e5771; color:#FFF;"><th colspan="6">薪资情况</th></tr>
						</thead>
						<tbody>
							<tr>
								<td>平均月薪</td>
								<td colspan="2">
									<input style="width:100px;" type="text" name="salary" id="salary" value="<?php echo ($userinfo['salary']); ?>"/>元
								</td>
								<td>个税缴纳时长</td>
								<td colspan="2">
									<input style="width:100px;" type="text" name="income_tax_duration" id="income_tax_duration" value="<?php echo ($userinfo['income_tax_duration']); ?>"/>月							
								</td>
							</tr>
							<tr>
								<td>公积金基数</td>
								<td>
									<input style="width:100px;" type="text" name="housing_fund_base_fee" id="housing_fund_base_fee" value="<?php echo ($userinfo['housing_fund_base_fee']); ?>"/>元
								</td>
								<td>公积金月平均缴费金额</td>
								<td>
									<input style="width:100px;" type="text" name="housing_fund_fee" id="housing_fund_fee" value="<?php echo ($userinfo['housing_fund_fee']); ?>"/>元
								</td>
								<td>公积金连续缴纳时长</td>
								<td>
									<input style="width:100px;" type="text" name="housing_fund_duration" id="housing_fund_duration" value="<?php echo ($userinfo['housing_fund_duration']); ?>"/>月			
								</td>
							</tr>
							<tr>
								<td>职业</td>
								<td colspan="2">
									<select name="occpation" style="width:100px;">
										<?php $occpation_select[1] = $userinfo['occpation'] == '民企' ? 'selected':''; $occpation_select[2] = $userinfo['occpation'] == '公务员' ? 'selected':''; $occpation_select[3] = $userinfo['occpation'] == '事业单位' ? 'selected':''; $occpation_select[4] = $userinfo['occpation'] == '公立医院' ? 'selected':''; $occpation_select[5] = $userinfo['occpation'] == '公立学校' ? 'selected':''; $occpation_select[6] = $userinfo['occpation'] == '银行' ? 'selected':''; $occpation_select[7] = $userinfo['occpation'] == '国企' ? 'selected':''; $occpation_select[8] = $userinfo['occpation'] == '500强' ? 'selected':''; $occpation_select[9] = $userinfo['occpation'] == '律师' ? 'selected':''; ?>
										<option value=""></option>
										<option value="民企" <?php echo ($occpation_select[1]); ?>>民企</option>
										<option value="公务员" <?php echo ($occpation_select[2]); ?>>公务员</option>
										<option value="事业单位" <?php echo ($occpation_select[3]); ?>>事业单位</option>
										<option value="公立医院" <?php echo ($occpation_select[4]); ?>>公立医院</option>
										<option value="公立学校" <?php echo ($occpation_select[5]); ?>>公立学校</option>
										<option value="银行" <?php echo ($occpation_select[6]); ?>>银行</option>
										<option value="国企" <?php echo ($occpation_select[7]); ?>>国企</option>
										<option value="500强" <?php echo ($occpation_select[8]); ?>>500强</option>
										<option value="律师" <?php echo ($occpation_select[9]); ?>>律师</option>
									</select>
								</td>
								<td>入职时长</td>
								<td colspan="2">
									<input style="width:100px;" type="text" name="occupation_duration" id="occupation_duration" value="<?php echo ($userinfo['occupation_duration']); ?>"/>月							
								</td>
							</tr>
							<tr>
								<td>社保月平均缴纳金额</td>
								<td colspan="2">
									<input style="width:100px;" type="text" name="social_security_fee" id="social_security_fee" value="<?php echo ($userinfo['social_security_fee']); ?>"/>元
								</td>
								<td>社保连续缴纳时长</td>
								<td colspan="2">
									<input style="width:100px;" type="text" name="social_security_duration" id="social_security_duration" value="<?php echo ($userinfo['social_security_duration']); ?>"/>月					
								</td>
							</tr>
							<tr>
								<td>芝麻信用分数</td>
								<td colspan="2">
									<input style="width:100px;" type="text" name="sesame_credit" id="sesame_credit" value="<?php echo ($userinfo['sesame_credit']); ?>"/>分
								</td>
								<td>支付宝注册时长</td>
								<td colspan="2">
									<input style="width:100px;" type="text" name="alipay_register_date" id="alipay_register_date" value="<?php echo ($userinfo['alipay_register_date']); ?>"/>月		
								</td>
							</tr>
							<tr>
								<td>信用卡授信额度</td>
								<td colspan="2">
									<input style="width:100px;" type="text" name="credit_line" id="credit_line" value="<?php echo ($userinfo['credit_line']); ?>"/>元
								</td>
								<td>信用卡使用时长</td>
								<td colspan="2">
									<input style="width:100px;" type="text" name="credit_card_duration" id="credit_card_duration" value="<?php echo ($userinfo['credit_card_duration']); ?>"/>月		
								</td>
							</tr>
						</tbody>
         				<thead>
							<tr style="background:#3e5771; color:#FFF;"><th colspan="6">汽车情况</th></tr>
						</thead>
						<tbody>
							<tr>
								<td>汽车类型</td>
								<td>
									<select name="car_hand" style="width:100px;">
									    <option value="0"></option>
										<?php $car_hand_select[1] = $userinfo['car_hand'] == 1 ? 'selected':''; $car_hand_select[2] = $userinfo['car_hand'] == 2 ? 'selected':''; ?>
										<option value="1" <?php echo ($car_hand_select[1]); ?>>一手车</option>
										<option value="2" <?php echo ($car_hand_select[2]); ?>>二手车</option>
									</select>
								</td>
								<td>车龄</td>
								<td><input style="width:30px;" type="text" name="car_age" id="car_age" value="<?php echo ($userinfo['car_age']); ?>"/>月</td>
								<td>车估值</td>
								<td><input style="width:100px;" type="text" name="car_value" id="car_value" value="<?php echo ($userinfo['car_value']); ?>"/>万元</td>
							</tr>
							
						</tbody>
         				<thead>
							<tr style="background:#3e5771; color:#FFF;"><th colspan="6">房屋信息</th></tr>
						</thead>
						<tbody>
							<tr>
								<td>物业登记时间</td>
								<td>
									<input style="width:100px;" type="text" name="oroperty_register_date" id="oroperty_register_date" value="<?php echo ($userinfo['oroperty_register_date']); ?>"/>月
								</td>
								<td>是否有物业出租</td>
								<td>
									<input type="radio" value="1" name="rental_property_check" <?php if($userinfo['rental_property_check'] == 1): ?>checked="checked"<?php endif; ?> />是
									<input type="radio" value="0" name="rental_property_check" <?php if($userinfo['rental_property_check'] == 0): ?>checked="checked"<?php endif; ?> />否

								</td>
								<td>按揭物业月供金额</td>
								<td>
									<input style="width:100px;" type="text" name="mortgage_property_fee" id="mortgage_property_fee" value="<?php echo ($userinfo['mortgage_property_fee']); ?>"/>元
								</td>
							</tr>
							<tr>
								<td>按揭物业已供时长</td>
								<td>
									<input style="width:100px;" type="text" name="mortgage_property_duration" id="mortgage_property_duration" value="<?php echo ($userinfo['mortgage_property_duration']); ?>"/>月
								</td>
								<td>已结清按揭房产的时长</td>
								<td colspan="3">
									<input style="width:100px;" type="text" name="mortgage_property_paid_off_duration" id="mortgage_property_paid_off_duration" value="<?php echo ($userinfo['mortgage_property_paid_off_duration']); ?>"/>月
								</td>
							</tr>
							
						</tbody>
         				<thead>
							<tr style="background:#3e5771; color:#FFF;"><th colspan="6">POS信息</th></tr>
						</thead>
						<tbody>
							<tr>
								<td>pos安装时长</td>
								<td colspan="2">
									<input style="width:100px;" type="text" name="pos_register_date" id="pos_register_date" value="<?php echo ($userinfo['pos_register_date']); ?>"/>月
								</td>
								<td>pos月流水金额</td>
								<td colspan="2"><input style="width:100px;" type="text" name="pos_money" id="pos_money" value="<?php echo ($userinfo['pos_money']); ?>"/>元</td>
							</tr>
							
						</tbody>
         				<thead>
							<tr style="background:#3e5771; color:#FFF;"><th colspan="6">公司信息</th></tr>
						</thead>
						<tbody>
							<tr>
								<td>是否是公司法人</td>
								<td>
									<input type="radio" value="0" name="company_owner" <?php if($userinfo['company_owner'] == 0): ?>checked="checked"<?php endif; ?> />职工
									<input type="radio" value="1" name="company_owner"  <?php if($userinfo['company_owner'] == 1): ?>checked="checked"<?php endif; ?> />个体户
									<input type="radio" value="2" name="company_owner" <?php if($userinfo['company_owner'] == 2): ?>checked="checked"<?php endif; ?> />法人
								</td>
								<td>占公司股份百分比</td>
								<td><input style="width:100px;" type="text" name="company_share" id="company_share" value="<?php echo ($userinfo['company_share']); ?>"/>％</td>
								<td>公司注册资金</td>
								<td><input style="width:100px;" type="text" name="company_capital" id="company_capital" value="<?php echo ($userinfo['company_capital']); ?>"/>万元</td>
							</tr>
							<tr>
								<td>公司注册时长</td>
								<td>
									<input style="width:100px;" type="text" name="company_register_duration" id="company_register_duration" value="<?php echo ($userinfo['company_register_duration']); ?>"/>月
								</td>
								<td>公司月营业额</td>
								<td colspan="3"><input style="width:100px;" type="text" name="company_sales" id="company_sales" value="<?php echo ($userinfo['company_sales']); ?>"/>万元</td>
							</tr>
						</tbody>
         				<thead>
							<tr style="background:#3e5771; color:#FFF;"><th colspan="6">保单信息</th></tr>
						</thead>
						<tbody>
							<tr>
								<td>保单类型</td>
								<td colspan="2">
									<select name="insurance_type" style="width:100px;">
										<?php $insurance_type_select[1] = $userinfo['insurance_type'] == 1 ? 'selected':''; $insurance_type_select[2] = $userinfo['insurance_type'] == 2 ? 'selected':''; $insurance_type_select[3] = $userinfo['insurance_type'] == 3 ? 'selected':''; ?>
										<option value="0"}> </option>
										<option value="1" <?php echo ($insurance_type_select[1]); ?>>分红型</option>
										<option value="2" <?php echo ($insurance_type_select[2]); ?>>传统型</option>
										<option value="3" <?php echo ($insurance_type_select[3]); ?>>万能险</option>
									</select>
								</td>
								<td>保单生效时长</td>
								<td colspan="2"><input style="width:100px;" type="text" name="insurance_effective_time" id="insurance_effective_time" value="<?php echo ($userinfo['insurance_effective_time']); ?>"/>月</td>
								
							</tr>
							<tr>
								<td>保单缴金额</td>
								<td colspan="2">
									<select name="insurance_fee_type" style="width:80px;">
										<?php $insurance_fee_type_select[1] = $userinfo['insurance_fee_type'] == 1 ? 'selected':''; $insurance_fee_type_select[2] = $userinfo['insurance_fee_type'] == 2 ? 'selected':''; $insurance_fee_type_select[3] = $userinfo['insurance_fee_type'] == 3 ? 'selected':''; $insurance_fee_type_select[4] = $userinfo['insurance_fee_type'] == 4 ? 'selected':''; ?>
										<option value="1" <?php echo ($insurance_fee_type_select[1]); ?>>月交</option>
										<option value="2" <?php echo ($insurance_fee_type_select[2]); ?>>季交</option>
										<option value="3" <?php echo ($insurance_fee_type_select[3]); ?>>年交</option>
										<option value="4" <?php echo ($insurance_fee_type_select[4]); ?>>趸交</option>
										
									</select>
									<input style="width:100px;" type="text" name="insurance_monthly_fee" id="insurance_monthly_fee" value="<?php echo ($userinfo['insurance_monthly_fee']); ?>"/>元
								</td>
								<td>保单已缴时长</td>
								<td colspan="2"><input style="width:100px;" type="text" name="insurance_fee_time" id="insurance_fee_time" value="<?php echo ($userinfo['insurance_fee_time']); ?>"/>月</td>
							</tr>
						</tbody>
         				<thead>
							<tr style="background:#3e5771; color:#FFF;"><th colspan="6">网购信息</th></tr>
						</thead>
							<tr>
								<td>淘宝注册时长</td>
								<td colspan="2">
									<input style="width:100px;" type="text" name="taobao_register_duration" id="taobao_register_duration" value="<?php echo ($userinfo['taobao_register_duration']); ?>"/>月
								</td>
								<td>淘宝信用等级</td>
								<td colspan="2">
									<select name="taobao_credit_line" style="width:50px;">
										<option value=""></option>
										<?php $taobao_credit_line_select[1] = $userinfo['taobao_credit_line'] == 1 ? 'selected':''; $taobao_credit_line_select[2] = $userinfo['taobao_credit_line'] == 2 ? 'selected':''; $taobao_credit_line_select[3] = $userinfo['taobao_credit_line'] == 3 ? 'selected':''; $taobao_credit_line_select[4] = $userinfo['taobao_credit_line'] == 4 ? 'selected':''; $taobao_credit_line_select[5] = $userinfo['taobao_credit_line'] == 5 ? 'selected':''; ?>
										<option value="1" <?php echo ($taobao_credit_line_select[1]); ?>>1</option>
										<option value="2" <?php echo ($taobao_credit_line_select[2]); ?>>2</option>
										<option value="3" <?php echo ($taobao_credit_line_select[3]); ?>>3</option>
										<option value="4" <?php echo ($taobao_credit_line_select[4]); ?>>4</option>
										<option value="5" <?php echo ($taobao_credit_line_select[5]); ?>>5</option>
									</select>
									<select name="taobao_credit_type" style="width:60px;">
										<option value=""></option>
										<?php $taobao_credit_type_select[1] = $userinfo['taobao_credit_type'] == 1 ? 'selected':''; $taobao_credit_type_select[2] = $userinfo['taobao_credit_type'] == 2 ? 'selected':''; $taobao_credit_type_select[3] = $userinfo['taobao_credit_type'] == 3 ? 'selected':''; ?>
										<option value="1" <?php echo ($taobao_credit_type_select[1]); ?>>星</option>
										<option value="2" <?php echo ($taobao_credit_type_select[2]); ?>>钻</option>
										<option value="3" <?php echo ($taobao_credit_type_select[3]); ?>>皇冠</option>
									</select>
								</td>
								
							</tr>
							<tr>
								<td>淘宝好评率</td>
								<td colspan="2">
									<input style="width:100px;" type="text" name="taobao_comment_rate" id="taobao_comment_rate" value="<?php echo ($userinfo['taobao_comment_rate']); ?>"/>%
								</td>
								<td>京东会员级别</td>
								<td colspan="2">
									<select name="jingdong_credit_line" style="width:100px;">
										<option value=""></option>
										<?php $jingdong_credit_line_select[1] = $userinfo['jingdong_credit_line'] == 1 ? 'selected':''; $jingdong_credit_line_select[2] = $userinfo['jingdong_credit_line'] == 2 ? 'selected':''; ?>
										<option value="1" <?php echo ($jingdong_credit_line_select[1]); ?>>银牌</option>
										<option value="2" <?php echo ($jingdong_credit_line_select[2]); ?>>金牌</option>
									</select>
									<input style="width:100px;" type="text" name="jingdong_rate" id="jingdong_rate" value="<?php echo ($userinfo['jingdong_rate']); ?>"/>分
								</td>
							</tr>
						
        			</table>
			
			<div class="form-actions">
				<button type="submit" class="btn btn-primary js-ajax-submit"><?php echo L('ADD');?></button>
				<a class="btn" href="javascript:history.back(-1);"><?php echo L('BACK');?></a>
			</div>
		</form>

	</div>
	<script src="/web/daikaun/public/js/common.js"></script>
	<script>
		var arr = new  Array();
		<?php if(is_array($provinces)): foreach($provinces as $key=>$vo): $crucitys = $citys[$vo['id']];$citys1=array(); ?>
			<?php if(is_array($crucitys)): foreach($crucitys as $key=>$vo1): $citys1[] = $vo1['name']; endforeach; endif; ?>
			<?php $crucityt = implode(",",$citys1); ?>
			arr[<?php echo ($vo["id"]); ?>] = "<?php echo ($crucityt); ?>";<?php endforeach; endif; ?>
		
		function getCity(proid){
			var city = document.getElementById("city_sel");
			var cityArr = arr[proid].split(",");  
		    city.length = 0;
		    
		    for(var i=0;i<cityArr.length;i++)
		    {
             	city[i]=new Option(cityArr[i],cityArr[i]);
         	}
			
			
		}
		function marry_date_select(status){
			var marry_date_span = document.getElementById("marry_date_span");
			if (status == 2){
				marry_date_span.style.display = '';
			}else{
				marry_date_span.style.display = 'none';

			}
			
			
			
		}
	</script>
</body>
</html>