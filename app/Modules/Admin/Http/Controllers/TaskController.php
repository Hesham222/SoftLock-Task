<?php

namespace Admin\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Admin\Actions\Task\{
    StoreAction,
    UpdateAction,
    TrashAction,
    RestoreAction,
    DestroyAction,
    FilterAction,
};
use Admin\Http\Requests\Task\{
    StoreRequest,
    RemoveRequest,
    FilterDateRequest
};
use Admin\Exports\Task\{
    ExportData,
};
use Admin\Models\{
    Task
};
use App\Http\Traits\FileTrait;

class TaskController extends JsonResponse
{

    public function index()
    {
        return view('Admin::tasks.index');
    }

    public function create()
    {
        return view('Admin::tasks.create');
    }

    public function store(StoreRequest $request, StoreAction $storeAction)
    {

        DB::beginTransaction();
        try {
            $storeAction->execute($request);
            DB::commit();
            return redirect()->route('admins.task.index')->with('success','Data has been saved successfully.');
        } catch (\Exception $exception) {
            DB::rollback();
            return redirect()->back()->with('error','Failed, Please try again later.')->withInput();
        }
    }
    public function decrypt($id,UpdateAction $updateAction)
    {
        DB::beginTransaction();
        try {

            $record = Task::FindOrFail($id);

            $updateAction->execute($record);

            DB::commit();

            if ($record->status == 0)
                return back()->with('success','File is Decrypted');
            else
                return back()->with('success','File is Encrypted');

        } catch (\Exception $exception) {
            DB::rollback();
            return redirect()->back()->with('error','Failed, Please try again later.')->withInput();
        }
    }

    public function download($id)
    {
        DB::beginTransaction();
        try {

            $record = Task::FindOrFail($id);
            DB::commit();

            if ($record->status == 1){
                $file = public_path($record->name);
                return response()->download($file);
            }else{

                $file = public_path('decrypt'.'-'.$record->name);
                return response()->download($file);
            }

        } catch (\Exception $exception) {
            DB::rollback();
            return redirect()->back()->with('error','Failed, Please try again later.')->withInput();
        }
    }


    public function data(FilterDateRequest $request, FilterAction $filterAction)
    {
        $records = $filterAction->execute($request)
            ->orderBy('id','DESC')
            ->paginate(10)->appends([
                'view'       => $request->input('view'),
                'column'     => $request->input('column'),
                'value'      => $request->input('value'),
                'start_date' => $request->input('start_date'),
                'end_date'   => $request->input('end_date'),

            ]);
        $result = view('Admin::tasks.components.table_body',compact('records'))->render();
        return response()->json(['result' => $result, 'links' => $records->links()->render()], 200);
    }

    public function export(FilterDateRequest $request, FilterAction $filterAction)
    {
        try{
            $records = $filterAction->execute($request)->orderBy('id','DESC')->get();
                return Excel::download(new ExportData($records), 'tasks_data.csv');
        }
        catch (\Exception $ex){
            return redirect()->back()->with('error', 'Error occured, Please try again later.');
        }
    }


    public function trash(RemoveRequest $request, TrashAction $trashAction)
    {
        DB::beginTransaction();
        try {
            $record =  $trashAction->execute($request);
            if(!$record)
                return $this->response(500, 'Failed, This record is not found .', 200);
            DB::commit();
            return $this->response(200, 'Data moved to trash successfully.', 200, [], $record, ['module' => 'tasks', 'trashesCount' => $this->countTrashes()]);
        } catch (\Exception $ex) {
            DB::rollBack();
            return $this->response(500, 'Failed, Please try again later.', 200);
        }
    }

    public function destroy(RemoveRequest $request, DestroyAction $destroyAction, $id)
    {
        DB::beginTransaction();
        try {
            if ($id === 1)
                return $this->response(500, 'Failed, You can not delete this record.', 200);
            $record =  $destroyAction->execute($request, $id);
            if(!$record)
                return $this->response(500, 'Failed, This record is not found .', 200);
            DB::commit();
            return $this->response(200, 'Data has been deleted successfully.', 200, [], $record, ['module' => 'tasks', 'trashesCount' => $this->countTrashes()]);
        } catch (\Exception $ex) {
            DB::rollBack();
            return $this->response(500, 'Failed, Please try again later.', 200);
        }
    }

    public function restore(RemoveRequest $request, RestoreAction $restoreAction)
    {
        DB::beginTransaction();
        try {
            $record =  $restoreAction->execute($request);
            DB::commit();
            return $this->response(200, 'Data has been restored successfully.', 200, [], $record, ['module' => 'tasks', 'trashesCount' => $this->countTrashes()]);
        } catch (\Exception $ex) {
            DB::rollBack();
            return $this->response(500, 'Failed, Please try again later.', 200);
        }
    }

    private function countTrashes()
    {
        return Task::onlyTrashed()->count();
    }
}
