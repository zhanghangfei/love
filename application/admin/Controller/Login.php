<?php
        namespace app\admin\controller;
        use think\Controller;

        class Login extends Controller
        {
                //登录页面
                public function index(){
                        if(IS_AJAX){
                                $data = input('param.');
                                $model = model('Login');
                                $res = $model->login($data);
                                return json($res);
                        }else {
                                return view('login/login');
                        }
                }
                //退出页面
                public function loginout(){
                        session('user',null);
                        $this->redirect('Login/index');
                }
        }
