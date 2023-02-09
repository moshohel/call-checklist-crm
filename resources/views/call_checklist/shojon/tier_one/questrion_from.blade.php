<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">গগোল্ড বোর্গের মোনসিক স্বোস্থ্য সবষয়ক প্রশ্নমোলো</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>      
        </div>
        <form id="question_from"> 
        @csrf
              <div class="modal-body">
                   <div class="form-group">
                   <table class="table table-bordered border-primary" id="dynamic_field_two">
                        <thead>
                            <tr>
                              <th scope="col">প্রশ্ন মালা !</th>
                              <th scope="col">মোটেই না</th>
                              <th scope="col">কিছুটা</th>
                              <th scope="col">বেশ খানিকটা</th>
                              <th scope="col">সর্বাধিক পরিমাণ</th>
                            </tr>
                          </thead>
                          <tbody>
                           
                           
                            <tr>
                              <td>ইদানিং আপনি যা করছেন তাতে কি মনোনিবেশ করতে পারছেন ?</td>  
                              <td><input type="checkbox" id="oneSelect" class="value_1" name="value_1[]" value="1" /></td> 
                              <td><input type="checkbox"class="value_2" id="twoSelect" name="value_2[]" value="1" /></td> 
                              <td><input type="checkbox"class="value_3" id="threeSelect" name="value_3[]" value="0" /></td> 
                              <td><input type="checkbox"class="value_4" id="fourSelect" name="value_4[]" value="0" /></td>
                            </tr>
                            <tr>
                              <td>ইদানিং দুশ্চিন্তায় আপনার নিদ্রার অত্যন্ত ব্যাঘাত ঘটে কি?</td>  
                              <td><input type="checkbox" class="value_1" id="oneSelect1" name="value_1[]" value="0" /></td> 
                              <td><input type="checkbox"class="value_2" id="twoSelect1" name="value_2[]" value="0" /></td> 
                              <td><input type="checkbox"class="value_3" id="threeSelect1" name="value_3[]" value="1" /></td> 
                              <td><input type="checkbox"class="value_4" id="fourSelect1" name="value_4[]" value="1" /></td>
                            </tr>
                            <tr>
                              <td>আপনি আজকাল প্রয়োজনীয় কাজে মনোযোগ দিতে পারেন কি?</td>  
                              <td><input type="checkbox" class="value_1" id="oneSelect2" name="value_1[]" value="1" /></td> 
                              <td><input type="checkbox"class="value_2" id="twoSelect2" name="value_2[]" value="1" /></td> 
                              <td><input type="checkbox"class="value_3" id="threeSelect2" name="value_3[]" value="0" /></td> 
                              <td><input type="checkbox"class="value_4" id="fourSelect2" name="value_4[]" value="0" /></td>
                            </tr>
                            <tr>
                              <td>আপনি কি বর্তমানে কোন কিছু সম্পর্কে সিদ্ধান্ত গ্রহণ করতে সমর্থ?</td>  
                              <td><input type="checkbox" class="value_1" id="oneSelect3" name="value_1[]" value="1" /></td> 
                              <td><input type="checkbox"class="value_2" id="twoSelect3" name="value_2[]" value="1" /></td> 
                              <td><input type="checkbox"class="value_3" id="threeSelect3" name="value_3[]" value="0" /></td> 
                              <td><input type="checkbox"class="value_4" id="fourSelect3" name="value_4[]" value="0" /></td>
                            </tr>
                            <tr>
                              <td>আপনি কি ইদানিং সর্বদা মানসিক চাপের মধ্যে থাকছেন?</td>  
                              <td><input type="checkbox" class="value_1" id="oneSelect4" name="value_1[]" value="0" /></td> 
                              <td><input type="checkbox"class="value_2" id="twoSelect4" name="value_2[]" value="0" /></td> 
                              <td><input type="checkbox"class="value_3" id="threeSelect4" name="value_3[]" value="1" /></td> 
                              <td><input type="checkbox"class="value_4" id="fourSelect4" name="value_4[]" value="1" /></td>
                            </tr>
                            <tr>
                              <td>আপনার কি মনে হয় ইদানিং আপনার অসুবিধাগুলি দুর করতে সক্ষম হচ্ছেন না?</td>  
                              <td><input type="checkbox" class="value_1" id="oneSelect5" name="value_1[]" value="0" /></td> 
                              <td><input type="checkbox"class="value_2" id="twoSelect5" name="value_2[]" value="0" /></td> 
                              <td><input type="checkbox"class="value_3" id="threeSelect5" name="value_3[]" value="1" /></td> 
                              <td><input type="checkbox"class="value_4" id="fourSelect5" name="value_4[]" value="1" /></td>
                            </tr>
                             <tr>
                              <td>আপনার দৈনন্দিন কাজগুলি উপভোগে করতে সক্ষম হচেছন কি?</td>  
                              <td><input type="checkbox" class="value_1" id="oneSelect6" name="value_1[]" value="1" /></td> 
                              <td><input type="checkbox"class="value_2" id="twoSelect6" name="value_2[]" value="1" /></td> 
                              <td><input type="checkbox"class="value_3" id="threeSelect6" name="value_3[]" value="0" /></td> 
                              <td><input type="checkbox"class="value_4" id="fourSelect6" name="value_4[]" value="0" /></td>
                            </tr>
                            <tr>
                              <td>আপনি কি ইদানিং আপনার সমস্যা গুলির মোকাবেলা করতে সক্ষম?</td>  
                              <td><input type="checkbox" class="value_1" id="oneSelect7" name="value_1[]" value="1" /></td> 
                              <td><input type="checkbox"class="value_2" id="twoSelect7" name="value_2[]" value="1" /></td> 
                              <td><input type="checkbox"class="value_3" id="threeSelect7" name="value_3[]" value="0" /></td> 
                              <td><input type="checkbox"class="value_4" id="fourSelect7" name="value_4[]" value="0" /></td>
                            </tr>
                            <tr>
                              <td>আপনি কি ইদানিং অসুখী ও বিমর্ষ বোধ করছেন?</td>  
                              <td><input type="checkbox" class="value_1" id="oneSelect8" name="value_1[]" value="0" /></td> 
                              <td><input type="checkbox"class="value_2" id="twoSelect8" name="value_2[]" value="0" /></td> 
                              <td><input type="checkbox"class="value_3" id="threeSelect8" name="value_3[]" value="1" /></td> 
                              <td><input type="checkbox"class="value_4" id="fourSelect8" name="value_4[]" value="1" /></td>
                            </tr>
                            <tr>
                              <td>বর্তমানে আপনি কি আবিশ্বাস হারিয়ে ফেলেছেন বলে মনে করেন?</td>  
                              <td><input type="checkbox" class="value_1" id="oneSelect9" name="value_1[]" value="0" /></td> 
                              <td><input type="checkbox"class="value_2" id="twoSelect9" name="value_2[]" value="0" /></td> 
                              <td><input type="checkbox"class="value_3" id="threeSelect9" name="value_3[]" value="1" /></td> 
                              <td><input type="checkbox"class="value_4" id="fourSelect9" name="value_4[]" value="1" /></td>
                            </tr>
                            <tr>
                              <td>ইদানিং আপনি কি নিজেকে একজন অযোগ্য ব্যক্তি হিসাবে গণ্য করেন?</td>  
                              <td><input type="checkbox" class="value_1" id="oneSelect10" name="value_1[]" value="0" /></td> 
                              <td><input type="checkbox"class="value_2" id="twoSelect10" name="value_2[]" value="0" /></td> 
                              <td><input type="checkbox"class="value_3" id="threeSelect10" name="value_3[]" value="1" /></td> 
                              <td><input type="checkbox"class="value_4" id="fourSelect10" name="value_4[]" value="1" /></td>
                            </tr>
                            <tr>
                              <td>সবদিক বিবেচনা করে বর্তমানে আপনি কি নিজেকে মোটামুটিভাবে সুখী মনে করেন?</td>  
                              <td><input type="checkbox" class="value_1" id="oneSelect11" name="value_1[]" value="1" /></td> 
                              <td><input type="checkbox"class="value_2" id="twoSelect11" name="value_2[]" value="1" /></td> 
                              <td><input type="checkbox"class="value_3" id="threeSelect11" name="value_3[]" value="0" /></td> 
                              <td><input type="checkbox"class="value_4" id="fourSelect11" name="value_4[]" value="0" /></td>
                            </tr>
                          </tbody> 
                    </table>
                  </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <button type="Submit"  class="btn btn-primary save_btn">Update</button>
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

        let total= 0 ;

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
                let a = 0;
                let b = 0;
                let c = 0;
                let d = 0;
          for (let i = 0; i < value_1.length; i++) {
            let x;
            if (value_1[i] == 1) {
             x = 1;
             a =a + x; 
            }
          }
          for (let i = 0; i < value_2.length; i++) {
            let x;
            if (value_2[i] == 1) {
             x = 1;
             b =b + x; 
            }
          }
          for (let i = 0; i < value_3.length; i++) {
            let x;
            if (value_3[i] == 1) {
             x = 1;
             c =c + x; 
            }
          }
          for (let i = 0; i < value_4.length; i++) {
            let x;
            if (value_4[i] == 1) {
             x = 1;
             d =d + x; 
            }
          }  
        let str1 = "(No Case)" ;   
        let str2 = "(Mild)" ;   
        let str3 = "(Moderate)" ;   
        let str4 = "(Severe)" ;   
        var length = value_1.length + value_2.length + value_3.length + value_4.length;
        if (length == 12) {          
        total = a + b + c + d;
        if(total >= 9 && total <= 12){
        document.getElementById("ghq").value = total + str4;

        $('#editModal').modal('hide');
          }else if (total >= 6 && total <= 8) {
            document.getElementById("ghq").value = total + str3;

            $('#editModal').modal('hide');
          }else if (total >= 3 && total <= 5) {
            document.getElementById("ghq").value = total + str2;

            $('#editModal').modal('hide');
          }else if (total >= 0 && total <= 2) {
            document.getElementById("ghq").value = total + str1;

            $('#editModal').modal('hide');
          }
        }             
       });
    });

