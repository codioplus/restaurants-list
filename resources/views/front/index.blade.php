@extends('layouts.front')
@section('content')
    {{--<div class="row">--}}
        <div class="section filterWrapper" id="filterWrapper" data-url="{{url('/')}}" data-token="{{ csrf_token() }}">
            <div class="row">

                <!-- Search Result -->
                <div class="col">

                    <div class="form-group row">

                        <div class="offset-md-8  col-md-4">
                            {{ Form::text('search',null,['id'=>'search','placeholder'=>'Search by name']) }}
                        </div>

                    </div>

                    <div class="card">

                        <div class="card-header">
                            <div class="row">
                            <div class=" col-xl-7 col-lg-6 col-sm-6 col-9">
                            <h3>Restaurants List</h3>
                            </div>

                            {{--Display--}}
                            {{ Form::label('qty','Display:',['class'=>'col-form-label d-none d-sm-block offset-md-2 col-md-2 offset-0 col-3 text-right']) }}

                            <div class="col-xl-1 col-lg-2 col-md-2 col-3">
                                {{ Form::select('qty',[3=>3,6=>6,9=>9],6,['class'=>'form-control custom-select','id'=>'qty']) }}
                            </div>
                            </div>

                        </div>
                        <div class="card-body">
                            <div >

                                <div class="form-group row">
                                    {{--Sorting--}}

                                    {{ Form::label('sorting','Sort by:',['class'=>'col-form-label label-sort']) }}
                                    <div class="col-md-4">
                                        {{ Form::select('sorting',$repository->sorting(),null,['class'=>'form-control custom-select','id'=>'sorting','placeholder'=>'Select for sorting']) }}
                                    </div>



                                    {{ Form::label('status','Status:',['class'=>'col-form-label label-sort']) }}
                                    <div class="col-md-3">
                                        {{ Form::select('status',$repository->direction(),null,['class'=>'form-control custom-select','id'=>'status']) }}
                                    </div>

                                </div>

                            </div>
                        </div>
                        <div class="panel-body" id="result">
                            <!-- Search result will appeared here -->
                        </div>
                        <!-- Pagination -->
                        <div class="text-center">
                            <nav aria-label="Page navigation">
                                <ul class="pagination justify-content-center" id="pagination">

                                </ul>
                            </nav>
                        </div>
                        <!-- /Pagination -->
                    </div>
                </div>
                <!-- /Search Result -->
            </div>
        </div>
    {{--</div>--}}
@stop

