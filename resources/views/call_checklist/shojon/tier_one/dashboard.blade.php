@extends('call_checklist.app')
@push('styles')
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.bundle.min.js"></script> --}}
@endpush
@section('title') {{ $pageTitle }} @endsection
@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-tags"></i> <a href="{{ route('call_checklist.shojon.tierOne.dashboard') }}">Dashboard Tier-1</span></a>
            </h1>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-body">
                    <div>
                        <div class="text-center">
                        <!--    <span class="pull-right hidden-print" style="margin-left: 5px">
                                <a class="btn btn-success btn-sm" href="{{ URL::to('call-checklist/kpr/report/excel/all') }}" target="_blank"><i class="fa fa-download"></i>Excel</a>
                            </span>-->
                            {{-- @include('call_checklist._date_range_label') --}}
                            {{-- <span class="text-bold" id="headerId">
                                <strong> Last 10 days </strong>
                            </span> --}}

                            <form action="{{ route('call_checklist.shojon.tierOne.dashboard') }}" method="get" enctype="multipart/form-data" id="search">
                              @csrf
                              <div class="row card-body pt-0 pb-5 position-relative">

                                  <div class="form-group col-3" id="from_date">
                                    <label for="exampleFormControlInput6">Start Date</label>
                                    <input type="date" class="form-control"  name="start_time" id="exampleFormControlInput6" placeholder="Chamber Time">
                                  </div>
                                  <div class="form-group col-3" id="to_date">
                                    <label for="exampleFormControlInput5"> End Date</label>
                                    <input type="date" class="form-control"  name="end_time" id="exampleFormControlInput5" placeholder="Chamber Time">
                                  </div>

                                  <div class="form-group col-3 m-4 pt-2">
                                    <button type="submit" class="btn btn-info btn-default" id="search-btn">Search</button>
                                  </div>
                                </div>
                            </form>
                        </div>


                        <hr>
                    </div>

                    <div class="row">

                        <div class="col-xl-3 col-sm-6">
                            <div class="card widget-block p-4 rounded bg-primary ">
                                <div class="card-block">
                                    <h3 class="text-white">{{ $total_cnt }}</h3>
                                    <p class="py-2">NEW CLIENTS</p>
                                </div>

                            </div>
                        </div>
                        <div class="col-xl-3 col-sm-6">
                            <div class="card widget-block p-4 rounded bg-warning ">
                                <div class="card-block">
                                    <h3 class="text-white">{{ $ref_cnt_tier2 }}</h3>
                                    <p class="py-2">REFERRED TO TIER 2</p>
                                </div>

                            </div>
                        </div>
                        <div class="col-xl-3 col-sm-6">
                            <div class="card widget-block p-4 rounded bg-danger ">
                                <div class="card-block">
                                    <h3 class="text-white">{{ $ref_cnt_tier3 }}</h3>
                                    <p class="py-2">REFERRED TO TIER 3</p>
                                </div>

                            </div>
                        </div>
                        <div class="col-xl-3 col-sm-6">
                            <div class="card widget-block p-4 rounded bg-success ">
                                <div class="card-block">
                                    <h3 class="text-white">{{ $total_call_cnt }}</h3>
                                    <p class="py-2">TOTAL CALLS</p>
                                </div>

                            </div>
                        </div>

                    </div>


                </div>
            </div>
        </div>
    </div>


