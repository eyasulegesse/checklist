<?php

namespace App\Http\Controllers;

use App\Models\AssignTask;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SupervisionDashboardController extends Controller
{
    //
    public function changeStatus(Request $request)
    {

        try {

            $assignTask = AssignTask::find($request->task_id);
            $assignTask->status = $request->status;
            $assignTask->save();
            return redirect()->route('assign.task');
        } catch (Exception $e) {
            dd($e->getMessage());
            Log::channel('error')->error(' IP ' . $request->ip . ' Message: ' . $e->getMessage());
            return redirect('/404');
        }
    }
}
