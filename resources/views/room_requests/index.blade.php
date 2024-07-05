@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('History Permintaan Ruangan') }}</div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>{{ __('Nama Organisasi') }}</th>
                                <th>{{ __('Nomor Kop Surat') }}</th>
                                <th>{{ __('Nama Acara') }}</th>
                                <th>{{ __('Tanggal Berawal Acara') }}</th>
                                <th>{{ __('Tanggal Berakhir Acara') }}</th>
                                <th>{{ __('Status') }}</th>
                                <th>{{ __('Actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($roomRequests as $request)
                                <tr>
                                    <td>{{ $request->organization_name }}</td>
                                    <td>{{ $request->letter_number }}</td>
                                    <td>{{ $request->event_name }}</td>
                                    <td>{{ $request->event_start }}</td>
                                    <td>{{ $request->event_end }}</td>
                                    <td>
                                        @if ($request->status == 'pending')
                                            <span class="badge bg-warning">{{ __('Pending') }}</span>
                                        @elseif ($request->status == 'approved')
                                            <span class="badge bg-success">{{ __('Approved') }}</span>
                                        @else
                                            <span class="badge bg-danger">{{ __('Rejected') }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('room_requests.show', $request->id) }}" class="btn btn-info">{{ __('View') }}</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
