<?php

namespace App\Http\Controllers;

use App\Models\ChecklistTask;
use App\Models\SubChecklist;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;

class ChecklistTaskController extends Controller
{
    //

    public function index(Request $request)
    {
        try {
            $checklistTask = ChecklistTask::with(['subChecklist', 'subChecklist.mainchecklist'])->orderBy('id', 'DESC')->get();
            $subChecklists = SubChecklist::with(['mainCheckList'])->orderBy('id', 'DESC')->get();

            return Inertia::render('Admin/Pages/ChecklistTask', [
                'checklistTask' => $checklistTask,
                'subChecklists' => $subChecklists
            ]);
        } catch (Exception $e) {
            dd($e->getMessage());
            Log::channel('error')->error(' IP ' . $request->ip . ' Message: ' . $e->getMessage());
            return redirect('/404');
        }
    }

    public function store(Request $request)
    {
        $attr = $request->validate([
            'task' => ['required'],
            'sub_checklist_id' => ['required']
        ]);
        try {
            ChecklistTask::create($attr);
            return redirect()->route('checklist.task.index');
        } catch (Exception $e) {
            dd($e->getMessage());
            Log::channel('error')->error(' IP ' . $request->ip . ' Message: ' . $e->getMessage());
            return redirect('/404');
        }
    }

    public function deleteSubChecklist(Request $request, $id)
    {
        try {
            $task =  ChecklistTask::findOrFail($id)->delete();
            return redirect()->route('checklist.task.index');
        } catch (Exception $e) {
            dd($e->getMessage());
            Log::channel('error')->error(' IP ' . $request->ip . ' Message: ' . $e->getMessage());
            return redirect('/404');
        }
    }
}
