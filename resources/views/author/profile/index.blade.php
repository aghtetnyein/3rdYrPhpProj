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
                      <img src="{{ Storage::disk('public')->url('/profile/'.$user->profile->image) }}" alt="Avatar" class="pimage">
                    </div>

                    <div class="col-lg-8">
                      
                      <profile name='{{ $user->name }}' 
                               user-id='{{ auth()->user()->id }}' 
                               profile-id='{{ $user->id }}'
                               followers= '{{ $user->profile->follows->count() }}'
                               following = '{{ $user->follows->count() }}'
                               follow-or-not = '{{ $follow }}'
                               recipes='{{ $recipes_publish->count() }}'>
                      </profile>

                      <div class="row mt-3">
                          <div><h3 class="bio">{{ $user->profile->about }}</h3></div>
                      </div>

                      <div class="row mt-1">
                          <div><h3 class="url">{{ $user->profile->url }}</h3></div>
                      </div>

                      <div class="row mt-3 create">

                        @can('update', $user->profile)
                          <a class="btn mr-4 new" href="{{ route('author.recipe.create') }}">Create New Dish</a>
                        @endcan
                        
                        @can('update', $user->profile)
                          <a class="btn mr-4" href="/author/profile/{{ $user->id }}/edit">Edit Profile</a>
                        @endcan

                        @can('update', $user->profile)
                          <a class="btn btn-danger" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>

                          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                        @endcan

                      </div>
                    </div>
                </div>
            </div>
        </div>

        <hr>

        @if(auth()->user()->id === $user->id)
        <div class="row">
          <div class="col-lg-12" style="text-align: center;">
              <div class="d-flex flex-row">
                <div id="btn" class="col-4 active">
                  <a class="item pull-right" onclick="showall()"><i class="material-icons">apps</i><p>Recipes</p></a> 
                </div>
                <div id="btn" class="col-4">
                  <a class="item" onclick="showshare()"><i class="material-icons pr-2">share</i><p>Shared</p></a>
                </div>
                <div id="btn" class="col-4">
                  <a class="item pull-left" onclick="showdraft()"><i class="material-icons pr-2">create</i><p>Draft</p></a>
                </div> 
              </div>
          </div>
        </div>
        @else
        <div class="row">
          <div class="col-lg-12" style="text-align: center;">
              <div class="d-flex flex-row">
                <div id="btn" class="col-4 active">
                  <a class="item pull-right" onclick="showall()"><i class="material-icons">apps</i><p>Recipes</p></a> 
                </div>
                <div id="btn" class="col-4">
                  <a class="item" onclick="showshare()"><i class="material-icons pr-2">share</i><p>Shared</p></a>
                </div>
              </div>
          </div>
        </div>
        @endif


        <div id="id1" class="col-lg-12">
            <div class="grid">
                
                @foreach($recipes_publish as $recipe)
                  <figure class="effect-sadie">
                    <img class="imgfit" src="{{ Storage::disk('public')->url('/recipe/'.$recipe->image) }}" alt="image">
                    <figcaption>
                        <h2><span>{{ $recipe->title }}</span></h2>
                        
                        <a href="/author/recipe/{{ $recipe->id }}">View more</a>
                    </figcaption>           
                  </figure>
                @endforeach

            </div>
        </div>

        <div id="id2" class="col-lg-12" style="display: none;">
            <div class="grid">
                
                @foreach($recipes_shared as $recipe)
                  <figure class="effect-sadie">
                    <img class="imgfit" src="{{ Storage::disk('public')->url('/recipe/'.$recipe->image) }}" alt="image">
                    <figcaption>
                        <h2><span>{{ $recipe->title }}</span></h2>
                        
                        <a href="/author/recipe/{{ $recipe->id }}">View more</a>
                    </figcaption>           
                  </figure>
                @endforeach

            </div>
        </div>

        <div id="id3" class="col-lg-12" style="display: none;">
            <div class="grid">
                
                @foreach($recipes_draft as $recipe)
                  <figure class="effect-sadie">
                    <img class="imgfit" src="{{ Storage::disk('public')->url('/recipe/'.$recipe->image) }}" alt="image">
                    <figcaption>
                        <h2><span>{{ $recipe->title }}</span></h2>
                        
                        <a href="/author/recipe/{{ $recipe->id }}">View more</a>
                    </figcaption>           
                  </figure>
                @endforeach

            </div>
        </div>
    </div>

@endsection

@push('js')
    
  <script src="{{ asset('js/app.js') }}"></script>
  <script type="text/javascript">

  function showall() {
    document.getElementById('id1').style.display = 'block';
    document.getElementById('id2').style.display = 'none';
    document.getElementById('id3').style.display = 'none';
  }

  function showshare() {
    document.getElementById('id1').style.display = 'none';
    document.getElementById('id2').style.display = 'block';
    document.getElementById('id3').style.display = 'none';
  }

  function showdraft() {
    document.getElementById('id1').style.display = 'none';
    document.getElementById('id2').style.display = 'none';
    document.getElementById('id3').style.display = 'block';
  }

</script>
<script type="text/javascript">
  $(document).on('click', '#btn', function(){
    $(this).addClass('active').siblings().removeClass('active');
  })
</script>

@endpush
