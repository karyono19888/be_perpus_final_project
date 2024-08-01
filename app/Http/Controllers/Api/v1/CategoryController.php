<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Categories;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Categories::latest()->get();

        //make response JSON
        return response()->json([
            'success' => true,
            'message' => 'Tampil data berhasil',
            'data'    => CategoryResource::collection($data) 
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        $post = Categories::create([
            'name'  => $request->name,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Tambah category berhasil',
            'data'    => new CategoryResource($post)  
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try{
            $data = Categories::with('book')->findOrfail($id);
    
            //make response JSON
            return response()->json([
                'success' => true,
                'message' => 'Detail Data Category',
                'data'    => new CategoryResource($data) 
            ], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Category Not Found',
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, string $id)
    {
        try{
            $data = Categories::findOrFail($id);

            $data->update([
                'name'  => $request->name,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Update Data berhasil',
                'data'    => new CategoryResource($data)  
            ], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Data Not Found',
            ], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try{
            $data = Categories::findOrfail($id);

            $data->delete();

            return response()->json([
                'success' => true,
                'message' => 'Berhasil Menghapus data dengan nama : '.$data->name.'',
            ], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Data Not Found',
            ], 404);
        }
    }
}