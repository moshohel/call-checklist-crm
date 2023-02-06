@extends('call_checklist.app')
@push('styles')
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.bundle.min.js"></script> --}}
<link
      href="https://fonts.googleapis.com/css?family=Montserrat:400,500|Poppins:400,500,600,700|Roboto:400,500"
      rel="stylesheet"
    />
    <link
      href="https://cdn.materialdesignicons.com/3.0.39/css/materialdesignicons.min.css"
      rel="stylesheet"
    />
@endpush
@section('title') {{ $pageTitle }} @endsection
@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-tags"></i> <a href="{{ route('call_checklist.shojon.doctor.dashboard') }}">{{ $pageTitle }}</span></a>
            </h1>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-body">
                    <div>
                        {{-- <div class="text-center">
                            <form action="{{ route('call_checklist.shojon.doctor.dashboard') }}" method="get" enctype="multipart/form-data" id="search">
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
                        </div> --}}
                        {{-- <hr> --}}
                    </div>

                    <p>Schedule Overview</p>
                    <div class="row">
                        <div class="col-xl-3 col-sm-6">
                            <div class="card widget-block p-4 rounded bg-primary ">
                                <div class="card-block">
                                    <h3 class="text-white">{{ $total_cnt }}</h3>
                                    <p class="py-2">Scheduled/Upcoming</p>
                                </div>

                            </div>
                        </div>
                        <div class="col-xl-3 col-sm-6">
                            <div class="card widget-block p-4 rounded bg-warning ">
                                <div class="card-block">
                                    <h3 class="text-white">{{ $ref_cnt_tier2 }}</h3>
                                    <p class="py-2">Schedule Request</p>
                                </div>

                            </div>
                        </div>
                        <div class="col-xl-3 col-sm-6">
                            <div class="card widget-block p-4 rounded bg-danger ">
                                <div class="card-block">
                                    <h3 class="text-white">{{ $ref_cnt_tier3 }}</h3>
                                    <p class="py-2">Reschedule Request</p>
                                </div>

                            </div>
                        </div>
                        <div class="col-xl-3 col-sm-6">
                            <div class="card widget-block p-4 rounded bg-success ">
                                <div class="card-block">
                                    <h3 class="text-white">{{ $total_call_cnt }}</h3>
                                    <p class="py-2">Cancellation Request</p>
                                </div>

                            </div>
                        </div>
                    </div>

                    <p>Client & Seddion Summary</p>
                    <div class="row">
                        <div class="col-xl-3 col-sm-6">
                            <div class="card widget-block p-4 rounded bg-primary ">
                                <div class="card-block">
                                    <h3 class="text-white">{{ $total_cnt }}</h3>
                                    <p class="py-2">Total Client Served</p>
                                </div>

                            </div>
                        </div>
                        <div class="col-xl-3 col-sm-6">
                            <div class="card widget-block p-4 rounded bg-warning ">
                                <div class="card-block">
                                    <h3 class="text-white">{{ $ref_cnt_tier2 }}</h3>
                                    <p class="py-2">Total Sessions</p>
                                </div>

                            </div>
                        </div>
                        <div class="col-xl-3 col-sm-6">
                            <div class="card widget-block p-4 rounded bg-danger ">
                                <div class="card-block">
                                    <h3 class="text-white">{{ $ref_cnt_tier3 }}</h3>
                                    <p class="py-2">Total Terminated</p>
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

          {{-- <div class="col-12 col-lg-6">
            <div class="card card-default">
                <div class="card-header justify-content-center">
                    <h2 class="text-center">Call Types</h2>
                </div>
                <div class="card-body" style="height: 400px;"><div class="chartjs-size-monitor" style="position: absolute; inset: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;"><div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div></div><div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:200%;height:200%;left:0; top:0"></div></div></div>
                    <canvas id="callType" width="988" height="680" style="display: block; height: 340px; width: 494px;" class="chartjs-render-monitor"></canvas>
                </div>
            </div>
        </div> --}}

        <div class="col-12">
          <div class="card card-default" id="activity-user">
            <div class="card-header justify-content-center">
              <h6>Monthlu Session Summary</h6>
            </div>
            <div class="card-body" style="height: 400px;">
              
                <canvas id="hourlyCallSummary"  ></canvas>
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
  var xValues = [ "Jan-22", "Feb-22", "Mar-22", "Apr-22", "May-22", "Jun-22", "Jul-22", "Aug-22", "Jan-22", "Jan-22", "Jan-22", "Jan-22"];
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
      type: "bar",
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
          // xAxes: [
          //   {
          //     gridLines: {
          //       drawBorder: false,
          //       display: false,
          //     },
          //     ticks: {
          //       // max: Math.max(...data.datasets[0].data) + 10,
          //       fontColor: "#8a909d",
          //       fontFamily: "Roboto, sans-serif",
          //       display: true, // hide main x-axis line
          //       beginAtZero: true,
          //       callback: function(tick, index, array) {
          //         return index % 2 ? "" : tick;
          //       }
          //     },
          //     barPercentage: 4,
          //     categoryPercentage: 0.2
          //   }
          // ],
          yAxes: [
            {

              gridLines: {
                drawBorder: false,
                display: false,
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
  var ctx = document.getElementById("suicideRisk");

  var xValues = ["NO", "Don't Know", "Mild", "Moderate", "Severe", "Medical Emergency"];
  var yValues = [55, 49, 44, 24, 15, 79];
  var barColors = [
    "#B8D6FA",
    "#AD9F9F",
    "#E6ACAB",
    "#ED6565",
    "#F03232",
    "#FE0000",
  ];

  new Chart("suicideRisk", {
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
  var primaryReasonForCall = document.getElementById("primaryReasonForCall");

  var xValues = ["Mental Illness", "Substance Abuse", "Family/Relationship Issues", "Health/Physical Concerns", "Financial Concerns", "Immediate Emotional Crisis", "Child Abuse", "Education", "Bereavement", "Don’t know"];
  var yValues = [55, 49, 44, 24, 5, 35, 9, 48, 24, 25];
  var barColors = ["red", "green","blue","orange","brown"];

  new Chart(primaryReasonForCall, {
      type: "horizontalBar",
      data: {
        labels: xValues,
        datasets: [
          {
            // label: "Italy",
            data: yValues,
            // data: [2, 3.2, 1.8, 2.1, 1.5, 3.5, 4, 2.3, 2.9, 4.5, 1.8, 3.4, 2.8],
            backgroundColor: "#6f42c1",
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
  var topDifferentialDiagnosisT2 = document.getElementById("topDifferentialDiagnosisT2");

  var xValues = ["Print Media", "TV", "Radio", "SF Microfinance", "SUDIN", "Refereed By Professional", "Word of Mouth", "Social Media", "KPR", "Search Engine/Online"];
  var yValues = [55, 49, 44, 24, 5, 35, 9, 48, 24, 25];
  var barColors = ["red", "green","blue","orange","brown"];

  new Chart(topDifferentialDiagnosisT2, {
      type: "horizontalBar",
      data: {
        labels: xValues,
        datasets: [
          {
            // label: "Italy",
            data: yValues,
            // data: [2, 3.2, 1.8, 2.1, 1.5, 3.5, 4, 2.3, 2.9, 4.5, 1.8, 3.4, 2.8],
            backgroundColor: "#2b5797",
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
  var topDifferentialDiagnosisT3 = document.getElementById("topDifferentialDiagnosisT3");

  var xValues = ["Print Media", "TV", "Radio", "SF Microfinance", "SUDIN", "Refereed By Professional", "Word of Mouth", "Social Media", "KPR", "Search Engine/Online"];
  var yValues = [55, 49, 44, 24, 5, 35, 9, 48, 24, 25];
  var barColors = ["red", "green","blue","orange","brown"];

  new Chart(topDifferentialDiagnosisT3, {
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
            backgroundColor: "#00aba9",
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
  var ctx = document.getElementById("linechart");
  if (ctx !== null) {
    var chart = new Chart(ctx, {
      // The type of chart we want to create
      type: "line",

      // The data for our dataset
      data: {
        labels: [
          "Jan",
          "Feb",
          "Mar",
          "Apr",
          "May",
          "Jun",
          "Jul",
          "Aug",
          "Sep",
          "Oct",
          "Nov",
          "Dec"
        ],
        datasets: [
          {
            label: "",
            backgroundColor: "transparent",
            borderColor: "rgb(82, 136, 255)",
            data: [
              100,
              11000,
              10000,
              14000,
              11000,
              17000,
              14500,
              18000,
              5000,
              23000,
              14000,
              19000
            ],
            lineTension: 0.3,
            pointRadius: 5,
            pointBackgroundColor: "rgba(255,255,255,1)",
            pointHoverBackgroundColor: "rgba(255,255,255,1)",
            pointBorderWidth: 2,
            pointHoverRadius: 8,
            pointHoverBorderWidth: 1
          }
        ]
      },

      // Configuration options go here
      options: {
        responsive: true,
        maintainAspectRatio: false,
        legend: {
          display: false
        },
        layout: {
          padding: {
            right: 10
          }
        },
        scales: {
          xAxes: [
            {
              gridLines: {
                display: false
              }
            }
          ],
          yAxes: [
            {
              gridLines: {
                display: true,
                color: "#eee",
                zeroLineColor: "#eee",
              },
              ticks: {
                callback: function(value) {
                  var ranges = [
                    { divider: 1e6, suffix: "M" },
                    { divider: 1e4, suffix: "k" }
                  ];
                  function formatNumber(n) {
                    for (var i = 0; i < ranges.length; i++) {
                      if (n >= ranges[i].divider) {
                        return (
                          (n / ranges[i].divider).toString() + ranges[i].suffix
                        );
                      }
                    }
                    return n;
                  }
                  return formatNumber(value);
                }
              }
            }
          ]
        },
        tooltips: {
          callbacks: {
            title: function(tooltipItem, data) {
              return data["labels"][tooltipItem[0]["index"]];
            },
            label: function(tooltipItem, data) {
              return "$" + data["datasets"][0]["data"][tooltipItem["index"]];
            }
          },
          responsive: true,
          intersect: false,
          enabled: true,
          titleFontColor: "#888",
          bodyFontColor: "#555",
          titleFontSize: 12,
          bodyFontSize: 18,
          backgroundColor: "rgba(256,256,256,0.95)",
          xPadding: 20,
          yPadding: 10,
          displayColors: false,
          borderColor: "rgba(220, 220, 220, 0.9)",
          borderWidth: 2,
          caretSize: 10,
          caretPadding: 15
        }
      }
    });
  }
</script>

@endpush
