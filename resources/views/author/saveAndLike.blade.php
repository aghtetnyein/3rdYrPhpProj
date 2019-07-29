<save recipe-id='{{ $recipe->id }}'
	user-id='{{ auth()->user()->id }}'
	save-check='{{ $save_check }}'
	>
</save>

<like recipe-id='{{ $recipe->id }}'
      user-id='{{ auth()->user()->id }}'
      like='{{ $recipe->likes->count() }}'
      like-check='{{ $like_check }}'
      >
</like>


@foreach( $recipes as $recipe )
    <div class="row mb-3">
        <div class="col-lg-12">
            <div class="border row bg-white eachblog">
                <div class="col-lg-6 col-sm-12 col-ls-12 image">
                    <img src="{{ Storage::disk('public')->url('/recipe/'.$recipe->image) }}" alt="image" class="fimage">
                </div>
                <div class="col-lg-6 col-sm-12 col-ls-12">
                    <div class="row" id="save">
                        <div class="col-10 d-flex flex-row">
                            <a href="#"> 
                                <img src="{{ asset('/storage/images/avatar1.png') }}" alt="Avatar" class="profileimg">
                            </a>
                            <a href="profile/{{ $recipe->user->id }}" class="profilename">{{ $recipe->user->name }}</a>
                        </div>
                        
                        <div class="col-2 save"><i class="material-icons">bookmark_border</i></div>
                    </div>

                    <div class="row">
                        <h2 class="fname" style="text-align: left;">{{ $recipe->title }}</h2>
                    </div>

                    <div class="row">
                        <p class="fmethod">Lightly oil the grill grate...</p>
                    </div>

                    <div class="row">
                        <div class="d-flex flex-row col-12 fperiod"><i class="material-icons">access_time</i><p class="pl-2">15 m</p></div>
                    </div>

                    <div class="row" id="like">
                        <div class="col-5 d-flex flex-row frate"><i class="material-icons">favorite_border</i><p class="love">3</p></div>

                        <div class="col-6 coverage"><a href="/author/recipe/{{ $recipe->id }}" class="d-flex flex-row"><i class="material-icons">remove_red_eye</i><span>View</span></a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endforeach



<recipe v-for='value in blog'
    :title=value.title
    :username=value.username
    :key=value.index
    :recipe-id=value.id
    user-id='{{ auth()->user()->id }}'
    :like=value.likes.length
    like-check='{{ $like_check }}'
    save-check-user-id='{{ $save_check->user_id }}'
    save-check-recipe-id='{{ $save_check->recipe_id }}'>
</recipe>


<recipe v-for='value in recipe'
    :title=value.title
    :username=value.username
    :key=value.index
    :recipe-id=value.id
    user-id='{{ auth()->user()->id }}'
    user-name='{{ auth()->user()->name }}'
    :like=value.likes.length>
</recipe>




<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                      <h2 style="font-size: 15px;">
                       INGREDIENTS
                      </h2>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                      <a href="" id="addNew" class="pull-right" data-toggle="modal" data-target="#exampleModal"><i class="fas fa-plus"></i></a>
                    </div>
                </div>
            </div>
            <div class="body">
              <div class="row">
                  <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                      <div class="form-group" style="margin-bottom: 0;">
                          <div class="list-group-item ourItem" data-toggle="modal" data-target="#exampleModal">blah
                          <input type="hidden" id="itemId" value="blah"></div>
                      </div>
                  </div>

                  <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                      <div class="form-group" style="margin-bottom: 0;">
                          <div class="list-group-item ourItem" data-toggle="modal" data-target="#exampleModal">miya
                          <input type="hidden" id="itemId" value="miya"></div>
                      </div>
                  </div>

                  <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                      <div class="form-group" style="margin-bottom: 0;">
                          <div class="list-group-item ourItem" data-toggle="modal" data-target="#exampleModal">miya
                          <input type="hidden" id="itemId" value="miya"></div>
                      </div>
                  </div>
              </div>
            </div>
        </div>
    </div>
</div>




@extends('layouts.author.app')

@section('title', 'Profile')

@push('css')
    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <script src="https://kit.fontawesome.com/a442ef78f6.js"></script>
    <link rel="stylesheet" type="text/css" href="{{ asset('../assets/author/css/noti.css') }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" integrity="sha256-rByPlHULObEjJ6XQxW/flG2r+22R5dKiAoef+aXWfik=" crossorigin="anonymous" />

