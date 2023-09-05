@extends('layouts.app')
@yield('section')
@section('content')
    


<div class="container mt-5">
     <div class="row d-flex justify-content-center align-item-center">
          <div class=" col-md-8 col-sm-12">
               <h1 class="text-center text-danger my-3">Registration Form</h1>
               <form method="post" id="register" action="{{url('register')}}"  enctype="multipart/form-data">
                    @csrf
                         @if (Session::has('error'))
                         <div class="alert alert-danger">{{Session::get('error')}}</div>
                         @endif
                    <div class="mb-3">
                         <label for="name" class="form-label">Name</label>
                         <input type="text" class="form-control" name="name" value="{{old('name')}}" id="name" aria-describedby="emailHelp">
                         <span class="text-danger">
                              @error('name')
                              {{$message}}
                              @enderror
                         </span>
                    </div>
                    <div class="mb-3">
                         <label for="email" class="form-label">Email address</label>
                         <input type="email" class="form-control" value="{{old('email')}}" name="email" id="email" aria-describedby="emailHelp">
                         <span class="text-danger">
                              @error('email')
                              {{$message}}
                              @enderror
                         </span>
                    </div>
                    <div class="mb-3">
                         <label for="password" class="form-label">Password</label>
                         <input type="password" class="form-control" name="password" id="password">
                         <span class="text-danger">
                              @error('password')
                              {{$message}}
                              @enderror
                         </span>
                    </div>
                    <div class="mb-3">
                         <label for="confirm_password" class="form-label"> Confirm Password</label>
                         <input type="password" class="form-control" name="password_confirmation" id="confirm_password">
                         <span class="text-danger">
                              @error('password_confirmation')
                              {{$message}}
                              @enderror
                         </span>
                    </div>
                    <div class="mb-3">
                         <label for="avater" class="form-label">Upload Your Avater</label>
                         <input type="file" class="form-control" name="avater" id="avater" required>
                         <span class="text-danger">
                              @error('avater')
                              {{$message}}
                              @enderror
                         </span>
                    </div>
                    {{-- <button type="submit" class="btn btn-primary">Submit</button> --}}
                    <input type="submit" class="btn btn-primary" value="Submit">
               </form>
          </div>
     </div>
</div>  



{{-- <script type="text/javascript">
     $(document).ready(function()
     {
          $('#register').on('submit',function(e)
          {
               e.preventDefault();

               jQuery.ajax({
                    url:"{{url('register')}}",
                    data: new FormData(this),
                    method:'post',
                    dataType: 'json',
                    contentType: false,
                    cache: false,
                    processData: false,
                    success:function(res){
                         console.log(res);
                    }
               })
          })
     });
</script> --}}

@endsection
   