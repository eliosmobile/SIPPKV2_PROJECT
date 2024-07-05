@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Detail Permintaan') }}</div>

                <div class="card-body">
                    <p>{{ __('Nama Organisasi: ') . $roomRequest->organization_name }}</p>
                    <p>{{ __('Nomor Kop Surat: ') . $roomRequest->letter_number }}</p>
                    <p>{{ __('Nama Acara: ') . $roomRequest->event_name }}</p>
                    <p>{{ __('Tanggal Berawal Acara: ') . $roomRequest->event_start }}</p>
                    <p>{{ __('Tanggal Berakhir Acara: ') . $roomRequest->event_end }}</p>
                    <p>{{ __('Status: ') }}
                        @if ($roomRequest->status == 'pending')
                            <span class="badge bg-warning">{{ __('Pending') }}</span>
                        @elseif ($roomRequest->status == 'approved')
                            <span class="badge bg-success">{{ __('Approved') }}</span>
                        @else
                            <span class="badge bg-danger">{{ __('Rejected') }}</span>
                        @endif
                    </p>
                    <p>{{ __('Surat: ') }} <a href="{{ asset('storage/' . $roomRequest->letter_file_path) }}" target="_blank">{{ __('Download') }}</a></p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