@endpush

@section('content')
        
    <div class="container conwidth" style="margin-top: 90px;">
        <div class="row" id="app">
            <div class="col-lg-6 col-md-12 col-sm-12 col-12 offset-lg-2">
                 <div class="panel panel-default">
                     <div class="panel-heading">
                         <h3 class="panel-title">Groceries List <a href="" id="addNew" class="pull-right" data-toggle="modal" data-target="#exampleModal"><i class="fas fa-plus"></i></a></h3>
                     </div>
                     <div class="panel-body" id="items">
                         <ul class="list-group">
                            @foreach($items as $item)
                                 <li class="list-group-item ourItem" data-toggle="modal" data-target="#exampleModal">{{ $item->item }}
                                    <input type="hidden" id="itemId" value="{{ $item->id }}"></li>
                            @endforeach
                         </ul>
                     </div>
                 </div>
            </div>

            <div class="col-lg-2">
              <input type="text" class="form-control" name="searchItem" id="searchItem" placeholder="Search">
            </div>
        </div>
    </div>

    <div class="modal" id="exampleModal" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="title">Add New Item</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <input type="hidden" id="id" name="">
            <p><input type="text" id="addItem" name="" placeholder="Write your item" class="form-control"></p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" id="delete" data-dismiss="modal" style="display: none;">Delete</button>
            <button type="button" class="btn btn-warning" id="saveChanges" data-dismiss="modal" style="display: none;">Save changes</button>
            <button type="button" id="addButton" class="btn btn-warning text-white" data-dismiss="modal">Add Item</button>
          </div>
        </div>
      </div>
    </div>

@endsection

@push('js')
    {{csrf_field()}}
    <script
      src="https://code.jquery.com/jquery-3.4.1.min.js"
      integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
      crossorigin="anonymous">
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js" integrity="sha256-KM512VNnjElC30ehFwehXjx1YCHPiQkOPmqnrWtpccM=" crossorigin="anonymous"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $(document).on('click', '.ourItem', function(event) {
                    var text = $(this).text();
                    var id = $(this).find('#itemId').val();
                    $('#title').text('Edit Item');
                    var text = $.trim(text);
                    $('#delete').show();
                    $('#saveChanges').show();
                    $('#addButton').hide();
                    $('#addItem').val(text);
                    $('#id').val(id);
                    console.log(text);
            });

            $(document).on('click', '#addNew', function(event) {
                $('#title').text('Add New Item');
                $('#delete').hide();
                $('#saveChanges').hide();
                $('#addButton').show();
                $('#addItem').val("");
            });

            $('#addButton').click(function(event){
                var text = $('#addItem').val();
                if (text=="") {
                   alert('Please type anything for item'); 
                }else{
                    $.post('/author/shoppinglist/create', {'text': text, '_token':$('input[name=_token]').val()}, function(data) {
                    //console.log(data);
                    $('#items').load(location.href + ' #items');
                    });
                }
            });

            $('#delete').click(function(event){
                var id = $("#id").val();
                $.post('/author/shoppinglist/delete', {'id': id, '_token':$('input[name=_token]').val()}, function(data) {
                    //console.log(data);
                    $('#items').load(location.href + ' #items');
                });
            });

            $('#saveChanges').click(function(event){
                var id = $("#id").val();
                var value = $.trim($("#addItem").val());
                $.post('/author/shoppinglist/update', {'id': id, 'value': value, '_token':$('input[name=_token]').val()}, function(data) {
                    console.log(data);
                    $('#items').load(location.href + ' #items');
                });
            });

            $( function() {
                
                $( "#searchItem" ).autocomplete({
                  source: 'http://localhost:8000/search'
                });
            } );
        });
    </script>

@endpush



    <div class="row">
      <div class="col-6">
        <p class="pull-right">
          <label class="container">Recipe Name
            <input type="radio" checked="checked" name="radio">
            <span class="checkmark"></span>
          </label>
        </p>
      </div>
      <div class="col-6">
        <p class="pull-left">
          <label class="container">Tags
            <input type="radio" name="radio">
            <span class="checkmark"></span>
          </label>
        </p>
      </div>
    </div>