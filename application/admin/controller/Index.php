<?php
        namespace app\admin\controller;
        use think\Controller;

        class Index extends Common
        {
                public function index(){
                        return view("Index/index");
                }
                public function welcome(){
                        return view("Index/welcome");
                }
        }
