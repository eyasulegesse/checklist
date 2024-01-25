<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\BreakageMaintenance;
use App\Models\Department;
use App\Models\Item;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;

class BreakageMaintenanceController extends Controller
{
    //

    public function index(Request $request)
    {

        try {
            $items = Item::orderBy('id', 'DESC')->get();

            $user_id = auth()->user()->id;
            $breakageMaintenances = BreakageMaintenance::with(['item', 'branch', 'user.branch', 'user.department'])->orderBy('id', 'DESC')->get();

            return Inertia::render('Admin/Pages/BreakageMaintenance', [
                'user_id' => $user_id,
                'items' => $items,
                'breakageMaintenances' => $breakageMaintenances

            ]);
        } catch (Exception $e) {
            dd($e->getMessage());
            Log::channel('error')->error(' IP ' . $request->ip . ' Message: ' . $e->getMessage());
            return redirect('/404');
        }
    }

    public function indexsupervisor(Request $request)
    {

        try {
            $items = Item::orderBy('id', 'DESC')->get();
            $user_id = Auth::user()->id;
            $branchs = Branch::orderBy('id', 'DESC')->get();
            $departments = Department::orderBy('id', 'DESC')->get();
            $breakageMaintenances = BreakageMaintenance::with(['item', 'branch', "department", 'user.department'])
                ->where('user_id', $user_id)->orderBy('id', 'DESC')->get();

            return Inertia::render('Supervisor/Pages/BreakageMaintenance', [
                'user_id' => $user_id,
                'items' => $items,
                'breakageMaintenances' => $breakageMaintenances,
                'branchs' => $branchs,
                "departments" => $departments

            ]);
        } catch (Exception $e) {
            dd($e->getMessage());
            Log::channel('error')->error(' IP ' . $request->ip . ' Message: ' . $e->getMessage());
            return redirect('/404');
        }
    }

    public function storesupervisor(Request $request)
    {
        $attr = $request->validate([
            'date' => ['required'],
            'quantity' => ['required'],
            'remark' => ['required'],
            'item_id' => ['required'],
            'user_id' => ['required'],
            'branch_id' => ['required'],
            'department_id' => ['required'],
            'image' => ['required']
        ]);


        try {
            $imageName = time() . '.' . $request->image->extension();

            $request->image->move(public_path('images'), $imageName);

            $breakageMaintenance = BreakageMaintenance::create([
                'date' => $attr['date'],
                'quantity' => $attr['quantity'],
                'remark' => $attr['remark'],
                'item_id' => $attr['item_id'],
                'user_id' => $attr['user_id'],
                'branch_id' => $attr['branch_id'],
                'department_id' => $attr['department_id'],
                'image' => $imageName,
            ]);
            Log::channel('success')->error("IP: " . $request->ip() . " USER: " . auth()->user()->id . " MESSAGE: Spoilage Maintenance  Added Successfully! ACTION ID: " . $breakageMaintenance->id);
            return redirect()->route('breakage.supervisor.index');
        } catch (Exception $e) {
            dd($e->getMessage());
            Log::channel('error')->error(' IP ' . $request->ip . ' Message: ' . $e->getMessage());
            return redirect('/404');
        }
    }

    public function store(Request $request)
    {
        $attr = $request->validate([
            'date' => ['required'],
            'quantity' => ['required'],
            'remark' => ['required'],
            'item_id' => ['required'],
            'user_id' => ['required']
        ]);
        try {
            $breakageMaintenance = BreakageMaintenance::create($attr);
            Log::channel('success')->error("IP: " . $request->ip() . " USER: " . auth()->user()->id . " MESSAGE: Spoilage Maintenance  Added Successfully! ACTION ID: " . $breakageMaintenance->id);
            return redirect()->route('breakage.index');
        } catch (Exception $e) {
            dd($e->getMessage());
            Log::channel('error')->error(' IP ' . $request->ip . ' Message: ' . $e->getMessage());
            return redirect('/404');
        }
    }
}
