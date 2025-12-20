@extends('layouts.master')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-body">

                    <h4 class="mb-3 text-center">
                        Verifikasi Sertifikat Digital
                    </h4>

                    <p class="text-muted text-center mb-4">
                        Upload file sertifikat (PDF) untuk memverifikasi keasliannya
                    </p>

                    <form id="verifyForm"
                          action="{{ route('verification.verify') }}"
                          method="POST"
                          enctype="multipart/form-data">
                        @csrf

                        <!-- FILE INPUT -->
                        <div class="mb-3">
                            <label class="form-label">
                                File Sertifikat (PDF)
                            </label>
                            <input type="file"
                                   name="certificate_file"
                                   class="form-control"
                                   accept="application/pdf"
                                   required>
                        </div>

                        <!-- SUBMIT -->
                        <div class="d-grid">
                            <button id="verifyBtn" type="submit" class="btn btn-primary">
                                Verifikasi Sertifikat
                            </button>
                        </div>
                    </form>

                    <!-- LOADING -->
                    <div id="loading" class="text-center mt-4 d-none">
                        <div class="spinner-border text-primary" role="status"></div>
                        <p class="mt-2">Memverifikasi sertifikat...</p>
                    </div>
                    {{-- HASIL VERIFIKASI --}}
                    @if(session('verification_result'))
                        <div class="alert mt-4 
                            {{ session('verification_result') === 'VALID' ? 'alert-success' : 'alert-danger' }}">
                            
                            <h5>Hasil Verifikasi: {{ session('verification_result') }}</h5>

                            <ul class="mb-0">
                                <li><strong>Certificate ID:</strong> {{ session('certificate_id') }}</li>
                                <li><strong>NIM:</strong> {{ session('nim') }}</li>
                            </ul>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-12">
                @if(session('logs'))
                <hr>
                <h5 class="mt-4">Riwayat Verifikasi (Audit Trail)</h5>

                <table class="table table-sm table-bordered mt-2">
                    <thead class="table-light">
                        <tr>
                            <th>Certificate ID</th>
                            <th>NIM</th>
                            <th>Verified By</th>
                            <th>Hasil</th>
                            <th>Waktu</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach(session('logs') as $log)
                            <tr>
                                <td>{{ $log->input_certificate_id }}</td>
                                <td>{{ $log->input_nim }}</td>
                                <td>{{ $log->verifier->name }}</td>
                                <td>
                                    <span class="badge 
                                        {{ $log->result === 'VALID' ? 'bg-success' : 'bg-danger' }}">
                                        {{ $log->result }}
                                    </span>
                                </td>
                                <td>{{ $log->verified_at }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif

        </div>
    </div>
</div>

{{-- SCRIPT LOADING --}}
<script>
document.getElementById('verifyForm').addEventListener('submit', function () {
    document.getElementById('verifyBtn').disabled = true;
    document.getElementById('verifyBtn').innerText = 'Memverifikasi...';
    document.getElementById('loading').classList.remove('d-none');
});
</script>
@endsection
