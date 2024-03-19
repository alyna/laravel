<?php

namespace App\Console\Commands;

use App\Services\NewsImporter;
use Illuminate\Console\Command;
use Symfony\Component\Console\Command\Command as SymfonyCommand;

/**
 * The command used to import the news in the application
 */
class ImportNews extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:import-news';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Imports news from a json file';

    /**
     * The file that is imported
     */
    const FILE_NAME = "storage/app/news.json";

    /**
     * @param NewsImporter $importer
     */
    public function __construct(private readonly NewsImporter $importer)
    {
        parent::__construct();
    }

    /**
     * @return int
     */
    public function handle(): int
    {
        try {
            $this->importer->run(self::FILE_NAME);
            return SymfonyCommand::SUCCESS;
        } catch (\Exception $e) {
            $this->error($e->getMessage());
        }
        return SymfonyCommand::FAILURE;
    }
}
