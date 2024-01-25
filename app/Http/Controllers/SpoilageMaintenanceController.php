<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Department;
use App\Models\Item;
use App\Models\SpoilageMaintenance;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;

class SpoilageMaintenanceController extends Controller
{
    //
    public function index()
    {



        $items = Item::orderBy('id', 'DESC')->get();
        $user_id = Auth::user()->id;
        $branchs = Branch::orderBy('id', 'DESC')->get();
        $spoilageMaintenances = SpoilageMaintenance::with(['item', 'user', "branch", 'user.department', 'user.branch'])->orderBy('id', 'DESC')->get();

        return Inertia::render('Admin/Pages/SpoilageMaintenance', [

            'spoilageMaintenances' => $spoilageMaintenances,
            'user_id' => $user_id,
            'items' => $items,
            'branchs' => $branchs

        ]);
    }

    public function store(Request $request)
    {


        $attr = $request->validate([
            'date' => ['required'],
            'item_id' => ['required'],
            'user_id' => ['required'],
            'quantity' => ['required'],
            'remark' => ['required'],
            'image' => ['required'],
        ]);
        dd("denez");
        try {
            $fileName = time() . '.' . $request->image->extension();


            $request->image->storeAs('public/images', $fileName);

            $spoilageMaintenance = SpoilageMaintenance::create($attr);
            Log::channel('success')->error("IP: " . $request->ip() . " USER: " . auth()->user()->id . " MESSAGE: Spoilage Maintenance  Added Successfully! ACTION ID: " . $spoilageMaintenance->id);
            return redirect()->route('spoilage.index');
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
            'item_id' => ['required'],
            'user_id' => ['required'],
            'branch_id' => ['required'],
            'department_id' => ['required'],
            'quantity' => ['required'],
            'remark' => ['required'],
            'image' => ['required'],

        ]);

        try {
            $imageName = time() . '.' . $request->image->extension();

            $request->image->move(public_path('images'), $imageName);

            $spoilageMaintenance = SpoilageMaintenance::create([
                'date' => $attr['date'],
                'item_id' => $attr['item_id'],
                'user_id' => $attr['user_id'],
                'branch_id' => $attr['branch_id'],
                'department_id' => $attr['department_id'],
                'quantity' => $attr['quantity'],
                'remark' => $attr['remark'],
                'image' => $imageName,
            ]);
            Log::channel('success')->error("IP: " . $request->ip() . " USER: " . auth()->user()->id . " MESSAGE: Spoilage Maintenance  Added Successfully! ACTION ID: " . $spoilageMaintenance->id);
            return redirect()->route('spoilage.supervisor.index');
        } catch (Exception $e) {
            dd($e->getMessage());
            Log::channel('error')->error(' IP ' . $request->ip . ' Message: ' . $e->getMessage());
            return redirect('/404');
        }
    }
    public function indexsupervisor()
    {

        $items = Item::orderBy('id', 'DESC')->get();
        $user_id = Auth::user()->id;
        $branchs = Branch::orderBy('id', 'DESC')->get();
        $departments = Department::orderBy('id', 'DESC')->get();
        $spoilageMaintenances = SpoilageMaintenance::with(['item', 'user', 'department', 'branch'])
            ->where('user_id', $user_id)->orderBy('id', 'DESC')->get();

        return Inertia::render('Supervisor/Pages/SpoilageMaintenance', [

            'spoilageMaintenances' => $spoilageMaintenances,
            'user_id' => $user_id,
            'items' => $items,
            'branchs' => $branchs,
            "departments" => $departments

        ]);
    }
}
