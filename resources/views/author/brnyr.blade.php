@extends('layouts.author.app')

@section('title', 'Search')

@push('css')
    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <script src="https://kit.fontawesome.com/a442ef78f6.js"></script>

    <link rel="stylesheet" type="text/css" href="{{ asset('../assets/author/css/search.css') }}">

@endpush

@section('content')

<div class="content">

  <div class="scrolling-wrapper-flexbox">
    @foreach($categories as $category)
    <div class="cad">
      <div class="box">
        <a href="{{ route('author.searchItem', ['category' => $category->slug]) }}">
            <div class="category">
                <img src="{{ Storage::disk('public')->url('/category/'.$category->image) }}" alt="categoryImage" style="width:100%; height: 150px; border-radius: 10px;">
                <div class="center"><h3>{{ $category->name }}</h3></div>
            </div>
        </a>
      </div>
    </div>
    @endforeach
  </div>

<div> 
  <form class="search-form" action="{{ route('author.itemsearch') }}" method="GET"> 
      <div class="row">
        <p class="col-lg-6 col-md-12 col-sm-12 col-xs-12" style="text-align: center;"><input type="text" name="recipeName" id="recipeName" class="search" value="{{ request()->input('recipeName') }}" placeholder="Search By Recipe Name"></p>
      </div>
  </form>
</div>

        
<div class="container" style="margin-top: 20px;">


    <div class="col-lg-12">
        <div class="grid">
            
            @foreach($recipes as $recipe)
              <figure class="effect-sadie">
                <img class="imgfit" src="{{ Storage::disk('public')->url('/recipe/'.$recipe->image) }}" alt="image">
                <figcaption>
                    <h2><span>{{ $recipe->title }}</span></h2>
                    <p>Sadie never took her eyes off me. <br>She had a dark soul.</p>
                    <a href="/author/recipe/{{ $recipe->id }}">View more</a>
                </figcaption>           
              </figure>
            @endforeach

        </div>
    </div>
</div>

    <!-- pager -->
    <ul class="pager">
        <li class="next">
            {{ $recipes->links() }}
        </li>
    </ul>


@endsection

@push('js')
    
    <script src="{{ asset('js/app.js') }}"></script>

@endpush
