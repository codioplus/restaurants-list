<?php
namespace App\Repositories;

use App\Brand;
use App\Category;
use App\Color;
use App\Offer;
use App\Type;

class FacetedRepository
{
//Sorting array
    public function sorting()
    {
        return [


            "sortingValues.bestMatch" => "Best match",
            "sortingValues.newest​" => "Newest​",
            "sortingValues.distance​" => "Distance​",
            "sortingValues.ratingAverage" => "Rating​ ​average",
            "sortingValues.popularity​" => "Popularity​",
            "sortingValues.averageProductPrice" => "Average​ ​product​ ​price",
            "sortingValues.deliveryCosts" => "Delivery costs",
            "sortingValues.minCost​" => "Minimum costs​",
            "sortingValues.topRestaurants" => "Top restaurants"
        ];
    }

//Type of sort desc
    public function descSorting()
    {
        return [
            "sortingValues.ratingAverage",
            "sortingValues.topRestaurants"
        ];
    }
//Type of sort asc
    public function ascSorting()
    {
        return [

            "sortingValues.bestMatch",
            "sortingValues.newest​",
            "sortingValues.distance​",
            "sortingValues.popularity​",
            "sortingValues.averageProductPrice",
            "sortingValues.deliveryCosts",
            "sortingValues.minCost​"

        ];
    }
//Type of direction on sorting restaurant status
    public function direction()
    {
        return [
            'open' => 'Open',
            'closed' => 'Closed',
            'order-ahead' => 'Order Ahead'
        ];
    }
}