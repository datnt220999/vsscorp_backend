<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Group;

class GroupController extends BaseController
{
    public function __construct(Group $group, $validate = [
        'name' => 'required|string|max:255',
        'manager_id' => 'required'
    ])
    {
        parent::__construct($group, $validate);
    }
}
