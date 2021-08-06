@extends('user.layouts.master')

@section('title')
    {{ $title }}
@endsection

@section('content')

    <div class="row">
        <div class="col-md-8 mr-auto ml-auto mt-5">
            <div class="card card-blue">
                <div class="card-header">
                    <h3 class="card-title">{{__('All Site Rules')}}</h3>
                </div>
                <div class="card-body">
                    @if (count($rules) <= 0)
                        <p class="card-text">{{__('No Rules Available')}}</p>
                    @else
                        @foreach ($rules as $rule)
                        <div class="callout callout-danger">
                            <p>{{ $rule->rule }}</p>
                        </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
