<?php

namespace App\Services;

use App\Models\UserAdditionally;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class TinifyService
{
    private string $path = 'public/photo';

    /**
     * @throws \Exception
     */
    public function __construct()
    {
       $this->setApiKey();
    }

    public function upload(UploadedFile $image, int $id): null|string
    {
        $fileName = $this->uniqueName($image->getClientOriginalExtension());
        $fileTmpPath = $image->getRealPath();
        $this->optimize($fileTmpPath, $fileName);

        if (Storage::exists($this->path . '/' . $fileName)) {
            $userAdditionally = UserAdditionally::query()->find($id);
            Storage::delete($this->path . '/' . $userAdditionally->photo);
            $userAdditionally->update(['photo' => $fileName]);
        }

        return $fileName;
    }

    /**
     * @throws \Exception
     */
    private function setApiKey(): void
    {
        try {
            \Tinify\setKey(config('tinify.key'));
            \Tinify\validate();
        } catch(\Tinify\Exception $e) {
            throw new \Exception('Validation of Tinypng API key failed');
        }
    }

    private function optimize($file, $filename): void
    {
        try {
            $source = \Tinify\fromFile($file);

            $resized = $source->resize(array(
                "method" => "cover",
                "width" => 70,
                "height" => 70
            ));

            $file = $resized->toBuffer();

            Storage::put($this->path . '/' . $filename, $file);
        } catch(\Tinify\AccountException $e) {
            throw new \Exception('The error message is:' . $e->getMessage());
            // Verify your API key and account limit.
        } catch(\Tinify\ClientException $e) {
            throw new \Exception('Check your source image and request options.');
            // Check your source image and request options.
        } catch(\Tinify\ServerException $e) {
            throw new \Exception('Temporary issue with the Tinify API.');
            // Temporary issue with the Tinify API.
        } catch(\Tinify\ConnectionException $e) {
            throw new \Exception('A network connection error occurred.');
            // A network connection error occurred.
        } catch(Exception $e) {
            throw new \Exception('Something else went wrong, unrelated to the Tinify API.');
            // Something else went wrong, unrelated to the Tinify API.
        }
    }

    private function uniqueName(string $ext): string
    {
        return Str::random() . '.' . $ext;
    }
}
