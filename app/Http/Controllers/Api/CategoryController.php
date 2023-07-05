<?php

namespace App\Http\Controllers\Api;

use App\DTO\CategoryDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class CategoryController extends BaseController
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
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        $requestData = $request->all();
        $category = Category::create($requestData);

        if(request()->has('sub_categories')){
            foreach ($request->sub_categories as $key => $value) {
                SubCategory::create([
                    'name' => $value['name'],
                    'category_id' => $category->id]);
            }
        }


        return $this->sendResponse(new CategoryResource($category), 'Category created successfuly.');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
    public function update()
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find($id);

        if(is_null($category)){
            return $this->sendError('Category not found');
        }
        else{

            $delete = $category->delete();
            return $delete ? response()->json(['success' => 'Category deleted']) : $this->sendError('Category not found');
        }
    }
}
