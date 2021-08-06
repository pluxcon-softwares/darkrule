@extends('user.layouts.master')

@section('title')
    {{ $title }}
@endsection

@section('content')

    <div class="row"></div>

    <div class="row mt-5">
        <div class="col-md-6 col-sm-6">
            <div class="card card-primary sg-shadow">
              <div class="card-header">
                <div class="card-title">
                    <i class="fa fa-user"></i> {{__('Contact & Personal Info')}}
                </div>
              </div>
              <div class="card-body">
                  <!-- /.User Information -->
                <form data-parsley-validate="" class="form-horizontal form-label-left" novalidate="">

                    <div class="item form-group">
                        <label class="">{{__('Last Login IP')}} </label>
                        <input type="text" value="{{$user->login_ip}}" disabled  class="form-control">
                    </div>

                    <div class="item form-group">
                        <label class="">{{__('Registered Date')}}</label>
                        <input type="text" value="{{ $user->created_at }}" disabled  class="form-control">
                    </div>

                    <div class="item form-group">
                        <label class="">{{__('Username')}}</label>
                        <input type="text" value="{{ $user->username }}" disabled  class="form-control">
                    </div>

                    <div class="item form-group">
                        <label class="">{{__('Email')}}</label>
                        <input type="text" value="{{ $user->email }}" disabled  class="form-control">
                    </div>

                    <div class="item form-group">
                        <label class="">{{__('Balance')}}</label>
                        <input type="text" value="${{ $user->wallet ? $user->wallet : '0.00' }}" disabled  class="form-control">
                    </div>

                    <div class="item form-group">
                        <label class="">{{__('Last Logout')}}</label>
                        <input type="text" value="{{$user->last_logout}}" disabled  class="form-control">
                    </div>


                </form>
              </div>
            </div>
          </div>

          <div class="col-md-6 col-sm-6 ">
            <!-- /.Change Password -->
            <div class="card card-primary sg-shadow">
                <div class="card-header">
                  <div class="card-title">
                    <i class="fa fa-edit"></i> {{__('Change Password')}}
                  </div>

                  @include('partials.messages')

                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('change.password') }}" data-parsley-validate="" class="" novalidate="">
                        <!-- CSRF Form Field -->
                        @csrf

                        <div class="form-group">
                            <label class="" for="old_password">{{__('Current Password')}} <span class="required">*</span>
                            </label>
                            <input type="password" required="required" placeholder="{{__('Old Password')}}" name="old_password" class="form-control {{ $errors->has('old_password') ? 'parsley-error' : ''}}">
                                @if ($errors->has('old_password'))
                                <ul class="parsley-errors-list filled">
                                    <li class="parsley-required">{{ $errors->first('old_password') }}</li>
                                </ul>
                                @endif
                        </div>

                        <div class="form-group">
                            <label class="" for="new_password">{{__('New Password')}} <span class="required">*</span>
                            </label>
                            <input type="password" required="required" name="new_password" placeholder="{{__('New Password')}}" class="form-control {{ $errors->has('new_password') ? 'parsley-error' : ''}}">
                                @if ($errors->has('new_password'))
                                <ul class="parsley-errors-list filled">
                                    <li class="parsley-required">{{ $errors->first('new_password') }}</li>
                                </ul>
                                @endif
                        </div>

                        <div class="form-group">
                            <label class="" for="new_password_confirmation">{{__('Confirm Password')}} <span class="required">*</span>
                            </label>
                            <input type="password" required="required" name="new_password_confirmation" placeholder="{{__('Verfiy Password')}}" class="form-control">
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-success">{{__("Change Password")}}</button>
                        </div>

                    </form>
                </div>
              </div>
          </div>
    </div>

@endsection

@section('extra_script')
    <script>
        $(function(){

        });
    </script>
@endsection
