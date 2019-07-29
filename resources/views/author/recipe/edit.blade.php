@extends('layouts.author.app')

@section('title', 'Home')

@push('css')

    <script src="https://kit.fontawesome.com/a442ef78f6.js"></script>

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/author/css/create.css') }}">


    <link href="{{ asset('assets/backend/plugins/bootstrap-select/css/bootstrap-select.css') }}" rel="stylesheet" />

@endpush

@section('content')
  <div class="header pt-md-5" style="background: linear-gradient(87deg, #ffad00 0, #e37f36 100%) !important; display: block; height: 300px;">      
  <div class="container" style="padding-top: 10em;">
        <!-- Vertical Layout | With Floating Label -->
        <form action="{{ route('author.recipe.update', $recipe->id) }}" method="POST" enctype="multipart/form-data" style="text-align: left;">
            @csrf
            @method('PUT')
            <div class="row clearfix">
                <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                EDIT RECIPE
                            </h2>
                        </div>
                        <div class="body">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" id="title" class="form-control" name="title" value="{{ $recipe->title }}">
                                        <label class="form-label">Recipe Name</label>
                                    </div>
                                </div>

                                <div class="form-group form-float" style="margin-bottom: 4em;">
                                    <div class="form-line">
                                        <input type="text" id="duration" class="form-control" name="duration" value="{{ $recipe->duration }}">
                                        <label class="form-label">Duration</label>
                                    </div>
                                </div>

                                <div class="form-group" style="margin-bottom: 0;">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                            <div class="">
                                                <label for="image">
                                                  <i class="material-icons">add_photo_alternate</i> Featured Image
                                                </label>
                                                <input type="file" name="image">
                                            </div>
                                        </div>

                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                            <div class="">
                                                <label for="video">
                                                  <i class="material-icons">camera_alt</i>
                                                  Video
                                                </label>
                                                <input type="file" id="video" name="status_image_upload">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
                  <div class="card">
                      <div class="header">
                          <h2>
                              CATEGORIES AND TAGS
                          </h2>
                      </div>
                      <div class="body">
                          <div class="form-group form-float">
                              <div class="form-line {{ $errors->has('categories') ? 'focused error' : '' }}">
                                  <label for="category">Select Category</label>
                                  <select name="categories[]" id="category" class="form-control show-tick" data-live-search="true" multiple>
                                    @foreach($categories as $category)
                                          <option 
                                          @foreach ( $recipe->categories as $recipeCategory )
                                            {{ $recipeCategory->id == $category->id ? 'selected' : '' }}
                                          @endforeach
                                          value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                  </select>
                              </div>
                          </div>

                          <div class="form-group form-float">
                              <div class="form-line">
                                  <input type="text" id="tag" class="form-control" name="tags" style="font-weight: bold;" value="@foreach ($tags as $tag)#{{ $tag->name }}@endforeach">
                                  <label class="form-label">Tags</label>
                              </div>
                          </div>

                          <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group" style="margin-bottom: 0;">
                                    <input type="checkbox" id="publish" class="filled-in" name="publish" value="1" {{ $recipe->publish == true ? 'checked' : '' }}>
                                    <label for="publish">Publish</label>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group" style="margin-bottom: 0;">
                                    <input type="checkbox" id="chef" class="filled-in" name="chef" value="1" {{ $recipe->chef == true ? 'checked' : '' }}>
                                    <label for="chef">Chef</label>
                                </div>
                            </div>
                          </div>

                          <a class="btn btn-danger waves-effect" href="/author/recipe/{{$recipe->id}}">Back</a>
                          <button type="submit" class="btn btn-warning waves-effect">Update</button>

                      </div>
                  </div>
              </div>
            </div>
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                               BODY
                            </h2>
                        </div>
                        <div class="body">
                            <textarea id="tinymce" name="body">{{ $recipe->body }}</textarea>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

@endsection

@push('js')
    
    <!-- Select Plugin Js -->
    <script src="{{ asset('assets/backend/plugins/bootstrap-select/js/bootstrap-select.js') }}"></script>
    <!-- TinyMCE -->
    <script src="{{ asset('assets/backend/plugins/tinymce/tinymce.js') }}"></script>
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

@endpush
