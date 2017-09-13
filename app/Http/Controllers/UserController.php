<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Validator;

class UserController extends Controller
{
    public function index()
    {
        try {
            $users = User::all();
            return parent::returnResponseData(0, ['users' => $users], 200, 'fetch list of users');
        }
        catch (\Exception $e) {
            return parent::returnResponseData( 1,'', 500, 'server error: ' . $e->getMessage());
        }
    }

    public function show($id)
    {
        try {
            $user = User::findOrFail($id);
            return parent::returnResponseData(0, ['user' => $user], 200, 'fetch info of a user');
        } catch (\Exception $e) {
            return parent::returnResponseData(1, '', 500, 'server error: ' . $e->getMessage());
        }
    }

    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), User::$rules);
            if ($validator->fails()) {
                return parent::returnResponseData(1, '', 500, 'validation error', $validator->errors());
            } else {
                $input = $request->all();
                $input['api_token']=str_random(60);
                $user = User::create($input);
                return parent::returnResponseData(0, ['user' => $user], 200, 'user created successfully');
            }
        } catch (\Exception $e) {
            return parent::returnResponseData(1, '', 500, 'server error: ' . $e->getMessage(), []);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $user = User::findOrFail($id);
            $validator = Validator::make($request->all(), User::$rules);
            if ($validator->fails()) {
                return parent::returnResponseData(1, '', 500, 'validation error', $validator->errors());
            } else {
                $user->update($request->all());
                return parent::returnResponseData(0, $user, 200, 'user updated successfully');
            }
        } catch (\Exception $e) {
            return parent::returnResponseData(1, '', 500, 'server error: ' . $e->getMessage(),[]);
        }
    }
}
