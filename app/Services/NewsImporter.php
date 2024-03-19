<?php
namespace App\Services;

use App\Models\News;
use App\Traits\JsonFile;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class NewsImporter
{
    use JsonFile;
    public function __construct(
        private readonly NewsMapper $mapper,
        private readonly NewsValidator $validator
    ){
    }

    /**
     * @param string $filePath
     * @return void
     * @throws FileNotFoundException
     */
    public function run(string $filePath): void
    {
        if (!$this->fileExists($filePath)) {
            throw new FileNotFoundException('File not found');
        }
        $newsData = $this->getJsonAsArray($filePath);
        foreach ($newsData as $key => $newsItem) {
            try {
                $mappedData = $this->mapper->map($newsItem);
                $validData = $this->validator->validate($mappedData);
                $newsModel = new News();
                $newsModel->newModelQuery()
                    ->updateOrCreate(['link' => $validData['link']], $validData);
            } catch (ValidationException $e) {
                Log::channel('import_news_log')->error('Element:' . $key . ': ' . json_encode($e->errors()));
            } catch (\Exception $e) {
                Log::channel('import_news_log')->error('Element:' . $key . ': ' . $e->getMessage());
            }
        }
    }
}
