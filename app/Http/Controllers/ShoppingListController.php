<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ShoppingList;
use Illuminate\Http\Request;

class ShoppingListController extends Controller
{
    public function showShoppingList(Request $request)
    {
        $user = auth()->user();

        $search = $request->input('search');
        $sortInfo = explode('|', $request->input('sort', 'ingredient_name|asc'));
        $sort = $sortInfo[0] ?? 'ingredient_name';
        $order = $sortInfo[1] ?? 'asc';

        $shoppingList = ShoppingList::where('user_id', $user->id)
            ->orderBy($sort, $order);

        if ($search) {
            $shoppingList->where(function ($query) use ($search) {
                $query->where('ingredient_name', 'like', '%' . $search . '%');
            });
        }

        $shoppingList = $shoppingList->paginate(21);

        return view('user.shoppingList', compact('shoppingList', 'search', 'sort', 'order'));
    }

    public function deleteItem($id)
    {
        $shoppingListItem = ShoppingList::findOrFail($id);
        $shoppingListItem->delete();

        return redirect()->back();
    }

    public function deleteAllItems()
    {
        ShoppingList::where('user_id', auth()->id())->delete();

        return redirect()->route('shoppingList.show')->with('success', 'Lista zakupów została wyczyszczona.');
    }

    public function addItem(Request $request)
    {
        $request->validate([
            'ingredient_name' => 'required|max:60',
            'quantity' => 'nullable|numeric',
            'unit' => 'nullable',
        ]);

        $user = auth()->user();

        $shoppingListItem = new ShoppingList([
            'user_id' => $user->id,
            'ingredient_name' => $request->input('ingredient_name'),
            'quantity' => $request->input('quantity'),
            'unit' => $request->input('unit'),
        ]);

        $shoppingListItem->save();

        return redirect()->back();
    }

    public function toggleItem($id)
    {
        $shoppingListItem = ShoppingList::findOrFail($id);
        $shoppingListItem->update(['checked' => !$shoppingListItem->checked]);
    }

}
