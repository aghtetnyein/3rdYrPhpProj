@extends('layouts.author.app')

@section('title', 'Home')

@push('css')
    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/a442ef78f6.js"></script>

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/author/css/recipe_detail.css') }}">


@endpush

@section('content')

  <div class="container" style="padding-top: 9em;">
    <div class="col-12">
      <div class="row mt-4 mb-4 pb-3 title line">
          <h3>{{ $recipe->title }}</h3>
      </div>

      <div class="row mt-3 mb-4">
            <img src="{{ Storage::disk('public')->url('/recipe/'.$recipe->image) }}" class="image-wh">
      </div>

      <div class="row mb-4 pb-3">
        <div class="recipebody">
          {!! $recipe->body !!}
        </div>
      </div>

      <div class="row mb-4 pb-1 line">
        <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
            <div class="row">


              <div class="col-6">
                <div id="like" style="cursor: pointer;">
                  <like recipe-id='{{ $recipe->id }}'
                    user-id='{{ auth()->user()->id }}'
                    like='{{ $recipe->likes->count() }}'
                    like-check='{{ $like_check }}'
                    >
                  </like>
                </div>
              </div>

              <div class="col-6">
                <div id="save" style="cursor: pointer;">
                  <save recipe-id='{{ $recipe->id }}'
                    user-id='{{ auth()->user()->id }}'
                    save-check='{{ $save_check }}'
                    >
                  </save>
                </div>
              </div>
            </div>
        </div>

        <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12 mt-lg-0 mt-4">
          <div class="row">
            <div class="col-6">
              <div class="tag mb-3">
                Categories
              </div>
              <div class="row mb-5">
                @foreach ( $categories as $category )
                <span class="badge badge-pill badge-info tag-item">{{$category->name}}</span>
                @endforeach
              </div>
            </div>
            <div class="col-6">
              <div class="tag mb-3">
                Tags                
              </div>
              <div class="row mb-5">
                @foreach ( $tags as $tag )
                <span class="badge badge-pill badge-warning tag-item" style="background-color: #ffa000; margin-bottom: 5px;">#{{$tag->name}}</span>
                @endforeach
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="row mb-4 pull-right" style="padding-bottom: 60px;">
        
        @if($recipe->user->id != auth()->user()->id)
        <div class="col-12">
          <a href="../profile/{{ $recipe->user->id }}">
            <div class="d-flex flex-row">
              <div>
                 <img src="{{ asset('/storage/images/avatar1.png') }}" style="border-radius: 100%; width: 30px; height: 30px;">
              </div>
              <div class="pl-3 pt-3">
                <h2 style="font-size: 13px;">{{ $recipe->user->name }}</h2>
              </div>
            </div>
          </a>
        </div>
        @else
        <div class="col-12">
            @can('update', $user->profile)
              <a class="btn btn-warning button" href="/author/recipe/{{ $recipe->id }}/edit">Edit Dish</a>
            @endcan

            @can('update', $user->profile)
              <button class="btn btn-danger waves-effect button" type="button" 
              onclick="deleteRecipe({{ $recipe->id }})" style="padding-bottom: 15px;">Delete Dish</button>
              <form id="delete-form" action="{{ route('author.recipe.destroy', $recipe->id) }}" 
                method="POST" style="display: none;">
                  @csrf
                  @method('DELETE')
              </form>
            @endcan

            <!-- @can('update', $user->profile)
            <input type="button" class="next" value="Next">
            @endcan -->
        </div>
        @endif

      </div>

    </div>
  </div>

@endsection

@push('js')
    
    <!-- Select Plugin Js -->
    <script src="{{ asset('assets/backend/plugins/bootstrap-select/js/bootstrap-select.js') }}"></script>
    <!-- TinyMCE -->
    <script src="{{ asset('assets/backend/plugins/tinymce/tinymce.js') }}"></script>
    <script src="https://unpkg.com/sweetalert2@7.19.1/dist/sweetalert2.all.js"></script>
    <script>
        $(function () {
            //TinyMCE
            tinymce.init({
                selector: "textarea#tinymce",
                theme: "modern",
                height: 300,
                plugins: [
                    'advlist autolink lists link image charmap print preview hr anchor pagebreak',
                    'searchreplace wordcount visualblocks visualchars code fullscreen',
                    'insertdatetime media nonbreaking save table contextmenu directionality',
                    'emoticons template paste textcolor colorpicker textpattern imagetools'
                ],
                toolbar1: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
                toolbar2: 'print preview media | forecolor backcolor emoticons',
                image_advtab: true
            });
            tinymce.suffix = ".min";
            tinyMCE.baseURL = '{{ asset('assets/backend/plugins/tinymce') }}';
        });
    </script>
    
    <script src="{{ asset('js/app.js') }}"></script>

@endpush
