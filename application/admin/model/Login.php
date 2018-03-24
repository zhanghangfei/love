<?php
        namespace app\admin\model;
        use think\Model;
        use think\Validate;

        class Login extends Model
        {
                public function login($keyword){
                        // dump($keyword);die;
                        $rule = [
                                'username' => 'require',
                                'password' => 'require',
                                'code' => 'require'
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
                                        'msg' => $validate->getError()
                                ];
                        }else{
                                $codeyz = $keyword['code'];
                                if(!captcha_check($codeyz)){
                                        $info = [
                                                'status' =>0,
                                                'msg' =>'可惜了，验证码错啦'
                                        ];
                                }
                                $row = db('admin_user')->where('username',$keyword['username'])->find();
                                // dump($user['username']);die;
                                if(!$row){
                                        $info = [
                                                'status' =>0,
                                                'msg' =>'可惜了，用户名?密码错啦'
                                        ];
                                }else{
                                        $password = md5($keyword['password']);
                                        if($password!==$row['password']){
                                                $info = [
                                                        'status' =>0,
                                                        'msg' =>'可惜了，用户名?密码错啦'
                                                ];
                                        }else{
                                                //判断是否记住密码
                                                $remember = $keyword['remember'];
                                                // dump($remember);die;
                                                if($remember==0){
                                                        cookie('username',null);
                                                        cookie('password',null);
                                                        cookie('remember',null);
                                                }else{
                                                        cookie('username',$keyword['username'],3600*24*7);
                                                        cookie('password',$keyword['password'],3600*24*7);
                                                        cookie('remember',$remember,3600*24*7);
                                                        session('user',$row);
                                                        // dump(session('user',$row));die;
                                                }
                                                //获取上次登录时间(数据库法)
                                                $times = time();//获取登录时的时间
                                                $times = date("Y-m-d H:i:s",$times);//时间戳转字符串
                                                $data =['logined_time'=>$times];
                                                $logined_time = db('admin_user')->where('username',$keyword['username'])->value('logined_time');//查询时间戳
                                                session('logined_time',$logined_time);
                                                // dump($login_time);die;
                                                if($logined_time){
                                                        $login_time = db('admin_user')->where('username',$keyword['username'])->setField('logined_time',$times);
                                                        session('login_time',$login_time);
                                                }else{
                                                        $login_time = db('admin_user')->where('username',$keyword['username'])->setField('logined_time',$times);
                                                }
                                                $info = [
                                                        'status' =>1,
                                                        'msg' =>'终于登陆成功了哈'
                                                ];
                                        }
                                }
                        }
                        return $info;
                }
        }