<div class="content-wrapper">
    <div class="content">
        <div class="row">

          <div class="col-12 col-lg-6">
            <div class="card card-default">
                <div class="card-header justify-content-center">
                    <h2 class="text-center">Call Types</h2>
                </div>
                <div class="card-body" style="height: 400px;"><div class="chartjs-size-monitor" style="position: absolute; inset: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;"><div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div></div><div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:200%;height:200%;left:0; top:0"></div></div></div>
                    <canvas id="callType" width="988" height="680" style="display: block; height: 340px; width: 494px;" class="chartjs-render-monitor"></canvas>
                </div>
            </div>
        </div>

        <div class="col-12 col-lg-6">
          <div class="card card-default" id="activity-user">
            <div class="card-header justify-content-center">
              <h2>Hourly Call Summary</h2>
            </div>
            <div class="card-body" style="height: 400px;"><div class="chartjs-size-monitor" style="position: absolute; inset: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;"><div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div></div><div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:200%;height:200%;left:0; top:0"></div></div></div>
                <canvas id="hourlyCallSummary" width="988" height="680" style="display: block; height: 340px; width: 494px;" class="chartjs-render-monitor"></canvas>
            </div>
          </div>
        </div>

        <div class="col-12 col-lg-6">
          <div class="card card-default">
              <div class="card-header justify-content-center">
                  <h2 class="text-center">Refer Summary </h2>
              </div>
              <div class="card-body" style="height: 400px;"><div class="chartjs-size-monitor" style="position: absolute; inset: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;"><div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div></div><div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:200%;height:200%;left:0; top:0"></div></div></div>
                  <canvas id="referSummary" width="988" height="680" style="display: block; height: 340px; width: 494px;" class="chartjs-render-monitor"></canvas>
              </div>
          </div>
      </div>

            <div class="col-12 col-lg-6">
                <div class="card card-default">
                    <div class="card-header justify-content-center">
                        <h2 class="text-center">Demographic - Gender</h2>
                    </div>
                    <div class="card-body" style="height: 400px;"><div class="chartjs-size-monitor" style="position: absolute; inset: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;"><div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div></div><div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:200%;height:200%;left:0; top:0"></div></div></div>
                        <canvas id="demographicGender" width="988" height="680" style="display: block; height: 340px; width: 494px;" class="chartjs-render-monitor"></canvas>
                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-6">
                <div class="card card-default">
                    <div class="card-header justify-content-center">
                        <h2 class="text-center">Top 5 Distruct</h2>
                    </div>
                    <div class="card-body" style="height: 400px;"><div class="chartjs-size-monitor" style="position: absolute; inset: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;"><div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div></div><div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:200%;height:200%;left:0; top:0"></div></div></div>
                        <canvas id="topFiveDistruct" width="988" height="680" style="display: block; height: 340px; width: 494px;" class="chartjs-render-monitor"></canvas>
                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-6">
              <div class="card card-default" id="activity-user">
                <div class="card-header justify-content-center">
                  <h2>Demographic – Age Group</h2>
                </div>
                <div class="card-body" style="height: 400px;"><div class="chartjs-size-monitor" style="position: absolute; inset: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;"><div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div></div><div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:200%;height:200%;left:0; top:0"></div></div></div>
                    <canvas id="currentUser" width="988" height="680" style="display: block; height: 340px; width: 494px;" class="chartjs-render-monitor"></canvas>
                </div>
              </div>
            </div>

            <div class="col-12 col-lg-6">
              <div class="card card-default" id="activity-user">
                <div class="card-header justify-content-center">
                  <h2>Demographic - Occupation</h2>
                </div>
                <div class="card-body" style="height: 400px;"><div class="chartjs-size-monitor" style="position: absolute; inset: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;"><div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div></div><div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:200%;height:200%;left:0; top:0"></div></div></div>
                    <canvas id="demographicOccupation" width="988" height="680" style="display: block; height: 340px; width: 494px;" class="chartjs-render-monitor"></canvas>
                </div>
              </div>
            </div>

            <div class="col-12 col-lg-6">
                <div class="card card-default">
                    <div class="card-header justify-content-center">
                        <h2 class="text-center">Lead Source</h2>
                    </div>
                    <div class="card-body" style="height: 400px;"><div class="chartjs-size-monitor" style="position: absolute; inset: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;"><div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div></div><div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:200%;height:200%;left:0; top:0"></div></div></div>
                        <canvas id="leadSource" width="988" height="680" style="display: block; height: 340px; width: 494px;" class="chartjs-render-monitor"></canvas>
                    </div>
                </div>
            </div>

          {{-- <canvas id="pieChart" width=200 height=200></canvas> --}}
          {{-- <canvas id="testChart" style="width:100%;max-width:600px"></canvas> --}}


        </div>
    </div>
</div>

<div style="display: none;" id="call_type"> {{$call_type}} </div>
<div style="display: none;" id="sex_cnt"> {{$sex_cnt}} </div>
<div style="display: none;" id="call_age"> {{$call_age}} </div>
<div style="display: none;" id="hearing_source"> {{$hearing_source}} </div>
<div style="display: none;" id="financial_aff"> {{$financial_aff}} </div>
<div style="display: none;" id="call_status"> {{$call_status}} </div>

