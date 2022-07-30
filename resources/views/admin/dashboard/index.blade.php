@extends('admin.layouts.app')
@section('title','Admin')
@section('content')

  <div class="row justify-content-md-center">
       <div class="col-md-6" >
        <u><h2 class="text-center"> All Post</h2></u>
        <div class="errorMessage"></div>
        <table class="table table-bordered">
            <thead>
              <tr>
                <th>SL</th>
                <th>Post Title</th>
                <th>Description</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($posts as $post)
                     <tr>
                        <td>{{ $loop->iteration}}</td>
                        <td>{{ $post->title}}</td>
                        <td>{{ $post->description}}</td>
                        <td class="d-flex">
                            <a style="margin-right: 5px" href="javascript:void()" class="btn badge bg-primary" data-bs-toggle="modal" data-bs-target="#editModal"
                              onclick="editPost({{ $post->id }})"
                              >Edit</a>
                            <button class="btn badge bg-danger" onclick="deletePost({{ $post->id }})" > Delete</button>
                        </td>
                     </tr>
                @endforeach
            </tbody>
          </table>
          {{ $posts->links() }}
       </div>
  </div>

  @include('admin.dashboard.edit')


@endsection

@push('scripts')
<script>
   function deletePost(id){
       if(confirm('Are you sure delete post?')){
        $.ajax({
            url: "{{ url('admin/posts/delete')}}" + '/' + id,
            method:"POST",
            data:{id:id},
            success: function(res){
               if(res.status==405){
                $('.errorMessage').html('');
                $('.errorMessage').addClass('alert alert-danger');
                $('.errorMessage').text(res.message);
               }

               $('.table').load(location.href+' .table');
                Command: toastr["success"]("Post Delete Success")

                toastr.options = {
                "closeButton": true,
                "debug": false,
                "newestOnTop": false,
                "progressBar": true,
                "positionClass": "toast-top-right",
                "preventDuplicates": false,
                "onclick": null,
                "showDuration": "300",
                "hideDuration": "1000",
                "timeOut": "5000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
                }
            }
        });
       }
    }

</script>
@endpush
