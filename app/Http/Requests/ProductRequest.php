<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Resources\MergeValue;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
class ProductRequest extends FormRequest
{


    protected function prepareForValidation(): void
    {
        $this->merge([
            'slug' => Str::slug($this->slug ?? $this->name),
        ]);
    }



    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        // name	slug	description	price	stock	image	
        return [
            'name' => ['required', 'string', 'between:3,255'],
            'slug' => [
                'required',
                'string',
                'between:3,255',
                Rule::unique('products', 'slug')->ignore($this->product?->id),
            ],
            'description' => ['required', 'string', 'min:10'],
            'price' => ['required', 'numeric',],
            'stock' => ['required', 'integer', 'min:0'],
            'image' => [
               
                $this->product && !$this->hasFile('image') ? 'nullable' : 'required',
                'image',
                'mimes:jpeg,png,jpg,webp',
                'max:2048'
            ],
            'category_id' => ['required', 'integer', 'exists:categories,id']

        ];
    }
}
