<?php
/**
 * 后台首页
 */
namespace Qianshan\Controller;

use Common\Controller\AdminbaseController;

class UserController extends AdminbaseController {
	
    function _initialize(){
        
    }
	
    /**
     * 信贷经理列表
     */
    public function managelist() {
        $mibile = trim($_POST['mibile']);
        $where[] = array('user_type'=>3);
        if ($username != ''){
            $where[] = array('mibile'=>$mibile);
        }
        $lists = array();
        foreach (M('Users')->where($where)->select() as $k=>$v){
            $relnameinfo = M('JsLoanManager')->where('id='.$v['id'])->find();
            $v['relname'] = $relnameinfo['name'];
            $lists[] = $v;
        }

        $this->assign("lists",$lists);
        $this->display();
    }
    /**
     * 信贷经理管理
     */
    public function manageedit() {

        $id = intval($_GET['id']);
        $provinces = M('JsDistrict')->where('level=1 AND upid=0')->select();

        if(IS_POST){
            $relname=I('post.relname');
            $password=I('post.password');
            $mobile=I('post.mobile');
           if ($id>0){
                $savedata['mobile'] = $mobile;
                if($password>0){
                    $savedata['user_pass'] = sp_password($password);
                }
                M("Users")->where('id='.$id)->save($savedata);
                M('JsLoanManager')->where('id='.$id)->save(array('name'=>$relname));
                $this->success("编辑信贷经理成功！",U("Qianshan/User/manageedit"));
                exit;
            }else{
                $rules = array(
                    //array(验证字段,验证规则,错误提示,验证条件,附加规则,验证时间)
                    array('mobile', 'require', '手机号不能为空！', 1 ),
                    array('mobile','','手机号已被注册！！',0,'unique',3),
                    array('password','require','密码不能为空！',1),
                    array('password','5,20',"密码长度至少5位，最多20位！",1,'length',3),
                );
                    
                $users_model=M("Users");
                 
                if($users_model->validate($rules)->create()===false){
                    $this->error($users_model->getError());
                }
                
                 
                
                $users_model=M("Users");
                $data=array(
                    'user_login' => '',
                    'user_email' => '',
                    'mobile' =>$mobile,
                    'user_nicename' =>'',
                    'user_pass' => sp_password($password),
                    'last_login_ip' => get_client_ip(0,true),
                    'create_time' => date("Y-m-d H:i:s"),
                    'last_login_time' => date("Y-m-d H:i:s"),
                    'user_status' => 1,
                    "user_type"=>3,//信贷经理
                );
                
                $result = $users_model->add($data);
                $result1 = M('JsLoanManager')->add(array('id'=>$result,'name'=>$relname));

                if($result){
                    //注册成功页面跳转
                    $data['id']=$result;
                    //session('user',$data);
                    $this->success("添加信贷经理成功！",U("Qianshan/User/managelist"));
                     
                }else{
                    $this->error("添加信贷经理失败！",U("Qianshan/User/managelist"));
                }
                exit;
            }
        }else{
            if($id >0){
                $userinfo = M('Users')->where('id='.$id)->find();
                $relname_info = M('JsLoanManager')->where('id='.$id)->find();
            }
        }
        $this->assign("id",$id);
        $this->assign("userinfo",$userinfo);
        $this->assign("relname_info",$relname_info);
        $this->display();
    }
    
