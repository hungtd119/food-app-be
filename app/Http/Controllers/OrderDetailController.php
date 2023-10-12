<?php

namespace App\Http\Controllers;

use App\Models\OrderDetail;
use Illuminate\Http\Request;

class OrderDetailController extends BaseServiceController
{
    public function __construct(OrderDetail $orderDetail)
    {
        parent::__construct($orderDetail);
    }
    public function index(Request $request)
    {
        $limit = $request->query("limit") ? $request->query("limit") : 5;
        $page = $request->query("page") ? $request->query("page") : 1;
        $keyword = $request->query("keyword") ? $request->query("keyword") : "";
        $offSet = ($page - 1) * $limit;

        $orderDetails = $this->getAll($limit, $offSet, $keyword);
        return $this->responseJson('get all orderDetails', $orderDetails);
    }
    public function find($sid)
    {
        // validate
        if (!$sid)
            throw new \Exception('Not found sid');
        $orderDetail = $this->findById($sid);
        return $this->responseJson('find orderDetail by id', $orderDetail);
    }
    public function deleteById($sid)
    {
        if (!$sid) throw new \Exception('Not found sid');
        $this->delete($sid);
        return $this->responseJson("Deleted orderDetail with id " . $sid, true);
    }
    public function update(Request $request)
    {
        $id = $request->query("id");
        $dataInputs = $this->getDataInput($request);
        $orderDetail = $this->store($dataInputs, $id);
        return $this->responseJson("Updated text success", $orderDetail);
    }
    public function createOrderDetailByOrderId(Request $request){
        $dataInputs = $this->getDataInput($request);
        $newOrderDetail = new OrderDetail();
        $newOrderDetail->fill($dataInputs);
        $newOrderDetail->save();
        $orderDetail = $this->model->where(OrderDetail::_sid,$newOrderDetail->sid)->first();
        return $this->responseJson("Create new order detail", $orderDetail);
    }
    public function getByOrderIdWithFood (Request $request){
        $dataInputs = $this->getDataInput($request);
        $orderDetails = $this->model->with('food')->where(OrderDetail::_order_id,$dataInputs['order_id'])->get();
        return $this->responseJson("get order details by order id",$orderDetails);
    }
}
