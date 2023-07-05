<?php

namespace App\Http\Controllers\Api;

use App\DTO\AddToCartDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\AddToCartRequest;
use App\Http\Requests\DeleteProductFromCartRequest;
use App\Http\Resources\AddToCartResource;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends BaseController
{
    public function add_to_cart(AddToCartRequest $request){

        $requestData = $request->all();
        // $requestData = AddToCartDTO::formRequest($request);
        $requestData['user_id'] = Auth::id();
        $product = Product::find($request->product_id);
        if($product){
            $total_price = $product->price * $request->count;
            $requestData['total_price'] = $total_price;

            $cart = Cart::create($requestData);

            return $this->sendResponse(new AddToCartResource($cart), 'Product added successfuly.');

        }
        else{
          return $this->sendError('Product not found');

        }


    }

    public function delete_product_from_cart(DeleteProductFromCartRequest $request){

        $product_in_cart = Cart::find($request->id);
        if(!is_null($product_in_cart)){
            if($product_in_cart->user_id == Auth::id()){
                $delete = $product_in_cart->delete();
                return $delete ? response()->json(['success' => 'Product deleted from cart']) : $this->sendError('error');

            }
            else{
                return $this->sendError('You dont hav this permission');
            }
        }
        else{
            return $this->sendError('Product not found ');
        }
    }
}
