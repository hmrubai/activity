@extends('layouts.details_master') 
@section('content') 
<div class="content-wrapper">
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body"> 
                  <?php 
                  if(sizeof($posts)){
                  ?>
                    <div class="col-md-12">
                      <span class="btn btn-inverse-secondary btn-rounded btn-fw float-right"><span class="mdi mdi-clock"></span> <?php echo date("F j, Y, g:i a", strtotime($posts[0]->post_date)) ?> </span> <span class="btn btn-inverse-secondary btn-rounded btn-fw float-right"> <span class="mdi mdi-comment-outline"></span> 2</span>
                      <h3>{{ $posts[0]->title }}</h3>
                      <hr>
                      <p><?php echo $posts[0]->details; ?></p>
                        <span class="btn btn-inverse-secondary btn-rounded btn-fw"><span class="mdi mdi-account"></span> {{ $posts[0]->name }}</span>
                        <span class="btn btn-inverse-secondary btn-rounded btn-fw float-right"><span class="mdi mdi-tag"></span> {{ $posts[0]->category }}</span>
                    </div>
                  <?php 
                  }
                  ?>
                  <div class="col-md-12">
                      <br/>
                      <hr>
                      <h4>Latest Comments</h4>
                      <ul class="timeline">
                        <?php if(sizeof($comments)){ 
                          foreach($comments as $comment):
                          ?>
                            <li>
                              <a class="comment_title" href="#">{{ $comment->name }}</a>
                              <a href="#" class="float-right"><?php echo date("F j, Y, g:i a", strtotime($comment->comment_date)) ?></a>
                              <p><?php echo $comment->details; ?></p>
                            </li>
                          <?php 
                          endforeach;
                      }else{
                        ?> 
                        <li>
                          <p class="comment_title">No comments found!</p>
                        </li>
                        <?php
                      }
                       ?>
                      </ul>
                  </div>
                  <div class="col-md-12">
                    <br/>
                    <hr>
                    <h3>Write a Comment</h3>
                    <div class="form-group">
                      <textarea class="form-control" name="details" id="details" rows="8" ></textarea>
                    </div>
                    <br>
                    <button type="submit" onclick="SubmitCommentDetails()" class="btn btn-success mr-2">Save</button>
                  </div>
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

        function SubmitCommentDetails()
        {
          var details = tinyMCE.get('details').getContent();

          var params = { 
            post_id: '<?= $posts[0]->id; ?>',
            details: tinyMCE.get('details').getContent(),
            '_token': '<?= csrf_token() ?>'
          }

          if(details){
            axios.post('/saveComment', params)
            .then(function (response) {
              Swal.fire({
                position: 'top-end',
                type: 'success',
                title: 'Your comment has been submitted successfully!',
                showConfirmButton: false,
                timer: 1500
              });
              setTimeout(function() { location.reload();; }, 3000);
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

        ul.timeline {
            list-style-type: none;
            position: relative;
        }
        ul.timeline:before {
            content: ' ';
            background: #d4d9df;
            display: inline-block;
            position: absolute;
            left: 29px;
            width: 2px;
            height: 100%;
            z-index: 400;
        }
        ul.timeline > li {
            margin: 20px 0;
            padding-left: 20px;
        }
        ul.timeline > li:before {
            content: ' ';
            background: white;
            display: inline-block;
            position: absolute;
            border-radius: 50%;
            border: 3px solid #22c0e8;
            left: 20px;
            width: 20px;
            height: 20px;
            z-index: 400;
        }
        .comment_title
        {
          padding-left: 13px;
        }
        .comment_title:hover
        {
          text-decoration: none;
        }
    </style>
</div> 
@endsection
