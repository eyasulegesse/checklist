<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;

class CategoryController extends Controller
{
    //
    public function index(Request $request)
    {

        try {
            $itemCategory = Category::orderBy('id', 'DESC')->get();
            return Inertia::render(
                'Admin/Pages/ItemCategory',
                [
                    'itemCategorys' => $itemCategory
                ]
            );
        } catch (Exception $e) {
            dd($e->getMessage());
            Log::channel('error')->error("IP: " . $request->ip() . " MESSAGE: " . $e->getMessage());
            return redirect('/404');
        }
    }

    public function store(Request $request)
    {

        $attr = $request->validate([
            'name' => ['required', 'string']
        ]);
        try {
            $itemcategory = Category::create($attr);
            Log::channel('success')->error("IP: " . $request->ip() . " USER: " . auth()->user()->id . " MESSAGE: Item Category Added Successfully! ACTION ID: " . $itemcategory->id);
            return redirect()->route('item.index');
        } catch (Exception $e) {

            Log::channel('error')->error("IP: " . $request->ip() . " MESSAGE: " . $e->getMessage());
            return redirect('/404');
        }
    }

    public function deleteItemCategory(Request $request, $id)
    {
        try {
            Category::findOrFail($id)->delete();
            return redirect()->route('item.index');
        } catch (Exception $e) {

            Log::channel('error')->error("IP: " . $request->ip() . " MESSAGE: " . $e->getMessage());
            return redirect('/404');
        }
    }
}
