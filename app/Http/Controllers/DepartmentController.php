<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Department;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;

class DepartmentController extends Controller
{
    //
    public function index(Request $request)
    {


        $departments = Department::with(['branch'])->orderBy('id', 'DESC')->get();
        $branches = Branch::orderBy('id', 'DESC')->get();
        return Inertia::render('Admin/Pages/Department', [
            'departments' => $departments,
            'branches' => $branches
        ]);
    }



    public function store(Request $request)
    {
        $attr = $request->validate(
            [
                'name' => ['required'],
                'branch_id' => ['required']
            ]
        );

        try {
            $department = Department::create($attr);
            Log::channel('success')->error('IP: ' . $request->ip() . 'USER: ' . auth()->user()->id . " MESSAGE: Department  Added Successfully! ACTION ID: " . $department->id);

            return redirect()->route('department.index');
        } catch (Exception $e) {
            Log::channel('success')->error('IP: ' . $request->ip() . 'Message: ' . $e->getMessage());

            return redirect('/404');
        }
    }

    public function deleteDepartment(Request $request, $id)
    {
        try {
            $department = Department::findOrFail($id)->delete();
            return redirect()->route('department.index');
        } catch (Exception $e) {
            Log::channel('success')->error('IP: ' . $request->ip() . 'Message: ' . $e->getMessage());

            return redirect('/404');
        }
    }
}
