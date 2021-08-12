@extends('user.layouts.master')

@section('title')

@endsection

@section('content')

<div class="row"></div>

<div class="row mt-3">

    <div class="col-12 mb-3">
        @if(session('lowfunds'))
            <div class="alert alert-danger alert-dismissible sg-flash-message" role="alert">
               <i class="fas fa-times"></i> {{ session('lowfunds') }}
            </div>
        @endif
    </div>

    <div class="col-md-6">
        <div class="card card-success">
            <div class="card-header">
              <h3 class="card-title"><i class="fa fa-comment"></i> {{__('Message Board')}}</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              @if(count($message_boards) > 0)
              <ul class="">
                  @foreach ($message_boards as $message)
                  <li>
                      <div class="block">
                        <div class="block_content">
                          <h2 class="title" style="font-size: 20px;">
                              <a href="#" class="view_message" data-message_id="{{$message->id}}">{{ $message->title }}</a>
                          </h2>
                          <p>{{ substr($message->body, 0, 200) }}...
                            <a href="#" class="view_message" data-message_id="{{$message->id}}">[Read More]</a>
                         </p>
                          <div class="byline">
                            <span>{{ $message->created_at->diffForHumans() }}</span>
                          </div>
                          <hr>
                        </div>
                      </div>
                    </li>
                  @endforeach
              </ul>
              @else
                <p>No message available</p>
              @endif
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
    </div>

    <div class="col-md-6" style="text-align: center;">
        <div class="card card-success">
            <div class="card-header">
              <h3 class="card-title"><i class="fas fa-user"></i> {{__('My Account')}}</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <a href="{{route('add.money')}}" class="btn btn-sm btn-danger p-3"><i class="fas fa-plus-circle"></i> {{__('Add Balance')}}</a>
              <a href="{{route('purchases')}}" class="btn btn-sm btn-success p-3"><i class="fas fa-shopping-cart"></i> {{__('My Orders')}}</a>
              <a href="{{route('tickets')}}" class="btn btn-sm btn-success p-3"><i class="fas fa-comments-o"></i> {{__('Open Ticket')}}</a>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->

          <div class="card card-warning">
            <div class="card-header">
              <h3 class="card-title"><i class="fas fa-user"></i> {{__('Fast Support 24/7')}}</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <a href="{{ url('tickets') }}" class="btn btn-primary btn-xs">{{ __('Have any Question Our Support Team is online to help you!') }}</a>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
    </div>

</div>

<!-- Modal - View Account Modal -->
    <div class="modal fade" id="viewMessageModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">{{__('Message Board')}}</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                    <!-- Content Here -->
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">{{__('Close')}}</button>
                </div>
              </div>
        </div>
      </div>


@endsection

@section('extra_script')

<script>
$(function(){
  $("a.view_message").on('click', function(e){
    e.preventDefault();
    var message_id = e.currentTarget.dataset.message_id;
    $.ajax({
      url: '/message/' + message_id,
      method: 'GET',
      success: function(res){
        $('#viewMessageModal .modal-body').empty();
        $('#viewMessageModal .modal-body').append(`
        <h2>${res.message.title}</h2>
        <p>${res.message.body}</p>
        <span>${moment(res.message.created_at).format("ddd, hA")}</span>
        `);
        $('#viewMessageModal').modal('show');
      }
    });
  });
});
</script>

@endsection
