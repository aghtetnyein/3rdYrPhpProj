@extends('layouts.author.app')

@section('title', 'Home')

@push('css')
    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <script src="https://kit.fontawesome.com/a442ef78f6.js"></script>
    <link rel="stylesheet" type="text/css" href="{{ asset('../assets/author/css/feed.css') }}">

@endpush

@section('content')
        
    <div class="container" style="margin-top: 100px;">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-8 col-sm-12">
                    <div class="row mb-3">
                        <div class="col-lg-12">
                            <div class="border row bg-white eachblog">
                                <div class="col-lg-6 col-sm-12 col-ls-12 image">
                                    <img src="{{ asset('/storage/images/burger1.jpeg') }}" alt="image" class="fimage">
                                </div>
                                <div class="col-lg-6 col-sm-12 col-ls-12">
                                    <div class="row">
                                        <div class="col-10 d-flex flex-row">
                                            <a href="#"> 
                                                <img src="{{ asset('/storage/images/avatar1.png') }}" alt="Avatar" class="profileimg">
                                            </a>
                                            <a href="#" class="profilename">John Doe</a>
                                        </div>
                                        
                                        <div class="col-2 save">
                                            <a href="#">  
                                                <i class="material-icons">bookmark_border</i>
                                            </a>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <h2 class="fname" style="text-align: left;">Hamburger</h2>
                                    </div>

                                    <div class="row">
                                        <p class="fmethod">Lightly oil the grill grate...</p>
                                    </div>

                                    <div class="row">
                                        <div class="d-flex flex-row col-12 fperiod"><i class="material-icons">access_time</i><p class="pl-2">15 m</p></div>
                                    </div>

                                    <div class="row">
                                        <div class="col-5 d-flex flex-row frate"><i class="material-icons">favorite_border</i><p class="love">32</p></div>

                                        <div class="col-6 coverage"><a href="" class="d-flex flex-row"><i class="material-icons">remove_red_eye</i><span>View</span></a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="col-lg-4 largeview">
                    <div class="row">
                        <div class="col-lg-12 border rounded bg-white">
                            <h2 class="createtitle">Wanna Share Your Recipe ?</h2>
                            <a href="newrecipe.html"><div type="btn" class="button">Click Here</div></a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 border rounded bg-white mt-5">
                            <div class="row">
                                <h2 class="pt-4 pb-3" style="font-size: 16px; font-weight: bold; margin: 0 auto;"><i class="fas fa-list pr-2"></i>CATEGORIES</h2>
                            </div>

                            <div class="row mt-3">
                                <div class="col-lg-6"  style="margin: 0; padding: 0;">
                                    <div class="category">
                                        <img src="{{ asset('/storage/images/chinese.jpeg') }}" alt="Notebook" style="width:100%; height: 100px;">
                                        <div class="center"><h3>Chinese Dishes</h3></div>
                                    </div>
                                </div>

                                <div class="col-lg-6"  style="margin: 0; padding: 0;">
                                    <div class="category">
                                        <img src="{{ asset('/storage/images/thailand.jpg') }}" alt="Notebook" style="width:100%; height: 100px;">
                                        <div class="center"><h3>Thailand Dishes</h3></div>
                                    </div>
                                </div>

                                <div class="col-lg-6"  style="margin: 0; padding: 0;">
                                    <div class="category">
                                        <img src="{{ asset('/storage/images/europe.jpg') }}" alt="Notebook" style="width:100%; height: 100px;">
                                        <div class="center"><h3>European Dishes</h3></div>
                                    </div>
                                </div>

                                <div class="col-lg-6"  style="margin: 0; padding: 0;">
                                    <div class="category">
                                        <img src="{{ asset('/storage/images/fastfood.jpg') }}" alt="Notebook" style="width:100%; height: 100px;">
                                        <div class="center"><h3>Fast Food</h3></div>
                                    </div>
                                </div>
                                
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('script')
    

@endpush
