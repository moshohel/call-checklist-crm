<!DOCTYPE html>
<html lang="en">
<head>
    <title>@yield('title') - {{ config('app.name') }}</title>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/css/main.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/css/font-awesome/4.7.0/css/font-awesome.min.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/slider/css/rSlider.min.css') }}"/>
    {{-- <link rel="stylesheet" type="text/css"  href="{{ asset('plugins/date-picker/css/bootstrap-datetimepicker.min.css') }}"> --}}
</head>
<body class="app sidenav-toggled rtl">
    @include('call_checklist.partials.header')
    <main class="app-content">
        @yield('content')
    </main>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/js/jquery.dataTables.min.js" defer></script>
    {{-- <script src="{{ asset('backend/js/jquery-3.2.1.min.js') }}"></script> --}}
    <script src="{{ asset('backend/js/popper.min.js') }}"></script>
    <script src="{{ asset('backend/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('backend/js/main.js') }}"></script>
    <script src="{{ asset('backend/js/plugins/pace.min.js') }}"></script>
    <script src="{{ asset('plugins/slider/js/rSlider.min.js') }}"></script>
    {{-- <script src="{{ asset('plugins/date-picker/moment.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('plugins/date-picker/js/bootstrap-datetimepicker.min.js') }}"> </script>    @stack('scripts') --}}

@section('datatables')
    <script>
        $(document).ready(function () {
            $('.sampleTable').DataTable({
                responsive: true
            });
            // $('.date-picker').datetimepicker({
            //         format: 'YYYY-MM-DD'
            //     });
        });
    </script>
@show

@yield('script')

</body>
</html>
