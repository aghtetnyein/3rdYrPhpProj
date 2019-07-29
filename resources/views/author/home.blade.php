@extends('layouts.author.app')

@section('title', 'Home')

@push('css')
    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <script src="https://kit.fontawesome.com/a442ef78f6.js"></script>
    <link rel="stylesheet" type="text/css" href="{{ asset('../assets/author/css/feed.css') }}">

@endpush

@section('content')
        
    <div class="container" style="margin-top: 90px;">
        <div class="col-lg-12">
            <div class="row" id="app">
                <div class="col-lg-8 col-sm-12">
                    @foreach( $recipes as $recipe )
                    <div class="row mb-3">
                        <div class="col-lg-12">
                            <div class="border row bg-white eachblog">
                                <a href="/author/recipe/{{ $recipe->id }}">
                                    <div>
                                        <div class="col-lg-6 col-sm-12 col-ls-12 image">
                                            <img src="{{ Storage::disk('public')->url('/recipe/'.$recipe->image) }}" alt="image" class="fimage">
                                        </div>
                                        <div class="col-lg-6 col-sm-12 col-ls-12">
                                            <div class="row" id="save">
                                                <div class="col-12 d-flex flex-row">
                                                    <a href="profile/{{ $recipe->user->id }}"> 
                                                        <img src="{{ asset('/storage/images/avatar1.png') }}" alt="Avatar" class="profileimg">
                                                    </a>
                                                    <div class="col-lg-9 profilename">
                                                        <a href="profile/{{ $recipe->user->id }}">{{ $recipe->user->name }}</a>
                                                        <p class="date">{{ $recipe->created_at->diffForHumans() }}</p>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row mt-lg-4">
                                                <h2 class="fname" style="text-align: left;"><a href="/author/recipe/{{ $recipe->id }}">{{ $recipe->title }}</a></h2>
                                            </div>

                                            <div class="row">
                                                @foreach ( $recipe->categories as $category )
                                                <span class="badge badge-pill badge-info tag-item">{{$category->name}}</span>
                                                @endforeach
                                            </div>

                                            <div class="row mt-lg-5">
                                                <div class="col-5 d-flex flex-row frate"><i class="material-icons" style="font-size: 17px;">favorite</i><p class="love">{{ $recipe->likes->count() }}</p></div>

                                                <div class="col-5 d-flex flex-row frate"><i class="material-icons" style="font-size: 20px;">access_time</i><p class="love">{{ $recipe->duration }}</p></div>
                                            </div>
                                        </div>
                                    </div>
                                </a>   
                            </div>
                        </div>
                    </div>

                @endforeach
                </div>

                <div class="col-lg-4 largeview">
                    <div class="row">
                        <div class="col-lg-12 border rounded bg-white">
                            <h2 class="createtitle">Wanna Share Your Recipe ?</h2>
                            <a href="{{ route('author.recipe.create') }}"><div class="btn button">Click Here</div></a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 border rounded bg-white mt-5">
                            <div class="row">
                                <h2 class="pt-4 pb-3" style="font-size: 16px; font-weight: bold; margin: 0 auto;"><i class="fas fa-user mr-3"></i>POPULAR CHEFS</h2>
                            </div>

                            <div class="row mt-3">
                                
                                @foreach ($users as $user)
                                    @if($user->id < 21 && $user->id != auth()->user()->id && $user->id != 1)
                                    <div class="col-lg-4"  style="margin: 0; padding: 0; border-radius: 100%;">
                                        <a href="/author/profile/{{ $user->id }}">
                                            <div class="category">
                                                <img 
                                                src="{{ Storage::disk('public')->url('/profile/'.$user->profile->image) }}" alt="categoryImage" style="width:100%; height: 100px;">
                                                <div class="center"><h3>{{ $user->name }}</h3></div>
                                            </div>
                                        </a>
                                    </div>
                                    @endif
                                @endforeach

                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
            
            
        </div>
    </div>

@endsection

@push('js')

@endpush
