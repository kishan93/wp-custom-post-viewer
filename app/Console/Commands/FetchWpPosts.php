<?php

namespace App\Console\Commands;

use App\Models\Property;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class FetchWpPosts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'wp:fetch:posts';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch posts from wp api';
    private $featuredMedia;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): int
    {
        $baseUrl = config('services.wordpress.baseApiUrl');

        for ($i = 1; ; $i++) {

            $response = Http::get($baseUrl . "estate_property?page={$i}");
            $properties = $response->json();

            foreach ($properties as $property) {
                $property['featured_media'] = $this->getFeaturedMedia($property['featured_media']);
                Property::fromWpProperty($property);
            }

            $totalPages = (int)$response->header('X-WP-TotalPages');
            if ($i >= $totalPages) {
                break;
            }
        }

        return 0;
    }

    private function getFeaturedMedia($id)
    {
        $baseUrl = config('services.wordpress.baseApiUrl');

        if (!isset($this->featuredMedia[$id])) {
            $response = Http::get($baseUrl . "media/{$id}");
            $media = $response->json();
            $this->featuredMedia[$id] = $media['guid']['rendered'];
        }
        return $this->featuredMedia[$id];
    }
}
