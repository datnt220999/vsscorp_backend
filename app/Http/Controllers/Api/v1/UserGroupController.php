<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserGroup;

class UserGroupController extends BaseController
{
    public function __construct(UserGroup $userGroup, $validate = [
        'user_id' => 'required',
        'group_id' => 'required'
    ])
    {
        parent::__construct($userGroup, $validate);
    }
}
