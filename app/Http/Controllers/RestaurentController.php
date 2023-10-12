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
        $total = $this->getCount();
        return $this->responseJson('get all restaurents', [
            'data'=>$restaurents,
            'total'=>$total
        ]);
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
    public function createRestaurent(Request $request){
        $request->validate([
            "user_id"=>"required",
            "name"=>"required",
            "taxCode"=>"required",
            "thumbnail"=>"required"
        ]);
        $dataInputs = $this->getDataInput($request);
        $createdRestaurent = new Restaurent();
        $createdRestaurent->fill($dataInputs);
        $createdRestaurent->save();
        return $this->responseJson('create restaurents by user id',$createdRestaurent);

    }
    public function getByUserId (Request $request){
        $request->validate([
            'user_id'=>'required'
        ]);
        $userId = $request->input('user_id');
        $restaurents = $this->model->query()->where('user_id',$userId)->get();
        return $this->responseJson('Get all restaurents by user id',$restaurents);
    }
}
