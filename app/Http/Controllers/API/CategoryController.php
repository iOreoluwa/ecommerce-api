<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Models\Category;


class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $categories =  Category::latest()->paginate(5);

        $response = ["message" =>'Categories Listed Successfully'];
        return response($categories, 200);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'required|string|min:10',
            'image_url' => 'required|string',
        ]);
        if ($validator->fails())
        {
            return response(['errors'=>$validator->errors()->all()], 422);
        }
        $store = Category::create([
            'name' => $request->name,
            'slug' => Str::limit(Str::slug($request->name), '20', '') . '-' . random_int(0, 999999999),
            'description' => $request->description,
            'image_url' => $request->image_url,
        ]);

        $response = ["message" =>'Category Created Successfully'];
        return response($response, 200);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = Category::findOrFail($id);

        $response = ["message" =>'Category Listed Successfully'];
        return response($category, 200);


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
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'required|string|min:10',
            'image_url' => 'required|string',
        ]);
        if ($validator->fails())
        {
            return response(['errors'=>$validator->errors()->all()], 422);
        }
        $update = Category::find($id)->update([
            'name' => $request->name,
            'description' => $request->description,
            'image_url' => $request->image_url,
        ]);

        $response = ["message" =>'Category Updated Successfully'];
        return response($response, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::findorFail($id);
        $category->delete();

        $response = ["message" =>'Category Deleted Successfully'];
        return response($response, 200);
    }
}
