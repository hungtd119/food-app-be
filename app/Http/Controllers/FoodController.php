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
        $total = $this->getCount();
        return $this->responseJson('get all foods', [
            'data'=>$foods,
            'total'=>$total
        ]);
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
    public function createFoodByRestaurentId(Request $request){
        $request->validate([
            "restaurent_id"=>"required",
            "category_id"=>"required",
            "title"=>"required",
            "thumbnail"=>"required",
            "description"=>"required",
            "portion"=>"required",
            "calory"=>"required",
            "unit"=>"required",
        ]);
        $dataInputs = $this->getDataInput($request);
        $createdFood = new Food();
        $createdFood->fill($dataInputs);
        $createdFood->save();
        return $this->responseJson("Tạo món ăn theo nhà hàng thành công",$createdFood);
    }
    public function fetchListFoodByRestaurentId(Request $request){
        $request->validate([
            'restaurent_id'=>'required'
        ]);
        $dataInputs = $this->getDataInput($request);
        $foods = $this->model->select(
            Food::_id,
            Food::_title,
            Food::_thumbnail,
            Food::_unit,
            Food::_prize,
            Food::_calory,
            Food::_description,
            Food::_restaurent_id,
        )->where(Food::_restaurent_id,$dataInputs['restaurent_id'])->get();
        return $this->responseJson("get foods by restaurent id",$foods);
    }
}
