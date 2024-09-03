<?php

namespace App\Http\Requests;

use App\Models\Product;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;

class ProductUpdateRequestForm extends FormRequest
{
    public function rules(): array
    {
        $rules = [
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:5000',
            'price' => 'required|numeric',
        ];
        return $rules;
    }

    public function save()
    {
        $data = $this->validated();
        $product = $this->route('product');

        if (!$product) {
            throw new \Exception('Product not found');
        }

        DB::beginTransaction();
        try {
            $product->update($data);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
        
        return $product;
    }
}
