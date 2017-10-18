<?php
/**
 * 后台首页
 */
namespace Daikuan\Controller;

use Common\Controller\AdminbaseController;

class AdminController extends AdminbaseController {
    
    function _initialize(){

        
    }
    
    /**
     * 产品管理
     */
    public function Product() {
        if(IS_POST){
            foreach ($_POST['displayorders'] as $k=>$v){
                $data['displayorder'] = $v;
                $data['status'] = $_POST['status'][$k];
                M('DkProduct')->where('pid='.$k)->save($data);
            }
            $this->success("更新成功！");
            
        }
        $lists = array();
        foreach (M('DkProduct')->order('displayorder ASC')->select() as $k=>$v){
            $lists[] = $v;
        }

        $this->assign("lists",$lists);
        $this->display();
    }
    /**
     * 产品管理
     */
    public function Productedit() {

        $pid = $_GET['pid'];
        $provinces = M('JsDistrict')->where('level=1 AND upid=0')->select();
        foreach (M('JsDistrict')->where('level=1 AND upid=0')->select() as $k=>$v){
            $citys[$v['id']] = M('JsDistrict')->where('level=2 AND upid='.$v['id'])->select();
        }

        if(IS_POST){
            if(!empty($_POST['proname'])){
                $data['name'] = trim($_POST['proname']);
                $data['due_time_from'] = trim($_POST['due_time_from']);
                $data['due_time_to'] = trim($_POST['due_time_to']);
                $data['credit_from'] = trim($_POST['credit_from']);
                $data['credit_to'] = trim($_POST['credit_to']);
                for($i=0;$i<3;$i++){
                    $lixi[$i] = array('lixitype'=>$_POST['lixitype'][$i],'lixi1'=>$_POST['lixi1'][$i],'lixidw1'=>$_POST['lixidw1'][$i],'lixi2'=>$_POST['lixi2'][$i],'lixidw2'=>$_POST['lixidw2'][$i]);
                }
                $data['interest'] = serialize($lixi);
                $data['commission'] = trim($_POST['commission']);
                $data['apply_material'] = trim($_POST['apply_material']);
                $data['prepayment_notice'] = trim($_POST['prepayment_notice']);
                $data['overdue_repayment_notice'] = trim($_POST['overdue_repayment_notice']);
                $data['occupation'] = serialize($_POST['occupation']);
                $data['city'] = serialize($_POST['citys']);
                
                
                if ($pid>0){
                    if (M('JsPro')->where("name='".$data['name']."' AND pid <> ".$pid)->find()){
                        $this->error("产品名称已经存在！");
                    }
                    $data['updatetime'] = time();
                    M('JsPro')->where('pid='.$pid)->save($data);
                    $this->success("修改成功！", U("Qianshan/product/index"));
                    exit;
                }else{
                    if (M('JsPro')->where("name='".$data['name']."'")->find()){
                        $this->error("产品名称已经存在！");
                    }
                    
                    $data['createtime'] = time();
                    $data['updatetime'] = time();
                    if (M('JsPro')->add($data)){
                        $this->success("添加成功！", U("Qianshan/product/index"));
                        exit;
                    }else{
                        $this->error("添加失败！");
                    }
                }
                
            }else{
                $this->error("必须填写产品名称！");
            }

        }else{
            
            if ($pid>0){
                $proinfo = M('JsPro')->where('pid='.$pid)->find();
                $proinfo['interest'] =  unserialize($proinfo['interest']);
                $proinfo['occupation'] =  unserialize($proinfo['occupation']);
                $proinfo['city'] =  unserialize($proinfo['city']);
                $provs_check = array();
                foreach ($proinfo['city'] as $ck=>$cv){
                    $prov_info = M('JsDistrict')->where('id='.$cv)->find();
                    $provs_check[$prov_info['upid']] = 1;
                    
                }
                
                
                $this->assign("proinfo",$proinfo);
            }
        }
        
        $this->assign("provs_check",$provs_check);
        $this->assign("provinces",$provinces);
        $this->assign("citys",$citys);
        $this->assign("pid",$pid);
        $this->assign("canshus",$this->canshus);
        $this->assign("shuxings",$this->shuxings);
        
        
        $this->display();
    }
    
