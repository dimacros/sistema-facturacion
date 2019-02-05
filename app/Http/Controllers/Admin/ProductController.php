<?php

namespace App\Http\Controllers\Admin;

use App\Product;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CreateProductRequest;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display the data in the table.
     *
     * @return \Illuminate\Http\Response
     */
    public function data() 
    {   
        $products = Product::perCompany()->search(request('search'))->render()->get();

        return response()->json(['total' => $products->count(), 'rows' => $products]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.products.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateProductRequest $request)
    {
        $data = $request->validated();
        
        if( isset($data['images']) ) {
            $images = $this->uploadImages($data['images'], $request->user()->company_id);
        }

        $product = Product::create([
            'code' => $data['code'],
            'description' => $data['description'],
            'images' => isset($images) ? json_encode($images) : NULL,
            'currency_code' => $data['currency_code'], 
            'unit_code' => $data['unit_code'],
            'price' => $data['price'],
            'company_id' => $request->user()->company_id
        ]);
        
        return back()->with([
            'success' => sprintf('El producto "%s" fue creado con éxito.', $product->code)
        ]);
    }

    private function uploadImages(array $images, $upload_folder) 
    {
        $items = [];
        for ($i=0; $i < count($images); $i++) { 
            $items[$i] = $images[$i]->store($upload_folder, 'public');
        }

        return $items;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

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
        //
    }
}
