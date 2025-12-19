<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateNotificationsRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'email_operations' => ['boolean'],
            'email_declarations' => ['boolean'],
            'email_pendencies' => ['boolean'],
            'email_newsletter' => ['boolean'],
            'push_operations' => ['boolean'],
            'push_declarations' => ['boolean'],
            'push_pendencies' => ['boolean'],
        ];
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        // Converte checkboxes vazios para false
        $this->merge([
            'email_operations' => $this->boolean('email_operations'),
            'email_declarations' => $this->boolean('email_declarations'),
            'email_pendencies' => $this->boolean('email_pendencies'),
            'email_newsletter' => $this->boolean('email_newsletter'),
            'push_operations' => $this->boolean('push_operations'),
            'push_declarations' => $this->boolean('push_declarations'),
            'push_pendencies' => $this->boolean('push_pendencies'),
        ]);
    }
}
