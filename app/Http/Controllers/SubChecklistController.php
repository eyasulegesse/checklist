<?php

namespace App\Http\Controllers;

use App\Models\MainCheckList;
use App\Models\SubChecklist;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;

class SubChecklistController extends Controller
{

    public function index(Request $request)
    {

        $subchecklists = SubChecklist::with(['mainCheckList'])->orderBy('id', 'DESC')->get();
        $mainCheckList = MainCheckList::orderBy('id', 'DESC')->get();

        return Inertia::render('Admin/Pages/SubChecklist', [
            'subchecklists' => $subchecklists,
            'mainCheckList' => $mainCheckList
        ]);
    }

    public function store(Request $request)
    {
        $attr = $request->validate([
            'name' => ['required'],
            'main_check_list_id' => ['required']
        ]);

        try {
            SubChecklist::create($attr);
            return redirect()->route('subchecklist.index');
        } catch (Exception $e) {
            dd($e->getMessage());
            Log::channel('error')->error(' IP ' . $request->ip . ' Message: ' . $e->getMessage());
            return redirect('/404');
        }
    }

    public function deleteSubChecklist(Request $request, $id)
    {

        try {
            SubChecklist::findOrFail($id)->delete();
            return redirect()->route('subchecklist.index');
        } catch (Exception $e) {
            dd($e->getMessage());
            Log::channel('error')->error(' IP ' . $request->ip . ' Message: ' . $e->getMessage());
            return redirect('/404');
        }
    }
}
