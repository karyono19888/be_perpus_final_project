<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\BooksRequest;
use App\Http\Resources\BookResource;
use App\Models\Books;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BooksController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Books::with(['category'])->latest()->get();

        //make response JSON
        return response()->json([
            'success' => true,
            'message' => 'Tampil data berhasil',
            'data'    => BookResource::collection($data) 
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BooksRequest $request)
    {
        $data = $request->validated();
 
        if ($request->hasFile('image')) {
  
            $imageName = time().'.'.$request->image->extension();

            $request->image->storeAs('public/images', $imageName);

            $data['image'] = env('APP_URL').'/storage/images/'.$imageName;
 
        }
 
        $post = Books::create($data);
        $post->load('category');
 
        return response()->json([
            'success' => true,
            'message' => 'Tambah data berhasil',
            'data'    => new BookResource($post)  
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try{
            //find post by ID
            $data = Books::with('category')->findOrfail($id);
            $data->load('borrow');
    
            //make response JSON
            return response()->json([
                'success' => true,
                'message' => 'Detail data berhasil',
                'data'    => new BookResource($data) 
            ], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Data Not Found',
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BooksRequest $request, string $id)
    {
        try{
            $find = Books::findOrFail($id);
            $data = $request->validated();

            if ($request->hasFile('image')) {
    
                if ($find->image) {
                    $getImage = basename($find->image);
                    Storage::delete('public/images/' . $getImage);
                }
    
                $imageName = time().'.'.$request->image->extension();
    
                $request->image->storeAs('public/images', $imageName);
    
                $data['image'] = env('APP_URL').'/storage/images/'.$imageName;
    
            }

            $find->update($data);

            return response()->json([
                'success' => true,
                'message' => 'Update data berhasil',
                'data'    => new BookResource($find)  
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
            $data = Books::findOrfail($id);

            if ($data->image) {
                $getImage = basename($data->image);
                Storage::delete('public/images/' . $getImage);
            }

            $data->delete();

            return response()->json([
                'success' => true,
                'message' => 'Berhasil Menghapus data dengan nama : '.$data->title.'',
            ], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Data Not Found',
            ], 404);
        }
    }
}