</script>
<script type="text/javascript">
$('#oneSelect,#twoSelect,#threeSelect,#fourSelect').change(function() {

  if ($('#oneSelect').prop('checked') === true) {
    licSelect = true;
    $('#twoSelect,#threeSelect,#fourSelect').attr("disabled", true);
  } else {
    licSelect = false;
    if (licSelect === false) {
      $('#twoSelect,#threeSelect,#fourSelect').removeAttr("disabled");
    }

  }

  if ($('#twoSelect').prop('checked') === true) {
    licSelect = true;
    $('#oneSelect,#threeSelect,#fourSelect').attr("disabled", true);

  } else {
    if (licSelect === false) {
      $('#oneSelect,#threeSelect,#fourSelect').removeAttr("disabled");
    }
  }

  if ($('#threeSelect').prop('checked') === true) {
    licSelect = true;
    $('#oneSelect,#twoSelect,#fourSelect').attr("disabled", true);
  } else {
    if (licSelect === false) {
      $('#oneSelect,#twoSelect,#fourSelect').removeAttr("disabled");
    }

  }

  if ($('#fourSelect').prop('checked') === true) {
    licSelect = true;
    $('#oneSelect,#twoSelect,#threeSelect').attr("disabled", true);

  } else {
    if (licSelect === false) {
      $('#oneSelect,#twoSelect,#threeSelect').removeAttr("disabled");
    }
  }
});
$('#oneSelect1,#twoSelect1,#threeSelect1,#fourSelect1').change(function() {

  if ($('#oneSelect1').prop('checked') === true) {
    licSelect = true;
    $('#twoSelect1,#threeSelect1,#fourSelect1').attr("disabled", true);
  } else {
    licSelect = false;
    if (licSelect === false) {
      $('#twoSelect1,#threeSelect1,#fourSelect1').removeAttr("disabled");
    }

  }

  if ($('#twoSelect1').prop('checked') === true) {
    licSelect = true;
    $('#oneSelect1,#threeSelect1,#fourSelect1').attr("disabled", true);

  } else {
    if (licSelect === false) {
      $('#oneSelect1,#threeSelect1,#fourSelect1').removeAttr("disabled");
    }
  }

  if ($('#threeSelect1').prop('checked') === true) {
    licSelect = true;
    $('#oneSelect1,#twoSelect1,#fourSelect1').attr("disabled", true);
  } else {
    if (licSelect === false) {
      $('#oneSelect1,#twoSelect1,#fourSelect1').removeAttr("disabled");
    }

  }

  if ($('#fourSelect1').prop('checked') === true) {
    licSelect = true;
    $('#oneSelect1,#twoSelect1,#threeSelect1').attr("disabled", true);

  } else {
    if (licSelect === false) {
      $('#oneSelect1,#twoSelect1,#threeSelect1').removeAttr("disabled");
    }
  }
});


