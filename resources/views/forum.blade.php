@extends('layouts.master') 
@section('content') 
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
<div class="content-wrapper">
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body"> 
                  <h3 style="display: inline-block;">Disscussion Board</h3>
                  <button type="button"  data-toggle="modal" data-target="#NewPost" class="btn btn-secondary float-right">New Post</button>
                  {{-- Start Modal --}}
                  <div class="modal fade" id="NewPost" tabindex="-1" role="dialog" aria-labelledby="NewPost" aria-hidden="true">
                      <div class="modal-dialog custom-dialog-position" role="document">
                        <div class="modal-content custom-modal-size">
                          <div class="modal-header">
                            <h5 class="modal-title">New Post</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                              <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Post Details</h4>
                                    <form class="forms-sample" onsubmit="event.preventDefault();" enctype="multipart/form-data" method="post" accept-charset="utf-8">
                                      <div class="form-group">
                                        <label for="post_title">Title</label>
                                        <input class="form-control" name="post_title" id="post_title" type="text" placeholder="Title">
                                      </div>
                                      <div class="form-group">
                                          <label for="category">Category</label>
                                          <select class="form-control" name="category" id="category">
                                            <?php foreach($category as $item): ?>
                                            <option value="{{ $item->id }}" >{{ $item->title }}</option>
                                          <?php endforeach; ?>
                                          </select>
                                        </div>
                                      <div class="form-group">
                                        <label for="details">Details</label>
                                        <textarea class="form-control" name="details" id="details" rows="6" ></textarea>
                                      </div>
                                      <br/>
                                      
                                      <button type="submit" onclick="SubmitPostDetails()" class="btn btn-success mr-2">Submit</button>
                                      <button class="btn btn-light">Cancel</button>
                                    </form>
                                </div>
                              </div>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- <span class="mdi mdi-tooltip-text"></span>  -->
                    {{-- End Modal --}}
                  <br/><br/>
                  <?php foreach($posts as $post): 
                    $post_details = $post['posts'];
                    $post_comment = $post['comments'];
                  ?>
                    <hr>
                    <div class="col-md-12">
                      <span class="btn btn-inverse-secondary btn-rounded btn-fw float-right"><span class="mdi mdi-clock"></span> <?php echo date("F j, Y, g:i a", strtotime($post_details['post_date'])) ?> </span> <span class="btn btn-inverse-secondary btn-rounded btn-fw float-right"> <span class="mdi mdi-comment-outline"></span> {{ $post_comment }}</span>
                      <a href="{{ url('/post-details/'.$post_details['id'] )}}" class="post_title"><h3>{{ $post_details['title'] }}</h3></a>
                      <p><?php echo $post_details['details']; ?></p>
                        <span class="btn btn-inverse-secondary btn-rounded btn-fw"><span class="mdi mdi-account"></span> {{ $post_details['name'] }}</span>
                        <span class="btn btn-inverse-secondary btn-rounded btn-fw float-right"><span class="mdi mdi-tag"></span> {{ $post_details['category'] }}</span>
                    </div>
                  <?php endforeach; ?>
                  
                </div>
            </div>
        </div>
    </div>
    <footer class="footer">
        <div class="container-fluid clearfix">
            <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © 2019 <a href="#"
                    target="_blank">DGDA</a>. All rights reserved.</span>
            <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center"><a href="#"
                    target="_blank">Cerebrum Technology Limited</a></span>
        </div>
    </footer>
    <script>
        $("#forum").addClass("active");
        
        tinymce.init({
          selector: '#details'
        });

        function SubmitPostDetails()
        {
          var title = $("#post_title").val();
          var details = tinyMCE.get('details').getContent();
          var category = $("#category").val();

          var params = { 
            title: $("#post_title").val(),
            details: tinyMCE.get('details').getContent(),
            category: $("#category").val(),
            '_token': '<?= csrf_token() ?>'
          }

          if(title && details && category){
            axios.post('/savePost', params)
            .then(function (response) {
              Swal.fire({
                position: 'top-end',
                type: 'success',
                title: 'Your information has been submitted successfully!',
                showConfirmButton: false,
                timer: 1500
              });
              setTimeout(function() { location.reload();; }, 5000);
            })
            .catch(function (error) {
              console.log(error);
            });
          }
          
        }

    </script>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            text-align: left;
            background-color: #229f5e;
            color: white;
        }

        th,
        td {
            padding: 6px;
            text-align: left;
            font-weight: 300;
            font-size: 14px;
            border: 1px solid #ddd;
        }

        tr:hover {
            background-color: #d6d5d3;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .custom-modal-size{
          width: 700px !important;
        }

        .profile-image{
          width: 40px !important;
        }

        .custom-dialog-position{
          left: -100px !important;
        }
        .add-butn{
          cursor: pointer;
        }
        .post_title{
          color: #4e4e4e !important;
        }
        .post_title:hover{
          color: #266f42 !important;
          text-decoration: none;
        }
    </style>
</div> 
@endsection
