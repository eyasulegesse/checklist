<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Department;
use App\Models\InventoryCount;
use App\Models\Item;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;
use Termwind\Components\Dd;

class InventoryCountController extends Controller
{
    public function index(Request $request)
    {
        $user_id = auth()->user()->id;
        $inventoryCounts = InventoryCount::with('item', 'item.category', 'branch')->where('user_id', $user_id)->orderBy('id', 'DESC')->get();
        return Inertia::render('Supervisor/Pages/InventoryCount', [
            'inventoryCounts' => $inventoryCounts
        ]);
    }
    //
    public function store(Request $request)
    {
        $attr = $request->validate([

            'date' => ['required'],

        ]);


        try {

            $user_id = Auth::user()->id;
            foreach ($request->inventoryCount as $item) {
                InventoryCount::create([
                    'item_id' => $item['item_id'],
                    'amount' => $item['amount'],
                    'branch_id' => $item['branch_id'],
                    'date' => $attr['date'],
                    'user_id' => $user_id,
                ]);
            }


            return redirect()->route('index');
        } catch (Exception $e) {
            dd($e->getMessage());
            Log::channel('error')->error(' IP ' . $request->ip . ' Message: ' . $e->getMessage());
            return redirect('/404');
        }
    }

    public function indexAdd(Request $request)
    {
        $items = Item::orderBy('id', 'DESC')->get();
        $branches = Branch::orderBy('id', 'DESC')->get();
        $departments = Department::orderBy('id', 'DESC')->get();

        return Inertia::render('Supervisor/Components/InventoryCount/Create', [
            'items' => $items,
            'branches' => $branches,
            "departments" => $departments
        ]);
    }
}
