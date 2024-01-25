<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Checklist;
use App\Models\ChecklistTask;
use App\Models\Department;
use App\Models\MainCheckList;
use App\Models\SubChecklist;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;
use Nette\Utils\Arrays;
use PhpParser\Node\Stmt\Foreach_;

class CheckListController extends Controller
{
    //

    public function index(Request $request)
    {
        $user_id = Auth::user()->id;
        try {
            $checklists = Checklist::where('user_id', $user_id)->with(['branch', 'department', 'mainCheckList', 'subChecklist', 'checklistTask', 'user'])->orderBy('id', 'DESC')->get();
            return Inertia::render('Supervisor/Pages/Checklist', [
                'checklists' => $checklists
            ]);
        } catch (Exception $e) {
            dd($e->getMessage());
            Log::channel('error')->error(' IP ' . $request->ip . ' Message: ' . $e->getMessage());
            return redirect('/404');
        }
    }
    public function indexAdd(Request $request)
    {
        try {
            $branches = Branch::orderBy('id', 'DESC')->get();
            $departments = Department::orderBy('id', 'DESC')->get();
            $mainCheckLists = MainCheckList::orderBy('id', 'DESC')->get();
            $subChecklist = SubChecklist::orderBy('id', 'DESC')->get();
            $checklistTask = ChecklistTask::orderBy('id', 'DESC')->get();

            return Inertia::render('Supervisor/Components/Checklist/Create', [
                'branches' => $branches,
                'departments' => $departments,
                'mainCheckLists' => $mainCheckLists,
                'subChecklist' => $subChecklist,
                'checklistTask' => $checklistTask

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
            'branch_id' => ['required'],
            'department_id' => ['required'],
            'main_check_list_id' => ['required'],
            'sub_checklist_id' => ['required'],
            'task' => ['required'],
            'date' => ['required'],



        ]);

        try {
            $user_id = Auth::user()->id;
            foreach ($request->task as $task) {
                Checklist::create([
                    'branch_id' => $attr['branch_id'],
                    'department_id' => $attr['department_id'],
                    'main_check_list_id' => $attr['main_check_list_id'],
                    'sub_checklist_id' => $attr['sub_checklist_id'],
                    'date' => $attr['date'],
                    'user_id' => $user_id,
                    'checklist_task_id' => $task,
                ]);
            }
            return redirect()->route('supervisor.checklist');
        } catch (Exception $e) {
            dd($e->getMessage());
            Log::channel('error')->error(' IP ' . $request->ip . ' Message: ' . $e->getMessage());
            return redirect('/404');
        }
    }
}
