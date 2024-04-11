<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Department;

class DepartmentController extends BaseController
{
    public function __construct(Department $department, $validate = [
        'name' => 'required|string|max:255',
        'manager_id' => 'required'
    ])
    {
        parent::__construct($department, $validate);
    }
}
