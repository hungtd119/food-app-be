<?php

namespace App\Http\Controllers;

use App\Models\Restaurent;
use Illuminate\Http\Request;

class RestaurentController extends  BaseServiceController
{
    public function __construct(Restaurent $restaurent)
    {
        parent::__construct($restaurent);
    }
    public function index(Request $request)
    {
        $limit = $request->query("limit") ? $request->query("limit") : 5;
        $page = $request->query("page") ? $request->query("page") : 1;
        $keyword = $request->query("keyword") ? $request->query("keyword") : "";
        $offSet = ($page - 1) * $limit;

        $restaurents = $this->getAll($limit, $offSet, $keyword);
        return $this->responseJson('get all restaurents', $restaurents);
    }
    public function find($sid)
    {
        // validate
        if (!$sid)
            throw new \Exception('Not found sid');
        $restaurent = $this->findById($sid);
        return $this->responseJson('find restaurent by id', $restaurent);
    }
    public function deleteById($sid)
    {
        if (!$sid) throw new \Exception('Not found sid');
        $this->delete($sid);
        return $this->responseJson("Deleted restaurent with id " . $sid, true);
    }
    public function update(Request $request)
    {
        $id = $request->query("id");
        $dataInputs = $this->getDataInput($request);
        $restaurent = $this->store($dataInputs, $id);
        return $this->responseJson("Updated text success", $restaurent);
    }
}
