@if(session()->has('notice'))
    <div class="alert bg-primary alert-dismissible" role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      {{ session()->get('notice') }}
    </div>
@endif