$('#oneSelect2,#twoSelect2,#threeSelect2,#fourSelect2').change(function() {

  if ($('#oneSelect2').prop('checked') === true) {
    licSelect = true;
    $('#twoSelect2,#threeSelect2,#fourSelect2').attr("disabled", true);
  } else {
    licSelect = false;
    if (licSelect === false) {
      $('#twoSelect2,#threeSelect2,#fourSelect2').removeAttr("disabled");
    }

  }

  if ($('#twoSelect2').prop('checked') === true) {
    licSelect = true;
    $('#oneSelect2,#threeSelect2,#fourSelect2').attr("disabled", true);

  } else {
    if (licSelect === false) {
      $('#oneSelect2,#threeSelect2,#fourSelect2').removeAttr("disabled");
    }
  }

  if ($('#threeSelect2').prop('checked') === true) {
    licSelect = true;
    $('#oneSelect2,#twoSelect2,#fourSelect2').attr("disabled", true);
  } else {
    if (licSelect === false) {
      $('#oneSelect2,#twoSelect2,#fourSelect2').removeAttr("disabled");
    }

  }

  if ($('#fourSelect2').prop('checked') === true) {
    licSelect = true;
    $('#oneSelect2,#twoSelect2,#threeSelect2').attr("disabled", true);

  } else {
    if (licSelect === false) {
      $('#oneSelect2,#twoSelect2,#threeSelect2').removeAttr("disabled");
    }
  }
});


