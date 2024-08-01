<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileRequest;
use App\Http\Resources\ProfileResource;
use App\Http\Resources\UserResource;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $data = User::with('profile')
                    ->with('role')
                    ->find($user->id);

        return response()->json([
            'success' => true,
            'message' => 'Profile berhasil ditampilkan',
            'user'    => new UserResource($data),
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(ProfileRequest $request)
    {
        $user = Auth::user();
                
        $updatedProfile = Profile::updateOrCreate(
            ['user_id' => $user->id],
            [
                'age'   => $request->age,
                'bio'   => $request->bio,
            ]
        );

        $updatedProfile->load('user');

        return response()->json([
            'success' => true,
            'message' => 'Update profil berhasil',
            'data'    => new ProfileResource($updatedProfile),
        ], 200);
    }

}