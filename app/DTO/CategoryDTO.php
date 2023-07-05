<?php
namespace App\DTO;

use Illuminate\Http\Request;

class CategoryDTO
{
    public string $name;

    public function __construct(string $name)
    {
        $this->name = $name;

    }

    public static function formRequest(Request $request){
        return new static (
            $request->name
        );
    }
}