$('#oneSelect3,#twoSelect3,#threeSelect3,#fourSelect3').change(function() {

  if ($('#oneSelect3').prop('checked') === true) {
    licSelect = true;
    $('#twoSelect3,#threeSelect3,#fourSelect3').attr("disabled", true);
  } else {
    licSelect = false;
    if (licSelect === false) {
      $('#twoSelect3,#threeSelect3,#fourSelect3').removeAttr("disabled");
    }

  }

  if ($('#twoSelect3').prop('checked') === true) {
    licSelect = true;
    $('#oneSelect3,#threeSelect3,#fourSelect3').attr("disabled", true);

  } else {
    if (licSelect === false) {
      $('#oneSelect3,#threeSelect3,#fourSelect3').removeAttr("disabled");
    }
  }

  if ($('#threeSelect3').prop('checked') === true) {
    licSelect = true;
    $('#oneSelect3,#twoSelect3,#fourSelect3').attr("disabled", true);
  } else {
    if (licSelect === false) {
      $('#oneSelect3,#twoSelect3,#fourSelect3').removeAttr("disabled");
    }

  }

  if ($('#fourSelect3').prop('checked') === true) {
    licSelect = true;
    $('#oneSelect3,#twoSelect3,#threeSelect3').attr("disabled", true);

  } else {
    if (licSelect === false) {
      $('#oneSelect3,#twoSelect3,#threeSelect3').removeAttr("disabled");
    }
  }
});


