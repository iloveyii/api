<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;


class LinksController extends Controller
{
    /**
     * Reads all the links from the database
     *
     * @return \Illuminate\Support\Collection
     */
    public function links() {
        $links = DB::table('locations')
            ->join('links', 'locations.id', '=', 'links.location_id')
            ->select(['links.id', 'links.name', 'links.url', 'locations.name AS loc_name', 'locations.id AS loc_id'])
            ->orderBy('locations.id')
            ->get();

        return $links;
    }
}
