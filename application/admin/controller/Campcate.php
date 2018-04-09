<?php
        namespace app\admin\controller;
        use think\Controller;

        class Campcate extends Common
        {
                //阵营首页
                public function index(){
                        if(IS_AJAX){
                                $p = input('post.onepage');  //当前在第几页
                                $num = input('post.num'); //每页显示的数量
                                $keyword = input('post.keyword');//关键字查询
                                if($keyword){
                                        $where['campname'] = ['like', "%$keyword%"];
                                }else{
                                        $where = [];
                                }
                                if($p){$p = isset($p) ? $p : '1';}else{$p = 1;}
                                $count = db("admin_campcate")->where($where)->count();
                                $list = db("admin_campcate")->where($where)->limit(($p-1)*$num,$num)->select();
                                foreach($list as $k => $v){
                                        if($v['status'] == 1){
                                                $list[$k]['status'] = '已启用';
                                                $list[$k]['style'] = '';
                                        }else{
                                                $list[$k]['status'] = '已停用';
                                                $list[$k]['style'] = 'layui-btn-disabled';
                                        }
                                }
                                return $info = [
                                        'count' =>$count,
                                        'data' => $list
                                ];
                                return json($info);
                        }
                        $count = db("admin_campcate")->count();
                        $this->assign('count',$count);
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

                //是否停用
                public function stop(){
                        if(IS_AJAX){
                                $id = input('param.campid');
                                $model = model("Camp");
                                $res = $model->campstop($id);
                                return json($res);
                        }
                }
        }
