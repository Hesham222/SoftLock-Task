<?php

namespace User\Http\Controllers;
use User\Actions\Post\CommentPostAction;
use User\Actions\Post\UpdateAction;
use User\Actions\Post\FilterAction;
use User\Http\Requests\Post\CommentPostRequest;
use User\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use User\Actions\Post\{
    StoreAction,
    DestroyAction,
};

use User\Http\Resources\{Comment\CommentResource, Post\PostCollection, Post\PostResource, PaginationResource};
use User\Http\Requests\Post\{
    UpdateRequest,
    RemoveRequest,
    StoreRequest,
};

class PostController extends BaseResponse
{
    public function index(Request $request, FilterAction $getData){

        $records = $getData->execute($request)->orderBy('created_at','desc')->paginate(10)->appends($request->except('page'));

        return $this->response(200, 'posts', 200, [], 0, [
            'posts'   => new PostCollection($records),
            'pagination' => new PaginationResource($records),
        ]);
    }

    public function store(StoreRequest $request, StoreAction $storeAction){

        DB::beginTransaction();
        try {
            $user = auth()->user();
            $record = $storeAction->execute($request, $user);
            DB::commit();
            return $this->response(200, 'Post has been created successfully.', 200, [], 0, [
                'post' => new PostResource($record),
            ]);
        }
        catch (\Exception $e) {
            DB::rollback();
            return $this->response(500, $e->getMessage(), 500);
        }
    }

    public function update(UpdateRequest $request,UpdateAction $updateAction ){
        DB::beginTransaction();
        try {
            $user   = auth()->user();
            $record = $updateAction->execute($request,$user);
            if(!$record)
                return $this->response(500, 'Failed, This record is not found .', 200);
            DB::commit();
            return $this->response(200, 'Post has been Updated successfully.', 200, [], 0, [
                'post' => new PostResource($record),
            ]);
        }catch (\Exception $e) {
            DB::rollback();
            return $this->response(500, $e->getMessage(), 500);
        }
    }
    public function commentPost(CommentPostRequest $request , CommentPostAction $sendAction){

        DB::beginTransaction();
        try {
            $user = auth()->user();
            $record = $sendAction->execute($request, $user);
            //return $record;
            DB::commit();
            return $this->response(200, 'The Comment has been sent successfully.', 200, [], 0, [
                'comment' => new CommentResource($record),
            ]);
        }
        catch (\Exception $e) {
            DB::rollback();
            return $this->response(500, $e->getMessage(), 500);
        }

    }
    public function destroy(RemoveRequest $request, DestroyAction $destroyAction)
    {
        DB::beginTransaction();
        try {
            $user   = auth()->user();
            $record =  $destroyAction->execute($request,$user);
            if(!$record)
                return $this->response(500, 'Failed, This record is not found .', 200);
            DB::commit();
            return $this->response(200, 'Post has been Deleted successfully.', 200, [], 0);
        } catch (\Exception $ex) {
            DB::rollBack();
            return $this->response(500, 'Failed, Please try again later.', 200);
        }
    }

}
