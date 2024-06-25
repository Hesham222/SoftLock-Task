<?php

namespace User\Http\Controllers;
use User\Actions\Comment\CommentCommentAction;
use User\Actions\Comment\FilterAction;
use User\Http\Requests\Comment\CommentCommentRequest;
use User\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use User\Actions\Comment\{
    StoreAction,
    UpdateAction,
    DestroyAction,
};

use User\Http\Resources\{Comment\CommentResource, Comment\CommentCollection, Comment\CommentResource, PaginationResource};
use User\Http\Requests\Comment\{
    UpdateRequest,
    RemoveRequest,
    StoreRequest,
};

class CommentController extends BaseResponse
{
    public function index(Request $request, FilterAction $getData){

        $records = $getData->execute($request)->orderBy('created_at','desc')->paginate(10)->appends($request->except('page'));

        return $this->response(200, 'Comments', 200, [], 0, [
            'Comments'   => new CommentCollection($records),
            'pagination' => new PaginationResource($records),
        ]);
    }

    public function store(Request $request, StoreAction $storeAction){

        DB::beginTransaction();
        try {
            $user = auth()->user();
            $record = $storeAction->execute($request, $user);
            DB::commit();
            return $this->response(200, 'Comment has been created successfully.', 200, [], 0, [
                'Comment' => new CommentResource($record),
            ]);
        }
        catch (\Exception $e) {
            DB::rollback();
            return $this->response(500, $e->getMessage(), 500);
        }
    }

    public function update(Request $request,UpdateAction $updateAction ){
        DB::beginTransaction();
        try {
            $user   = auth()->user();

            $record = $updateAction->execute($request,$user);
            if(!$record)
                return $this->response(500, 'Failed, This record is not found .', 200);
            DB::commit();
            return $this->response(200, 'Comment has been Updated successfully.', 200, [], 0, [
                'Comment' => new CommentResource($record),
            ]);
        }catch (\Exception $e) {
            DB::rollback();
            return $this->response(500, $e->getMessage(), 500);
        }
    }
    public function commentComment(CommentCommentRequest $request , CommentCommentAction $sendAction){

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
            return $this->response(200, 'Comment has been Deleted successfully.', 200, [], 0);
        } catch (\Exception $ex) {
            DB::rollBack();
            return $this->response(500, 'Failed, Please try again later.', 200);
        }
    }

}
