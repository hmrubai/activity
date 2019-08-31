@extends('layouts.master') 
@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body"> 
                  Meeting List 
                  <button type="button"  data-toggle="modal" data-target="#AddMeeting" class="btn btn-secondary float-right">Add New Meeting</button>
                  {{-- Start Modal --}}
                  <div class="modal fade" id="AddMeeting" tabindex="-1" role="dialog" aria-labelledby="AddMeeting" aria-hidden="true">
                    <div class="modal-dialog custom-dialog-position" role="document">
                      <div class="modal-content custom-modal-size">
                        <div class="modal-header">
                          <h5 class="modal-title">Add Meeting</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                            <div class="card">
                              <div class="card-body">
                                  
                                  <h4 class="card-title">Meeting Details</h4>
                                  <form class="forms-sample">
                                    <div class="form-group">
                                      <label for="exampleInputName1">Date & Time</label>
                                      <input class="form-control" placeholder="dd/mm/yyyy">
                                    </div>
                                    <div class="form-group">
                                      <label for="exampleInputEmail3">Chairperson</label>
                                      <input type="text" class="form-control" id="exampleInputEmail3" placeholder="Chairperson">
                                    </div>
                                    <div class="form-group">
                                      <label for="exampleInputEmail3">Participant</label>
                                      <select class="form-control" multiple size="6">
                                        <option>MAJ. GEN. MD MAHBUBUR RAHMAN</option>
                                        <option>MD. RUHUL AMIN</option>
                                        <option>NAYER SULTANA</option>
                                        <option>DR. KHANDAKER SAGIR AHMED</option>
                                        <option>MD. ALTAF HOSSAIN</option>
                                        <option>MD. NURUL ISLAM</option>
                                        <option>MD. MOSTAFIZUR RAHMAN</option>
                                        <option>MD. AYUB HOSSAIN</option>
                                        <option>MD. ASHRAF HOSSAIN</option>
                                        <option>MIRZA MD. ANWARUL BASHED</option>
                                        <option>MOHAMMAD MOZAMMEL HOSSAIN</option>
                                        <option>MD. EYAHYA</option>
                                        <option>MD. SALAH UDDIN</option>
                                        <option>MD.MOHID ISLAM</option>
                                      </select>
                                    </div>
                                    <div class="form-group">
                                      <label for="exampleInputPassword4">	Vanue</label>
                                      <input type="text" class="form-control" id="exampleInputPassword4" placeholder="Vanue">
                                    </div>
                                    <div class="form-group">
                                      <label>File upload</label>
                                      <input type="file" name="img[]" class="file-upload-default">
                                      <div class="input-group col-xs-12">
                                        <input type="text" class="form-control file-upload-info" disabled="" placeholder="Upload Image">
                                        <span class="input-group-append">
                                          <button class="file-upload-browse btn btn-info" type="button">Upload</button>
                                        </span>
                                      </div>
                                    </div>
                                    <div class="form-group">
                                      <label for="exampleInputCity1">Agenda</label>
                                      <input type="text" class="form-control" id="exampleInputCity1" placeholder="Agenda">
                                    </div>
                                    <div class="form-group">
                                      <label for="exampleTextarea1">Action Items</label>
                                      <textarea class="form-control" id="exampleTextarea1" rows="5" spellcheck="false">
                                        - ভলেন্টারি রিকল করলে ঔষূধ প্রশাশন কে জানাতে হবে
                                        - বিভিন্ন মিডিয়ায় বিজ্ঞপ্তি প্রকাশ করতে হবে
                                        - পোস্ট মার্কেটিং সারভিলাঞ্চ সংক্রান্ত কার্যাদি পরিচালনা করার বাবস্থা থাকতে হবে
                                        - মতামতের ভিত্তিতে গাইড লাইন টি চূড়ান্ত করতে হবে
                                        - ্রডাক্ট রিকল ডিপো / ফার্মাসি / প্যাশেন্ট লেভেল পর্যন্ত থাকতে হবে
                                      </textarea>
                                    </div>
                                    <button type="submit" class="btn btn-success mr-2">Submit</button>
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
                  {{-- End Modal --}}

                  <br/><br/>
                  <table>
                      <thead>
                          <tr>
                              <th>Date</th>
                              <th>Chairperson</th>
                              <th>Time</th>
                              <th>Vanue</th>
                              <th>Agenda</th>
                              <th>Action</th>
                          </tr>
                      </thead>
                      <tbody>
                          <tr>
                            <td>2019-07-01</td>
                            <td>জনাব রুহুল আমিন, পরিচালক  </td>
                            <td>সকাল ১০ ঘটিকা</td>
                            <td>ঔষূধ প্রশাশন অধিদপ্তর - সম্মেলন কক্ষ</td>
                            <td>Pharmaceutical Product Recall Gonosunani</td>
                            <td>
                              <button type="button" class="btn btn-success">Details</button>
                              <button type="button" data-toggle="modal" data-target="#DetailsActionItem" class="btn btn-warning">Action Items</button>
                            </td>
                          </tr>
                          <tr>
                            <td>2019-06-26</td>
                            <td>জনাব রুহুল আমিন, পরিচালক  </td>
                            <td>দুপুর ১২ ঘটিকা</td>
                            <td>সম্মেলন কক্ষ</td>
                            <td>Recipe Related Circular</td>
                            <td>
                              <button type="button" class="btn btn-success">Details</button>
                              <button type="button" data-toggle="modal" data-target="#DetailsActionItem" class="btn btn-warning">Action Items</button>
                            </td>
                          </tr>
                          <tr>
                            <td>2019-06-23</td>
                            <td>জনাব রুহুল আমিন, পরিচালক  </td>
                            <td>দুপুর ২ ঘটিকা</td>
                            <td>ঔষূধ প্রশাশন অধিদপ্তর - সম্মেলন কক্ষ</td>
                            <td>Vokta Audhikar</td>
                            <td>
                              <button type="button" class="btn btn-success">Details</button>
                              <button type="button" data-toggle="modal" data-target="#DetailsActionItem" class="btn btn-warning">Action Items</button>
                            </td>
                          </tr>
                          <tr>
                            <td>2019-04-26</td>
                            <td>জনাব রুহুল আমিন, পরিচালক  </td>
                            <td>দুপুর ১২ ঘটিকা</td>
                            <td>ঔষূধ প্রশাশন অধিদপ্তর - সম্মেলন কক্ষ</td>
                            <td>Nokol Vazal Proterode</td>
                            <td>
                              <button type="button" class="btn btn-success">Details</button>
                              <button type="button" data-toggle="modal" data-target="#DetailsActionItem" class="btn btn-warning">Action Items</button>
                            </td>
                          </tr>
                          <tr>
                            <td>2019-04-13</td>
                            <td>জনাব রুহুল আমিন, পরিচালক  </td>
                            <td>বিকেল ৪ ঘটিকা</td>
                            <td>ঔষূধ প্রশাশন অধিদপ্তর</td>
                            <td>Food Supliment</td>
                            <td>
                              <button type="button" class="btn btn-success">Details</button>
                              <button type="button" data-toggle="modal" data-target="#DetailsActionItem" class="btn btn-warning">Action Items</button>
                            </td>
                          </tr>
                      </tbody>
                  </table>

                  {{-- Start Modal --}}
                  <div class="modal fade" id="DetailsActionItem" tabindex="-1" role="dialog" aria-labelledby="DetailsActionItem" aria-hidden="true">
                    <div class="modal-dialog custom-dialog-position" role="document">
                      <div class="modal-content custom-modal-size">
                        <div class="modal-header">
                          <h5 class="modal-title">Action items Of Pharmaceutical Product Recall Gonosunani  (Date: 2019-07-01)</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                            <div class="card">
                              <div class="card-body">
                                  <table>
                                    <thead>
                                      <tr>
                                        <th>SL#</th>
                                        <th>New Actions/Decisions</th>
                                        <th>Responsibilities</th>
                                        <th>Dateline</th>
                                        <th>Status</th>
                                      </tr>
                                    </thead>
                                      <tr>
                                          <td>1.</td>
                                          <td>ভলেন্টারি রিকল করলে ঔষূধ প্রশাশন কে জানাতে হবে</td>
                                          <td>আমদানিকারি প্রতিষ্ঠান</td>
                                          <td>2019-07-20</td>
                                          <td>
                                            <button type="button" class="btn btn-primary btn-rounded btn-fw">On Going</button>
                                          </td>
                                      </tr>
                                      <tr>
                                          <td>2.</td>
                                          <td>বিভিন্ন মিডিয়ায় বিজ্ঞপ্তি প্রকাশ করতে হবে </td>
                                          <td>আমদানিকারি প্রতিষ্ঠান</td>
                                          <td>2019-07-03</td>
                                          <td>
                                            <button type="button" class="btn btn-danger btn-rounded btn-fw">Not Done</button>
                                          </td>
                                      </tr>
                                      <tr>
                                          <td>3.</td>
                                          <td>পোস্ট মার্কেটিং সারভিলাঞ্চ সংক্রান্ত কার্যাদি পরিচালনা করার বাবস্থা থাকতে হবে</td>
                                          <td>আমদানিকারি প্রতিষ্ঠান</td>
                                          <td>2019-07-10</td>
                                          <td>
                                            <button type="button" class="btn btn-success btn-rounded btn-fw">Done</button>
                                          </td>
                                      </tr>
                                      <tr>
                                          <td>4.</td>
                                          <td>মতামতের ভিত্তিতে গাইড লাইন টি চূড়ান্ত করতে হবে  </td>
                                          <td>আমদানিকারি প্রতিষ্ঠান</td>
                                          <td>2019-07-02</td>
                                          <td>
                                            <button type="button" class="btn btn-warning btn-rounded btn-fw">Attempted</button>
                                          </td>
                                      </tr>
                                      <tr>
                                          <td>5.</td>
                                          <td>প্রডাক্ট রিকল ডিপো / ফার্মাসি / প্যাশেন্ট লেভেল পর্যন্ত থাকতে হবে</td>
                                          <td>আমদানিকারি প্রতিষ্ঠান</td>
                                          <td>2019-07-17</td>
                                          <td>
                                            <button type="button" class="btn btn-primary btn-rounded btn-fw">On Going</button>
                                          </td>
                                      </tr>
                                  </table>
                              </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                      </div>
                    </div>
                  </div>
                  {{-- End Modal --}}


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
        $("#meeting_list").addClass("active");
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
          width: 1000px !important;
        }

        .custom-dialog-position{
          left: -245px !important;
        }
    </style>
</div> 
@endsection
