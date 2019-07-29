@extends('layouts.author.app')

@section('title', 'Notifications')

@push('css')
    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <script src="https://kit.fontawesome.com/a442ef78f6.js"></script>
    <link rel="stylesheet" type="text/css" href="{{ asset('../assets/author/css/noti.css') }}">

@endpush

@section('content')
        
    <div class="container conwidth" style="margin-top: 90px;">
        <div class="row" id="app">
            <div class="col-lg-8 col-md-12 col-sm-12 col-12 offset-lg-2">
                 <div class="row noti">
                   <div class="col-lg-1 col-md-1 col-sm-1 col-1">
                     <img src="{{ asset('/storage/images/avatar1.png') }}"  alt="Avatar" class="nimg">
                   </div>
                   <div class="col-lg-7 col-md-7 col-sm-7 col-7 ml-lg-4 ml-md-5 ml-sm-5 ml-5"> 
                      <div class="ntext">
                        <span style="font-weight: bold;">Dave</span> liked your recipe.<br>
                      </div>
                      <div class="ntime">
                        <span>5 seconds ago</span>
                      </div>
                   </div>
                   <div class="col-lg-3 col-md-3 col-sm-3 col-3 img-padding">
                     <img src="{{ asset('/storage/images/avatar1.png') }}"  alt="Avatar" class="concept-img">
                   </div>
                 </div>

                 <div class="row noti">
                   <div class="col-lg-1 col-md-1 col-sm-1 col-1">
                     <img src="{{ asset('/storage/images/avatar1.png') }}"  alt="Avatar" class="nimg">
                   </div>
                   <div class="col-lg-7 col-md-7 col-sm-7 col-7 ml-lg-4 ml-md-5 ml-sm-5 ml-5"> 
                      <div class="ntext">
                        <span style="font-weight: bold;">Dave</span> liked your recipe.<br>
                      </div>
                      <div class="ntime">
                        <span>5 seconds ago</span>
                      </div>
                   </div>
                   <div class="col-lg-3 col-md-3 col-sm-3 col-3 img-padding">
                     <img src="{{ asset('/storage/images/avatar1.png') }}"  alt="Avatar" class="concept-img">
                   </div>
                 </div>
            </div>
        </div>
    </div>

@endsection

@push('js')
    
  <script src="{{ asset('js/app.js') }}"></script>

@endpush
