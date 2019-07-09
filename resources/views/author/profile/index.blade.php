@extends('layouts.author.app')

@section('title', 'Profile')

@push('css')
    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <script src="https://kit.fontawesome.com/a442ef78f6.js"></script>
    <link rel="stylesheet" type="text/css" href="{{ asset('../assets/author/css/profile.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('../assets/author/css/grid.css') }}">

@endpush

@section('content')
        
    <div class="container conwidth">
        <div class="row" id="app">
            <div class="col-lg-12">
                <div class="d-flex flex-row">
                    <div class="col-4">
                      <img src="{{ asset('/storage/images/avatar1.png') }}" alt="Avatar" class="pimage">
                    </div>

                    <div class="col-lg-8">
                      
                      <profile name='{{ $user->name }}' 
                               user-id='{{ auth()->user()->id }}' 
                               profile-id='{{ $user->id }}'
                               followers= '{{ $user->profile->follows->count() }}'
                               following = '{{ $user->follows->count() }}'>
                      </profile>

                      <div class="row mt-3">
                          <div><h3 class="bio">Bio</h3></div>
                      </div>

                      <div class="row mt-3 create">

                        @can('update', $user->profile)
                          <a class="btn mr-4 new" href="{{ route('author.recipe.create') }}">Create New Dish</a>
                        @endcan
                        
                        @can('update', $user->profile)
                          <a class="btn" href="/author/profile/{{ $user->id }}/edit">Edit Profile</a>
                        @endcan

                      </div>
                    </div>
                </div>
            </div>
        </div>

        <hr>

        <div class="row">
          <div class="col-lg-12">
              <div class="d-flex flex-row nav">
                <div>
                  <a href="profile.html" class="pa active" style="float:left;"><i class="fas fa-th pr-2"></i>Recipes</a> 
                </div>
                <div>
                  <a href="saved.html" class="pa" style="float:left;"><i class="fas fa-bookmark pr-2"></i>Saved</a>
                </div> 
              </div>
          </div>
        </div>


        <div class="col-lg-12">
        <div class="grid">
                <figure class="effect-sadie">
                    <img src="{{ asset('/storage/images/food2.jpg') }}" alt="img02" class="imgfit" />
                    <figcaption>
                        <h2><span>Eggs</span></h2>
                        <p>Sadie never took her eyes off me. <br>She had a dark soul.</p>
                        <a href="#">View more</a>
                    </figcaption>           
                </figure>
                <figure class="effect-sadie">
                    <img src="{{ asset('/storage/images/food3.jpg') }}" alt="img14" class="imgfit"/>
                    <figcaption>
                        <h2><span>Soup</span></h2>
                        <p>Sadie never took her eyes off me. <br>She had a dark soul.</p>
                        <a href="#">View more</a>
                    </figcaption>           
                </figure>
                <figure class="effect-sadie">
                    <img src="{{ asset('/storage/images/fastfood.jpg') }}" alt="img14" class="imgfit"/>
                    <figcaption>
                        <h2><span>Fast Food</span></h2>
                        <p>Sadie never took her eyes off me. <br>She had a dark soul.</p>
                        <a href="#">View more</a>
                    </figcaption>           
                </figure>
            </div>
        </div>
      </div>

@endsection

@push('js')
    
  <script src="{{ asset('js/app.js') }}"></script>

@endpush
