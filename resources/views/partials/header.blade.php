<nav class="navbar navbar-default navbar-inverse navbar-fixed-top">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="{{ url('/') }}">Restaurants</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li><a href="/recipe">What's on your fridge? <span class="sr-only">(current)</span></a></li>
        <li><a href="imgclarifai">Find Ingredients in image</a></li>
        
      </ul>
      
      <ul class="nav navbar-nav navbar-right">
        @if(Auth::guest())
          <li><a href="/auth/login">Log In</a></li>
          <li><a href="/auth/register">Register</a></li>
        @else
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" style="position: relative;">
              <img src="{{ asset('/uploads/avatars/' . Auth::user()->avatar) }}" style="width: 32px; height: 32px; position: absolute; top: 10px; left: -30px; border-radius: 50%;">
              {{ Auth::user()->name }} <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="/profile/{{ Auth::id() }}/settings">Settings</a></li>
              <li><a href="{{ url('/profile/' . Auth::id()) }}">Profile</a></li>
              
              <li role="separator" class="divider"></li>
              <li><a href="/logout">Logout</a></li>
            </ul>
          </li>
        @endif
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
