<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Item;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;

class ItemController extends Controller
{
    //
    public function index(Request $request)
    {

        try {
            $items = Item::with(['category'])->get();
            $categories = Category::orderBy('id', 'DESC')->get();
            return Inertia::render('Admin/Pages/Item', [
                'items' => $items,
                'categories' => $categories
            ]);
        } catch (Exception $e) {
            Log::channel('error')->error(' IP: ' . $request->ip . ' Message: ' . $e->getMessage());
            return redirect('/404');
        }
    }

    public function store(Request $request)
    {

        $attr =  $request->validate(
            [
                'name' =>  ['required', 'string'],
                'code' =>  ['required', 'string'],
                'category_id' => ['required', 'string'],
            ]
        );

        try {
            $item = Item::create($attr);
            Log::channel('success')->error("IP: " . $request->ip() . " USER: " . auth()->user()->id . " MESSAGE: Item  Added Successfully! ACTION ID: " . $item->id);
            return redirect()->route('item');
        } catch (Exception $e) {
            dd($e->getMessage());
            Log::channel('error')->error(' IP ' . $request->ip . ' Message: ' . $e->getMessage());
            return redirect('/404');
        }
    }

    public function deleteHandler(Request $request, $id)
    {

        try {
            $item =  Item::findOrFail($id)->delete();

            return redirect()->route('item');
        } catch (Exception $e) {
            dd($e->getMessage());
            Log::channel('error')->error(' IP ' . $request->ip . ' Message: ' . $e->getMessage());
            return redirect('/404');
        }
    }
}
