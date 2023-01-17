@extends('call_checklist.app')
@push('styles')
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.bundle.min.js"></script> --}}
@endpush
@section('title') {{ $pageTitle }} @endsection
@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-tags"></i> <a href="{{ route('call_checklist.shojon.dashboard') }}">Dashboard</span></a>
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

                            <form action="{{ route('call_checklist.shojon.dashboard') }}" method="get" enctype="multipart/form-data" id="search">
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
                        <canvas id="deviceChart" width="988" height="680" style="display: block; height: 340px; width: 494px;" class="chartjs-render-monitor"></canvas>
                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-6">
                <div class="card card-default">
                    <div class="card-header justify-content-center">
                        <h2 class="text-center">General Call Status</h2>
                    </div>
                    <div class="card-body" style="height: 400px;"><div class="chartjs-size-monitor" style="position: absolute; inset: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;"><div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div></div><div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:200%;height:200%;left:0; top:0"></div></div></div>
                        <canvas id="deviceChart2" width="988" height="680" style="display: block; height: 340px; width: 494px;" class="chartjs-render-monitor"></canvas>
                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-6">
                <div class="card card-default">
                    <div class="card-header justify-content-center">
                        <h2 class="text-center">Demographic - Gender</h2>
                    </div>
                    <div class="card-body" style="height: 400px;"><div class="chartjs-size-monitor" style="position: absolute; inset: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;"><div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div></div><div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:200%;height:200%;left:0; top:0"></div></div></div>
                        <canvas id="deviceChart3" width="988" height="680" style="display: block; height: 340px; width: 494px;" class="chartjs-render-monitor"></canvas>
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
                  <h2>Referral Source</h2>
                </div>
                <div class="card-body" style="height: 400px;"><div class="chartjs-size-monitor" style="position: absolute; inset: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;"><div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div></div><div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:200%;height:200%;left:0; top:0"></div></div></div>
                    <canvas id="ReferralSource" width="988" height="680" style="display: block; height: 340px; width: 494px;" class="chartjs-render-monitor"></canvas>
                </div>
              </div>
            </div>

            <div class="col-12 col-lg-6">
                <div class="card card-default">
                    <div class="card-header justify-content-center">
                        <h2 class="text-center">Financial Affordability </h2>
                    </div>
                    <div class="card-body" style="height: 400px;"><div class="chartjs-size-monitor" style="position: absolute; inset: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;"><div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div></div><div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:200%;height:200%;left:0; top:0"></div></div></div>
                        <canvas id="FinancialAffordability" width="988" height="680" style="display: block; height: 340px; width: 494px;" class="chartjs-render-monitor"></canvas>
                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-6">
              <div class="card card-default">
                  <div class="card-header justify-content-center">
                      <h2 class="text-center">Refer Summary </h2>
                  </div>
                  <div class="card-body" style="height: 400px;"><div class="chartjs-size-monitor" style="position: absolute; inset: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;"><div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div></div><div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:200%;height:200%;left:0; top:0"></div></div></div>
                      <canvas id="pieChart" width="988" height="680" style="display: block; height: 340px; width: 494px;" class="chartjs-render-monitor"></canvas>
                  </div>
              </div>
          </div>

            <div class="col-12 col-lg-6">
              <div class="card card-default">
                  <div class="card-header justify-content-center">
                      <h2 class="text-center">Test </h2>
                  </div>
                  <div class="card-body" style="height: 400px;"><div class="chartjs-size-monitor" style="position: absolute; inset: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;"><div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div></div><div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:200%;height:200%;left:0; top:0"></div></div></div>
                      <canvas id="mmyChart" width="988" height="680" style="display: block; height: 340px; width: 494px;" class="chartjs-render-monitor"></canvas>
                  </div>
              </div>
          </div>

          <div class="col-12 col-lg-6">
            <div class="card card-default">
              <div class="card-body">

                <canvas id="myChart"></canvas>
              </div>
            </div>
          </div>

          <canvas id="pieChart" width=200 height=200></canvas>


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

    <script type="text/javascript" src="{{ asset('backend/js/plugins/jquery.dataTables.min.js') }}"></script>
    {{-- <script type="text/javascript" src="{{ asset('backend/js/chart.js') }}"></script> --}}
    {{-- <script type="text/javascript" src="{{ asset('backend/js/Chart1.min.js') }}"></script> --}}
    <script type="text/javascript" src="{{ asset('backend/js/Chart2019.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('backend/js/chartjs-plugin-labels.js') }}"></script>
    {{-- <link href="https://cdnjs.cloudflare.com/ajax/libs/SyntaxHighlighter/3.0.83/styles/shCore.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/SyntaxHighlighter/3.0.83/styles/shThemeDefault.css" rel="stylesheet">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/SyntaxHighlighter/3.0.83/scripts/shCore.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/SyntaxHighlighter/3.0.83/scripts/shBrushJScript.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/SyntaxHighlighter/3.0.83/scripts/shBrushXml.js"></script>
  <script>
    SyntaxHighlighter.all();
  </script> --}}
    {{-- <script type="text/javascript" src="{{ asset('backend/js/plugins/chart.js') }}"></script> --}}
    <script type="text/javascript" src="{{ asset('backend/js/plugins/dataTables.bootstrap.min.js') }}"></script>
    <script type="text/javascript">$('#sampleTable').DataTable();</script>
    <script>
      $(document).ready(function(){
      $("#search-btn").click(function(){
        $("#headerId").hide();
      });
    });
    </script>

