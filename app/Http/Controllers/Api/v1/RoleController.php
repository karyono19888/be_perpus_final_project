<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\RoleRequest;
use App\Http\Resources\RoleResource;
use App\Models\Role;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Role::latest()->get();

        //make response JSON
        return response()->json([
            'success' => true,
            'message' => 'Tampil data berhasil',
            'data'    => RoleResource::collection($data) 
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RoleRequest $request)
    {
        $post = Role::create([
            'name'  => $request->name,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Tambah Role berhasil',
            'data'    => new RoleResource($post)  
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try{
            $data = Role::findOrfail($id);
    
            //make response JSON
            return response()->json([
                'success' => true,
                'message' => 'Detail Data Roles',
                'data'    => new RoleResource($data) 
            ], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Roles Not Found',
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RoleRequest $request, string $id)
    {
        try{
            $data = Role::findOrFail($id);

            $data->update([
                'name'  => $request->name,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Update Roles berhasil',
                'data'    => new RoleResource($data)  
            ], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Roles Not Found',
            ], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try{
            $data = Role::findOrfail($id);

            $data->delete();

            return response()->json([
                'success' => true,
                'message' => 'Berhasil Menghapus Role dengan nama : '.$data->name.'',
            ], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Role Not Found',
            ], 404);
        }
    }
}