 <!-- Modal -->
 <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
         <form action="" method="post" id="addPostForm">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Post Create</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="title" class="form-label">Post Title</label>
                        <input type="text" class="form-control" id="title" name="title" placeholder="Post Title">
                        <span id="tilteError" class="text-danger"></span>
                    </div>

                      <div class="mb-3">
                        <label for="description" class="form-label">Post Description</label>
                        <textarea class="form-control" name="description" id="description" rows="3" placeholder="Describe post here..."></textarea>
                        <span id="descriptionError" class="text-danger"></span>
                    </div>

                      {{-- <div class="mb-3">
                        <label for="image" class="form-label">Post Image</label>
                        <input type="file" class="form-control" name="image" id="image" placeholder="name@example.com">
                    </div> --}}
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  <button type="button" class="btn btn-primary" onclick="addPost()">Create</button>
                </div>
              </div>
         </form>
    </div>
  </div>

  @push('scripts')

  <script>
         $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

        function addPost(){
           var title = $('#title').val();
           var description = $('#description').val();
           $.ajax({
            url: "{{ url('admin/posts/store')}}",
            method:"POST",
            data:{title:title,description:description},
            success: function(res){
                $('#exampleModal').modal('hide');
                $('#addPostForm')[0].reset();
                $('.table').load(location.href+' .table');
                Command: toastr["success"]("Add Post Success")

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
                  $('#tilteError').text(error.responseJSON.errors.title);
                  $('#descriptionError').text(error.responseJSON.errors.description);
               }
        });
      }
  </script>
  @endpush


