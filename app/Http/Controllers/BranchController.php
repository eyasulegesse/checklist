<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;

class BranchController extends Controller
{
    //

    public function index()
    {
        $branches = Branch::orderBy('id', 'DESC')->get();
        return Inertia::render('Admin/Pages/Branch', [
            'branches' => $branches
        ]);
    }

    public function store(Request $request)
    {

        $attr = $request->validate([
            'name' => ['required']
        ]);

        try {
            $branch = Branch::create($attr);
            Log::channel('success')->error("IP: " . $request->ip() . " USER: " . auth()->user()->id . " MESSAGE: Item Category Added Successfully! ACTION ID: " . $branch->id);
            return redirect()->route('branch.index');
        } catch (Exception $e) {
            Log::channel('error')->error("IP: " . $request->ip() . " MESSAGE: " . $e->getMessage());
            return redirect('/404');
        }
    }

    public function deleteBranch(Request $request, $id)
    {
        try {
            $branch = Branch::findOrFail($id)->delete();
            return redirect()->route('branch.index');
        } catch (Exception $e) {
            Log::channel('error')->error("IP: " . $request->ip() . " MESSAGE: " . $e->getMessage());
            return redirect('/404');
        }
    }
}
