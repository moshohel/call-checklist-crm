
<div class="modal fade" id="ghq-questionnaire-modal" tabindex="-1" role="dialog"
     aria-labelledby="confirmation-modal-title">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title text-left">গোল্ডবার্গ এর মানসিক স্বাস্থ্য বিষয়ক প্রশ্নমালা</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">



                <div class="row">
                    <div class="col-md-10 mx-auto">
                        <div class="tile">

                            <div class="tile-body">

                                @php $questionairs = \App\Questionair::all(); @endphp

                                @foreach($questionairs as $questionair )

                                    <div class="form-group">
                                        <label class="control-label" for="{{$questionair->id}}">
                                            <b>{{$questionair->question}}</b></label>
                                        <select name="{{$questionair->id}}" id="{{$questionair->id}}" class="form-control">
                                            <option disabled selected>Select</option>
                                            <option value={{$questionair->value1}}>মোটেই না</option>
                                            <option value={{$questionair->value2}}>কিছুটা</option>
                                            <option value={{$questionair->value3}}>বেশ খানিকটা</option>
                                            <option value={{$questionair->value4}}>সর্বাধিক পরিমাণ</option>
                                        </select>

                                    </div>

                                @endforeach

                                {{--<div class="form-group">
                                    <label class="control-label" for="first_q"><b>ইদানিং আপনি যা করছেন তাতে কি মনোনিবেশ করতে পারছেন?</b></label>
                                    @php $types = ['মোটেই না' => 1, 'কিছুটা' => 1, 'বেশ খানিকটা' => 0, 'সর্বাধিক পরিমাণ' => 0]; @endphp
                                    <select name="first_q" id="first_q" class="form-control">
                                        <option value=0 disabled selected>Select</option>
                                        @foreach($types as $key => $item)
                                            <option value="{{ $item }}">{{ $key }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label class="control-label" for="second_q"><b>ইদানিং দুশ্চিন্তায় আপনার নিদ্রার অত্যন্ত ব্যাঘাত ঘতে কি?</b></label>
                                    @php $types = ['মোটেই না' => 0, 'কিছুটা' => 0, 'বেশ খানিকটা' => 1, 'সর্বাধিক পরিমাণ' => 1]; @endphp
                                    <select name="second_q" id="second_q" class="form-control">
                                        <option value=0 disabled selected>Select</option>
                                        @foreach($types as $key => $item)
                                            <option value="{{ $item }}">{{ $key }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label class="control-label" for="third_q"><b>আপনি আজকাল প্রয়োজনীয় কাজে মনোযোগ দিতে পারেন কি?</b></label>
                                    @php $types = ['মোটেই না' => 1, 'কিছুটা' => 1, 'বেশ খানিকটা' => 0, 'সর্বাধিক পরিমাণ' => 0]; @endphp
                                    <select name="third_q" id="third_q" class="form-control">
                                        <option value=0 disabled selected>Select</option>
                                        @foreach($types as $key => $item)
                                            <option value="{{ $item }}">{{ $key }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label class="control-label" for="fourth_q"><b>আপনি ই বর্তমানে কোন কিছু সম্পর্কে সিদ্ধান্ত গ্রহণ করতে সমর্থ?</b></label>
                                    @php $types = ['মোটেই না' => 1, 'কিছুটা' => 1, 'বেশ খানিকটা' => 0, 'সর্বাধিক পরিমাণ' => 0]; @endphp
                                    <select name="fourth_q" id="fourth_q" class="form-control">
                                        <option value=0	 disabled selected>Select</option>
                                        @foreach($types as $key => $item)
                                            <option value="{{ $item }}">{{ $key }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label class="control-label" for="fifth_q"><b>আপনি কি ইদানিং সর্বদা মানসিক চাপের মধ্যে থাকছেন?</b></label>
                                    @php $types = ['মোটেই না' => 0, 'কিছুটা' => 0, 'বেশ খানিকটা' => 1, 'সর্বাধিক পরিমাণ' => 1]; @endphp
                                    <select name="fifth_q" id="fifth_q" class="form-control">
                                        <option value=0	 disabled selected>Select</option>
                                        @foreach($types as $key => $item)
                                            <option value="{{ $item }}">{{ $key }}</option>
                                        @endforeach
                                    </select>
                                </div>--}}

                            </div>


                        </div>
                    </div>
                </div>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-success" onclick="getSum()">Submit</button>
                <button style="display: none" type="button" class="btn btn-primary" data-dismiss="modal">close</button>
            </div>

        </div>
    </div>

</div>



<script>
    function getSum() {
        let questionairs = <?php echo json_encode($questionairs); ?>;

        let sum = 0;
        questionairs.every(question => {
            let val =  document.getElementById(question.id).value;
            console.log(val);
            if(val == 'Select'){
                sum = "Incomplete";
                return false;
            }else {
                sum += parseInt(document.getElementById(question.id).value);
                return true;
            }
        });

        if(1<=sum && sum <=3)
            document.getElementById("ghq").value = sum+" (No case)";
        else if(4<=sum && sum <=5)
            document.getElementById("ghq").value = sum+" (Mild)";
        else if(6<=sum && sum <=8)
            document.getElementById("ghq").value = sum+" (Moderate)";
        else if(9<=sum && sum <=12)
            document.getElementById("ghq").value = sum+" (Severe)";
        else
            document.getElementById("ghq").value = sum;

        $('#ghq-questionnaire-modal').modal('hide');

    }
</script>
