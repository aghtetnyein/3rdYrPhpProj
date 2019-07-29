@extends('layouts.author.app')

@section('title', 'Profile')

@push('css')
    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <script src="https://kit.fontawesome.com/a442ef78f6.js"></script>
    <link rel="stylesheet" type="text/css" href="{{ asset('../assets/author/css/editprofile.css') }}">

@endpush

@section('content')

<div class="content" style="margin-bottom: 50px;">

  <form action="/author/profile/{{ $user->id }}" enctype="multipart/form-data" method="post">
    @csrf
    @method('PATCH')

      <div class="topsection">
        <img src="{{ Storage::disk('public')->url('/profile/'.$user->profile->image) }}" alt="Avatar" class="pimage">
      </div>  

      <div class="field">
          <p class="fname">Name</p>

          <input id="name"
                 type="text"
                 name="name"
                 class="input @error('name') is-invalid @enderror"
                 value="{{ old('name') ?? $user->name }}"
                 autocomplete="title"
                 autofocus>

          @error('title')
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
          @enderror
      </div>  

      <div class="field">
          <p class="fname">URL</p>

          <input id="url"
                 type="text"
                 name="url"
                 class="input @error('url') is-invalid @enderror"
                 value="{{ old('url') ?? $user->profile->url }}"
                 autocomplete="url"
                 autofocus>

          @error('url')
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
          @enderror
      </div>

      <div class="field">
          <p class="fname">About</p>

          <input id="about"
                 type="text"
                 name="about"
                 class="input @error('about') is-invalid @enderror"
                 value="{{ old('about') ?? $user->profile->about }}"
                 autocomplete="about"
                 autofocus>

          @error('about')
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
          @enderror
      </div>

      <div class="choosefile">
          <label for="image" class="col-md-4 col-form-label">Profile Image</label>
          <input type="file" class="form-control-file" name="image" id="image" value="">

          @error('image')
                  <strong>{{ $message }}</strong>
          @enderror
      </div> 

      <div style="margin-top: 20px; display: block; text-align: center;">
        <button class="btn button">Back</button>
        <button class="btn button">Save Profile</button>
      </div>

  </form>

</div>

@endsection

@push('script')
    

@endpush
