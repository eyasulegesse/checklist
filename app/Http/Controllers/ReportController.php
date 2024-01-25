<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\BreakageMaintenance;
use App\Models\Checklist;
use App\Models\InventoryCount;
use App\Models\SpoilageMaintenance;
use Illuminate\Http\Request;
use Inertia\Inertia;

use function Termwind\render;

class ReportController extends Controller
{
    //

    public function checklistIndex(Request $request)
    {
        $branches = Branch::orderBy('id', 'DESC')->get();
        $checklists = Checklist::with(['mainCheckList', 'subChecklist', 'branch', 'checklistTask', 'user', 'department'])->orderBy('id', 'DESC')->get();
        return Inertia::render('Admin/Pages/ChecklistReport', [
            'checklists' => $checklists,
            'branches' => $branches
        ]);
    }
    public function breakageIndex(Request $request)
    {

        $branches = Branch::orderBy('id', 'DESC')->get();
        $breakage = BreakageMaintenance::with(['item', "user", "branch"])->orderBy('id', 'DESC')->get();

        return Inertia::render('Admin/Pages/BreakageReport', [
            'breakages' => $breakage,
            'branches' => $branches
        ]);
    }

    public function spoilageIndex(Request $request)
    {
        $branches = Branch::orderBy('id', 'DESC')->get();
        $spoilages = SpoilageMaintenance::with('item', 'user', "branch")->orderBy('id', 'DESC')->get();
        return Inertia::render('Admin/Pages/SpoilageReport', [
            'spoilages' => $spoilages,
            'branches' => $branches
        ]);
    }

    public function inventoryCountIndex(Request $request)
    {
        $branches = Branch::orderBy('id', 'DESC')->get();
        $inventoryCount = InventoryCount::with(['item', 'user', 'branch'])->orderBy('id', 'DESC')->get();
        return Inertia::render('Admin/Pages/InventoryCountReport', [
            'inventoryCount' => $inventoryCount,
            'branches' => $branches
        ]);
    }

    public function inventoryCountByBranch(Request $request, $id)
    {
        $branches = Branch::orderBy('id', 'DESC')->get();
        $inventoryCount = InventoryCount::where('branch_id', $id)->with(['item', 'user', 'branch'])->orderBy('id', 'DESC')->get();
        return Inertia::render('Admin/Pages/InventoryCountReport', [
            'inventoryCount' => $inventoryCount,
            'branches' => $branches
        ]);
    }
    public function breakageByBranch(Request $request, $id)
    {
        $branches = Branch::orderBy('id', 'DESC')->get();
        $breakage = BreakageMaintenance::where('branch_id', $id)->with(['item', "user", "branch"])->orderBy('id', 'DESC')->get();

        return Inertia::render('Admin/Pages/BreakageReport', [
            'breakages' => $breakage,
            'branches' => $branches
        ]);
    }
    public function spoilageByBranch(Request $request, $id)
    {
        $branches = Branch::orderBy('id', 'DESC')->get();
        $spoilages = SpoilageMaintenance::where('branch_id', $id)->with('item', 'user', "branch")->orderBy('id', 'DESC')->get();
        return Inertia::render('Admin/Pages/SpoilageReport', [
            'spoilages' => $spoilages,
            'branches' => $branches
        ]);
    }

    public function checklistByBranch(Request $request, $id)
    {

        $branches = Branch::orderBy('id', 'DESC')->get();
        $checklists = Checklist::where('branch_id', $id)->with(['mainCheckList', 'subChecklist', 'branch', 'checklistTask', 'user', 'department'])->orderBy('id', 'DESC')->get();
        return Inertia::render('Admin/Pages/ChecklistReport', [
            'checklists' => $checklists,
            'branches' => $branches
        ]);
    }
}