<script>
    /*========  DEVICE - DOUGHNUT CHART For id="deviceChart========*/
    var data = JSON.parse(document.getElementById("call_type").innerHTML);
    // console.log(data);
    var deviceChart = document.getElementById("deviceChart");
    if (deviceChart !== null) {
        var mydeviceChart = new Chart(deviceChart, {
        type: "doughnut",
        data: {
            labels: ["Information Related", "Silent Calls", "Received Service", "Hang-Up", "Inappropriate Call"],
            datasets: [
            {
                label: ["Information Related", "Silent Calls", "Received Service", "Hang-Up", "Inappropriate Call"],
                data: [data.information, data.silent_calls, data.received_service, data.hang_up_call, data.inappropriate],
                backgroundColor: [
                "rgba(60, 179, 113, 1)",
                "rgba(115, 171, 133, 1)",
                "rgba(255, 99, 71, 1)",
                "rgba(106, 90, 205, 1)",
                "rgba(60, 60, 60, 1)",
                ],
                borderWidth: 1
            }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            legend: {
            display: true
            },
            cutoutPercentage: 75,
            tooltips: {
            callbacks: {
                title: function(tooltipItem, data) {
                return data["labels"][tooltipItem[0]["index"]];
                },
                label: function(tooltipItem, data) {
                return (
                    data["datasets"][0]["data"][tooltipItem["index"]] + " call"
                );
                }
            },

            titleFontColor: "#888",
            bodyFontColor: "#555",
            titleFontSize: 12,
            bodyFontSize: 15,
            backgroundColor: "rgba(256,256,256,0.95)",
            displayColors: true,
            xPadding: 10,
            yPadding: 7,
            borderColor: "rgba(220, 220, 220, 0.9)",
            borderWidth: 2,
            caretSize: 6,
            caretPadding: 5
            }
        }
        });
    }
</script>

<script>
    /*========  DEVICE - DOUGHNUT CHART For id="deviceChart2 ========*/

    var data = JSON.parse(document.getElementById("call_status").innerHTML);

    var deviceChart = document.getElementById("deviceChart2");
    if (deviceChart !== null) {
        var mydeviceChart = new Chart(deviceChart, {
        type: "doughnut",
        data: {
            labels: ["In-Time Call", "After Hour Call", "Drop Out Cal", "Time Out Call", "Recived Call"],
            datasets: [
            {
                label: ["In-Time Call", "After Hour Call", "Drop Out Cal", "Time Out Call", "Recived Call"],
                data: data,
                backgroundColor: [
                "rgba(60, 179, 113, 1)",
                "rgba(60, 60, 60, 1)",
                "rgba(255, 99, 71, 1)",
                "rgba(106, 90, 205, 1)",
                "rgba(2, 5, 73, 0.89)",
                ],
                borderWidth: 1
            }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            legend: {
            display: true
            },
            cutoutPercentage: 75,
            tooltips: {
            callbacks: {
                title: function(tooltipItem, data) {
                return data["labels"][tooltipItem[0]["index"]];
                },
                label: function(tooltipItem, data) {
                return (
                    data["datasets"][0]["data"][tooltipItem["index"]] + " Calls"
                );
                }
            },

            titleFontColor: "#888",
            bodyFontColor: "#555",
            titleFontSize: 12,
            bodyFontSize: 15,
            backgroundColor: "rgba(256,256,256,0.95)",
            displayColors: true,
            xPadding: 10,
            yPadding: 7,
            borderColor: "rgba(220, 220, 220, 0.9)",
            borderWidth: 2,
            caretSize: 6,
            caretPadding: 5
            }
        }
        });
    }
</script>

<script>
  // var php_var = <?php json_encode($sex_cnt);  ?>;
  
    /*========  DEVICE - DOUGHNUT CHART For id="deviceChart2 ========*/
    var data = JSON.parse(document.getElementById("sex_cnt").innerHTML);
    // var data = {!! json_encode($sex_cnt) !!};
    // var data = {{ $sex_cnt }};
    // var data = {!! json_encode($sex_cnt) !!};
    // var data = @json($sex_cnt);
    // alert(data);
    // console.log(php_var);
    console.log(data);
    console.log(typeof data);
    var deviceChart = document.getElementById("deviceChart3");
    if (deviceChart !== null) {
        var mydeviceChart = new Chart(deviceChart, {
        type: "doughnut",
        data: {
            labels: ["Male", "Female"],
            datasets: [
            {
                label: ["Male", "Female"],
                data: [data[0].male_cnt, data[0].female_cnt],
                backgroundColor: [
                "rgba(60, 179, 113, 1)",
                "rgba(2, 5, 73, 0.89)",
                                
                ],
                borderWidth: 1
            }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            legend: {
            display: true
            },
            cutoutPercentage: 75,
            tooltips: {
            callbacks: {
                title: function(tooltipItem, data) {
                return data["labels"][tooltipItem[0]["index"]];
                },
                label: function(tooltipItem, data) {
                return (
                    data["datasets"][0]["data"][tooltipItem["index"]] + " person"
                );
                }
            },

            titleFontColor: "#888",
            bodyFontColor: "#555",
            titleFontSize: 12,
            bodyFontSize: 15,
            backgroundColor: "rgba(256,256,256,0.95)",
            displayColors: true,
            xPadding: 10,
            yPadding: 7,
            borderColor: "rgba(220, 220, 220, 0.9)",
            borderWidth: 2,
            caretSize: 6,
            caretPadding: 5
            }
        }
        });
    }
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
  /*========  DEVICE - DOUGHNUT CHART For id="deviceChart2 ========*/

  var data = JSON.parse(document.getElementById("hearing_source").innerHTML);
  var deviceChart = document.getElementById("ReferralSource");
  if (deviceChart !== null) {
      var mydeviceChart = new Chart(deviceChart, {
      type: "doughnut",
      data: {
          labels: ["Social Media", "Word of mouth", "KPR", "Don't know"],
          datasets: [
          {
              label: ["Social Media", "Word of mouth", "KPR", "Don't know"],
              data: [data.social_medial, data.word_of_mouth, data.shojon_counselor, data.dont_know],
              backgroundColor: [
              "rgba(60, 179, 113, 1)",
              "rgba(60, 60, 60, 1)",
              "rgba(255, 99, 71, 1)",
              "rgba(106, 90, 205, 1)",
              
              ],
              borderWidth: 1
          }
          ]
      },
      options: {
          responsive: true,
          maintainAspectRatio: false,
          legend: {
          display: true
          },
          cutoutPercentage: 75,
          tooltips: {
          callbacks: {
              title: function(tooltipItem, data) {
              return data["labels"][tooltipItem[0]["index"]];
              },
              label: function(tooltipItem, data) {
              return (
                  data["datasets"][0]["data"][tooltipItem["index"]] + " "
              );
              }
          },

          titleFontColor: "#888",
          bodyFontColor: "#555",
          titleFontSize: 12,
          bodyFontSize: 15,
          backgroundColor: "rgba(256,256,256,0.95)",
          displayColors: true,
          xPadding: 10,
          yPadding: 7,
          borderColor: "rgba(220, 220, 220, 0.9)",
          borderWidth: 2,
          caretSize: 6,
          caretPadding: 5
          }
      }
      });
  }
</script>

<script>
  /*======== 14. CURRENT USER BAR CHART ========*/
  var data = JSON.parse(document.getElementById("financial_aff").innerHTML);
  // console.log(data);
  var cUser = document.getElementById("FinancialAffordability");
  var xValues = [ "<0-50", "51-100", "101-200"];
  var yValues = data;
  var barColors = ["blue","orange","brown"];
  var data = {
    labels: xValues,
    datasets: [{
      label:  [ "41-65", "31-40", "20-30"],
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
                labelString: 'IN TAKA',

              }
              
            }
          ]
        },

      }
    });
  }
