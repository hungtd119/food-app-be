<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends BaseServiceController
{
    public function __construct(Order $order)
    {
        parent::__construct($order);
    }
    public function index(Request $request)
    {
        $limit = $request->query("limit") ? $request->query("limit") : 5;
        $page = $request->query("page") ? $request->query("page") : 1;
        $keyword = $request->query("keyword") ? $request->query("keyword") : "";
        $offSet = ($page - 1) * $limit;

        $orders = $this->getAll($limit, $offSet, $keyword);
        return $this->responseJson('get all orders', $orders);
    }
    public function find($sid)
    {
        // validate
        if (!$sid)
            throw new \Exception('Not found sid');
        $order = $this->findById($sid);
        return $this->responseJson('find order by id', $order);
    }
    public function deleteById($sid)
    {
        if (!$sid) throw new \Exception('Not found sid');
        $this->delete($sid);
        return $this->responseJson("Deleted order with id " . $sid, true);
    }
    public function update(Request $request)
    {
        $id = $request->query("id");
        $dataInputs = $this->getDataInput($request);
        $order = $this->store($dataInputs, $id);
        return $this->responseJson("Updated text success", $order);
    }
}
