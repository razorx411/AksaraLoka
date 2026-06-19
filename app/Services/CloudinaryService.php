<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class CloudinaryService
{
    /**
     * Upload an image to Cloudinary using Signed API.
     *
     * @param \Illuminate\Http\UploadedFile $file
     * @return string|null The secure URL of the uploaded image, or null on failure.
     */
    public static function upload($file): ?string
    {
        $cloudName = env('CLOUDINARY_CLOUD_NAME');
        $apiKey    = env('CLOUDINARY_API_KEY');
        $apiSecret = env('CLOUDINARY_API_SECRET');

        if (!$cloudName || !$apiKey || !$apiSecret) {
            Log::error('Cloudinary credentials are not configured in .env');
            return null;
        }

        $timestamp = time();
        
        // Define params for signing
        $params = [
            'folder'    => 'avatars',
            'timestamp' => $timestamp,
        ];

        // Sort params alphabetically (required for signature)
        ksort($params);

        // Create the string to sign
        $sigString = '';
        foreach ($params as $key => $value) {
            $sigString .= "{$key}={$value}&";
        }
        $sigString = rtrim($sigString, '&') . $apiSecret;
        $signature = sha1($sigString);

        try {
            $response = Http::asMultipart()->post("https://api.cloudinary.com/v1_1/{$cloudName}/image/upload", [
                'file'      => fopen($file->getRealPath(), 'r'),
                'api_key'   => $apiKey,
                'timestamp' => $timestamp,
                'signature' => $signature,
                'folder'    => 'avatars',
            ]);

            if ($response->successful()) {
                return $response->json('secure_url');
            }

            Log::error('Cloudinary Upload Failed: ' . $response->body());
            return null;
        } catch (\Exception $e) {
            Log::error('Cloudinary Upload Exception: ' . $e->getMessage());
            return null;
        }
    }

    /**
     * Delete an image from Cloudinary if it exists.
     *
     * @param string|null $url The full secure URL of the image.
     * @return bool
     */
    public static function delete(?string $url): bool
    {
        if (!$url || !filter_var($url, FILTER_VALIDATE_URL)) {
            return false;
        }

        $cloudName = env('CLOUDINARY_CLOUD_NAME');
        $apiKey    = env('CLOUDINARY_API_KEY');
        $apiSecret = env('CLOUDINARY_API_SECRET');

        if (!$cloudName || !$apiKey || !$apiSecret) {
            return false;
        }

        // Extract public_id from the Cloudinary URL
        // Example URL: https://res.cloudinary.com/cloudname/image/upload/v12345678/avatars/filename.jpg
        // We need: "avatars/filename"
        $path = parse_url($url, PHP_URL_PATH);
        if (!$path) {
            return false;
        }

        // Find where "upload/" or similar starts
        $parts = explode('/upload/', $path);
        if (count($parts) < 2) {
            return false;
        }

        // Skip version string (starts with 'v' followed by digits)
        $subParts = explode('/', $parts[1]);
        if (isset($subParts[0]) && preg_match('/^v\d+$/', $subParts[0])) {
            array_shift($subParts);
        }

        $publicIdWithExt = implode('/', $subParts);
        $publicId = pathinfo($publicIdWithExt, PATHINFO_FILENAME);
        
        $folderPath = pathinfo($publicIdWithExt, PATHINFO_DIRNAME);
        if ($folderPath && $folderPath !== '.') {
            $publicId = $folderPath . '/' . $publicId;
        }

        $timestamp = time();
        $params = [
            'public_id' => $publicId,
            'timestamp' => $timestamp,
        ];

        ksort($params);

        $sigString = '';
        foreach ($params as $key => $value) {
            $sigString .= "{$key}={$value}&";
        }
        $sigString = rtrim($sigString, '&') . $apiSecret;
        $signature = sha1($sigString);

        try {
            $response = Http::asMultipart()->post("https://api.cloudinary.com/v1_1/{$cloudName}/image/destroy", [
                'public_id' => $publicId,
                'api_key'   => $apiKey,
                'timestamp' => $timestamp,
                'signature' => $signature,
            ]);

            return $response->successful() && $response->json('result') === 'ok';
        } catch (\Exception $e) {
            Log::error('Cloudinary Delete Exception: ' . $e->getMessage());
            return false;
        }
    }
}

