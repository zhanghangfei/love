<?php
        namespace app\admin\controller;
        use think\Controller;

        class Campcate extends Common
        {
                public function index(){
                        $count = db("admin_campcate")->count();
                        $this->assign('count',$count);
                        $list = db("admin_campcate")->select();
                        $this->assign('list',$list);
                        return view("Campcate/index");
                }
                //修改新增
                public function add(){
                        if(IS_AJAX){
                                $list = input('param.');
                                $model = model("Camp");
                                $res = $model->campadd($list);
                                return json($res);
                        }else{
                                $campid = input('param.campid',0);
                                if($campid){
                                        $row = db("admin_campcate")->where('campid',$campid)->find();
                                        $this->assign('row',$row);
                                }
                                $this->assign('campid',$campid);
                        }
                        return view("Campcate/campcateadd");
                }

                //删除
                public function del(){
                        if(IS_AJAX){
                                $id = input('param.campid');
                                $model = model("Camp");
                                $res = $model->campdel($id);
                                return json($res);
                        }
                }
        }
