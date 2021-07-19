@extends('user.layouts.master')

@section('title')
    {{ $title }}
@endsection

@section('content')
    <div class="row"></div>

    <div class="row mt-5">
        <div class="col-md-6 col-sm-12 ml-auto mr-auto">
            <div class="x_panel sg-shadow">
                <div class="x_title">
                    <h2>{{__('Purchase Complete - Thank You!')}}</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content" style="text-align: center;">
                    <h5>{{__('We are looking forward for another purchase.')}}</h5>
                    <p><a href="{{route('home')}}" class="btn btn-sm btn-primary">{{__('Home')}}</a></p>
                </div>
            </div>
        </div>
    </div>
@endsection
