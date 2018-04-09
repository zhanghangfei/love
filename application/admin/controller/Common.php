<?php
        namespace app\admin\controller;
        use think\Controller;

        class Common extends Controller
        {
                //判断是否有登录权限
                public function _initialize(){
                        if(session('user')){
                                $this->error('请先登录哦','Login/index');
                        }
                }
        }
