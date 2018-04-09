<?php
        namespace app\admin\controller;
        use think\Controller;

        class Hero extends Common
        {
                public function index(){
                        return view("Hero/hero");
                }
        }
