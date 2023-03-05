<table>
  			<thead>
  				<tr>
  					<th>#S No.</th>
  					<th>Name</th>
  					<th>Counselor name</th>
  					<th>Duration Call</th>
  					<th>Date</th>
            <th>Rating Score</th>
            <th>Recommendation</th>
            {{-- <th>Counselor greeted the client nicely</th>
            <th>Informed the client about confidentially</th>
            <th>Listens to the client attentively</th>
            <th>Showed proper empathy towards the client</th>
            <th>Build a good rapport with the client</th>
            <th>Spoke softly and Patiently with the client.</th>
            <th>Gave reassurance to the client</th>
            <th>Ask open ended question</th>
            <th>Discusses in detail the difficulties / problems with the client</th>
            <th>Discussed with the client about how to stay well</th>
            <th>Being able to apply the psychometric scale properly and share the score of the scale.</th>
            <th>Did the financial assessment properly if necessary</th>
            <th>Informs the client about the next step of the service </th>
  					<th>Answered to the enquiries of client correctly</th> --}}
  					
  				</tr>
  			</thead>
  			<tbody>
                @foreach ($data as $key => $row)
                @php $types = ['Counselor greeted the client nicely','Informed the client about confidentially','Listens to the client attentively','Showed proper empathy towards the client','Build a good rapport with the client','Spoke softly and Patiently with the client.','Gave reassurance to the client','Ask open ended question','Discusses in detail the difficulties / problems with the client','Discussed with the client about how to stay well','Being able to apply the psychometric scale properly and share the score of the scale.','Did the financial assessment properly if necessary','Informs the client about the next step of the service','Answered to the enquiries of client correctly']; @endphp
                @php
                  $check_item = json_decode($row->assessment);
                  var_dump($check_item);
                  @endphp 
                
                <tr>

                  <td>{{ $row->id  }}</td>
                  <td>{{ $row->name  }}</td>
                  <td>{{ $row->counselor_name  }}</td>
                  <td>{{ $row->duration_call  }}</td>
                  <td>{{ $row->date  }}</td>
                  <td>{{ $row->rating_score  }}</td>
                  <td>{{ $row->recommendation  }}</td>



                </tr>
                @endforeach
                {{-- @foreach($report as $key=>$row) 	
                    <tr>
                      <td>{{ $key+1 }}</td>
                      <td>{{ $row->program_name }}</td>
                      <td>{{ $row->service_providers_name }}</td>
                      <td>{{ $row->duration }}</td>
                      <td>{{ $row->caller_id }}</td>
                      <td>{{ $row->caller_name }}</td>
                      <td>{{ $row->age }}</td>
                      <td>{{ $row->education }}</td>
                      <td>{{ $row->session }}</td>
                      <td>{{ $row->distress }}</td>
                      <td>{{ $row->WHO }}</td>
                      <td>
                      @if ($row->symptoms != "" && $row->severity != "")
                       @foreach(explode(';', $row->symptoms) as $key1 => $info)
                        @foreach(explode(';', $row->severity) as $key2 =>$infoSev)
                         @if($key1 == $key2)
                          <ul>
                            <li>
                             {{ $info }} = {{ $infoSev }}
                            </li>
                          </ul>
                         @endif
                        @endforeach
                       @endforeach
                      @endif
                      </td>
                      <td>{{ $row->problem_duration }}</td>
                      <td>{{ $row->suicidal_ideation }}</td>
                      <td>{{ $row->self_harm_history }}</td>
                      @php
                      $check_item = json_decode($row->diagnosis);
                      @endphp
                      <td>
                          @if ($row->check_item != "")
                          @foreach($check_item as $info) 
                          <ul><li>{{$info}}</li></ul>
                          @endforeach
                          @endif   
                      </td>
                      @php
                      $check_item = json_decode($row->differential_diagnosis);
                      @endphp
                      <td>
                        @if($row->check_item != "")
                        @foreach($check_item as $info) 
                        <ul><li>{{$info}}</li></ul>
                        @endforeach
                        @endif
                      </td>
                      <td>{{ $row->effective }}</td>
                      <td>{{ $row->internal_referral }}</td>
                      <td>{{ $row->external_referral }}</td>
                      <td>{{ $row->session_plan }}</td>
                      <td>{{ $row->session_summary }}</td>
                  </tr>
                  @endforeach --}}
  			</tbody>
  			
  		</table>