<!DOCTYPE html>
<html lang="en">
<head>
    <!-- start: Meta -->
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Sajida Foundation</title>
    <meta name="description" content="Sajida Foundation Information Statement">
    <meta name="author" content="Sajida Foundation">
    <meta name="keyword" content="">
    <style>
        @page {
            margin: 75px 0;
            padding: 0;
        }
        #main {
            padding: 0 30px;
        }
        .header_footer {
            position: fixed;
            left: 0;
            right: 0;
            background-color: #007d71;
            color: #fff;
            height: 30px;
            padding: 10px 30px;
        }
        .header {
            top: -75px;
            text-align: center;
            padding-bottom: 0;
            margin-bottom: 30px;
        }
        .header h1 {
            line-height: 0;
            font-size: 30px;
        }
        .footer {
            bottom: -75px;
            padding-bottom: 0;
            height: 30px;
            font-style: oblique;
        }
        .footer .page:after {
            content: counter(page, upper-roman);
        }

        table{
            width: 100%;
            border-collapse: collapse;
            border: 0;
            font-size: 12px;
        }
        table td,table th{
            padding: 5px 5px;
            border: 1px solid #000;
        }
    </style>
</head>
<body>
<header class="header_footer header">
    <h1>{{ \Carbon\Carbon::now()->toDateString() }} Kpr Call Checklist Report</h1>
</header>
<footer class="header_footer footer">
    <table>
        <tr>
            <td style="border: none; font-size: 16px;">Sajida Foundation.</td>
            <td style="border: none; text-align: center" class="page">Page </td>
            <td style="border: none; text-align: right; font-size: 10px">Gen. on: {{ \Carbon\Carbon::now()->format('d M, Y h:i A') }}</td>
        </tr>
    </table>
</footer>

<div id="main">
    <table>
        @if($requests->count())
            <tr>
                <td>
                    <table border="0">
                        <tr>
                            <th> Caller Name </th>
                            <th> Sex </th>
                            <th> Age </th>
                            <th> Occupation </th>
                            <th> Location </th>
                            <th> Call Type </th>
                            <th> Caller </th>
                            <th> Risk Level </th>
                            {{-- <th> Main Reason </th>
                            <th> Secondary Reason </th>
                            <th> Caller Experience </th>
                            <th> Client Referral </th>
                            <th> Caller Descriprion </th> --}}
                        </tr>

                        @foreach ($requests as $request)
                            <tr>
                                <td>{{ $request->caller_name }}</td>
                                <td>{{ $request->sex }}</td>
                                <td>{{ $request->age }}</td>
                                <td>{{ $request->occupation }}</td>
                                <td>{{ $request->location }}</td>
                                <td>{{ $request->call_type }}</td>
                                <td>{{ $request->caller }}</td>
                                <td>{{ $request->risk_level }}</td>
                                {{-- <td>{{ $request->main_reason_for_calling }}</td>
                                <td>{{ $request->secondary_reason_for_calling }}</td>
                                <td>{{ $request->caller_experience }}</td>
                                <td>{{ $request->client_referral }}</td>
                                <td>{{ $request->caller_description }}</td> --}}
                            </tr>
                        @endforeach
                    </table>
                </td>
            </tr>
        @else
            <td>
                <table>
                    <tr>
                        <th> Caller Name </th>
                        <th> Sex </th>
                        <th> Age </th>
                        <th> Occupation </th>
                        <th> Location </th>
                        <th> Call Type </th>
                        <th> Caller </th>
                        <th> Risk Level </th>
                        {{-- <th> Main Reason </th>
                        <th> Secondary Reason </th>
                        <th> Caller Experience </th>
                        <th> Client Referral </th>
                        <th> Caller Descriprion </th> --}}
                    </tr>
                    <tr>
                        <td colspan="13">No Kpr Records</td>
                    </tr>
                </table>
            </td>
        @endif
    </table>
</div>
</body>
</html>
