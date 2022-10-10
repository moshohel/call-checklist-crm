<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">গোল্ডবার্গ এর মানসিক স্বাস্থ্য বিষয়ক প্রশ্নমালা</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button> 
         @php $types = ['আমি উৎফুল্ল এবং উৎসাহিতবোধ করেছি', 'আমি শান্ত এবং হালকা বোধ করেছি।', 'আমি কর্মক্ষম এবং সজীব অনুভব করেছি', 'সতেজ এবং আরামের অনুভূতি নিয়ে আমি ঘুম থেকে জেগে উঠেছি','আমি যা কিছু পছন্দ করি তা দিয়ে আমার দৈনন্দিন জীবন পূর্ণ রয়েছে']; @endphp      
        </div>
        <form id="question_from">
        @csrf
              <div class="modal-body">
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
                              <td><input type="checkbox" class="value_1" name="value_1[]" value="5" /></td> 
                              <td><input type="checkbox"class="value_2" name="value_2[]" value="4" /></td> 
                              <td><input type="checkbox"class="value_3" name="value_3[]" value="3" /></td> 
                              <td><input type="checkbox"class="value_4" name="value_4[]" value="2" /></td>
                              <td><input type="checkbox"class="value_5" name="value_5[]" value="1" /></td>
                              <td><input type="checkbox"class="value_6" name="value_6[]" value="0" /></td>
                            </tr>
                            @endforeach
                          </tbody> 
                    </table>
                  </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <button type="Submit" class="btn btn-primary save_btn">Update</button>
              </div>
        </form> 
    </div>
  </div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
       $('.save_btn').on('click',function(e){
        e.preventDefault();

        const value_1 = [];
        const value_2 = [];
        const value_3 = [];
        const value_4 = [];
        const value_5 = [];
        const value_6 = [];

        let total= 0 ;
        let data = 1;
        
          
          $('.value_1').each(function(){
                if($(this).is(":checked")){
                    value_1.push($(this).val());
                }

            });
          $('.value_2').each(function(){
                if($(this).is(":checked")){
                    value_2.push($(this).val());
                }

            });
          $('.value_3').each(function(){
                if($(this).is(":checked")){
                    value_3.push($(this).val());
                }
              
            });
          $('.value_4').each(function(){
                if($(this).is(":checked")){
                    value_4.push($(this).val());
                }

            });
          $('.value_5').each(function(){
                if($(this).is(":checked")){
                    value_5.push($(this).val());
                }

            });
          $('.value_6').each(function(){
                if($(this).is(":checked")){
                    value_6.push($(this).val());
                }

            });

                let a = 0;
                let b = 0;
                let c = 0;
                let d = 0;
                let g = 0;
                let f = 0;
                if(value_1.length!=0){
                for (let x in value_1) {
                  x=5;
                  a=a+x;
                }}else{a=0;} 
            if(value_2.length!=0){
                for (let x in value_2) {
                  x=4;
                  b=b+x;
                
            }}else{b=0;}    
            if(value_3.length!=0){    
                for (let x in value_3) {
                  x=3;
                  c=c+x;
                }}else{c=0;} 
            if(value_4.length!=0){    
                for (let x in value_4) {
                  x=2;
                  d=d+x;
                }}else{d=0;} 
            if(value_5.length!=0){    
                for (let x in value_5) {
                  x=1;
                  g=g+x;
                }}else{g=0;}
            if(value_6.length!=0){    
                for (let x in value_5) {
                  x=0;
                  f=f+x;
                }}else{f=0;} 
        total = a+b+c+d+g+f;
        data = total*4;
         document.getElementById("ghq").value = data;

        $('#editModal').modal('hide');
        //alert(data);
             
       });
    });
</script>