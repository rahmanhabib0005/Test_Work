@extends('layouts.app')
@section('content')
<div class="container pt-5">
     <form action="/" id="addPost" method="POST" enctype="multipart/form-data">
          <div class="post-form row">
              <div class="col-12 p-2">
                <textarea class="form-control" name="description" placeholder="Write your post..."></textarea>
              </div>
              <div class="col-6 p-2">
                <input type="file" name="photo" accept="image/*" class="form-control-file" id="image-upload">
              </div>
              <div class="col-6 p-2 text-right">
                <button class="btn btn-primary">Post</button>
              </div>
          </div>
     </form>
     <div class="feed" id="posts">
     </div>
</div>


<script type="text/javascript">
     $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

    $(document).ready(function(){
     getClientData();

          $('#addPost').on('submit',function(e)
          {
               e.preventDefault();

               jQuery.ajax({
                    url:"/",
                    data: new FormData(this),
                    method:'POST',
                    dataType: 'json',
                    contentType: false,
                    cache: false,
                    processData: false,
                    success:function(res){
                         jQuery('#addPost')[0].reset();
                         getClientData();
                    }
               })
          }); 

          $(document).on('submit','#addComment',function(e){
               e.preventDefault();

               jQuery.ajax({
                    url:"/comment",
                    data: new FormData(this),
                    method:'POST',
                    dataType: 'json',
                    contentType: false,
                    cache: false,
                    processData: false,
                    success:function(res){
                         jQuery('#addComment')[0].reset();
                         getClientData();
                    }
               })
          })

    })
     
     function getClientData () 
        {
            $.ajax({
                    url:"{{url('post')}}",
                    method:'get',
                    success:function(add)
                    {
                         $('#posts').html(add);
                    }
                })
        };
</script>
@endsection