$('#oneSelect4,#twoSelect4,#threeSelect4,#fourSelect4').change(function() {

  if ($('#oneSelect4').prop('checked') === true) {
    licSelect = true;
    $('#twoSelect4,#threeSelect4,#fourSelect4').attr("disabled", true);
  } else {
    licSelect = false;
    if (licSelect === false) {
      $('#twoSelect4,#threeSelect4,#fourSelect4').removeAttr("disabled");
    }

  }

  if ($('#twoSelect4').prop('checked') === true) {
    licSelect = true;
    $('#oneSelect4,#threeSelect4,#fourSelect4').attr("disabled", true);

  } else {
    if (licSelect === false) {
      $('#oneSelect4,#threeSelect4,#fourSelect4').removeAttr("disabled");
    }
  }

  if ($('#threeSelect4').prop('checked') === true) {
    licSelect = true;
    $('#oneSelect4,#twoSelect4,#fourSelect4').attr("disabled", true);
  } else {
    if (licSelect === false) {
      $('#oneSelect4,#twoSelect4,#fourSelect4').removeAttr("disabled");
    }

  }

  if ($('#fourSelect4').prop('checked') === true) {
    licSelect = true;
    $('#oneSelect4,#twoSelect4,#threeSelect4').attr("disabled", true);

  } else {
    if (licSelect === false) {
      $('#oneSelect4,#twoSelect4,#threeSelect4').removeAttr("disabled");
    }
  }
});


$('#oneSelect5,#twoSelect5,#threeSelect5,#fourSelect5').change(function() {

  if ($('#oneSelect5').prop('checked') === true) {
    licSelect = true;
    $('#twoSelect5,#threeSelect5,#fourSelect5').attr("disabled", true);
  } else {
    licSelect = false;
    if (licSelect === false) {
      $('#twoSelect5,#threeSelect5,#fourSelect5').removeAttr("disabled");
    }

  }

  if ($('#twoSelect5').prop('checked') === true) {
    licSelect = true;
    $('#oneSelect5,#threeSelect5,#fourSelect5').attr("disabled", true);

  } else {
    if (licSelect === false) {
      $('#oneSelect5,#threeSelect5,#fourSelect5').removeAttr("disabled");
    }
  }

  if ($('#threeSelect5').prop('checked') === true) {
    licSelect = true;
    $('#oneSelect5,#twoSelect5,#fourSelect5').attr("disabled", true);
  } else {
    if (licSelect === false) {
      $('#oneSelect5,#twoSelect5,#fourSelect5').removeAttr("disabled");
    }

  }

  if ($('#fourSelect5').prop('checked') === true) {
    licSelect = true;
    $('#oneSelect5,#twoSelect5,#threeSelect5').attr("disabled", true);

  } else {
    if (licSelect === false) {
      $('#oneSelect5,#twoSelect5,#threeSelect5').removeAttr("disabled");
    }
  }
});


$('#oneSelect6,#twoSelect6,#threeSelect6,#fourSelect6').change(function() {

  if ($('#oneSelect6').prop('checked') === true) {
    licSelect = true;
    $('#twoSelect6,#threeSelect6,#fourSelect6').attr("disabled", true);
  } else {
    licSelect = false;
    if (licSelect === false) {
      $('#twoSelect6,#threeSelect6,#fourSelect6').removeAttr("disabled");
    }

  }

  if ($('#twoSelect6').prop('checked') === true) {
    licSelect = true;
    $('#oneSelect6,#threeSelect6,#fourSelect6').attr("disabled", true);

  } else {
    if (licSelect === false) {
      $('#oneSelect6,#threeSelect6,#fourSelect6').removeAttr("disabled");
    }
  }

  if ($('#threeSelect6').prop('checked') === true) {
    licSelect = true;
    $('#oneSelect6,#twoSelect6,#fourSelect6').attr("disabled", true);
  } else {
    if (licSelect === false) {
      $('#oneSelect6,#twoSelect6,#fourSelect6').removeAttr("disabled");
    }

  }

  if ($('#fourSelect6').prop('checked') === true) {
    licSelect = true;
    $('#oneSelect6,#twoSelect6,#threeSelect6').attr("disabled", true);

  } else {
    if (licSelect === false) {
      $('#oneSelect6,#twoSelect6,#threeSelect6').removeAttr("disabled");
    }
  }
});

