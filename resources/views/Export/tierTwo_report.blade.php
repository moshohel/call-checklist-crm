<table>
  			<thead>
  				<tr>
  					<th>#S No.</th>
  					<th>Project name</th>
  					<th>Service provider name </th>
  					<th>Duration of call</th>
  					<th>Clients ID</th>
            <th>Clients Name</th>
            <th>Age</th>
            <th>Educational qualification</th>
            <th>Session no</th>
            <th>Distress rating</th>
            <th>Wellbeing scale rating</th>
            <th>Problem list</th>
            <th>Problem duration</th>
            <th>Suicidal ideation</th>
            <th>Self harmhistory</th>
            <th>Previous psychiatric diagnosis</th>
            <th>Current differential diagnosis</th>
            <th>Session effectiveness</th>
            <th>Internal referral</th>
            <th>External referral </th>
  					<th>Session outcomes</th>
  					<th>Session summary</th>
  				</tr>
  			</thead>
  			<tbody>
                @foreach($report as $key=>$row) 	
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
                  @endforeach
  			</tbody>
  			
  		</table>