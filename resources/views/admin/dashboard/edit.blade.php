 <!-- Modal -->
 <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
         <form action="" method="post" id="updatePostForm">
            @csrf
            <input type="hidden" id="post_id">
            <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Post Edit</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="title" class="form-label">Post Title</label>
                        <input type="text" class="form-control" id="up_title" name="title" placeholder="Post Title">
                        <span id="up_tilteError" class="text-danger"></span>
                    </div>

                      <div class="mb-3">
                        <label for="description" class="form-label">Post Description</label>
                        <textarea class="form-control" name="description" id="up_description" rows="3"></textarea>
                        <span id="up_descriptionError" class="text-danger"></span>
                    </div>

                      {{-- <div class="mb-3">
                        <label for="image" class="form-label">Post Image</label>
                        <input type="file" class="form-control" name="image" id="image" placeholder="name@example.com">
                    </div> --}}
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  <button type="button" class="btn btn-primary" id="updatePost">Update</button>
                </div>
              </div>
         </form>
    </div>
  </div>

  @push('scripts')
  <script>
     function editPost(id){
        $.ajax({
            url: "{{ url('admin/posts/edit')}}" + '/' + id,
            method:"get",
            success: function(res){
               if(res.status==404){
                $('.errorMessage').html('');
                $('.errorMessage').addClass('alert alert-danger');
                $('.errorMessage').text(res.message);
               }else{
                $('#post_id').val(id);
                $('#up_title').val(res.post.title);
                $('#up_description').val(res.post.description);

               }
            }
        });
      }

      $(document).on("click","#updatePost",function(e) {
            e.preventDefault();
          var id = $('#post_id').val();
          var title = $('#up_title').val();
          var description = $('#up_description').val();

          $.ajax({
            url: "{{ url('admin/posts/update')}}" + '/' + id,
            method:"POST",
            data:{id:id,title:title,description:description},
            success: function(res){
                $('#editModal').modal('hide');
                $('#updatePostForm')[0].reset();
                $('.table').load(location.href+' .table');
                Command: toastr["success"]("Update Post Success")

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
            }, error:function(error){
                  $('#up_tilteError').text(error.responseJSON.errors.title);
                  $('#up_descriptionError').text(error.responseJSON.errors.description);
               }
          });

        });


  </script>
@endpush