    /**
     * 产品属性
     */
    public function Productattribute(){
        $pid = $_GET['pid'];
        if ($pid>0){
            $proinfo = M('JsPro')->where('pid='.$pid)->find();
            $proinfo = GetSettingHtml($proinfo);
            //dump($proinfo);
            $this->assign("proinfo",$proinfo);
        }
        $lists = array();
        foreach (M('JsPro')->where()->select() as $k=>$v){
            $lists[] = $v;
        }
        $this->assign("lists",$lists);
        $this->display();
    }
    /**
     * 产品模型
     */
    public function model(){
        $lists = array();

        foreach (M('JsModel')->where()->select() as $k=>$v){
            $lists[] = $v;
        }
        $this->assign("lists",$lists);
        $this->display();
    }
    /**
     * 产品模型排序
     */
    public function modelorders(){
        foreach($_POST['displayorders'] as $k=>$v){
            $data['displayorder'] = $v;
            M('JsModel')->where('mid='.$k)->save($data);
        }
        $this->success("排序调整成功");
    }
    /**
     * 增加产品模型
     */
    public function modeladd(){
        $mid = $_GET['mid'];
        if(IS_POST){
            if(!empty($_POST['modelname'])){
                $data['modelname'] = trim($_POST['modelname']);
                if ($mid>0){
                    if (M('JsModel')->where("modelname='".$data['modelname']."' AND mid <> ".$mid)->find()){
                        $this->error("模型名称已经存在！");
                    }
                    M('JsModel')->where('mid='.$mid)->save($data);
                    $this->success("修改成功！", U("Qianshan/product/model"));
                    exit;
                }else{
                    if (M('JsModel')->where("modelname='".$data['modelname']."'")->find()){
                        $this->error("模型名称已经存在！");
                    }
                    $data['dateline'] = time();
                    if (M('JsModel')->add($data)){
                        $this->success("添加成功！", U("Qianshan/product/model"));
                        exit;
                    }else{
                        $this->error("添加失败！");
                    }
                }
                
            }else{
                $this->error("必须填写模型名称！");
            }

        }else{
            
            if ($mid>0){
                $modelinfo = M('JsModel')->where('mid='.$mid)->find();
                $this->assign("modelinfo",$modelinfo);
            }
        }
        $this->assign("mid",$mid);
        $this->display();
    }
    /**
     * 参数设置
     */
    public function canshu(){
        $lists = array();
        $types = array();
        foreach($this->types as $sk=>$sv){
            $types[$sv['typeid']] = $sv['typename'];
        }
        foreach (M('JsCanshu')->where()->select() as $k=>$v){
            $v['typename'] = $types[$v['type']];
            $lists[] = $v;
        }
    
        //$columns = M('JsPro')->query("SHOW FULL COLUMNS FROM `__TABLE__`");   
        //dump($columns);     
        $this->assign("lists",$lists);
        $this->display();
    }
    /**
     * 添加参数设置
     */
    public function canshuadd(){
        $sid = $_GET['sid'];
        if(IS_POST){
            if (empty($_POST['title'])){
                $this->error("参数中文名称不能为空！");
            }
            if (empty($_POST['title'])){
                $this->error("参数英文标识不能为空！");
            }
            if (empty($_POST['content'])){
                //$this->error("参数选项不能为空！");
            }
            $data['title'] = trim($_POST['title']);
            $data['name'] = trim($_POST['name']);
            $data['type'] = trim($_POST['typeid']);
            $data['content'] = trim($_POST['content']);
            
            if ($sid>0){
                if (M('JsCanshu')->where("name='".$data['name']."' AND sid <> ".$sid)->find()){
                    $this->error("英文名称已经存在！");
                }
                M('JsCanshu')->where('sid='.$sid)->save($data);
                $this->success("修改成功！", U("Qianshan/product/canshu"));
                exit;
            }else{
                if (M('JsCanshu')->where("name='".$data['name']."'")->find()){
                    $this->error("参数英文标识（变量名）已经存在！");
                }
                $data['dateline'] = time();
                if (M('JsCanshu')->add($data)){
                    $sql = " ALTER TABLE ".C('DB_PREFIX')."js_pro ADD ".$data['name']." VARCHAR(100) CHARACTER SET utf8;";
                    $re = M() -> execute($sql);
                    $this->success("添加成功！", U("Qianshan/product/canshu"));
                    exit;
                }else{
                    $this->error("添加失败！");
                }
            }
        }else{
            
            if ($sid>0){
                $settinginfo = M('JsCanshu')->where('sid='.$sid)->find();
                $this->assign("settinginfo",$settinginfo);
            }
        }
        $this->assign("sid",$sid);
        
        $this->display();
    }
    /**
     * 产品属性
     */
    public function attribute(){
        $this->display();
    }
    /**
     * 添加产品属性
     */
    public function attributeadd(){
        $this->display();
    }
    /**
     * 筛选条件
     */
    public function user(){
        $this->display();
    }
    /**
     * 添加筛选条件
     */
    public function useradd(){
        $this->display();
    }

