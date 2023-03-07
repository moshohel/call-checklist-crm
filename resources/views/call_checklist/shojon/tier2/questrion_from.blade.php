<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">WHO (Five) Well-Being Index (1988 version)</h5>
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
                <th scope="col">SR#</th>
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
              <tr><td>1</td>
                <td>আমি উৎফুল্ল এবং উৎসাহিতবোধ করেছি।</td>  
                <td><input type="checkbox" id="oneSelect" class="value_1" name="value_1[]" value="5" /></td> 
                <td><input type="checkbox"class="value_2" id="twoSelect" name="value_2[]" value="4" /></td> 
                <td><input type="checkbox"class="value_3" id="threeSelect" name="value_3[]" value="3" /></td> 
                <td><input type="checkbox"class="value_4" id="fourSelect" name="value_4[]" value="2" /></td>
                <td><input type="checkbox"class="value_5" id="fiveSelect" name="value_5[]" value="1" /></td>
                <td><input type="checkbox"class="value_6" id="sixSelect" name="value_6[]" value="0" /></td>
              </tr>
              <tr>
                <td>2</td>
                <td>আমি শান্ত এবং হালকা বোধ করেছি।</td>  
                <td><input type="checkbox" class="value_1" id="oneSelect1" name="value_1[]" value="5" /></td> 
                <td><input type="checkbox"class="value_2" id="twoSelect1" name="value_2[]" value="4" /></td> 
                <td><input type="checkbox"class="value_3" id="threeSelect1" name="value_3[]" value="3" /></td> 
                <td><input type="checkbox"class="value_4" id="fourSelect1" name="value_4[]" value="2" /></td>
                <td><input type="checkbox"class="value_5" id="fiveSelect1" name="value_5[]" value="1" /></td>
                <td><input type="checkbox"class="value_6" id="sixSelect1" name="value_6[]" value="0" /></td>
              </tr>
              <tr>
                <td>3</td>
                <td>আমি কর্মক্ষম এবং সজীব অনুভব করেছি।</td>  
                <td><input type="checkbox" class="value_1" id="oneSelect2" name="value_1[]" value="5" /></td> 
                <td><input type="checkbox"class="value_2" id="twoSelect2" name="value_2[]" value="4" /></td> 
                <td><input type="checkbox"class="value_3" id="threeSelect2" name="value_3[]" value="3" /></td> 
                <td><input type="checkbox"class="value_4" id="fourSelect2" name="value_4[]" value="2" /></td>
                <td><input type="checkbox"class="value_5" id="fiveSelect2" name="value_5[]" value="1" /></td>
                <td><input type="checkbox"class="value_6" id="sixSelect2" name="value_6[]" value="0" /></td>
              </tr>
              <tr>
                <td>4</td>
                <td>সতেজ এবং আরামের অনুভূতি নিয়ে আমি ঘুম থেকে জেগে উঠেছি।</td>  
                <td><input type="checkbox" class="value_1" id="oneSelect3" name="value_1[]" value="5" /></td> 
                <td><input type="checkbox"class="value_2" id="twoSelect3" name="value_2[]" value="4" /></td> 
                <td><input type="checkbox"class="value_3" id="threeSelect3" name="value_3[]" value="3" /></td> 
                <td><input type="checkbox"class="value_4" id="fourSelect3" name="value_4[]" value="2" /></td>
                <td><input type="checkbox"class="value_5" id="fiveSelect3" name="value_5[]" value="1" /></td>
                <td><input type="checkbox"class="value_6" id="sixSelect3" name="value_6[]" value="0" /></td>
              </tr>
              <tr>
                <td>5</td>
                <td>আমি যা কিছু পছন্দ করি তা দিয়ে আমার দৈনন্দিন জীবন পূর্ণ রয়েছে।</td>  
                <td><input type="checkbox" class="value_1" id="oneSelect4" name="value_1[]" value="5" /></td> 
                <td><input type="checkbox"class="value_2" id="twoSelect4" name="value_2[]" value="4" /></td> 
                <td><input type="checkbox"class="value_3" id="threeSelect4" name="value_3[]" value="3" /></td> 
                <td><input type="checkbox"class="value_4" id="fourSelect4" name="value_4[]" value="2" /></td>
                <td><input type="checkbox"class="value_5" id="fiveSelect4" name="value_5[]" value="1" /></td>
                <td><input type="checkbox"class="value_6" id="sixSelect4" name="value_6[]" value="0" /></td>
              </tr>
            </tbody> 
          </table>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        <button type="Submit"  class="btn btn-primary save_btnt2">Generate Score</button>
      </div>
    </form> 
  </div>
