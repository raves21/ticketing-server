<?php

namespace App\Http\Requests\TicketStatusLog;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class Store extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'ticket_id' => ['required', 'integer', 'exists:tickets,id'],
            'changed_by_user_id' => ['nullable', 'integer', 'exists:users,id'],
            'old_status' => ['required', 'string', 'in:pending,in_progress,on_hold,awaiting_approval,rejected,cancelled,completed'],
            'new_status' => ['required', 'string', 'in:pending,in_progress,on_hold,awaiting_approval,rejected,cancelled,completed'],
            'reason' => ['nullable', 'string'],
            'changed_at' => ['required', 'date'],
        ];
    }
}
