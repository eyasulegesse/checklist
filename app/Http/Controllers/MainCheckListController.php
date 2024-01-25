<?php

namespace App\Http\Controllers;

use App\Models\MainCheckList;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;

class MainCheckListController extends Controller
{
    //
    public function index(Request $request)
    {

        $mainchecklists = MainCheckList::orderBy('id', 'DESC')->get();
        return Inertia::render(
            'Admin/Pages/MainChecklist',
            [
                'mainchecklists' => $mainchecklists
            ]
        );
    }

    public function store(Request $request)
    {
        $attr = $request->validate([
            'name' => ['required']
        ]);
        try {
            MainCheckList::create($attr);
            return redirect()->route('mainchecklist.index');
        } catch (Exception $e) {
            dd($e->getMessage());
            Log::channel('error')->error(' IP ' . $request->ip . ' Message: ' . $e->getMessage());
            return redirect('/404');
        }
    }

    public function deleteMainchecklist(Request $request, $id)
    {
        try {
            MainCheckList::findOrFail($id)->delete();
            return redirect()->route('mainchecklist.index');
        } catch (Exception $e) {
            dd($e->getMessage());
            Log::channel('error')->error(' IP ' . $request->ip . ' Message: ' . $e->getMessage());
            return redirect('/404');
        }
    }
}
