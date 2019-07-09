<header>
		<div id="navbar" style="z-index: 1;">
		  <a href="{{ route('author.home') }}" class="active" style="float:left; padding:  15px 18px;"><span class="brand">FoodDe</span><i class="fas fa-pizza-slice"></i></a> 
      	  <span class="right"><a href="/author/profile/{{ auth()->user()->id }}"><i class="material-icons">person</i></a></span>
		  <a href="shop.html"><i class="material-icons">shopping_cart</i></a>
		  <a href="search.html"><i class="material-icons">search</i></a>  
		  <a href="noti.html"><i class="material-icons">notifications</i></a> 
		</div>
</header>