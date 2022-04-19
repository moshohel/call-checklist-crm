<span class="text-bold">
    <strong>{{ $data['start']->format('d-M-Y') }} </strong>
    <span class="text-muted"> to </span>
    <strong> {{ $data['end']->format('d-M-Y') }} </strong>
</span>

<span class="pull-right hidden-print">
    <a role="button"
        class="btn btn-primary btn-sm"
        data-toggle="collapse"
        href="#filter"
        aria-expanded="false"
        aria-controls="filter"
        >
            Filter <i class="fa fa-filter"></i>
    </a>
    {{-- <a class="btn btn-secondary btn-sm" href="{{ URL::to('call-checklist/shojon/report/pdf/all') }}" target="_blank"><i class="fa fa-download"></i>Pdf</a> --}}

</span>
