<?php

namespace App\Http\Requests;

use App\Models\Image;
use App\Models\Product;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class ProductStoreRequestForm extends FormRequest
{

    public function rules(): array
    {
        $rules = [
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:5000',
            'price' => 'required|numeric',
            'files.*.image' => 'required|file|mimes:jpeg,png,jpg,gif|max:1024'
		];
        return $rules;
    }

    public function save()
    {
        $request = Request::instance();
        $data = $this->validated();
        DB::beginTransaction();
        $product = Product::query()->create($data);
        if (!File::exists(public_path('storage/images/'))) {
            File::makeDirectory(public_path('storage/images/'), 0755, true);
        }
        if ($request->hasFile('image')) {
            $files = $request->file('image');
            foreach ($files as $file) {
                $imageName = Str::uuid() . '.' . $file->extension();
                $file->storeAs('images', $imageName, 'public');
                $image = new Image();
                $image->product_id = $product->id;
                $image->image = $imageName;
                $image->save();
            }
        }
        DB::commit();
        return $product;
    }
}
