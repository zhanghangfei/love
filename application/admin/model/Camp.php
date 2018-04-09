<?php
        namespace app\admin\model;
        use think\Model;
        use think\Validate;

        class Camp extends Model
        {
                public function campadd($keyword){
                        $rule = ['campname'=>'require'];
                        $msg = ['campname.require'=>'阵营那是必须填写的'];
                        $data = ['campname'=>$keyword['campname']];
                        $validate = new Validate($rule,$msg);
                        $list = $validate->check($data);
                        if(!$list){
                                $info = [
                                        'status' =>0,
                                        'msg' => $validate->getError()
                                ];
                        }else{
                                $data['status'] = 1;
                                $where['campid'] = $keyword['campid'];
                                $data['campname'] = $keyword['campname'];
                                $look = db("admin_campcate")->where("campname",$keyword['campname'])->find();
                                if($look){
                                        $info = [
                                                'status' =>0,
                                                'msg' => '英雄阵营已存在哦'
                                        ];
                                }else{
                                        if($keyword['campid']){
                                                $row = db("admin_campcate")->where($where)->update($data);
                                                if($row){
                                                        $info = [
                                                                'status' =>1,
                                                                'msg' => '英雄阵营修改成功'
                                                        ];
                                                }else{
                                                        $info = [
                                                                'status' =>0,
                                                                'msg' =>  '英雄阵营修改失败'
                                                        ];
                                                }
                                        }else{
                                                $row = db("admin_campcate")->insert($data);
                                                if($row){
                                                        $info = [
                                                                'status' =>1,
                                                                'msg' => '英雄阵营添加成功'
                                                        ];
                                                }else{
                                                        $info = [
                                                                'status' =>0,
                                                                'msg' =>  '英雄阵营添加失败'
                                                        ];
                                                }
                                        }
                                }
                        }
                        return $info;
                }

                public function campdel($keyword){
                        $where['campid'] = $keyword;
                        $row = db("admin_campcate")->where($where)->delete();
                        if($row){
                                $info = [
                                        'status' =>1,
                                        'msg' => '英雄阵营删除成功'
                                ];
                        }else{
                                $info = [
                                        'status' =>0,
                                        'msg' => '英雄阵营删除失败'
                                ];
                        }
                        return $info;
                }

                public function campstop($keyword){
                        $where['campid'] = $keyword;
                        $status = db("admin_campcate")->where($where)->value('status');
                        $dataT['status'] = 0;
                        $dataQ['status'] = 1;
                        if($status){
                                $row = db("admin_campcate")->where($where)->update($dataT);
                                if($row){
                                        $info = [
                                                'status' =>1,
                                                'msg' => '停用成功',
                                                'title' => '已停用',
                                                'style' => 'layui-btn-disabled'
                                        ];
                                }else{
                                        $info = [
                                                'status' =>0,
                                                'msg' => '停用失败'
                                        ];
                                }
                        }else{
                                $row = db("admin_campcate")->where($where)->update($dataQ);
                                if($row){
                                        $info = [
                                                'status' =>1,
                                                'msg' => '恢复成功',
                                                'title' => '已启用',
                                                'style' => ''
                                        ];
                                }else{
                                        $info = [
                                                'status' =>0,
                                                'msg' => '恢复失败'
                                        ];
                                }
                        }
                        return $info;
                }
        }
