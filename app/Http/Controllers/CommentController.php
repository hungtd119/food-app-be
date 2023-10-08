<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends BaseServiceController
{
    public function __construct(Comment $comment)
    {
        parent::__construct($comment);
    }
    public function index(Request $request)
    {
        $limit = $request->query("limit") ? $request->query("limit") : 5;
        $page = $request->query("page") ? $request->query("page") : 1;
        $keyword = $request->query("keyword") ? $request->query("keyword") : "";
        $offSet = ($page - 1) * $limit;

        $comments = $this->getAll($limit, $offSet, $keyword);
        return $this->responseJson('get all comments', $comments);
    }
    public function find($sid)
    {
        // validate
        if (!$sid)
            throw new \Exception('Not found sid');
        $comment = $this->findById($sid);
        return $this->responseJson('find comment by id', $comment);
    }
    public function deleteById($sid)
    {
        if (!$sid) throw new \Exception('Not found sid');
        $this->delete($sid);
        return $this->responseJson("Deleted comment with id " . $sid, true);
    }
    public function update(Request $request)
    {
        $id = $request->query("id");
        $dataInputs = $this->getDataInput($request);
        $comment = $this->store($dataInputs, $id);
        return $this->responseJson("Updated text success", $comment);
    }
}
