<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Department;
use App\Models\SubChecklist;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;

class UserController extends Controller
{
    //
    public function userlist(Request $request)
    {
        try {

            $userList = User::with(['branch', 'department', 'subChecklist', 'subChecklist.mainCheckList'])->orderBy('id', 'DESC')->get();
            $branches = Branch::orderBy('id', 'DESC')->get();
            $departments = Department::orderBy('id', 'DESC')->get();
            $subChecklists = SubChecklist::with(['mainCheckList'])->orderBy('id', 'DESC')->get();

            return Inertia::render('Admin/Pages/UserList', [
                'userList' => $userList,
                'branches' => $branches,
                'departments' => $departments,
                'subChecklists' => $subChecklists
            ]);
        } catch (Exception $e) {
            dd($e->getMessage());
            Log::channel('error')->error("IP: " . $request->ip() . " MESSAGE: " . $e->getMessage());
            return redirect('/404');
        }
    }

    public function addUser(Request $request)
    {

        $attr = $request->validate([
            'name' => ['required', 'string', 'max:251'],
            'email' => ['required', 'string', 'email', 'unique:users'],
            'role' => ['required', 'string'],
            'password' => ['required']
        ]);

        try {
            User::create([
                'name' => $attr['name'],
                'email' => $attr['email'],
                'role' => $attr['role'],
                'branch_id' => $request->branch,
                'department_id' => $request->department,
                'sub_checklist_id' => $request->subChecklistId,

                'password' => Hash::make($attr['password']),

            ]);
            return redirect()->route('user.list');
        } catch (Exception $e) {
            dd($e->getMessage());
            Log::channel('error')->error("IP: " . $request->ip() . " MESSAGE: " . $e->getMessage());
            return redirect('/404');
        }
    }

    public function deleteUser(Request $request, $id)
    {

        try {
            $user = User::findOrFail($id)->delete();
            return redirect()->route('user.list');
        } catch (Exception $e) {
            dd($e->getMessage());
            Log::channel('error')->error("IP: " . $request->ip() . " MESSAGE: " . $e->getMessage());
            return redirect('/404');
        }
    }
}
