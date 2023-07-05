<?php
namespace App\DTO;

use Illuminate\Http\Request;

class ProductDTO
{
    public int $category_id;
    public string $name;
    public int $price;
    public string $description;
    public bool $available;
    public string $image_path;

    public function __construct(int $category_id, string $name, int $price, string $description, bool $available, string $image_path)
    {
        $this->category_id = $category_id;
        $this->name = $name;
        $this->price = $price;
        $this->description = $description;
        $this->available = $available;
        $this->image_path = $image_path;

    }

    public static function formRequest(Request $request){
        return new static (
            $request->category_id,
            $request->name,
            $request->price,
            $request->description,
            $request->available,
            $request->image_path

        );
    }
}
