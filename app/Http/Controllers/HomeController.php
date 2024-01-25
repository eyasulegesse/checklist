<?php

namespace App\Http\Controllers;

use App\Models\AssignTask;
use App\Models\BreakageMaintenance;
use App\Models\Checklist;
use App\Models\ChecklistTask;
use App\Models\MainCheckList;
use App\Models\SpoilageMaintenance;
use App\Models\SubChecklist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class HomeController extends Controller
{
    //

    public function index(Request $request)
    {
        if (auth()->user()->role == 1) {
            $breakaTotal = BreakageMaintenance::orderBy('id', 'DESC')->count();
            $spoileTotal = SpoilageMaintenance::orderBy('id', 'DESC')->count();
            $mainChecklist = MainCheckList::orderBy('id', 'DESC')->count();
            $subChecklist = SubChecklist::orderBy('id', 'DESC')->count();
            $assignTask = AssignTask::orderBy('id', 'DESC')->count();
            $checklist = Checklist::with(['mainCheckList', 'subChecklist', 'checklistTask', 'user', 'department', 'branch'])->orderBy('id', 'DESC')->get();
            $assignedTasks = AssignTask::with(['taskAssignedBy.user', 'taskAssignedTo.user'])->orderBy('id', 'DESC')->take(8)->get();

            return Inertia::render('Admin/Pages/Dashboard', [
                'breakaTotal' => $breakaTotal,
                'spoileTotal' => $spoileTotal,
                'mainChecklist' => $mainChecklist,
                'subChecklist' => $subChecklist,
                'assignedTasks' => $assignedTasks,
                'assignTask' => $assignTask,
                'checklist' => $checklist

            ]);
        } else {
            $user_id = Auth::user()->id;
            $assignedTask = AssignTask::with(['taskAssignedTo.user', 'taskAssignedBy.user'])
                ->whereHas('taskAssignedTo', function ($query) use ($user_id) {
                    $query->where('user_id', $user_id);
                })->orderBy('id', 'DESC')->get();

            return Inertia::render(
                'Supervisor/Dashboard',
                ['assignedTasks' => $assignedTask]
            );
            return Inertia::render('Supervisor/Dashboard');
        }
    }
}
