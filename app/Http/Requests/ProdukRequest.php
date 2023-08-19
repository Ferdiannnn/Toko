<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProdukRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'Judul' => 'required|max:255',
            'Deskripsi' => 'required|max:20',
            'Harga' => 'required',
            'Gambar' => 'required',
            'user_id' => 'required',
            'kategori_id' => 'required',
        ];
    }

    public function attributes()
    {
        return [
            'kategori_id' => 'kategori',
        ];
    }
}