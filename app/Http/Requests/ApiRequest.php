<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;

class ApiRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        return [];
    }
    public function attributes(): array
    {
        return [];
    }
    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException($this->fail_response($validator->errors()->all(),422));
    }
    protected function success_response(array $message,$data =[],$data_name = 'data',$paging = null,$code = 200): JsonResponse
    {
        return response()->json(
            [
                'status' => [
                    'status'=>'success',
                    'message' => $message,
                    'code' => $code,

                ],
                ''.$data_name => $data,
                'paging'=>$paging?[
                    'total'=>$paging->total(),
                    'per_page' => $paging->perPage(),
                    'current_page' => $paging->currentPage(),
                    'last_page' => $paging->lastPage(),
                    'from' => $paging->firstItem(),
                    'to' => $paging->lastItem()
                ]:null
            ],
            200
        );
    }
    protected function fail_response(array $message, $code = 200): JsonResponse
    {
        return response()->json(
            [
                'status' => [
                    'status'=>'fail',
                    'message' => $message,
                    'code' => $code,
                ],
                'data' => [],
                'paging'=>null

            ],
            200
        );
    }
    protected function errorJsonResponse(array $message, $code = 500): JsonResponse
    {

        return response()->json(
            [
                'status' => [
                    'status'=>'error',
                    'message' => $message,
                    'code' => $code,
                ],
                'data' => [],
                'paging'=>null

            ],
            200
        );
    }
}