@endsection
@push('scripts')
    {{-- <script type="text/javascript" src="{{ asset('backend/js/chart.js') }}"></script> --}}
    <script type="text/javascript" src="{{ asset('backend/js/Chart1.min.js') }}"></script>
    {{-- <script type="text/javascript" src="{{ asset('backend/js/Chart2019.min.js') }}"></script> --}}
<script>
  var data = JSON.parse(document.getElementById("call_type").innerHTML);
  var canvas = document.getElementById('callType');
  new Chart(canvas, {
      type: 'pie',
      data: {
        labels: ["FAQ", "Silent Calls", "Received Service", "Hang-Up", "Inappropriate Call"],
        datasets: [{
          data: [data.information, data.silent_calls, data.received_service, data.hang_up_call, data.inappropriate],
          backgroundColor: ['#FF6384', '#36A2EB','#FFCE56', "#20c997", "#6f42c1"]
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: true,
        plugins: {
          labels: {
            render: 'value',
            fontColor: ['green', 'white', 'red']
          }
        }
      }
  });
</script>

<script> 
  // var data = JSON.parse(document.getElementById("hourlyCallSummaryData").innerHTML);
  var cUser = document.getElementById("hourlyCallSummary");
  var xValues = [ "01-02", "02-04", "04-06", "06-08", "08-10", "10-12", "12-14", "14-16", "16-18", "18-20", "20-22", "22-24"];
  // var yValues = [data.age40_65, data.age31_40, data.age20_30, data.age13_19];
  var yValues = [24, 34, 12, 27, 55, 66, 12, 54, 33, 17, 44, 48];
  var barColors = [
    '#FF6384', 
    '#36A2EB',
    '#FFCE56', 
    "#20c997", 
    "#6f42c1", 
    "#343a40",
    "#00aba9",
    "#2b5797",
    "#e8c3b9",
    "#20c997",
    "#6f42c1"
  ];
  var data = {
    labels: xValues,
    datasets: [{
      label:  [ "41-65", "31-40", "20-30", "13-19"],
      data: yValues,
      backgroundColor: barColors
    }]
  }
    if (cUser !== null) {
    var myUChart = new Chart(cUser, {
      type: "horizontalBar",
      data: {
        labels: xValues,
        datasets: [
          {

            // label: "Italy",
            data: yValues,
            // data: [2, 3.2, 1.8, 2.1, 1.5, 3.5, 4, 2.3, 2.9, 4.5, 1.8, 3.4, 2.8],
            backgroundColor: barColors
            // backgroundColor: "#4c84ff"
          }
        ]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        legend: {
          display: false
        },
        scales: {
          xAxes: [
            {
              gridLines: {
                drawBorder: true,
                display: false,
              },
              ticks: {
                max: Math.max(...data.datasets[0].data) + 10,
                fontColor: "#8a909d",
                fontFamily: "Roboto, sans-serif",
                display: true, // hide main x-axis line
                beginAtZero: true,
                callback: function(tick, index, array) {
                  return index % 2 ? "" : tick;
                }
              },
              barPercentage: 1.8,
              categoryPercentage: 0.2
            }
          ],
          yAxes: [
            {

              gridLines: {
                drawBorder: true,
                display: true,
                color: "#eee",
                zeroLineColor: "#eee"
              },
              ticks: {
                fontColor: "#8a909d",
                fontFamily: "Roboto, sans-serif",
                display: true,
                beginAtZero: true
              },
              scaleLabel: {
                display: false,
                labelString: 'Age Group',
              }
            }
          ]
        },
      }
    });
    }
</script>

<script>
  var ctx = document.getElementById("referSummary");

  var xValues = ["SHOJON", "Slient", "SUDIN", "CCDM", "Facebook", "LAMB"];
  var yValues = [55, 49, 44, 24, 15, 79];
  var barColors = [
    "#343a40",
    "#00aba9",
    "#2b5797",
    "#e8c3b9",
    "#20c997",
    "#6f42c1"
  ];

  new Chart("referSummary", {
    type: "pie",
    data: {
      labels: xValues,
      datasets: [{
        backgroundColor: barColors,
        data: yValues
      }]
    },

    options: {
      responsive: true,
      maintainAspectRatio: true,
      plugins: {
        labels: {
          render: 'value',
          fontColor: ['green', 'white', 'red']
        }
      }
    }
  });

</script>

<script>

  var data = JSON.parse(document.getElementById("sex_cnt").innerHTML);

  var ctx = document.getElementById("demographicGender");

  var xValues = ["Male", "Female", "InterSex", "Others"];
  var yValues = [55, 49, 44, 24, 15, 79];
  var barColors = [
    "#00aba9",
    "#2b5797",
    "#e8c3b9",
    "#20c997",
    "#6f42c1"
  ];

  new Chart("demographicGender", {
    type: "pie",
    data: {
      labels: xValues,
      datasets: [{
        backgroundColor: barColors,
        data: [data[0].male_cnt, data[0].female_cnt, 10, 18]
      }]
    },

    options: {
      responsive: true,
      maintainAspectRatio: true,
      plugins: {
        labels: {
          render: 'value',
          fontColor: ['green', 'white', 'red']
        }
      }
    }
  });

</script>


<script>
  var topFiveDistruct = document.getElementById("topFiveDistruct");

  var xValues = ["Dhaka", "Faridpur", "Rangpur", "Bhola", "Khulna"];
  var yValues = [55, 49, 44, 24, 15];
  var barColors = ["red", "green","blue","orange","brown"];

  new Chart("topFiveDistruct", {
    type: "bar",
    data: {
      labels: xValues,
      datasets: [{
        backgroundColor: barColors,
        data: yValues
      }]
    },
    options: {
      legend: {display: false},
      title: {
        display: false,
        text: "Top 5 Distructs"
      },
      scales: {
          xAxes: [
            {
              gridLines: {
                drawBorder: true,
                display: false,
              },
              ticks: {
                // max: Math.max(...data.datasets[0].data) + 10,
                fontColor: "#8a909d",
                fontFamily: "Roboto, sans-serif",
                display: true, // hide main x-axis line
                // beginAtZero: true,
                // callback: function(tick, index, array) {
                //   return index % 2 ? "" : tick;
                // }
              },
              barPercentage: 1.8,
              categoryPercentage: 0.2
            }
          ],
          yAxes: [
            {
              gridLines: {
                drawBorder: true,
                display: true,
                color: "#eee",
                zeroLineColor: "#eee"
              },
              ticks: {
                fontColor: "#8a909d",
                fontFamily: "Roboto, sans-serif",
                display: true,
                beginAtZero: true
              },
              scaleLabel: {
                display: false,
                labelString: 'Age Group',
              }
            }
          ]
        },
    }
  });

</script>

<script>
    /*======== 14. CURRENT USER BAR CHART ========*/
    var data = JSON.parse(document.getElementById("call_age").innerHTML);
    // console.log(data);
    var cUser = document.getElementById("currentUser");
    var xValues = [ "41-65", "31-40", "20-30", "13-19"];
    var yValues = [data.age40_65, data.age31_40, data.age20_30, data.age13_19];
    var barColors = ["red", "green","blue","orange","brown"];
    var data = {
      labels: xValues,
      datasets: [{
        label:  [ "41-65", "31-40", "20-30", "13-19"],
        data: yValues,
        backgroundColor: barColors
      }]
    }
  if (cUser !== null) {
    var myUChart = new Chart(cUser, {
      type: "horizontalBar",
      data: {
        labels: xValues,
        datasets: [
          {
            // label: "Italy",
            data: yValues,
            // data: [2, 3.2, 1.8, 2.1, 1.5, 3.5, 4, 2.3, 2.9, 4.5, 1.8, 3.4, 2.8],
            backgroundColor: barColors
            // backgroundColor: "#4c84ff"
          }
        ]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        legend: {
          display: false
        },
        scales: {
          xAxes: [
            {
              gridLines: {
                drawBorder: true,
                display: false,
              },
              ticks: {
                max: Math.max(...data.datasets[0].data) + 10,
                fontColor: "#8a909d",
                fontFamily: "Roboto, sans-serif",
                display: true, // hide main x-axis line
                beginAtZero: true,
                callback: function(tick, index, array) {
                  return index % 2 ? "" : tick;
                }
              },
              barPercentage: 1.8,
              categoryPercentage: 0.2
            }
          ],
          yAxes: [
            {

              gridLines: {
                drawBorder: true,
                display: true,
                color: "#eee",
                zeroLineColor: "#eee"
              },
              ticks: {
                fontColor: "#8a909d",
                fontFamily: "Roboto, sans-serif",
                display: true,
                beginAtZero: true
              },
              scaleLabel: {
                display: true,
                labelString: 'Age Group',

              }

            }
          ]
        },


        // tooltips: {
        //   mode: "index",
        //   titleFontColor: "#888",
        //   bodyFontColor: "#555",
        //   titleFontSize: 12,
        //   bodyFontSize: 15,
        //   backgroundColor: "rgba(256,256,256,0.95)",
        //   displayColors: true,
        //   xPadding: 10,
        //   yPadding: 7,
        //   borderColor: "rgba(220, 220, 220, 0.9)",
        //   borderWidth: 2,
        //   caretSize: 6,
        //   caretPadding: 5
        // }
      }
    });
  }
</script>

<script>
  var demographicOccupation = document.getElementById("demographicOccupation");

  var xValues = ["Athlete", "Engineer", "Couldn't Tell", "Other", "Retired", "Unemployed", "HouseWife", "Business", "Job Holder", "Student"];
  var yValues = [55, 49, 44, 24, 15, 25, 29, 34, 24, 65];
  var barColors = ["red", "green","blue","orange","brown"];

  new Chart(demographicOccupation, {
      type: "horizontalBar",
      data: {
        labels: xValues,
        datasets: [
          {
            // label: "Italy",
            data: yValues,
            // data: [2, 3.2, 1.8, 2.1, 1.5, 3.5, 4, 2.3, 2.9, 4.5, 1.8, 3.4, 2.8],
            backgroundColor: "#e8c3b9",
            // backgroundColor: "#4c84ff"
          }
        ]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        legend: {
          display: false
        },
        scales: {
          xAxes: [
            {
              gridLines: {
                drawBorder: true,
                display: false,
              },
              ticks: {
                // max: Math.max(...data.datasets[0].data) + 10,
                fontColor: "#8a909d",
                fontFamily: "Roboto, sans-serif",
                display: true, // hide main x-axis line
                beginAtZero: true,
                callback: function(tick, index, array) {
                  return index % 2 ? "" : tick;
                }
              },
              barPercentage: 1.8,
              categoryPercentage: 0.2
            }
          ],
          yAxes: [
            {
              gridLines: {
                drawBorder: true,
                display: true,
                color: "#eee",
                zeroLineColor: "#eee"
              },
              ticks: {
                fontColor: "#8a909d",
                fontFamily: "Roboto, sans-serif",
                display: true,
                beginAtZero: true
              },
              barPercentage: 1.8,
              categoryPercentage: 0.2,

              scaleLabel: {
                display: false,
                labelString: 'Age Group',
              }
            }
          ]
        },
      }
    });

</script>

<script>
  var leadSource = document.getElementById("leadSource");

  var xValues = ["Print Media", "TV", "Radio", "SF Microfinance", "SUDIN", "Refereed By Professional", "Word of Mouth", "Social Media", "KPR", "Search Engine/Online"];
  var yValues = [55, 49, 44, 24, 5, 35, 9, 48, 24, 25];
  var barColors = ["red", "green","blue","orange","brown"];

  new Chart(leadSource, {
      type: "horizontalBar",
      data: {
        labels: xValues,
        datasets: [
          {
            // label: "Italy",
            data: yValues,
            // data: [2, 3.2, 1.8, 2.1, 1.5, 3.5, 4, 2.3, 2.9, 4.5, 1.8, 3.4, 2.8],
            backgroundColor: "#20c997",
            // backgroundColor: "#4c84ff"
          }
        ]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        legend: {
          display: false
        },
        scales: {
          xAxes: [
            {
              gridLines: {
                drawBorder: true,
                display: false,
              },
              ticks: {
                // max: Math.max(...data.datasets[0].data) + 10,
                fontColor: "#8a909d",
                fontFamily: "Roboto, sans-serif",
                display: true, // hide main x-axis line
                beginAtZero: true,
                callback: function(tick, index, array) {
                  return index % 2 ? "" : tick;
                }
              },
              barPercentage: 1.8,
              categoryPercentage: 0.2
            }
          ],
          yAxes: [
            {
              gridLines: {
                drawBorder: true,
                display: true,
                color: "#eee",
                zeroLineColor: "#eee"
              },
              ticks: {
                fontColor: "#8a909d",
                fontFamily: "Roboto, sans-serif",
                display: true,
                beginAtZero: true
              },
              barPercentage: 1.8,
              categoryPercentage: 0.2,
              scaleLabel: {
                display: false,
                labelString: 'Age Group',
              }
            }
          ]
        },
      }
    });

</script>

@endpush
