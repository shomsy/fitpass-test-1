<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class GymReceptionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Turn route parameters to request parameters
     */
    protected function prepareForValidation()
    {
        $this->merge(['gym' => $this->route('gym'), 'card' => $this->route('card')]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'card' => [
                function ($attribute, $value, $fail) {
                    if (empty($value->user)) {
                        $fail('User is not attached to this card.');
                    }
                },
            ],

            'gym' => [
                function ($attribute, $value, $fail) {
                    if ($this->checkForVisit($value)) {
                        $fail('The user has met the limit of visits to sports facilities.');
                    }
                },
            ],
        ];
    }

    /**
     * @param $sportFacility
     *
     * @return mixed
     */
    private function checkForVisit($sportFacility)
    {
        $cardId = $this->route('card')->id;

        return $sportFacility->sportObjectLog()
                             ->where('card_id', $cardId)
                             ->whereDate('created_at', Carbon::today())
                             ->first();
    }


    /**
     * @param  \Illuminate\Contracts\Validation\Validator  $validator
     */
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json(
                [
                    'message' => 'The given data was invalid.',
                    'errors' => $validator->errors(),
                    'status' => 422
                ],
                422
            )
        );
    }
}
