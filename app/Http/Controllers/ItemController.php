<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Category;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {   
        $menus = Item::with('category')->get();
        return view('admin.Item.index', compact('menus'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {   
        $categories = Category::all();
        return view('admin.Item.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
            'img'   => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'is_active' => 'required|boolean',
        ]);

        if($request->hasFile('img')){
            $imageName = time() . '-' . $request->file('img')->getClientOriginalName();
            $request->file('img')->move(public_path('img_item_upload'), $imageName);
        } else {
            $imageName = 'https://upload.wikimedia.org/wikipedia/commons/a/a3/Image-not-found.png';
        }

        Item::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'category_id' => $request->category_id,
            'img' => $imageName,
            'is_active' => $request->is_active,
        ]);

        return redirect()->route('items.index')->with('success', 'Item created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $item = Item::findOrFail($id);
        return view('admin.Item.detail', compact('item'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {   
        $categories = Category::all();
        $item = Item::findOrFail($id);
        return view('admin.Item.edit', compact('item', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $item = Item::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
            'img' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'is_active' => 'required|boolean',
        ]);

        if($request->hasFile('img')){
            $oldPathImg = public_path('img_item_upload/'.$item->img);
            if(file_exists($oldPathImg)){
                unlink($oldPathImg);
            }

            $newimageName = time() . '-' . $request->file('img')->getClientOriginalName();
            $request->file('img')->move(public_path('img_item_upload'), $newimageName);

            $item->img = $newimageName;
        }

        $item->update([
            'name'        => $request->name,
            'description' => $request->description,
            'price'       => $request->price,
            'category_id' => $request->category_id,
            'is_active'   => $request->is_active,
        ]);

        return redirect()->route('items.index')->with('success', 'Item updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $item = Item::findOrFail($id);
        $item->delete();

        return redirect()->route('items.index')->with('success', 'Item deleted successfully.');
    }

    public function changeStatus($id){
        $item = Item::findOrFail($id);
        $item->is_active = !$item->is_active;
        $item->save();

        return redirect()->route('items.index')->with('success', 'Item status updated successfully.');
    }
}
