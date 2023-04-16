<?php

namespace App\Http\Requests;

use App\Spotify\Facades\SpotifyFacade as Spotify;
use Exception;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Response;
use Illuminate\Contracts\Validation\Validator;

class SpotifyRequest extends FormRequest
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'q' => ['required', 'string'],
        ];
    }


    public function searchAlbums()
    {
        $data = $this->validated();

        $artist = Spotify::getArtistId([
            'q' => $data['q'],
            'type' => 'artist',
            'limit' => 1,
            'offset' => 0
        ]);

        return Spotify::getArtistAlbums($artist->getId());
    }


    /**
     * Handle a failed validation attempt.
     *
     * @param  \Illuminate\Contracts\Validation\Validator  $validator
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'errors' => $validator->errors(),
            'status' => true
        ], 422));
    }
}
