<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Links;
use App\Locations;
use phpDocumentor\Reflection\Location;

class SaveData extends Command
{
    private $apiUrl = 'http://api.krisinformation.se/v1/links';
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'api:data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch data from api and save to MySQL';

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
     * @return mixed
     */
    public function handle()
    {
        /**
         * Fetch data from api and convert json to array
         */
        $data = file_get_contents($this->apiUrl);
        $links = json_decode($data, true);
        $count = 0;

        // Iterate through all links and save location and links
        foreach ($links as $link) {
            if( empty( $link['Location']) || strlen($link['Location']) > 20 ) continue; // E.g remove empty and long files

            $insertLocation = [
                'name' => $link['Location']
            ];
            $location= Locations::firstOrCreate($insertLocation);

            // If location save is successful then save to link table
            if($location->save()) {
                $insertLink = [
                    'name' => $link['LinkName'],
                    'url' => $link['LinkUrl'],
                    'location_id' => $location->id,
                    'category' => $link['Category'],
                ];
                Links::create($insertLink);
                $count++;
            }
        }

        $this->info($count . ' links data have been saved in database' );
    }
}
