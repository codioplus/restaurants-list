<?php

namespace App\Http\Controllers;

use App\Repositories\FacetedRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Collection;


class FrontController extends Controller
{

    private $repository;
    private $json;
    private $restaurants;
    private $user;
    public function __construct(FacetedRepository $repository)

    {
        $this->repository = $repository;
//        getting local jsons
        $json = Storage::disk('local')->get('sample.json');
        $json = json_decode($json, true);
        $user =  Storage::disk('local')->get('user.json');
        $user = json_decode($user, true);
        // creating collections
        $user = collect($user);
        $restaurants = collect($json['restaurants']);

        $this->restaurants = $restaurants;
        $this->user = $user;

        // merging data from 2 jsons
        $mergedData = $restaurants->map(function ($item,$key) {
        $item['sortingValues']['topRestaurants']=($item['sortingValues']['distance']*$item['sortingValues']['popularity'])+$item['sortingValues']['ratingAverage'];
        $single = $this->user->where('name',$item['name'])->last();
            return collect($item)->put('favorite', ($single['favorite'])?$single['favorite']:0);
        });

        $this->json = $mergedData;

    }

    public function index()
    {
        $products = $this->json->paginate(6);
        $repository = $this->repository;
        return view('front.index',compact('repository','products'));
    }

    function favorite(Request $request) {
        try {
           //updating the products object and user json
            $filtered = $this->user->whereNotIn( 'name',[$request->name]);

            $data = $filtered->push(['name'=>$request->name,'favorite'=>$request->action]);

             Storage::disk('local')->put('user.json', $data->toJson());

        } catch(Exception $e) {

            return ['error' => true, 'message' => $e->getMessage()];

        }
    }

    public function faceted(Request $request)
    {
          $search = $request->get('search');
          $status = $request->get('status');
          $sorting = $request->get('sorting');

        $products = $this->json;

        if($request->has('search') && $request->get('search') != null){

            $products =  $products
                ->filter(function ($item) use ($search) {
                    return false !== stristr($item['name'], $search);
                });

        }

        if($request->has('sorting') && $request->get('sorting') != ''){


            if(in_array($sorting, $this->repository->descSorting())){
               $sortType = 'desc';
            }else{
                $sortType = 'asc';
            }
            $favoriteArray = $this->sortingPriorities($products,$status,1,$sorting,$sortType);
            $nonFavoriteArray = $this->sortingPriorities($products,$status,0,$sorting,$sortType);

        }else{

            $favoriteArray = $this->sortingPriorities($products,$status,1);
            $nonFavoriteArray = $this->sortingPriorities($products,$status,0);

        }

        $products = collect(array_merge($favoriteArray, $nonFavoriteArray));

        if($request->has('qty')){
            $qty = $request->get('qty');
            $listings = $products->paginate($qty);
        }else{
            $listings = $products->paginate(6);
        }

        return view('front.products',compact('listings'))->render();

    }


    public function sortingPriorities($products,$status,$favorite,$sortBy=null,$sortType='asc')
    {

        //status sorting orders
        switch ($status) {

            case 'open':
                $order = array('open', 'order ahead', 'closed');
                break;

            case 'order-ahead':
                $order = array('order ahead', 'open', 'closed');
                break;

            case 'closed':
                $order = array('closed', 'order ahead', 'open');
                break;

            default:
                $order = array('open', 'order ahead', 'closed');
        }

        //way of sorting data

        //getting favorite & non favorite and sort them by sorting type
        if ($sortBy){
            if ($sortType == "desc") {
                $favoriteArray = $products->where('favorite', $favorite)->sortByDesc($sortBy)->all();
            } else {
                $favoriteArray = $products->where('favorite', $favorite)->sortBy($sortBy)->all();
            }
        }else{
            $favoriteArray = $products->where('favorite', $favorite)->sortByDesc($sortBy)->all();
        }

        //sort by status
        usort($favoriteArray, function ($a, $b) use ($order) {
            $pos_a = array_search($a['status'], $order);
            $pos_b = array_search($b['status'], $order);
            return $pos_a - $pos_b;
        });
      return $favoriteArray;
   }
}
