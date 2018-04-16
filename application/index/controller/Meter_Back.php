<?php

namespace app\Index\Controller;

use think\Controller;
use think\Db;
use think\Request;

class Meter_Back extends Controller
{

    Const PRICE = 5;

    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        $request = Request::instance();
        $keyword = $request->request('keyword');
        $hole = $request->request('hole');
        $start = $request->request('start');
        $num = $request->request('num');

        $meter = Db::name('water_meter');

        if (!empty($keyword)){
            $meter->where('name','like', '%' . $keyword . '%');
        }

        if (!empty($hole)){
            $meter->where('hole', $hole);
        }

        $countMeter = $meter;

        $count = $countMeter->count();

        $list = $meter->limit($start, $num)->order('id');

        return json([
            'count' => $count,
            'items' => $list
        ]);
    }

    public function createMeterData(){
        $req = Request::instance();

        $id = $req->get('id');
        $num = $req->get('num');
        $price = self::PRICE;

        $cost = $price * (float)$num;

        $meterList = Db::table('water_meter')->where('id', $id)->find();

        $writeTime = date('Y-m-d H:i:s', time());

        Db::table('meter_log')->insert([
            'meter_id' => $id,
            'num' => $num,
            'price' => $price,
            'cost' => $cost,
            'is_pay' => 0,
            'write_time' => $writeTime
        ]);

        Db::table('info')->insert([
           'meter_id' => $id,
           'name' => $meterList['name'],
           'direction' => $meterList['direction'],
           'num' => $num,
           'write_time' => $writeTime,
           'cost' => $cost
        ]);


    }

   public function getInfo(){
        $req = Request::instance();
        $id = $req->get('id');


   }

    /**
     * 显示指定的资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function read($id)
    {
        //
    }

    /**
     * 显示编辑资源表单页.
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * 保存更新的资源
     *
     * @param  \think\Request  $request
     * @param  int  $id
     * @return \think\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * 删除指定资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function delete($id)
    {
        //
    }
}
