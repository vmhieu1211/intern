<?php

namespace App\Services;

use App\Models\Photo;
use App\Models\Product;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PhotoService
{
    public function upload(Product $product, array $files): void
    {
        foreach ($files as $file) {
            /** @var UploadedFile $file */
            $name      = Str::random(14);
            $extension = $file->getClientOriginalExtension();
            $path      = $file->storeAs("products/{$product->id}", "{$name}.{$extension}", 'public');

            Photo::create([
                'images'     => $path,
                'product_id' => $product->id,
            ]);
        }
    }

    public function delete(Photo $photo): void
    {
        Storage::disk('public')->delete($photo->images);
        $photo->delete();
    }

    public function deleteAll(Product $product): void
    {
        foreach ($product->photos as $photo) {
            Storage::disk('public')->delete($photo->images);
        }

        $product->photos()->delete();
        Storage::disk('public')->deleteDirectory("products/{$product->id}");
    }
}
