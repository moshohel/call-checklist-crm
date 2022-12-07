
    <!-- Product Table -->
    <div class="card card-table-border-none" id="recent-orders">  
        <div class="card-body">
            @include('call_checklist.partials.messages')
            <table class="table table-striped" id="sampleTable">
                <thead>
                <tr>
                    <th>Name</th>
                    <th class="d-none d-md-table-cell">Client ID</th>
                    <th class="d-none d-md-table-cell">Sex</th>
                    <th class="d-none d-md-table-cell">Age</th>
                    <th class="d-none d-md-table-cell">Occupation</th>
                    <th class="d-none d-md-table-cell">Economic status</th>
                    <th >Options</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($patients as $patient)
                    <tr>
                    
                        <td >{{ $patient->name }}</td>
                        <td class="d-none d-md-table-cell text-dark">{{ $patient->unique_id }}</td>
                        <td class="d-none d-md-table-cell text-dark already_referred">{{ $patient->sex }}</td>
                        <td class="d-none d-md-table-cell text-dark">{{ $patient->age }}</td>
                        <td class="d-none d-md-table-cell text-dark">{{ $patient->occupation }}</td>
                        <td class="d-none d-md-table-cell text-dark">{{ $patient->socio_economic_status }}</td>
                        <td>
                            <a href="{{ route('patient.show', [ $patient->id]) }}" class="btn btn-info btn-default">Info</a>
                        </td>

                    </tr>
                @endforeach
                </tbody>
            
            </table>
        </div>
    </div>