</script>

<script>
  var ctx = document.getElementById("mmyChart");
  // debugger;
  var data = {
    labels: ["2 Jan", "9 Jan", "16 Jan", "23 Jan", "30 Jan", "6 Feb", "13 Feb"],
    datasets: [{
      data: [15, 87, 56, 50, 88, 60, 45],
      backgroundColor: "#4082c4"
    }]
  }
  var myChart = new Chart(ctx, {
    type: 'bar',
    data: data,
    options: {
      "hover": {
        "animationDuration": 0
      },
      "animation": {
        "duration": 1,
        "onComplete": function() {
          var chartInstance = this.chart,
            ctx = chartInstance.ctx;

          ctx.font = Chart.helpers.fontString(Chart.defaults.global.defaultFontSize, Chart.defaults.global.defaultFontStyle, Chart.defaults.global.defaultFontFamily);
          ctx.textAlign = 'center';
          ctx.textBaseline = 'bottom';

          this.data.datasets.forEach(function(dataset, i) {
            var meta = chartInstance.controller.getDatasetMeta(i);
            meta.data.forEach(function(bar, index) {
              var data = dataset.data[index];
              ctx.fillText(data, bar._model.x, bar._model.y - 5);
            });
          });
        }
      },
      legend: {
        "display": true,
        position: 'right'
      },
      tooltips: {
        "enabled": false
      },
      scales: {
        yAxes: [{
          display: false,
          gridLines: {
            display: false
          },
          ticks: {
            max: Math.max(...data.datasets[0].data) + 10,
            display: false,
            beginAtZero: true
          },
          scaleLabel: {
                display: true,
                labelString: 'IN Taka',

              }
        }],
        xAxes: [{
          gridLines: {
            display: false
          },
          ticks: {
            beginAtZero: true
          }
        }]
      }
    }
  });
