<?php
namespace App\DTO;

use Illuminate\Http\Request;

class AddToCartDTO
{
    public int $product_id;
    public int $count;

    public function __construct(int $product_id, int $count)
    {
        $this->product_id = $product_id;
        $this->count = $count;
    }

    public static function formRequest(Request $request){
        return new static (
            $request->product_id,
            $request->count

        );
    }
}
