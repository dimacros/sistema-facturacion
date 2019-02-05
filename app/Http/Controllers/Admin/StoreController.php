<?php

namespace App\Http\Controllers\Admin;

use App\Store;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\{CreateStoreRequest, UpdateStoreRequest};
use Illuminate\Http\Request;

class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { 
        return view('admin.stores.index', [
            'stores' => Store::perCompany()->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateStoreRequest $request)
    {
        $data = $request->validated();

        $store = Store::create([
            'name' => $data['name'], 
            'address' => $data['address'],
            'company_id' => $request->user()->company_id
        ]);

        return response()->json([
            'success' => sprintf('La tienda "%s" fue creada con éxito.', $store->name)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateStoreRequest $request, $id)
    {
        $data = $request->validated();

        $store = Store::find($id);

        if( is_null($store) || $store->company_id !== $request->user()->company_id ) {
            return back();
        }

        $store->name = $data['name'];
        $store->address = $data['address']; 
        $store->save();
        
        return back()->with([
            'success' => sprintf('La tienda "%s" fue actualizada con éxito.', $store->name)
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $company_id = auth()->user()->company_id;
        $store = Store::find($id);

        if( is_null($store) || $store->is_primary || $store->company_id !== $company_id ) {
            return back();
        }

        $store->delete();

        return back()->with([
            'success' => sprintf('La tienda "%s" fue eliminada con éxito.', $store->name)
        ]);
    }
}