$('#oneSelect7,#twoSelect7,#threeSelect7,#fourSelect7').change(function() {

  if ($('#oneSelect7').prop('checked') === true) {
    licSelect = true;
    $('#twoSelect7,#threeSelect7,#fourSelect7').attr("disabled", true);
  } else {
    licSelect = false;
    if (licSelect === false) {
      $('#twoSelect7,#threeSelect7,#fourSelect7').removeAttr("disabled");
    }

  }

  if ($('#twoSelect7').prop('checked') === true) {
    licSelect = true;
    $('#oneSelect7,#threeSelect7,#fourSelect7').attr("disabled", true);

  } else {
    if (licSelect === false) {
      $('#oneSelect7,#threeSelect7,#fourSelect7').removeAttr("disabled");
    }
  }

  if ($('#threeSelect7').prop('checked') === true) {
    licSelect = true;
    $('#oneSelect7,#twoSelect7,#fourSelect7').attr("disabled", true);
  } else {
    if (licSelect === false) {
      $('#oneSelect7,#twoSelect7,#fourSelect7').removeAttr("disabled");
    }

  }

  if ($('#fourSelect7').prop('checked') === true) {
    licSelect = true;
    $('#oneSelect7,#twoSelect7,#threeSelect7').attr("disabled", true);

  } else {
    if (licSelect === false) {
      $('#oneSelect7,#twoSelect7,#threeSelect7').removeAttr("disabled");
    }
  }
});


$('#oneSelect8,#twoSelect8,#threeSelect8,#fourSelect8').change(function() {

  if ($('#oneSelect8').prop('checked') === true) {
    licSelect = true;
    $('#twoSelect8,#threeSelect8,#fourSelect8').attr("disabled", true);
  } else {
    licSelect = false;
    if (licSelect === false) {
      $('#twoSelect8,#threeSelect8,#fourSelect8').removeAttr("disabled");
    }

  }

  if ($('#twoSelect8').prop('checked') === true) {
    licSelect = true;
    $('#oneSelect8,#threeSelect8,#fourSelect8').attr("disabled", true);

  } else {
    if (licSelect === false) {
      $('#oneSelect8,#threeSelect8,#fourSelect8').removeAttr("disabled");
    }
  }

  if ($('#threeSelect8').prop('checked') === true) {
    licSelect = true;
    $('#oneSelect8,#twoSelect8,#fourSelect8').attr("disabled", true);
  } else {
    if (licSelect === false) {
      $('#oneSelect8,#twoSelect8,#fourSelect8').removeAttr("disabled");
    }

  }

  if ($('#fourSelect8').prop('checked') === true) {
    licSelect = true;
    $('#oneSelect8,#twoSelect8,#threeSelect8').attr("disabled", true);

  } else {
    if (licSelect === false) {
      $('#oneSelect8,#twoSelect8,#threeSelect8').removeAttr("disabled");
    }
  }
});


