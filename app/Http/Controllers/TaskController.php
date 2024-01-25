<?php

namespace App\Http\Controllers;

use App\Models\AssignTask;
use App\Models\TaskAssignedBy;
use App\Models\TaskAssignedTo;
use App\Models\User;
use Exception;
use Illuminate\Console\View\Components\Task;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;

class TaskController extends Controller
{
    //

    public function index(Request $request)
    {
        $users = User::with(['department'])->orderBy('id', 'DESC')->get();
        $user_id = Auth::user()->id;
        $assigned_task = AssignTask::with(['taskAssignedBy.user', 'taskAssignedTo.user'])
            ->orderBy('id', 'DESC')->get();
        return Inertia::render('Admin/Pages/Task', [
            'users' => $users,
            'user_id' => $user_id,
            'assigned_task' => $assigned_task
        ]);
    }
    public function store(Request $request)
    {

        $attr = $request->validate([
            'task' => ['required'],
            'date' => ['required'],
            'task_assigned_to_id' => ['required'],
            'task_assigned_by_id' => ['required'],
        ]);

        try {


            $assignedBy = TaskAssignedBy::create([
                'user_id' => $attr['task_assigned_by_id'],


            ]);

            $assignedTo = TaskAssignedTo::create([
                'user_id' => $attr['task_assigned_to_id'],

            ]);


            $assignTask = AssignTask::create([
                'task' => $attr['task'],
                'date' => $attr['date'],
                'task_assigned_by_id' => $assignedBy['id'],
                'task_assigned_to_id' =>  $assignedTo['id'],
                'status' => 'assigned',


            ]);

            Log::channel('success')->error("IP: " . $request->ip() . " USER: " . auth()->user()->id . " MESSAGE: Spoilage Maintenance  Added Successfully! ACTION ID: " . $assignTask->id);
            return redirect()->route('task.index');
        } catch (Exception $e) {
            dd($e->getMessage());
            Log::channel('error')->error(' IP ' . $request->ip . ' Message: ' . $e->getMessage());
            return redirect('/404');
        }
    }

    public function AssignedTask(Request $request)
    {

        try {
            $user_id = Auth::user()->id;

            $assignedtasks = AssignTask::with(['taskAssignedBy.user', 'taskAssignedTo.user'])
                // ->where('task_assigned_to_id', $user_id)
                ->whereHas('taskAssignedTo', function ($query) use ($user_id) {
                    $query->where('user_id',  $user_id);
                })
                ->orderBy('id', 'DESC')->get();


            return Inertia::render('Supervisor/Pages/AssignedTask', [
                'assignedtasks' => $assignedtasks
            ]);
        } catch (Exception $e) {
            dd($e->getMessage());
            Log::channel('error')->error(' IP ' . $request->ip . ' Message: ' . $e->getMessage());
            return redirect('/404');
        }
    }

    public function AssignTask(Request $request)
    {

        try {
            $user_id = Auth::user()->id;
            $users = User::with(['department'])->orderBy('id', 'DESC')->get();
            $assignTasks = AssignTask::with(['taskAssignedBy.user', 'taskAssignedTo.user'])
                // ->where('task_assigned_to_id', $user_id)
                ->whereHas('taskAssignedBy', function ($query) use ($user_id) {
                    $query->where('user_id',  $user_id);
                })
                ->get();
            return Inertia::render('Supervisor/Pages/AssignTask', [
                'assignTasks' => $assignTasks,
                'users' => $users,
                'user_id' => $user_id
            ]);
        } catch (Exception $e) {
            dd($e->getMessage());
            Log::channel('error')->error(' IP ' . $request->ip . ' Message: ' . $e->getMessage());
            return redirect('/404');
        }
    }
    public function AssignTaskStore(Request $request)
    {


        $attr = $request->validate([
            'task' => ['required'],
            'date' => ['required'],
            'task_assigned_to_id' => ['required'],
            'task_assigned_by_id' => ['required'],
        ]);

        try {


            $assignedBy = TaskAssignedBy::create([
                'user_id' => $attr['task_assigned_by_id']
            ]);

            $assignedTo = TaskAssignedTo::create([
                'user_id' => $attr['task_assigned_to_id']
            ]);

            $assignTask = AssignTask::create([
                'task' => $attr['task'],
                'date' => $attr['date'],
                'task_assigned_by_id' => $assignedBy->id,
                'task_assigned_to_id' => $assignedTo->id,
                'status' => 'assigned',


            ]);

            Log::channel('success')->error("IP: " . $request->ip() . " USER: " . auth()->user()->id . " MESSAGE: Spoilage Maintenance  Added Successfully! ACTION ID: " . $assignTask->id);
            return redirect()->route('assign.task');
        } catch (Exception $e) {
            dd($e->getMessage());
            Log::channel('error')->error(' IP ' . $request->ip . ' Message: ' . $e->getMessage());
            return redirect('/404');
        }
    }
}
