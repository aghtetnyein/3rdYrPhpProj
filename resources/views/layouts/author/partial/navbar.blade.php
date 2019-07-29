<header>
		<div id="navbar" style="z-index: 1;">
		  <div class="active logo" style="color: #ffa000"><span class="brand">FoodDe</span><i class="fas fa-pizza-slice"></i></div> 
      	  <span class="right"><a href="/author/profile/{{ auth()->user()->id }}" class="die {{ request()->routeIs('author.profile.show') ? 'active' : '' }}"><i class="material-icons">person</i></a></span>
      	  <a href="/author/shoppinglist/{{ auth()->user()->id }}" class="die {{ request()->routeIs('author.shoppinglist.show') ? 'active' : '' }}"><i class="material-icons">shopping_cart</i></a>
		  <a href="{{ route('author.search.index') }}" class="die {{ request()->is('author/search') ? 'active' : '' }}"><i class="material-icons">search</i></a>
		  <a href="{{ route('author.home') }}" class="die {{ request()->is('author/home') ? 'active' : '' }}"><i class="material-icons">fastfood</i></a>
		</div>

		<div class="bot-nav" id="cbb">
			<div class="icb"><a href="{{ route('author.home') }}" class="die {{ request()->is('author/home') ? 'active' : '' }}"><i class="material-icons">fastfood</i></a></div>
			<div class="icb"><a href="/author/profile/{{ auth()->user()->id }}" class="{{ request()->routeIs('author.profile.show') ? 'active' : '' }}"><i class="material-icons">person</i></a></div>
			<div class="icb"><a href="{{ route('author.recipe.create') }}" class="{{ request()->routeIs('author.recipe.create') ? 'active' : '' }}"><i class="material-icons">add</i></a></div>
			<div class="icb"><a href="{{ route('author.search.index') }}" class="{{ request()->routeIs('author.search.index') ? 'active' : '' }}"><i class="material-icons">search</i></a></div>
			<div class="icb"><a href="/author/shoppinglist/{{ auth()->user()->id }}" class="die {{ request()->routeIs('author.shoppinglist.show') ? 'active' : '' }}"><i class="material-icons">shopping_cart</i></a>
		</div>
</header>