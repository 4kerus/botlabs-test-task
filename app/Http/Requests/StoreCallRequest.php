<?php

namespace App\Http\Requests;

use App\Enums\CallResult;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * @deprecated Валидацию вынес в DTO, как только появится авторизация или глубокая валидация - вернуть обратно
 * @see \App\Data\CallData
 */
class StoreCallRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'duration' => ['required', 'integer', 'min:0'],
            'result' => ['required', Rule::enum(CallResult::class)],
            'manager_id' => ['required', 'integer', 'exists:managers,id'],
        ];
    }
}
