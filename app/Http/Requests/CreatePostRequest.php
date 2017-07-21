<?php


use Illuminate\Foundation\Http\FormRequest;

class CreatePostRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('create', new \App\Reply);
    }

    protected function failedAuthorization()
    {
        throw new ThrottleException(
            'You are replying too frequently. Please take a break.'
        );
    }

    public function rules()
    {
        return [
            'body' => 'required|spamfree'
        ];
    }

}