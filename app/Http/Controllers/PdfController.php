<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Imagick;
use App\Models\Libro;

class PdfController extends Controller
{
    public function libroShowFirstPageAsImage($id)
    {
        $libro = Libro::with('publicaciones')->find($id);

        if (!$libro || !file_exists(storage_path('app/public/storage/' . $libro->publicaciones->archivo))) {
            return response()->json(['error' => 'PDF not found'], 404);
        }

        $pdfPath = storage_path('app/public/storage/' . $libro->publicaciones->archivo);

        $imagick = new Imagick();
        $imagick->setResolution(150, 150);
        $imagick->readImage($pdfPath . '[0]');
        $imagick->setImageFormat('jpg');

        $outputPath = storage_path('app/public/images/first_page_' . $libro->id . '.jpg');
        $imagick->writeImage($outputPath);

        return response()->json(['image' => asset('storage/images/first_page_' . $libro->id . '.jpg')]);
    }
}