$('#oneSelect9,#twoSelect9,#threeSelect9,#fourSelect9').change(function() {

  if ($('#oneSelect9').prop('checked') === true) {
    licSelect = true;
    $('#twoSelect9,#threeSelect9,#fourSelect9').attr("disabled", true);
  } else {
    licSelect = false;
    if (licSelect === false) {
      $('#twoSelect9,#threeSelect9,#fourSelect9').removeAttr("disabled");
    }

  }

  if ($('#twoSelect9').prop('checked') === true) {
    licSelect = true;
    $('#oneSelect9,#threeSelect9,#fourSelect9').attr("disabled", true);

  } else {
    if (licSelect === false) {
      $('#oneSelect9,#threeSelect9,#fourSelect9').removeAttr("disabled");
    }
  }

  if ($('#threeSelect9').prop('checked') === true) {
    licSelect = true;
    $('#oneSelect9,#twoSelect9,#fourSelect9').attr("disabled", true);
  } else {
    if (licSelect === false) {
      $('#oneSelect9,#twoSelect9,#fourSelect9').removeAttr("disabled");
    }

  }

  if ($('#fourSelect9').prop('checked') === true) {
    licSelect = true;
    $('#oneSelect9,#twoSelect9,#threeSelect9').attr("disabled", true);

  } else {
    if (licSelect === false) {
      $('#oneSelect9,#twoSelect9,#threeSelect9').removeAttr("disabled");
    }
  }


});$('#oneSelect10,#twoSelect10,#threeSelect10,#fourSelect10').change(function() {

  if ($('#oneSelect10').prop('checked') === true) {
    licSelect = true;
    $('#twoSelect10,#threeSelect10,#fourSelect10').attr("disabled", true);
  } else {
    licSelect = false;
    if (licSelect === false) {
      $('#twoSelect10,#threeSelect10,#fourSelect10').removeAttr("disabled");
    }

  }

  if ($('#twoSelect10').prop('checked') === true) {
    licSelect = true;
    $('#oneSelect10,#threeSelect10,#fourSelect10').attr("disabled", true);

  } else {
    if (licSelect === false) {
      $('#oneSelect10,#threeSelect10,#fourSelect10').removeAttr("disabled");
    }
  }

  if ($('#threeSelect10').prop('checked') === true) {
    licSelect = true;
    $('#oneSelect10,#twoSelect10,#fourSelect10').attr("disabled", true);
  } else {
    if (licSelect === false) {
      $('#oneSelect10,#twoSelect10,#fourSelect10').removeAttr("disabled");
    }

  }

  if ($('#fourSelect10').prop('checked') === true) {
    licSelect = true;
    $('#oneSelect10,#twoSelect10,#threeSelect10').attr("disabled", true);

  } else {
    if (licSelect === false) {
      $('#oneSelect10,#twoSelect10,#threeSelect10').removeAttr("disabled");
    }
  }
});

$('#oneSelect11,#twoSelect11,#threeSelect11,#fourSelect11').change(function() {

  if ($('#oneSelect11').prop('checked') === true) {
    licSelect = true;
    $('#twoSelect11,#threeSelect11,#fourSelect11').attr("disabled", true);
  } else {
    licSelect = false;
    if (licSelect === false) {
      $('#twoSelect11,#threeSelect11,#fourSelect11').removeAttr("disabled");
    }

  }

  if ($('#twoSelect11').prop('checked') === true) {
    licSelect = true;
    $('#oneSelect11,#threeSelect11,#fourSelect11').attr("disabled", true);

  } else {
    if (licSelect === false) {
      $('#oneSelect11,#threeSelect11,#fourSelect11').removeAttr("disabled");
    }
  }

  if ($('#threeSelect11').prop('checked') === true) {
    licSelect = true;
    $('#oneSelect11,#twoSelect11,#fourSelect11').attr("disabled", true);
  } else {
    if (licSelect === false) {
      $('#oneSelect11,#twoSelect11,#fourSelect11').removeAttr("disabled");
    }

  }

  if ($('#fourSelect11').prop('checked') === true) {
    licSelect = true;
    $('#oneSelect11,#twoSelect11,#threeSelect11').attr("disabled", true);

  } else {
    if (licSelect === false) {
      $('#oneSelect11,#twoSelect11,#threeSelect11').removeAttr("disabled");
    }
  }
});

</script>
