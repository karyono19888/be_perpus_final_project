<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\BorrowRequest;
use App\Http\Resources\BorrowResource;
use App\Models\Borrows;
use Illuminate\Http\Request;

class BorrowController extends Controller
{
    public function index()
    {   
        $data = Borrows::with(['user','book'])->latest()->get();

        //make response JSON
        return response()->json([
            'success' => true,
            'message' => 'Tampil data berhasil',
            'data'    => BorrowResource::collection($data) 
        ], 200);
    }

    public function store(BorrowRequest $request)
    { 
        $post = Borrows::updateOrCreate(
            ['book_id' => $request->book_id],
            [
                'load_date'     => $request->load_date,
                'borrow_date'   => $request->borrow_date,
                'book_id'       => $request->book_id,
                'user_id'       => $request->user_id,
            ]
        );
        $post->load(['user','book']);
 
        return response()->json([
            'success' => true,
            'message' => 'Tambah data berhasil',
            'data'    => new BorrowResource($post)  
        ], 201);
    }
}