<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{

    use HttpResponses;

    public function index() {
        $users = User::query()->with('profile')->get();
        return $users;
    }

    public function store(Request $request) {
       try {
        $data = $request->all();

        $request->validate([
            'name' => 'string|required',
            'email' => 'string|required|unique:users',
            'password'=> 'string|required|min:8|max:32',
            'profile_id'=> 'integer|required'
        ]);

        $user = User::create($data);

        return $user;
       } catch (\Exception $exception) {
        return $this->error($exception->getMessage(), Response::HTTP_BAD_REQUEST);
       }
    }

}