</script>

<script>
  var ctx = document.getElementById("pieChart");

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

  new Chart("pieChart", {
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
  var canvas = document.getElementById('myChart');
new Chart(canvas, {
    type: 'pie',    
    data: {
      labels: ['January', 'February', 'March'],
      datasets: [{
        data: [50445, 33655, 15900],
        backgroundColor: ['#FF6384', '#36A2EB','#FFCE56']
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

{{-- <script>
  var data = {
    datasets: [{
        data: [
            11,
            16,
            7,
            3,
            14
        ],
        backgroundColor: [
            "#FF6384",
            "#4BC0C0",
            "#FFCE56",
            "#E7E9ED",
            "#36A2EB"
        ],
        label: 'My dataset' // for legend
    }],
    labels: [
        "Red",
        "Green",
        "Yellow",
        "Grey",
        "Blue"
    ]
};

var pieOptions = {
  events: false,
  animation: {
    duration: 500,
    easing: "easeOutQuart",
    onComplete: function () {
      var ctx = this.chart.ctx;
      ctx.font = Chart.helpers.fontString(Chart.defaults.global.defaultFontFamily, 'normal', Chart.defaults.global.defaultFontFamily);
      ctx.textAlign = 'center';
      ctx.textBaseline = 'bottom';

      this.data.datasets.forEach(function (dataset) {

        for (var i = 0; i < dataset.data.length; i++) {
          var model = dataset._meta[Object.keys(dataset._meta)[0]].data[i]._model,
              total = dataset._meta[Object.keys(dataset._meta)[0]].total,
              mid_radius = model.innerRadius + (model.outerRadius - model.innerRadius)/2,
              start_angle = model.startAngle,
              end_angle = model.endAngle,
              mid_angle = start_angle + (end_angle - start_angle)/2;

          var x = mid_radius * Math.cos(mid_angle);
          var y = mid_radius * Math.sin(mid_angle);

          ctx.fillStyle = '#fff';
          if (i == 3){ // Darker text color for lighter background
            ctx.fillStyle = '#444';
          }
          var percent = String(Math.round(dataset.data[i]/total*100)) + "%";      
          //Don't Display If Legend is hide or value is 0
          if(dataset.data[i] != 0 && dataset._meta[0].data[i].hidden != true) {
            ctx.fillText(dataset.data[i], model.x + x, model.y + y);
            // Display percent in another line, line break doesn't work for fillText
            ctx.fillText(percent, model.x + x, model.y + y + 15);
          }
        }
      });               
    }
  }
};

var pieChartCanvas = $("#pieChart");
var pieChart = new Chart(pieChartCanvas, {
  type: 'pie', // or doughnut
  data: data,
  options: pieOptions
});
</script> --}}
@endpush
