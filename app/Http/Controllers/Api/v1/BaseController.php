<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;

class BaseController extends Controller
{
    protected $model;
    protected $validate;

    public function __construct(Model $model, $validate = [])
    {
        $this->model = $model;
        $this->validate = $validate;
        $this->middleware('jwt');
    }

    protected function success($data, $message = '', $statusCode = Response::HTTP_OK)
    {
        return response()->json([
            'code' => $statusCode,
            'message' => $message,
            'data' => $data,
        ], $statusCode);
    }

    protected function error($data, $statusCode = Response::HTTP_UNPROCESSABLE_ENTITY)
    {
        return response()->json([
            'code' => $statusCode,
            'error' => $data,
        ], $statusCode);
    }

    public function index()
    {   
        return $this->success($this->model->all());
    }

    public function store(Request $request)
    {   
        try {
            $validator = Validator::make($request->all(), $this->validate);
            if ($validator->fails()) {
                return $this->error($validator->errors());
            }
            $model = $this->model->create($request->all());
            return $this->success($model, 'Create success',  Response::HTTP_CREATED);
        } catch (\Exception $e) {
            $errorMessage =  'Internal Server Error';
            return $this->error($errorMessage, 500);
        }
    }

    public function show($id)
    {
        return $this->success($this->model->findOrFail($id));
    }

    public function update(Request $request, $id)
    {
        $model = $this->model->findOrFail($id);
        $model->update($request->all());
        return $model;
    }

    public function destroy($id)
    {
        $model = $this->model->findOrFail($id);
        $model->delete();
        return $this->success("","Delete success", 204);
    }
}