    /**
     * 普通用户列表
     */
    public function userlist(){
        
        $lists = array();
        foreach (M('JsUserProfile')->where()->select() as $k=>$v){
            $v['baseinfo'] = M('Users')->where('id='.$v['id'])->find();
            $v['xindaiinfo'] = M('Users')->where('id='.$v['loan_manager_id'])->find();

            $lists[] = $v;
        }
        $this->assign("lists",$lists);
        $this->display();
    }
    /**
     * 普通用户管理
     */
    public function useredit(){
        $id = intval(I('get.id'));
        $provinces = M('JsDistrict')->where('level=1 AND upid=0')->select();
        foreach (M('JsDistrict')->where('level=1 AND upid=0')->select() as $k=>$v){
            $citys[$v['id']] = M('JsDistrict')->where('level=2 AND upid='.$v['id'])->select();
        }
        $lists = array();
        foreach (M('Users')->where(array('user_type'=>3))->select() as $k=>$v){
            $relnameinfo = M('JsLoanManager')->where('id='.$v['id'])->find();
            $v['relname'] = $relnameinfo['name'];
            $lists[] = $v;
        }
        $userinfo = array();
        if(IS_POST){
            $userdata = $_POST;
            $taobao_credit_array[1][1]['min'] = 4;
            $taobao_credit_array[1][1]['max'] = 10;
            $taobao_credit_array[1][2]['min'] = 11;
            $taobao_credit_array[1][2]['max'] = 40;
            $taobao_credit_array[1][3]['min'] = 41;
            $taobao_credit_array[1][3]['max'] = 90;
            $taobao_credit_array[1][4]['min'] = 91;
            $taobao_credit_array[1][4]['max'] = 150;
            $taobao_credit_array[1][5]['min'] = 151;
            $taobao_credit_array[1][5]['max'] = 250;
            $taobao_credit_array[2][1]['min'] = 251;
            $taobao_credit_array[2][1]['max'] = 500;
            $taobao_credit_array[2][2]['min'] = 501;
            $taobao_credit_array[2][2]['max'] = 1000;
            $taobao_credit_array[2][3]['min'] = 1001;
            $taobao_credit_array[2][3]['max'] = 2000;
            $taobao_credit_array[2][4]['min'] = 2001;
            $taobao_credit_array[2][4]['max'] = 5000;
            $taobao_credit_array[2][5]['min'] = 5001;
            $taobao_credit_array[2][5]['max'] = 10000;
            $taobao_credit_array[3][1]['min'] = 10001;
            $taobao_credit_array[3][1]['max'] = 20000;
            $taobao_credit_array[3][2]['min'] = 20001;
            $taobao_credit_array[3][2]['max'] = 50000;
            $taobao_credit_array[3][3]['min'] = 50001;
            $taobao_credit_array[3][3]['max'] = 100000;
            $taobao_credit_array[3][4]['min'] = 100001;
            $taobao_credit_array[3][4]['max'] = 200000;
            $taobao_credit_array[3][5]['min'] = 500001;
            $taobao_credit_array[3][5]['max'] = 1000000;
            
            $userdata['taobao_credit_min'] = $taobao_credit_array[$userdata['taobao_credit_type']][$userdata['taobao_credit_line']]['min'];
            $userdata['taobao_credit_max'] = $taobao_credit_array[$userdata['taobao_credit_type']][$userdata['taobao_credit_line']]['max'];
            //dump($userdata['taobao_credit_type']);
            //dump($userdata['taobao_credit_line']);
            //unset($userdata['taobao_credit_line']);
            //unset($userdata['taobao_credit_type']);
            if ($id>0){
                M('JsUserProfile')->where('id='.$id)->save($userdata);
                 $this->success("编辑用户成功！",U("Qianshan/User/userlist"));
                 exit;
            }else{
                
                $rules = array(
                    //array(验证字段,验证规则,错误提示,验证条件,附加规则,验证时间)
                    array('mobile', 'require', '手机号不能为空！', 1 ),
                    array('mobile','','手机号已被注册！！',0,'unique',3),
                    
                );
                    
                $users_model=M("Users");
                 
                if($users_model->validate($rules)->create()===false){
                    $this->error($users_model->getError());
                }
                $password = rand(6, 15);
                 
                
                $users_model=M("Users");
                $data=array(
                    'user_login' => '',
                    'user_email' => '',
                    'mobile' =>$_POST['mobile'],
                    'user_nicename' =>'',
                    'user_pass' => sp_password($password),
                    'last_login_ip' => get_client_ip(0,true),
                    'create_time' => date("Y-m-d H:i:s"),
                    'last_login_time' => date("Y-m-d H:i:s"),
                    'user_status' => 1,
                    "user_type"=>2,//普通会员
                );
                
                $result = $users_model->add($data);

                //$userdata['id'] = $result;
                $userdata['id'] = 4;
                $result1 = M('JsUserProfile')->add($userdata);

                if($result){
                    //注册成功页面跳转
                    $data['id']=$result;
                    //session('user',$data);
                    $this->success("添加用户成功！",U("Qianshan/User/userlist"));
                     
                }else{
                    $this->error("添加用户失败！",U("Qianshan/User/userlist"));
                }
                exit;
            }
            
        }else{
            if ($id>0){
                $userinfo =  M('JsUserProfile')->where('id='.$id)->find();
                //dump($userinfo);
            }
        }
        //dump($userinfo);
        $this->assign("lists",$lists);
        $this->assign("provinces",$provinces);
        $this->assign("citys",$citys);
        $this->assign("userinfo",$userinfo);
        $this->display();
    }
    /**
     * 识别产品
     */
    public function procheck() {
        $id = I('id');
        $uesrinfo = M('Users')->where('id='.$id)->find();
        $uesrprofile = M('JsUserProfile')->where('id='.$id)->find();
        $cityinfo = M('JsDistrict')->where("name = '".$uesrprofile['city']."'")->find();
        
        $uesrprofile['cityid'] = $cityinfo['id'];
        $ages = diffDate(date("Y-m-d",time()),$uesrprofile['birthday']);
        $age = intval($ages['y']);//年龄
        $is_company_owner = $uesrprofile['company_owner'] ? true : false; //法人
        $is_salary = $uesrprofile['company_owner'] ?  false : true;//工薪

        $sql = "select distinct a.pid ,a.* from  dk_js_pro as a, dk_js_pro_type as b where ";
        $sql .= "( a.pid NOT IN (select distinct pid from dk_js_pro_type)  ";
        $sql .= " OR (b.type = 'age' AND b.ptype = 1 AND b.data1 < ".$age." AND b.data2  > ".$age." AND a.pid=b.pid)";
        $sql .= $is_salary ? " OR (b.type = 'age' AND b.ptype = 2 AND b.data1 < ".$age." AND b.data2  > ".$age." AND a.pid=b.pid)" : '';
        $sql .= $is_company_owner ? " OR (b.type = 'age' AND b.ptype = 3 AND b.data1 < ".$age." AND b.data2  > ".$age." AND a.pid=b.pid)":'';
        $sql .= ")";
        $sql .= " AND a.credit_from <=".$uesrprofile['required_load_amount']." AND a.credit_to >".$uesrprofile['required_load_amount'];
        $sql .= " AND a.due_time_from <=".$uesrprofile['required_load_term']." AND a.due_time_to  >".$uesrprofile['required_load_term'];
        $sql .= " order by a.pid desc ";
        $List = M()->query($sql);
        //dump($sql);
        $voList = array();
        $lixitypes = array('等额本息','等额本金','先息后本','日利息');
        $lixidw = array('fen'=>'分','li'=>'厘');
        foreach($List as $k=>$v){
            $interest_text = $interest_month = '';
            $interest = unserialize($v['interest']);
            if ($interest){
                foreach ($interest as $ik=>$iv){
                    //$interest_month = '';
                    //var_dump($iv['lixitype']);
                    $interest_text .=  $iv['lixi1'] ? ($lixitypes[$iv['lixitype']-1] .':'.$iv['lixi1'].$lixidw[$iv['lixidw1']] .'-'.$iv['lixi2'].$lixidw[$iv['lixidw2']]."<br/>"):'';
                    if($iv['lixi1']){
                        //贷款额为a，月利率为i，年利率为I，还款月数为n，每月还款额为yuehuan，还款利息总和为zhifulixi，支付利息总和为zhifuzonge 
                        $a = $uesrprofile['required_load_amount'];
                        $i = ($iv['lixi1']/100) * (($iv['lixi1']+100)/100);
                        $i1 = $iv['lixi2'] ? ($iv['lixi2']/100) * (($iv['lixi2']+100)/100) : 0;
                        $n = $uesrprofile['required_load_term'];
                       if($iv['lixitype'] == 1){
                            $yuehuan = $a*10000 * $i * pow(1+$i,$n)/(pow(1+$i,$n)-1);//a×i×（1＋i）^n÷〔（1＋i）^n－1〕

                            $zhifulixi = $n * $a * $i * pow(1+$i,$n) / (pow(1+$i,$n)-1) - $a;//n×a×i×（1＋i）^n÷〔（1＋i）^n－1〕－a
                            $zhifuzonge = $n*$a*$i* pow((1+$i),$n)/ (pow((1+$i),$n)-1);//n×a×i×（1＋i）^n÷〔（1＋i）^n－1〕
                            if ($i1){
                                $yuehuan1 = $a*10000 * $i1 * pow(1+$i1,$n)/(pow(1+$i1,$n)-1);//a×i×（1＋i）^n÷〔（1＋i）^n－1〕

                                $zhifulixi1 = $n * $a * $i1 * pow(1+$i1,$n) / (pow(1+$i1,$n)-1) - $a;//n×a×i×（1＋i）^n÷〔（1＋i）^n－1〕－a
                                $zhifuzonge1 = $n*$a*$i1* pow((1+$i1),$n)/ (pow((1+$i1),$n)-1);//n×a×i×（1＋i）^n÷〔（1＋i）^n－1〕

                            }
                            $interest_month .= '［等额本息］';
                       }elseif($iv['lixitype'] == 2){
                            /*
                            每月还本付息金额=(本金/还款月数)+(本金-累计已还本金)×月利率

                            每月本金=总本金/还款月数

                            每月利息=(本金-累计已还本金)×月利率

                            还款总利息=(还款月数+1)*贷款额*月利率/2

                            还款总额=(还款月数+1)*贷款额*月利率/2+贷款额
                            */
                            $yuehuan = (($n+1) * $a * $i/2 + $a)/$n;
                            $zhifulixi = ($n+1) * $a * $i/2 ; 
                            $zhifuzonge = ($n+1) * $a * $i/2 + $a;
                            if ($i1){
                                $yuehuan1 = (($n+1) * $a * $i1/2 + $a)/$n;
                                $zhifulixi1 = ($n+1) * $a * $i1/2 ; 
                                $zhifuzonge1 = ($n+1) * $a * $i1/2 + $a;
                            }
                             $interest_month .= '［等额本金］';
                            
                       }elseif($iv['lixitype'] == 3){
                            /*
                            小明在银行贷款10万，期限为一年，年利息为5.6%，按照先息后本的还款方式，每月还款金额为100000*5.6%/12=466.67元，一年到期后再还清10万元本金。
                            */
                            $yuehuan = $a*10000 * $i;
                            $zhifulixi = $a * $i * $n; 
                            $zhifuzonge = $a + $zhifulixi;
                            if ($i1){
                                $yuehuan1 = $a * 10000 * $i1;
                                $zhifulixi1 = $a * $i1 * $n; 
                                $zhifuzonge1 = $a + $zhifulixi1;
                            }
                            $interest_month .= '［先息后本］'; 
                            
                       }elseif($iv['lixitype'] == 4){
                            $interest_month .= '日利息 ：';
                            

                       }
                        $interest_month .= '月均还款：'.sprintf('%.0f',$yuehuan).($i1 ? ('~'.sprintf('%.0f',$yuehuan1)):'').'元，';
                        $interest_month .= '支付利息：'.sprintf('%.2f',$zhifulixi).($i1 ? ('~'.sprintf('%.2f',$zhifulixi1)):'').'万元，';
                        $interest_month .= '还款总额：'.sprintf('%.2f',$zhifuzonge).($i1 ? ('~'.sprintf('%.2f',$zhifuzonge1)):'').'万元';
                       $interest_month .= '<br/>';
                   }
                }
            }
            $v['interest_text'] = $interest_text;
            $v['interest_month'] = $interest_month;
            $voList[$k] = $v;
            
        }
        
        //dump($voList);
        




        $this->assign("uesrprofile",$uesrprofile);
        $this->assign("voList",$voList);
        $this->display();
    }

}

