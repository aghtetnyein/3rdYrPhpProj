@extends('layouts.author.app')

@section('title', 'ShoppingList')

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
                                  <li class="list-group-item ourItem" data-toggle="modal" data-target="#exampleModal">
                                  <div class="row">
                                    <div class="col-lg-6" id="item">
                                      {{ $item->item }}
                                    </div>
                                    <div class="col-lg-6" id="quantity">
                                      {{ $item->quantity }}
                                    </div>
                                  </div>
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
            <p><input type="text" id="addQuantity" name="" placeholder="Quantity" class="form-control"></p>
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
                    var item = $(this).find('#item').text();
                    var quantity =$(this).find('#quantity').text();
                    var id = $(this).find('#itemId').val();
                    $('#title').text('Edit Item');
                    var item = $.trim(item);
                    var quantity = $.trim(quantity);
                    $('#delete').show();
                    $('#saveChanges').show();
                    $('#addButton').hide();
                    $('#addItem').val(item);
                    $('#addQuantity').val(quantity);
                    $('#id').val(id);
                    console.log(text);
            });

            $(document).on('click', '#addNew', function(event) {
                $('#title').text('Add New Item');
                $('#delete').hide();
                $('#saveChanges').hide();
                $('#addButton').show();
                $('#addItem').val("");
                $('#addQuantity').val("");
            });

            $('#addButton').click(function(event){
                var text = $('#addItem').val();
                var quantity = $('#addQuantity').val();
                if (text=="" || quantity=="") {
                   alert('Please type anything for item and quantity'); 
                }else{
                    $.post('/author/shoppinglist/create', {'text': text, 'quantity': quantity, '_token':$('input[name=_token]').val()}, function(data) {
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
                var item = $.trim($("#addItem").val());
                var quantity = $.trim($("#addQuantity").val());
                $.post('/author/shoppinglist/update', {'id': id, 'item': item, 'quantity': quantity, '_token':$('input[name=_token]').val()}, function(data) {
                    //console.log(data);
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
