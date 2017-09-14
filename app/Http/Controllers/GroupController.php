<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Group;
use Validator;

class GroupController extends Controller
{
    /*
     * отображение групп
     */
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

    /*
     * отображение группы по id
     */
    public function show($id)
    {
        try {
            $group = Group::findOrFail($id);
            return parent::returnResponseData(0, ['group' => $group], 200, 'fetch info of a group');
        } catch (\Exception $e) {
            return parent::returnResponseData(1, '', 500, 'server error: ' . $e->getMessage());
        }
    }

    /*
     * вставка группы
     */
    public function store(Request $request)
    {
        try {
            //проверка на валидацию
            $validator = Validator::make($request->all(), Group::$rules);
            if ($validator->fails()) {
                return parent::returnResponseData(1, '', 500, 'validation error', $validator->errors());
            } else {
                //вставка группы
                $group = Group::create($request->all());
                return parent::returnResponseData(0, ['group' => $group], 200, 'group created successfully');
            }
        } catch (\Exception $e) {
            return parent::returnResponseData(1, '', 500, 'server error: ' . $e->getMessage(), []);
        }

    }

    /*
     * обновление группы по id
     */
    public function update(Request $request, $id)
    {
        try {
            $group = Group::findOrFail($id);
            //проверка на валидацию
            $validator = Validator::make($request->all(), Group::$rules);
            if ($validator->fails()) {
                return parent::returnResponseData(1, '', 500, 'validation error', $validator->errors());
            } else {
                //обновление группы
                $group->update($request->all());
                return parent::returnResponseData(0, $group, 200, 'group updated successfully');
            }
        } catch (\Exception $e) {
            return parent::returnResponseData(1, '', 500, 'server error: ' . $e->getMessage(),[]);
        }
    }
}
