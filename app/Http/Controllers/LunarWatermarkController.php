<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class LunarWatermarkController extends Controller
{
    public function store(Request $request)
    {
        try {
            Log::info("Start processing image");

            // Загружаем файл
            $imageFile = $request->file('fileimage');
            $message = $request->input('message');

            Log::info("Image file uploaded: " . $imageFile->getClientOriginalName());

            // Создаем изображение из загруженного файла
            $image = imagecreatefromstring(file_get_contents($imageFile->getPathname()));

            if (!$image) {
                Log::error("Unable to process the image.");
                return response()->json(['error' => 'Unable to process the image.'], 500);
            }

            // Настроим параметры текста
            $fontFile = public_path('fonts/arial.ttf'); // Путь к шрифту
            $fontSize = 20;
            $fontColor = imagecolorallocate($image, 255, 255, 255);
            $x = 10;
            $y = 50;

            // Добавляем текст на изображение
            imagettftext($image, $fontSize, 0, $x, $y, $fontColor, $fontFile, $message);

            Log::info("Text added to image.");

            // Генерация пути для сохранения
            $outputPath = storage_path('app/public/lunar_watermarked_image.jpg');

            // Сохраняем изображение
            imagejpeg($image, $outputPath);

            // Освобождаем память
            imagedestroy($image);

            Log::info("Image saved.");

            return response()->download($outputPath)->deleteFileAfterSend();
        } catch (\Exception $e) {
            Log::error("Error processing the image: " . $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
