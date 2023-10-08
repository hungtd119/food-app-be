<?php

namespace App\Http\Controllers;

use App\Models\Food;
use Illuminate\Http\Request;

class FoodController extends BaseServiceController
{
    public function __construct(Food $food)
    {
        parent::__construct($food);
    }
    public function index(Request $request)
    {
        $limit = $request->query("limit") ? $request->query("limit") : 5;
        $page = $request->query("page") ? $request->query("page") : 1;
        $keyword = $request->query("keyword") ? $request->query("keyword") : "";
        $offSet = ($page - 1) * $limit;

        $foods = $this->getAll($limit, $offSet, $keyword);
        return $this->responseJson('get all foods', $foods);
    }
    public function find($sid)
    {
        // validate
        if (!$sid)
            throw new \Exception('Not found sid');
        $food = $this->findById($sid);
        return $this->responseJson('find food by id', $food);
    }
    public function deleteById($sid)
    {
        if (!$sid) throw new \Exception('Not found sid');
        $this->delete($sid);
        return $this->responseJson("Deleted food with id " . $sid, true);
    }
    public function update(Request $request)
    {
        $id = $request->query("id");
        $dataInputs = $this->getDataInput($request);
        $food = $this->store($dataInputs, $id);
        return $this->responseJson("Updated text success", $food);
    }
}
