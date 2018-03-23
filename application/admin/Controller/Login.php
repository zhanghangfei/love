<?php
        namespace app\admin\controller;
        use think\Controller;

        class Login extends Controller
        {
                public function index(){
                        if(IS_AJAX){
                                $row = input("param.");
                                $model = model("Login");
                                $res = $model ->login($row);
                                return json($res);
                        }
                        return view('Login/login');
                }
        }
