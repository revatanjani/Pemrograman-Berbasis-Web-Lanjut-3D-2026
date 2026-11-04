<?php

namespace App\Http\Requests;

class UpdateBukuRequest extends StoreBukuRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $rules = parent::rules();


        foreach ($rules as $field => $rule) {
            if (is_string($rule)) {
                $rules[$field] = 'sometimes|' . $rule;
            } elseif (is_array($rule)) {
                array_unshift($rule, 'sometimes');
                $rules[$field] = $rule;
            }
        }

        return $rules;
    }
}