    /**
     * 申请条件列表
     */
    public function shenqing(){
        $pid = I('pid');
        $cid = intval(I('cid'));
        $coninfo = $proinfo = $proconlist = array();
        $proinfo = M('JsPro')->where('pid='.$pid)->find();

        if ($cid>0 && I('type')=='del'){
            M('JsProCondition')->where('cid='.$cid)->delete();
        }

        foreach ($this->canshus as $k=>$v){
            $csarray[$v['csid']] = $v['csname'];
        }
        foreach ($this->ops as $k=>$v){
            $sxarray[$v['opid']] = $v['opname'];
        }
        
        if(IS_POST){
            if (trim($_POST['content']) || $_POST['content1']){
                $data['pid'] = $pid;
                $data['optionname'] = $_POST['optionname'];
                $data['equationtype'] = $_POST['equationtype'];
                $data['content'] = in_array($data['optionname'],array('occpation','insurance_type','insurance_fee_type')) ? serialize($_POST['content1']) : $_POST['content'];
                
                if ($cid > 0){
                    M('JsProCondition')->where('cid='.$cid)->save($data);
                    $this->success("编辑成功！", U("Qianshan/product/shenqing",array('pid'=>$pid)));
                }else{
                    M('JsProCondition')->add($data);
                    $this->success("添加成功！", U("Qianshan/product/shenqing",array('pid'=>$pid)));
                }
                exit;
            }
        }else{
            if ($cid>0){
                $coninfo = M('JsProCondition')->where('cid='.$cid)->find();
                $proconlist = M('JsProCondition')->where('pid='.$pid." AND cid <> ".$cid)->select();
            }else{
                $proconlist = M('JsProCondition')->where('pid='.$pid)->select();
            }
            foreach ($proconlist as $k=>$v){
                $v['optionname'] = $csarray[$v['optionname']];
                $v['equationtype'] = $sxarray[$v['equationtype']];
                $v['content'] = is_array(unserialize($v['content'])) ? implode(',',unserialize($v['content'])) : $v['content'] ;
                $proconlist[$k] = $v;
            }
            
        }
        $this->assign("csarray",$csarray);
        $this->assign("coninfo",$coninfo);
        $this->assign("proinfo",$proinfo);
        $this->assign("proconlist",$proconlist);
        $this->display();
    }
    /**
     * 申请条件列表
     */
    public function shenqingadd(){
        $pid = I('pid');
        $canshutypes = $this->types;
        
        foreach (M('JsCanshu')->where()->select() as $k=>$v){
            $v['typename'] = $types[$v['type']];
            $canshulists[] = $v;
        }

        $proinfo = M('JsPro')->where('pid='.$pid)->find();
        $this->assign("canshutypes",$canshutypes);
        $this->assign("canshulists",$canshulists);
        $this->assign("proinfo",$proinfo);
        $this->display();
    }

}