</div>
</div>

<script type="text/javascript">
  $(document).ready(function(){
   $('.save_btnt2').on('click',function(e){
    e.preventDefault();

    const value_1 = [];
    const value_2 = [];
    const value_3 = [];
    const value_4 = [];
    const value_5 = [];
    const value_6 = [];

    let total= 0 ;
    let data = 0;
    
    
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
                var length = value_1.length + value_2.length + value_3.length + value_4.length + value_5.length + value_6.length;
                if (length == 5) {          
                  total = a+b+c+d+g+f;
                  data = total*4;
                  
                  document.getElementById("ghq").value = data;

                  $('#editModal').modal('hide');
        //alert(data);
                }
                
              });
 });

</script>
<script type="text/javascript">
  $('#oneSelect,#twoSelect,#threeSelect,#fourSelect,#fiveSelect,#sixSelect').change(function() {

    if ($('#oneSelect').prop('checked') === true) {
      licSelect = true;
      $('#twoSelect,#threeSelect,#fourSelect,#fiveSelect,#sixSelect').attr("disabled", true);
    } else {
      licSelect = false;
      if (licSelect === false) {
        $('#twoSelect,#threeSelect,#fourSelect,#fiveSelect,#sixSelect').removeAttr("disabled");
      }

    }

    if ($('#twoSelect').prop('checked') === true) {
      licSelect = true;
      $('#oneSelect,#threeSelect,#fourSelect,#fiveSelect,#sixSelect').attr("disabled", true);

    } else {
      if (licSelect === false) {
        $('#oneSelect,#threeSelect,#fourSelect,#fiveSelect,#sixSelect').removeAttr("disabled");
      }
    }

    if ($('#threeSelect').prop('checked') === true) {
      licSelect = true;
      $('#oneSelect,#twoSelect,#fourSelect,#fiveSelect,#sixSelect').attr("disabled", true);
    } else {
      if (licSelect === false) {
        $('#oneSelect,#twoSelect,#fourSelect,#fiveSelect,#sixSelect').removeAttr("disabled");
      }

    }

    if ($('#fourSelect').prop('checked') === true) {
      licSelect = true;
      $('#oneSelect,#twoSelect,#threeSelect,#fiveSelect,#sixSelect').attr("disabled", true);

    } else {
      if (licSelect === false) {
        $('#oneSelect,#twoSelect,#threeSelect,#fiveSelect,#sixSelect').removeAttr("disabled");
      }
    }

    if ($('#fiveSelect').prop('checked') === true) {
      licSelect = true;
      $('#oneSelect,#twoSelect,#threeSelect,#fourSelect,#sixSelect').attr("disabled", true);

    } else {
      if (licSelect === false) {
        $('#oneSelect,#twoSelect,#threeSelect,#fourSelect,#sixSelect').removeAttr("disabled");
      }
    }

    if ($('#sixSelect').prop('checked') === true) {
      licSelect = true;
      $('#oneSelect,#twoSelect,#threeSelect,#fourSelect,#fiveSelect').attr("disabled", true);

    } else {
      if (licSelect === false) {
        $('#oneSelect,#twoSelect,#threeSelect,#fourSelect,#fiveSelect').removeAttr("disabled");
      }
    }

  });

  $('#oneSelect1,#twoSelect1,#threeSelect1,#fourSelect1,#fiveSelect1,#sixSelect1').change(function() {

    if ($('#oneSelect1').prop('checked') === true) {
      licSelect = true;
      $('#twoSelect1,#threeSelect1,#fourSelect1,#fiveSelect1,#sixSelect1').attr("disabled", true);
    } else {
      licSelect = false;
      if (licSelect === false) {
        $('#twoSelect1,#threeSelect1,#fourSelect1,#fiveSelect1,#sixSelect1').removeAttr("disabled");
      }

    }

    if ($('#twoSelect1').prop('checked') === true) {
      licSelect = true;
      $('#oneSelect1,#threeSelect1,#fourSelect1,#fiveSelect1,#sixSelect1').attr("disabled", true);

    } else {
      if (licSelect === false) {
        $('#oneSelect1,#threeSelect1,#fourSelect1,#fiveSelect1,#sixSelect1').removeAttr("disabled");
      }
    }

    if ($('#threeSelect1').prop('checked') === true) {
      licSelect = true;
      $('#oneSelect1,#twoSelect1,#fourSelect1,#fiveSelect1,#sixSelect1').attr("disabled", true);
    } else {
      if (licSelect === false) {
        $('#oneSelect1,#twoSelect1,#fourSelect1,#fiveSelect1,#sixSelect1').removeAttr("disabled");
      }

    }

    if ($('#fourSelect1').prop('checked') === true) {
      licSelect = true;
      $('#oneSelect1,#twoSelect1,#threeSelect1,#fiveSelect1,#sixSelect1').attr("disabled", true);

    } else {
      if (licSelect === false) {
        $('#oneSelect1,#twoSelect1,#threeSelect1,#fiveSelect1,#sixSelect1').removeAttr("disabled");
      }
    }

    if ($('#fiveSelect1').prop('checked') === true) {
      licSelect = true;
      $('#oneSelect1,#twoSelect1,#threeSelect1,#fourSelect1,#sixSelect1').attr("disabled", true);

    } else {
      if (licSelect === false) {
        $('#oneSelect1,#twoSelect1,#threeSelect1,#fourSelect1,#sixSelect1').removeAttr("disabled");
      }
    }

    if ($('#sixSelect1').prop('checked') === true) {
      licSelect = true;
      $('#oneSelect1,#twoSelect1,#threeSelect1,#fourSelect1,#fiveSelect1').attr("disabled", true);

    } else {
      if (licSelect === false) {
        $('#oneSelect1,#twoSelect1,#threeSelect1,#fourSelect1,#fiveSelect1').removeAttr("disabled");
      }
    }

  });

  $('#oneSelect2,#twoSelect2,#threeSelect2,#fourSelect2,#fiveSelect2,#sixSelect2').change(function() {

    if ($('#oneSelect2').prop('checked') === true) {
      licSelect = true;
      $('#twoSelect2,#threeSelect2,#fourSelect2,#fiveSelect2,#sixSelect2').attr("disabled", true);
    } else {
      licSelect = false;
      if (licSelect === false) {
        $('#twoSelect2,#threeSelect2,#fourSelect2,#fiveSelect2,#sixSelect2').removeAttr("disabled");
      }

    }

    if ($('#twoSelect2').prop('checked') === true) {
      licSelect = true;
      $('#oneSelect2,#threeSelect2,#fourSelect2,#fiveSelect2,#sixSelect2').attr("disabled", true);

    } else {
      if (licSelect === false) {
        $('#oneSelect2,#threeSelect2,#fourSelect2,#fiveSelect2,#sixSelect2').removeAttr("disabled");
        
      }

      if ($('#threeSelect2').prop('checked') === true) {
        licSelect = true;
        $('#oneSelect2,#twoSelect2,#fourSelect2,#fiveSelect2,#sixSelect2').attr("disabled", true);
      } else {
        if (licSelect === false) {
          $('#oneSelect2,#twoSelect2,#fourSelect2,#fiveSelect2,#sixSelect2').removeAttr("disabled");
        }

      }

      if ($('#fourSelect2').prop('checked') === true) {
        licSelect = true;
        $('#oneSelect2,#twoSelect2,#threeSelect2,#fiveSelect2,#sixSelect2').attr("disabled", true);

      } else {
        if (licSelect === false) {
          $('#oneSelect2,#twoSelect2,#threeSelect2,#fiveSelect2,#sixSelect2').removeAttr("disabled");
        }
      }

      if ($('#fiveSelect2').prop('checked') === true) {
        licSelect = true;
        $('#oneSelect2,#twoSelect2,#threeSelect2,#fourSelect2,#sixSelect2').attr("disabled", true);

      } else {
        if (licSelect === false) {
          $('#oneSelect2,#twoSelect2,#threeSelect2,#fourSelect2,#sixSelect2').removeAttr("disabled");
        }
      }

      if ($('#sixSelect2').prop('checked') === true) {
        licSelect = true;
        $('#oneSelect2,#twoSelect2,#threeSelect2,#fourSelect2,#fiveSelect2').attr("disabled", true);

      } else {
        if (licSelect === false) {
          $('#oneSelect2,#twoSelect2,#threeSelect2,#fourSelect2,#fiveSelect2').removeAttr("disabled");
        }
      }
    }
  });

  $('#oneSelect3,#twoSelect3,#threeSelect3,#fourSelect3,#fiveSelect3,#sixSelect3').change(function() {

    if ($('#oneSelect3').prop('checked') === true) {
      licSelect = true;
      $('#twoSelect3,#threeSelect3,#fourSelect3,#fiveSelect3,#sixSelect3').attr("disabled", true);
    } else {
      licSelect = false;
      if (licSelect === false) {
        $('#twoSelect3,#threeSelect3,#fourSelect3,#fiveSelect3,#sixSelect3').removeAttr("disabled");
      }

    }

    if ($('#twoSelect3').prop('checked') === true) {
      licSelect = true;
      $('#oneSelect3,#threeSelect3,#fourSelect3,#fiveSelect3,#sixSelect3').attr("disabled", true);

    } else {
      if (licSelect === false) {
        $('#oneSelect3,#threeSelect3,#fourSelect3,#fiveSelect3,#sixSelect3').removeAttr("disabled");
        
      }

      if ($('#threeSelect3').prop('checked') === true) {
        licSelect = true;
        $('#oneSelect3,#twoSelect3,#fourSelect3,#fiveSelect3,#sixSelect3').attr("disabled", true);
      } else {
        if (licSelect === false) {
          $('#oneSelect3,#twoSelect3,#fourSelect3,#fiveSelect3,#sixSelect3').removeAttr("disabled");
        }

      }

      if ($('#fourSelect3').prop('checked') === true) {
        licSelect = true;
        $('#oneSelect3,#twoSelect3,#threeSelect3,#fiveSelect3,#sixSelect3').attr("disabled", true);

      } else {
        if (licSelect === false) {
          $('#oneSelect3,#twoSelect3,#threeSelect3,#fiveSelect3,#sixSelect3').removeAttr("disabled");
        }
      }

      if ($('#fiveSelect3').prop('checked') === true) {
        licSelect = true;
        $('#oneSelect3,#twoSelect3,#threeSelect3,#fourSelect3,#sixSelect3').attr("disabled", true);

      } else {
        if (licSelect === false) {
          $('#oneSelect3,#twoSelect3,#threeSelect3,#fourSelect3,#sixSelect3').removeAttr("disabled");
        }
      }

      if ($('#sixSelect3').prop('checked') === true) {
        licSelect = true;
        $('#oneSelect3,#twoSelect3,#threeSelect3,#fourSelect3,#fiveSelect3').attr("disabled", true);

      } else {
        if (licSelect === false) {
          $('#oneSelect3,#twoSelect3,#threeSelect3,#fourSelect3,#fiveSelect3').removeAttr("disabled");
        }
      }
    }
  });

  $('#oneSelect4,#twoSelect4,#threeSelect4,#fourSelect4,#fiveSelect4,#sixSelect4').change(function() {

    if ($('#oneSelect4').prop('checked') === true) {
      licSelect = true;
      $('#twoSelect4,#threeSelect4,#fourSelect4,#fiveSelect4,#sixSelect4').attr("disabled", true);
    } else {
      licSelect = false;
      if (licSelect === false) {
        $('#twoSelect4,#threeSelect4,#fourSelect4,#fiveSelect4,#sixSelect4').removeAttr("disabled");
      }

    }

    if ($('#twoSelect4').prop('checked') === true) {
      licSelect = true;
      $('#oneSelect4,#threeSelect4,#fourSelect4,#fiveSelect4,#sixSelect4').attr("disabled", true);

    } else {
      if (licSelect === false) {
        $('#oneSelect4,#threeSelect4,#fourSelect4,#fiveSelect4,#sixSelect4').removeAttr("disabled");
        
      }

      if ($('#threeSelect4').prop('checked') === true) {
        licSelect = true;
        $('#oneSelect4,#twoSelect4,#fourSelect4,#fiveSelect4,#sixSelect4').attr("disabled", true);
      } else {
        if (licSelect === false) {
          $('#oneSelect4,#twoSelect4,#fourSelect4,#fiveSelect4,#sixSelect4').removeAttr("disabled");
        }

      }

      if ($('#fourSelect4').prop('checked') === true) {
        licSelect = true;
        $('#oneSelect4,#twoSelect4,#threeSelect4,#fiveSelect4,#sixSelect4').attr("disabled", true);

      } else {
        if (licSelect === false) {
          $('#oneSelect4,#twoSelect4,#threeSelect4,#fiveSelect4,#sixSelect4').removeAttr("disabled");
        }
      }

      if ($('#fiveSelect4').prop('checked') === true) {
        licSelect = true;
        $('#oneSelect4,#twoSelect4,#threeSelect4,#fourSelect4,#sixSelect4').attr("disabled", true);

      } else {
        if (licSelect === false) {
          $('#oneSelect4,#twoSelect4,#threeSelect4,#fourSelect4,#sixSelect4').removeAttr("disabled");
        }
      }

      if ($('#sixSelect4').prop('checked') === true) {
        licSelect = true;
        $('#oneSelect4,#twoSelect4,#threeSelect4,#fourSelect4,#fiveSelect4').attr("disabled", true);

      } else {
        if (licSelect === false) {
          $('#oneSelect4,#twoSelect4,#threeSelect4,#fourSelect4,#fiveSelect4').removeAttr("disabled");
        }
      }
    }
  });

</script>
