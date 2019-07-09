@extends('layouts.author.app')

@section('title', 'Home')

@push('css')
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <script src="https://kit.fontawesome.com/a442ef78f6.js"></script>
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/author/css/feed.css') }}">


    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/author/css/create.css') }}">

    <link type="text/css" href="{{ asset('assets/author/css/argon.css?v=1.0.0') }}" rel="stylesheet">


@endpush

@section('content')
        
  <div class="main-content" style="padding-top: 7em;">

    <!-- Header -->
    <div class="header pb-8 pt-md-6 " style="background: linear-gradient(87deg, #ffad00 0, #e37f36 100%) !important;">
      <div class="container-fluid">
        <div class="header-body">
          <!-- Card stats -->
          <div class="row">
            <div class="col-xl-6 col-lg-8 offset-3">
              <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <span class="createtitle font-weight-bold mb-0">Create New Recipe</span>
                      <h5 class="card-title text-uppercase text-muted mb-0 date">21.6.2019 <span class="pl-3" style="color: #f46e6e">Friday</span></h5>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-warning text-white rounded-circle shadow">
                        <i class="fas fa-newspaper"></i>
                      </div>
                    </div>
                  </div>
                  <!-- <p class="mt-3 mb-0 text-muted text-sm">
                    <span class="text-warning mr-2"><i class="fas fa-arrow-down"></i> 1.10%</span>
                    <span class="text-nowrap">Since yesterday</span>
                  </p> -->
                </div>
              </div>
            </div>
            
          </div>
        </div>
      </div>
    </div>
    <!-- Page content -->
    <div class="container-fluid mt--7 col-lg-12">
          <div class="card bg-secondary shadow">
            
            <div class="card-body">
              <form>
                
                <!-- Address -->
                <div class="pl-lg-4">
                  <div class="row">
                    <div class="col-lg-4">
                      <div class="form-group">
                        <label class="form-control-label" for="input-username">Name</label>
                        <input type="text" id="input-username" class="form-control form-control-alternative" placeholder="Write Recipe Name ...">
                      </div>
                    </div>
                    <div class="col-lg-4">
                      <div class="form-group">
                        <label class="form-control-label" for="input-email">Featured Image</label><br>
                        <input type="file" id="input-email" style="height: 45px;">
                      </div>
                    </div>

                    <div class="col-lg-4">
                      <div class="form-group">
                        <label class="form-control-label" for="input-email">Video</label><br>
                        <input type="file" id="input-email" style="height: 45px;">
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-lg-4">
                      <div class="form-group">
                          <label class="form-control-label" for="input-category">Category</label><br>
                                  <select id="input-category" class="select-css">
                                    <option value="volvo">Food Category</option>
                                    <option value="volvo">Traditional</option>
                                    <option value="saab">Fast Food</option>
                                    <option value="mercedes">Drinks</option>
                                    <option value="audi">Breakfast</option>
                                  </select>
                      </div>
                    </div>
                    <div class="col-lg-4">
                      <div class="form-group">
                        <label class="form-control-label" for="input-username">Tags</label>
                        <input type="text" id="input-username" class="form-control form-control-alternative" placeholder="Your Tags Here">
                      </div>
                    </div>
                  </div>
                </div>

                <hr class="my-4" />

                <div class="pl-lg-4">
                  <h6 class="heading-small text-muted mb-4">Add Ingredients</h6>
                  <div></div>

                  <div class="row">
                    <div class="col-lg-3">
                      <div class="form-group">
                        <label class="form-control-label" for="input-username">Name</label>
                        <input type="text" id="input-username" class="form-control form-control-alternative" placeholder="Write Ingredient Name ...">
                      </div>
                    </div>

                    <div class="col-lg-3">
                      <div class="form-group">
                        <label class="form-control-label" for="input-username">Amount or Quantity</label>
                        <input type="text" id="input-username" class="form-control form-control-alternative" placeholder="Amount">
                      </div>
                    </div>

                    <div class="col-lg-3">
                      <div class="form-group" style="margin-top: 13%;">
                        <input type="submit" name="Add Ingredient" value="Add Ingredient" style="line-height: 2.5; font-size: 15px;">
                      </div>
                    </div>
                    
                  </div>
                </div>


                <hr class="my-4" />
                <!-- Description -->
                <div class="pl-lg-4">
                  <div class="form-group">
                  <h6 class="heading-small text-muted mb-4">Descriptions ( Directions )</h6>
                    
                    <textarea class="tinymce" style="border-radius: 1em;"></textarea>
                  </div>
                </div>

                <div class="row">
                  <div class="col-6 pl-5">
                      <div class="form-group">
                        <input type="button" name="Back" value="Back" style="line-height: 2.5; font-size: 15px;" onclick="window.location='Profile.html';">
                      </div>
                  </div>
                  <div class="col-6 text-right">
                        <div class="form-group">
                          <input type="submit" name="Add Blog" value="Add Ingredient" style="line-height: 2.5; font-size: 15px;">
                        </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
    </div>

      <!-- Footer -->
      <footer class="footer col-lg-12">
        <div class="row align-items-center justify-content-xl-between">
          <div class="col-xl-4 ml-5">
            <div class="copyright text-center text-xl-left text-muted">
              &copy; 2019 <a href="https://www.creative-tim.com" class="font-weight-bold ml-1" target="_blank">FoodDev</a>
            </div>
          </div>
          <div class="col-xl-4 mr-5">
            <ul class="nav nav-footer justify-content-center justify-content-xl-end">
              
              <li class="nav-item">
                <a href="https://www.creative-tim.com/presentation" class="nav-link" target="_blank">About Us</a>
              </li>
              <li class="nav-item">
                <a href="http://blog.creative-tim.com" class="nav-link" target="_blank">Blog</a>
              </li>
              
            </ul>
          </div>
        </div>
      </footer>
  </div>

@endsection

@push('script')
    

@endpush
