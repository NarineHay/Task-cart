<?php

namespace App\Http\Controllers\Api;

use App\DTO\ProductDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Services\FileUploadService;
use Illuminate\Http\Request;

class ProductController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Product::all();
    }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
      //
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  // ============= создать продукт =========================
  public function store(ProductRequest $request)
  {

        $requestData = ProductDTO::formRequest($request);

        $product = Product::create($request->all());

        $path = FileUploadService::upload($request->image_path, 'product/' . $product->id);

        $product->update(['image_path' => $path]);

      return $this->sendResponse(new ProductResource($product), 'Product created successfuly.');
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show(Product $product)
  {
        return $this->sendResponse(new ProductResource($product), 'Product show.');

  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {

  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, Product $product)
  {

        $requestData = $request->all();
        if(request()->has('image_path')){
            $path = FileUploadService::upload($request->image_path, 'product/' . $product->id);
            $requestData['image_path'] = $path;
        }

        $product->update($requestData);

          return $this->sendResponse(new ProductResource($product), 'product updated');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {

      $product = Product::find($id);
      if(is_null($product)){
          return $this->sendError('product not found');
      }
      else{

          $delete = $product->delete();
          return $delete ? response()->json(['success' => 'Product deleted']) : $this->sendError('Product not found');

      }
  }
}
