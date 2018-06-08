<?php 

namespace Sendler\Http\Requests;
 
use Illuminate\Foundation\Http\FormRequest as LaravelFormRequest;
use Illuminate\Http\JsonResponse;
 
abstract class FormRequest extends LaravelFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    abstract public function rules();
 
    // /**
    //  * Get the failed validation response for the request.
    //  *
    //  * @param array $errors
    //  * @return JsonResponse
    //  */
    // private function response(array $errors)
    // {
    //     $transformed = [];
 
    //     foreach ($errors as $field => $message) {
    //         $transformed[] = [
    //             'field' => $field,
    //             'message' => $message[0]
    //         ];
    //     }
 
    //     return response()->json([
    //         'errors' => $transformed
    //     ], 500);
    // }

    // /**
    //  * Validate the class instance.
    //  *
    //  * @return void
    //  */
    // public function validate()
    // {
    //     $this->prepareForValidation();

    //     $instance = $this->getValidatorInstance();

    //     if (! $this->passesAuthorization()) {
    //         $this->failedAuthorization();
    //     } elseif (! $instance->passes()) {
    //         $this->response($instance->errors()->messages());
    //         // $this->failedValidation($instance);
    //     }
    // }
}