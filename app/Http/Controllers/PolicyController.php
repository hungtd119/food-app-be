<?php

namespace App\Http\Controllers;

use App\Models\Policy;
use Illuminate\Http\Request;

class PolicyController extends BaseServiceController
{
    public function __construct(Policy $policy)
    {
        parent::__construct($policy);
    }
    public function index(Request $request)
    {
        $limit = $request->query("limit") ? $request->query("limit") : 5;
        $page = $request->query("page") ? $request->query("page") : 1;
        $keyword = $request->query("keyword") ? $request->query("keyword") : "";
        $offSet = ($page - 1) * $limit;

        $policies = $this->getAll($limit, $offSet, $keyword);
        return $this->responseJson('get all policies', $policies);
    }
    public function find($sid)
    {
        // validate
        if (!$sid)
            throw new \Exception('Not found sid');
        $policy = $this->findById($sid);
        return $this->responseJson('find policy by id', $policy);
    }
    public function deleteById($sid)
    {
        if (!$sid) throw new \Exception('Not found sid');
        $this->delete($sid);
        return $this->responseJson("Deleted policy with id " . $sid, true);
    }
    public function update(Request $request)
    {
        $id = $request->query("id");
        $dataInputs = $this->getDataInput($request);
        $policy = $this->store($dataInputs, $id);
        return $this->responseJson("Updated text success", $policy);
    }
}
