<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Group;
use Mockery\Exception;

class GroupController extends Controller
{
    public function index()
    {
        try {
            $groups = Group::all();
            return parent::returnResponseData(0, $groups, 200, 'fetch list of groups');
        }
        catch (\Exception $e) {
            return parent::returnResponseData( 1,'', 500, 'server error: ' . $e->getMessage());
        }
    }

    public function show($id)
    {
        try {
            $group = Group::find($id);
            if ($group) {
                return parent::returnResponseData(0, $group, 200, 'fetch info of a group');
            } else {
                return parent::returnResponseData(1, '', 204, 'group not found');
            }
        } catch (\Exception $e) {
            return parent::returnResponseData(1, '', 500, 'server error: ' . $e->getMessage());
        }
    }

    public function store(Request $request)
    {
        try {
            $input = $request->all();
            $group = Group::create();
            $validator = Validator::make($input, Group::$rules);
            if ($validator->fails()) {

            } else {
                return parent::returnResponseData(0, $group, 200, 'group created successfully');
            }

        } catch (Exception $e) {
            return parent::returnResponseData(1, '', 500, 'server error: ' . $e->getMessage());
        }

    }

    public function update(Request $request, $id)
    {
        $group = Group::findOrFail($id);
        $group->update($request->all());

        return $group;
    }
}
