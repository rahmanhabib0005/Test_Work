@if (Route::has('login'))
    <div class="hidden fixed-top ">
          @auth
          <a href="{{ url('/logout')}}" id="logout" class="btn btn-outline-none"><u>Log Out</u></a>
     
          @else
               <a href="{{ url('/login')}}" class="btn btn-outline-none"><u>Log In</u></a>
               @if (Route::has('register'))
                    <a href="{{ url('/register-view')}}" class="btn btn-outline-none"><u>Register</u></a>
               @endif
          @endauth
    </div>
@endif

{{-- <script type="text/javascript">
     $(document).ready(function()
     {
          $('#logout').on('click',function(e)
          {
               e.preventDefault();

               jQuery.ajax({
                    url:"{{url('logout')}}",
                    method:'get'
               }).done(function(res){

               })
          })
     });
</script> --}}