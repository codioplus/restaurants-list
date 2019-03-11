<div id="card-deck-restaurant">
<div class="card-deck" >

        @foreach($listings as $list)

            <div class="col-md-6 col-lg-4 restaurant" >
                <div class="card">

                    <div class="rateImgContainer">
                        <img src="{{asset('image/image.jpg')}}" alt="restaurant" class="img-fluid">
                        <div class="rate-block">
                           <div>{{number_format($list['sortingValues']['ratingAverage'], 1)  }}</div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="card-body">
                            <h3 class="card-title">{{ $list['name'] }}</h3>

                            <hr/>
                            <div class="sortingValues">

                                <div class="row minCost">
                                    <div class="col-5 sortingLabel">Min Cost</div>
                                    <div class="col-7 sortingValue">{{ number_format($list['sortingValues']['minCost']) }} Ft</div>
                                </div>
                                <div class="row deliveryCosts">
                                    <div class="col-5 sortingLabel">Delivery Costs</div>
                                    <div class="col-7 sortingValue">{{ ($list['sortingValues']['deliveryCosts'] != 0)? number_format($list['sortingValues']['deliveryCosts'])." Ft" : 'Free' }}</div>
                                </div>

                                <div class="row distance">
                                    <div class="col-5 sortingLabel">Distance</div>
                                    <div class="col-7 sortingValue">{{ number_format($list['sortingValues']['distance']) }} m</div>
                                </div>

                                <div class="row averageProductPrice hiddenSortingVal">
                                    <div class="col-5 sortingLabel">Avg Product Price</div>
                                    <div class="col-7 sortingValue">{{ number_format($list['sortingValues']['averageProductPrice']) }} Ft</div>
                                </div>

                                <div class="row bestMatch hiddenSortingVal">
                                    <div class="col-5 sortingLabel">Best Match</div>
                                    <div class="col-7 sortingValue">{{ $list['sortingValues']['bestMatch'] }}</div>
                                </div>

                                <div class="row newest​ hiddenSortingVal">
                                    <div class="col-5 sortingLabel">Newest</div>
                                    <div class="col-7 sortingValue">{{ $list['sortingValues']['newest'] }}</div>
                                </div>

                                <div class="row popularity​ hiddenSortingVal">
                                    <div class="col-5 sortingLabel">Popularity</div>
                                    <div class="col-7 sortingValue">{{ $list['sortingValues']['popularity'] }}</div>
                                </div>

                                <div class="row topRestaurants hiddenSortingVal">
                                    <div class="col-5 sortingLabel">Top Restaurants</div>
                                    <div class="col-7 sortingValue">{{ $list['sortingValues']['topRestaurants'] }}</div>
                                </div>
                            </div>
<div class="extraFeatures">
                            <div class="row">
                             <div class="col-6">
                                <div class="status">{{ ucwords($list['status']) }}</div>
                             </div>
                                <div class="col-6">
                                    <a href="javascript:void(0);" data-name="{{ $list['name'] }}" class="btn-favorite {{($list['favorite']==1)? 'btn-favorite--is-active':''}}" role="button"></a>

                                </div>

                            </div>
</div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

</div>

<div class="panel">
    <div class="panel-body">
        <nav aria-label="Page navigation example">
            {{ $listings->links("pagination::bootstrap-4") }}
        </nav>
    </div>
</div>
</div>

<script>
var myEle = document.getElementById("content");
if(myEle == null) {
 document.getElementById("card-deck-restaurant").style.visibility = "hidden";
    var str =window.location.href
    var link = str.split('/filter');
    window.location.href = link[0];
}
</script>