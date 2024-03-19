<?php
namespace App\Services;

use App\Models\News;
use App\Traits\JsonFile;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

/**
 * The service used to import the list of news
 */
class NewsImporter
{
    use JsonFile;

    /**
     * @param NewsMapper $mapper
     * @param NewsValidator $validator
     */
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
                // Maps the columns from the JSON to the ones from the database
                $mappedData = $this->mapper->map($newsItem);

                // Validates the data
                $validData = $this->validator->validate($mappedData);

                // Inserts the news to the database, or updates it
                // if there is an entry with the same link
                $newsModel = new News();
                $newsModel->newModelQuery()
                    ->updateOrCreate(['link' => $validData['link']], $validData);
            } catch (ValidationException $e) {
                Log::channel('import_news_log')
                    ->error('Element:' . $key . ': ' . json_encode($e->errors()));
            } catch (\Exception $e) {
                Log::channel('import_news_log')
                    ->error('Element:' . $key . ': ' . $e->getMessage());
            }
        }
    }
}
