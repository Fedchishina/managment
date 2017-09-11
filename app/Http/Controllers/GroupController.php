<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Group;
use Validator;

class GroupController extends Controller
{
    public function index()
    {
        try {
            $groups = Group::all();
            return parent::returnResponseData(0, ['groups' => $groups], 200, 'fetch list of groups');
        }
        catch (\Exception $e) {
            return parent::returnResponseData( 1,'', 500, 'server error: ' . $e->getMessage());
        }
    }

    public function show($id)
    {
        try {
            $group = Group::findOrFail($id);
            return parent::returnResponseData(0, ['group' => $group], 200, 'fetch info of a group');
        } catch (\Exception $e) {
            return parent::returnResponseData(1, '', 500, 'server error: ' . $e->getMessage());
        }
    }

    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), Group::$rules);
            if ($validator->fails()) {
                return parent::returnResponseData(1, '', 500, 'validation error', $validator->errors());
            } else {
                $group = Group::create($request->all());
                return parent::returnResponseData(0, ['group' => $group], 200, 'group created successfully');
            }
        } catch (\Exception $e) {
            return parent::returnResponseData(1, '', 500, 'server error: ' . $e->getMessage(), []);
        }

    }

    public function update(Request $request, $id)
    {
        try {
            $group = Group::findOrFail($id);
            $validator = Validator::make($request->all(), Group::$rules);
            if ($validator->fails()) {
                return parent::returnResponseData(1, '', 500, 'validation error', $validator->errors());
            } else {
                $group->update($request->all());
                return parent::returnResponseData(0, $group, 200, 'group updated successfully');
            }
        } catch (\Exception $e) {
            return parent::returnResponseData(1, '', 500, 'server error: ' . $e->getMessage(),[]);
        }
    }
}
