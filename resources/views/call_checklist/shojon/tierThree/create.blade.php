@extends('call_checklist.appCreate')
@section('title') {{ $pageTitle }} @endsection
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"/>
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="tile">
                    <a href="#" class="btn btn-info btn-sm" data-id="#" data-toggle="modal" data-target="#question_Modal" ><i class="fas fa-edit"></i></a>
            </div>
        </div>
    </div>        


{{-- edit modal --}}
<div class="modal fade" id="question_Modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">গোল্ডবার্গ এর মানসিক স্বাস্থ্য বিষয়ক প্রশ্নমালা</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
         @php $types = ['আমি উৎফুল্ল এবং উৎসাহিতবোধ করেছি', 'আমি শান্ত এবং হালকা বোধ করেছি।', 'আমি কর্মক্ষম এবং সজীব অনুভব করেছি', 'সতেজ এবং আরামের অনুভূতি নিয়ে আমি থেকে জেগে উঠেছি','আমি যা কিছু পছন্দ করি তা দিয়ে আমার দৈনন্দিন জীবন পূর্ণ রয়েছে']; @endphp
        </div>
        
              <div class="modal-body">
                  <form id="question_from"> 
                   <div class="form-group">
                   <table class="table table-bordered border-primary" id="dynamic_field_two">
                        <thead>
                            <tr>
                              <th scope="col">গত দুই সপ্তাহে</th>
                              <th scope="col">সবসময়</th>
                              <th scope="col">বেশিরভাগ সময়</th>
                              <th scope="col">অর্ধেকের বেশি সময়</th>
                              <th scope="col">অর্ধেকের কম সময়</th>
                              <th scope="col">মাঝে মাঝে</th>
                              <th scope="col">কখনোই না</th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach($types as $data)
                            <tr>
                             <td>{{$data}}</td>  
                              <td><input type="checkbox"class="value" name="value[]" value="5" /></td>
                              <td><input type="checkbox"class="value" name="value[]" value="4" /></td> 
                              <td><input type="checkbox"class="value" name="value[]" value="3" /></td> 
                              <td><input type="checkbox"class="value" name="value[]" value="2" /></td>
                              <td><input type="checkbox"class="value" name="value[]" value="1" /></td>
                              <td><input type="checkbox"class="value" name="value[]" value="0" /></td>
                            </tr>
                            @endforeach
                          </tbody>
                    </table>
                  </div>
              
              <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <button type="Submit" id="submit" class="btn btn-primary">submit</button>
              </div>
           </form>   
    </div>
  </div>
</div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script type="text/javascript">
    $(document).ready(function(){
        $('.question_from').submit(function(e) {
            e.preventDefault();
            var value = [];
            $(".value").each(function(){
                if($(this).is(":checked")){
                   value.push($(this).val());
                }
            });
             
             value = value.toString();
             console.log(value);

        });
    });
</script>
@endsection