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
    public function success_response(array $message,array $data =[],$paging = null,$code = 200): JsonResponse
    {
        $response = [
            'status' => [
                'status'=>'success',
                'message' => $message,
                'code' => $code,

            ],
            'data' => $data,
        ];
        if ($paging != null){
            foreach ($paging as $key=>$value){
                $response['paging'][$key] = self::pagination_response($value);
            }
        }
        return response()->json($response);
    }
    public function fail_response(array $message, $code = 200): JsonResponse
    {
        return response()->json(
            [
                'status' => [
                    'status'=>'fail',
                    'message' => $message,
                    'code' => $code,
                ],
            ],
        );
    }
    public function error_response(array $message, $code = 500): JsonResponse
    {
        return response()->json(
            [
                'status' => [
                    'status'=>'error',
                    'message' => $message,
                    'code' => $code,
                ],
            ],
            200
        );
    }
    public function pagination_response($paging): array
    {
        return [
            'total'=>$paging->total(),
            'per_page' => $paging->perPage(),
            'current_page' => $paging->currentPage(),
            'last_page' => $paging->lastPage(),
            'from' => $paging->firstItem(),
            'to' => $paging->lastItem()
        ];
    }
}
