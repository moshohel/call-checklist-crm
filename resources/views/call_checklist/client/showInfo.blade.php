@extends('layouts.layout')

@section('content')
{{-- <div class="card card-default">
    <div class="card-header card-header-border-bottom">
        <h2>Detail of {{ $patient[0]->name }}</h2>
    </div>
    
</div> --}}
<div class="bg-white border rounded">
    <div class="row no-gutters">
        <div class="col-lg-4 col-xl-3">
            <div class="profile-content-left pt-5 pb-3 px-3 px-xl-5">
                <div class="contact-info pt-4">
                    <h3 class="text-dark mb-1">Patient Information</h3>
                    {{-- <p class="text-dark font-weight-medium pt-4 mb-2">Case ID</p>
                    <p>{{ $patient[0]->id }}</p> --}}
                    <p class="text-dark font-weight-medium pt-4 mb-2"> Name</p>
                    <p>{{ $patient[0]->name }}</p>
                    <p class="text-dark font-weight-medium pt-4 mb-2">Phone</p>
                    <p>{{ $patient[0]->phone }}</p>
                    <p class="text-dark font-weight-medium pt-4 mb-2">Email</p>
                    <p>{{ $patient[0]->email }}</p>
                    <p class="text-dark font-weight-medium pt-4 mb-2">Address</p>
                    <p>{{ $patient[0]->address }}</p>
                    <p class="text-dark font-weight-medium pt-4 mb-2">Department</p>
                    <p>{{ $patient[0]->department }}</p>
                </div>
            </div>
        </div>

        

        <div class="col-lg-8 col-xl-9">
            <div class="profile-content-right py-5">
                <ul class="nav nav-tabs px-3 px-xl-5 nav-style-border" id="myTab" role="tablist">
                    
                    <li class="nav-item">
                        <a class="nav-link active show" id="queries_Details-tab" data-toggle="tab" href="#queries_Details"
                            role="tab" aria-controls="queries_Details" aria-selected="true">Queries Details</a>
                    </li>
                </ul>
                <div class="tab-content px-3 px-xl-5" id="myTabContent">
                    <div class="tab-pane fade active show" id="queries_Details" role="tabpanel"
                        aria-labelledby="queries_Details-tab">
                        <div id="accordion" class="accordion">
                            @foreach ($queries as $query)
                            <div class="card">
                                <div class="card-header collapsible-title" id="headingThree" style="background-color: #f2f2f2;">
                                    <button class="btn btn-link collapsed" data-toggle="collapse"
                                        data-target="#collapseThree{{ $query->id }}" aria-expanded="false"
                                        aria-controls="collapseThree{{ $query->id }}">
                                        Query #
                                    </button>
                                </div>
                                <div id="collapseThree{{ $query->id}}" class="collapse"
                                    aria-labelledby="headingThree{{ $query->id }}" data-parent="#accordion{{ $query->id }}">
                                    <div class="card-body">
                                        <div class="media mt-1 profile-reportDetails-media">
                                            <div class="media-body">
                                                <h5 class="mt-0 text-dark" style="text-align: center;"> 
                                                    Query of {{ $query->name }}
                                                </h5>
                                                <table class="table table-striped table-responsive table-details">
                                                    <tbody>
                                                        {{-- <tr>
                                                            <td>$query->ID</td>
                                                            <td>{{ $query->id }}</td>
                                                        </tr> --}}
                                                        <tr>
                                                            <td>Name</td>
                                                            <td>{{ $query->name }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Phone</td>
                                                            <td>{{ $query->phone }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Address</td>
                                                            <td>{{ $query->address }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Query Details</td>
                                                            <td>{{ $query->note }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Email</td>
                                                            <td>{{ $query->email }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td> Date</td>
                                                            <td>{{ $query->created_at }}</td>
                                                        </tr>

                                                        <tr>
                                                            <td>Status</td>
                                                            <td>{{ $query->status }}</td>
                                                        </tr>
                                                    </tbody>
                                                </table>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
{{-- <table class="table card-table table-responsive table-responsive-large" style="width:100%" id="sampleTable">
    <thead>
      <tr>
        <th>Name</th>
        <th class="d-none d-md-table-cell">Phone</th>
        <th class="d-none d-md-table-cell">Email</th>
        <th>Address</th>
        <th>Query type</th>
        <th>Note</th>
        <th>Status</th>
        <th>Created At</th>
        <th>Options</th>
      </tr>
    </thead>

    <tbody>
        @foreach ($queries as $query)
            <tr>
                <td>
                <a class="text-dark" href="{{ route('query.show', $query->id) }}">{{ $query->name }}</a>
                </td>
                <td class="d-none d-md-table-cell text-dark">{{ $query->phone }}</td>
                <td class="d-none d-md-table-cell text-dark">{{ $query->email }}</td>
                <td class="d-none d-md-table-cell text-dark">{{ $query->address }}</td>
                <td class="d-none d-md-table-cell text-dark">{{ $query->query_type }}</td>
                <td class="d-none d-md-table-cell text-dark">{{ $query->note }}</td>
                <td class="d-none d-md-table-cell text-dark">{{ $query->status }}</td>
                <td class="d-none d-md-table-cell text-dark">{{ $query->created_at }}</td>
                <td>
                <a href="{{ route('query.show', $query->id) }}" class="badge bg-secondary">View</a>
                <a href="{{ route('query.edit', $query->id) }}" class="badge badge-success">Edit</a>
                
                </td>
            
            </tr>
        @endforeach
    </tbody>
</table> --}}
@endsection