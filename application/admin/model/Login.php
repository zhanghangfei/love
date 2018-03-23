<?php
        namespace app\admin\model;
        use think\Model;
        use think\Validate;

        class Login extends Model
        {
                public function login($keyword){
                        $rule = [
                                "username" => "require",
                                "password" => "require",
                                "code" => "require",
                        ];
                        $msg = [
                                 'username.require' => '亲亲，请输入账号哟',
                                'password.require' => '亲亲，请输入密码哟',
                                'code.require' => '哎呀，验证码忘记了噻'
                        ];
                         $data = [
                                'username' => $keyword['username'],
                                'password' => $keyword['password'],
                                'code' => $keyword['code']
                        ];
                        $validate = new Validate($rule,$msg);
                        $list = $validate->check($data);
                        if(!$list){
                                $info = [
                                        'status' =>0,
                                        'msg' =>$validate->getError()
                                ];
                        }else{
                                //判断验证码
                                $code = $keyword['code'];
                                if(!captcha_check($code)){
                                        $info = [
                                                'status' =>0,
                                                'msg' =>'玩毛，验证码都错了'
                                        ];
                                }else{
                                        //判断账号密码
                                        $where['username'] = $keyword['username'];
                                        $where['password'] = md5($keyword['password']);
                                        $xx = db("admin_user")->where($where)->find();
                                        if(!$xx){
                                                $info = [
                                                        'status' =>0,
                                                        'msg' =>'要么账号 或者密码是错的 你看着办'
                                                ];
                                        }else{
                                                //判断是否记住密码
                                                $remember = $keyword['remember'];
                                                if($remember==0){
                                                        cookie("username",null);
                                                        cookie("password",null);
                                                        cookie("remember",null);
                                                }else{
                                                        cookie("username",$keyword['username'],3600*24*7);
                                                        cookie("password",$keyword['password'],3600*24*7);
                                                        session('xx',$xx);
                                                        $info = [
                                                                'status' =>1,
                                                                'msg' =>'恭喜你 登录成功了嘿'
                                                        ];
                                                }
                                        }
                                }
                        }
                        return $info;
                }
        }
