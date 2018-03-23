<?php
        namespace app\admin\controller;
        use think\Controller;

        class Index extends Controller
        {
                public function index(){
                        return view("Index/index");
                }
                public function main(){
                        return view("Index/main");
                }
        }
