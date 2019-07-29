<?php

namespace App\Http\Controllers\Author;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\User;
use App\ShoppingList;

class ShoppingListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $item = new ShoppingList;
        $item->user_id = auth()->user()->id;
        $item->item = request()->text;
        $item->quantity = request()->quantity;
        $item->save();
        return 'Done';
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        $items = $user->shoppingLists()->get();
        return view('author.shoppinglist.index', compact('user', 'items'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

    }

    public function delete(Request $request)
    {
        ShoppingList::where('id', $request->id)->delete();
        return $request->all();
    }

    public function updateItem(Request $request)
    {
        $item = ShoppingList::find($request->id);
        $item->user_id = auth()->user()->id;
        $item->item = $request->item;
        $item->quantity = $request->quantity;
        $item->save();
        return $request->all();
    }

    public function search(Request $request)
    {
        $term = $request->term;
        $user_id = auth()->user()->id;
        $items = ShoppingList::where('item', 'LIKE', '%'.$term.'%')->where('user_id', $user_id)->get();

        if (count($items) == 0) {
            $searchResult[] = 'No Item Found';
        }else{
            foreach ($items as $key => $value) {
                $searchResult[] = $value->item;
            }
        }

        return $searchResult;
    }
}
