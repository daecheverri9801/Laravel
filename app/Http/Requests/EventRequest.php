<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EventRequest extends FormRequest
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
            'event_name' => ['string', 'required', 'max:256'],
            'event_date' => ['date', 'required'],
            'event_max_capacity' => ['integer'],
            'event_speaker_name' => ['string', 'max:256'],
            'event_location_name' => ['string', 'max:256'],
            'event_meetup_url' => ['string'],
            'event_is_virtual' => ['boolean']
        ];
    }
}
