$(window).on("load",faceted())


var xhr = new XMLHttpRequest();
function faceted(page){
    var imgUrl = $("#filterWrapper").attr('data-url');
    var csrf = $("#filterWrapper").attr('data-token');
    var search = $("#search").val();
    var status = $("#status").val();
    var sorting = $("#sorting").val();
    var qty = $("#qty").val();

    xhr = $.ajax({
        url: 'filter',
        data: {_token:csrf,search:search,page:page,qty:qty,status:status,sorting:sorting},
        type: 'get',
        beforeSend:function(){
            $("#result").html('<img src="'+imgUrl+'/image/spinner.gif" alt="" class="spinner"/>')
        }
    }).done(function(e){
        $data = $(e);
        $("#result").html($data);

        if(sorting){

            $opt = sorting.split(".");

            if($('.'+$opt[1]).hasClass('hiddenSortingVal')) {
                $('.'+$opt[1]).css('display','flex');
            }
        }




    });
}



$("#search").keyup(function(){
    faceted();
})

$(document).on('click', '.btn-favorite', function(e) {
    e.preventDefault();
    var $this = $(this);
    var csrf = $("#filterWrapper").attr('data-token');
    var name =  $this.attr('data-name');
    var action = 1;
    if($this.hasClass( "btn-favorite--is-active" )){
        action = 0
    }

    xhr = $.ajax({
        url: 'favorite',
        data: {_token:csrf,name:name,action:action},
        type: 'post',
        beforeSend:function(){

        }
    }).done(function(e){
        $data = $(e);
        if(action == 0){
            $this.removeClass('btn-favorite--is-active');
        }else{
            $this.addClass('btn-favorite--is-active');
        }
    });

});

$("#sorting,#status,#qty").on('change',function(){
    faceted();
});


$(document).on('click','.pagination a',function(e){
    e.preventDefault();
    var url = $(this).attr('href');
    var page = url.split('page=')[1];
    window.history.pushState("", "", url);
    faceted(page);
})

