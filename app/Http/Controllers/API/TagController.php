<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Models\Tag;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tags = Tag::latest()->paginate(5);

        $response = ["message" => 'Tag Listed Successfully'];
        return response($tags, 200);
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
            'name' => 'required|string|max:20',
            // 'description' => 'required|string|min:10',
        ]);
        if ($validator->fails())
        {
            return response(['errors'=>$validator->errors()->all()], 422);
        }
        $store = Tag::create([
            'name' => $request->name,
            'slug' => Str::limit(Str::slug($request->name), '20', '') . '-' . random_int(0, 999999999),
            // 'description' => $request->description,
        ]);

        $response = ["message" =>'Tag Created Successfully'];
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
        $tag = Tag::findOrFail($id);

        $response = ["message" =>'Tag Listed Successfully'];
        return response($tag, 200);
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
            // 'description' => 'required|string|min:10',
        ]);
        if ($validator->fails())
        {
            return response(['errors'=>$validator->errors()->all()], 422);
        }
        $update = Tag::find($id)->update([
            'name' => $request->name,
            // 'description' => $request->description,
        ]);

        $response = ["message" =>'Tag Updated Successfully'];
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
        $tag = Tag::findorFail($id);
        $tag->delete();

        $response = ["message" =>'Tag Deleted Successfully'];
        return response($response, 200);
    }
}
