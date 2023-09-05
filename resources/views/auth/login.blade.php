@extends('layouts.app')
@yield('section')
@section('content')
    
<div class="container mt-5">
     <div class="row d-flex justify-content-center align-item-center">
          <div class=" col-md-8 col-sm-12">
               <h1 class="text-center text-danger my-2">Login Form</h1>
               <form method="post" id="addpost" action="{{url('login')}}">
                    @if (Session::has('error'))
                        <div class="alert alert-danger">{{Session::get('error')}}</div>
                    @elseif (Session::has('success'))
                    <div class="alert alert-danger text-dark fw-bold">{{Session::get('success')}}</div>
                    @endif
                    @csrf
                    <div class="mb-3">
                    <label for="name" class="form-label ">Email Address</label>
                      <input type="email" class="form-control" value="{{old('email')}}" name="email" id="email" aria-describedby="emailHelp">
                      <span class="text-danger">
                         @error('email')
                             {{$message}}
                         @enderror
                      </span>
                    </div>
                    <div class="mb-3">
                         <label for="name" class="form-label ">Password</label>
                         <input type="password" class="form-control" name="password" id="password">
                         <span class="text-danger">
                              @error('password')
                                  {{$message}}
                              @enderror
                         </span>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </form>
          </div>
     </div>
</div>

{{-- <script type="text/javascript">
     $(document).ready(function()
     {
          $('#addpost').on('submit',function(e)
          {
               e.preventDefault();

               jQuery.ajax({
                    url:"{{url('login')}}",
                    data:jQuery('#addpost').serialize(),
                    type:'post',
                    success:function(response){
                         console.log(response);
                    }

               })
          })
     });
</script> --}}

@endsection