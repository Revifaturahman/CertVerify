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

                    <form action="{{ route('verification.verify') }}"
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
                            <button type="submit" class="btn btn-primary">
                                Verifikasi Sertifikat
                            </button>
                        </div>
                    </form>

                </div>
            </div>

        </div>
    </div>
</div>
@endsection
