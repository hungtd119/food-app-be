<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;

class UserController extends BaseServiceController
{
    public function __construct(User $user)
    {
        parent::__construct($user);
    }
    public function index(Request $request)
    {
        $limit = $request->query("limit") ? $request->query("limit") : 5;
        $page = $request->query("page") ? $request->query("page") : 1;
        $keyword = $request->query("keyword") ? $request->query("keyword") : "";
        $offSet = ($page - 1) * $limit;

        $users = $this->getAll($limit, $offSet, $keyword);
        $total = $this->getCount();
        return $this->responseJson('get all users', [
            'data'=>$users,
            'total'=>$total
        ]);
    }
    public function find($sid)
    {
        // validate
        if (!$sid)
            throw new \Exception('Not found sid');
        $user = $this->findById($sid);
        return $this->responseJson('find user by id', $user);
    }
    public function deleteById($sid)
    {
        if (!$sid) throw new \Exception('Not found sid');
        $this->delete($sid);
        return $this->responseJson("Deleted user with id " . $sid, true);
    }
    public function update(Request $request)
    {
        $id = $request->query("id");
        $dataInputs = $this->getDataInput($request);
        $user = $this->store($dataInputs, $id);
        return $this->responseJson("Updated text success", $user);
    }
}
