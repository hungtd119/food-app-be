<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends BaseServiceController
{
    public function __construct(Category $category)
    {
        parent::__construct($category);
    }
    public function index(Request $request)
    {
        $limit = $request->query("limit") ? $request->query("limit") : 5;
        $page = $request->query("page") ? $request->query("page") : 1;
        $keyword = $request->query("keyword") ? $request->query("keyword") : "";
        $offSet = ($page - 1) * $limit;

        $categories = $this->getAll($limit, $offSet, $keyword);
        return $this->responseJson('get all categories', $categories);
    }
    public function find($sid)
    {
        // validate
        if (!$sid)
            throw new \Exception('Not found sid');
        $category = $this->findById($sid);
        return $this->responseJson('find category by id', $category);
    }
    public function deleteById($sid)
    {
        if (!$sid) throw new \Exception('Not found sid');
        $this->delete($sid);
        return $this->responseJson("Deleted category with id " . $sid, true);
    }
    public function update(Request $request)
    {
        $id = $request->query("id");
        $dataInputs = $this->getDataInput($request);
        $category = $this->store($dataInputs, $id);
        return $this->responseJson("Updated text success", $category);
    }
}
