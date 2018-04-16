<?php
namespace app\index\controller;

use think\Config;
use think\Controller;
use think\Db;

class Index
{
    public function index1($name = 'World')
    {


        $ret = Config::get('route_config_file');

        return $ret;

        $testData = [
          'test1' => 1,
          'test2' => 2
        ];

        return jsonp($testData);

        return $testData;
    }

    public function getList(){
        return [
            'errorCode' => 0
        ];
    }
}
