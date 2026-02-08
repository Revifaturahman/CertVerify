@extends('layouts.master')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">

            <div class="card shadow-sm">
                <div class="card-body">

                    {{-- Avatar --}}
                    <div class="text-center mb-4">
                        <img
                            src="https://ui-avatars.com/api/?name={{ auth()->user()->name }}"
                            class="rounded-circle mb-2"
                            width="100"
                            height="100"
                            alt="Avatar"
                        >
                        <h5 class="mb-0">{{ auth()->user()->name }}</h5>
                        <small class="text-muted text-capitalize">
                            {{ auth()->user()->role }}
                        </small>
                    </div>

                    {{-- Alert sukses --}}
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    {{-- FORM --}}
                    {{-- <form method="POST" action="/profile/password">
                        @csrf --}}

                        <div class="mb-3">
                            <label class="form-label">Nama</label>
                            <input type="text"
                                   class="form-control"
                                   value="{{ auth()->user()->name }}"
                                   readonly>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email"
                                   class="form-control"
                                   value="{{ auth()->user()->email }}"
                                   readonly>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Role</label>
                            <input type="text"
                                   class="form-control"
                                   value="{{ auth()->user()->role }}"
                                   readonly>
                        </div>

                        <hr>
{{--                         
                        <div class="mb-3">
                            <label class="form-label">Password Baru</label>
                            <input type="password"
                                   name="password"
                                   class="form-control"
                                   placeholder="Masukkan password baru">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Konfirmasi Password</label>
                            <input type="password"
                                   name="password_confirmation"
                                   class="form-control"
                                   placeholder="Konfirmasi password baru">
                        </div>

                        <button type="submit" class="btn btn-primary w-100">
                            Update Password
                        </button> --}}
                    {{-- </form> --}}

                </div>
            </div>

        </div>
    </div>
</div>
@endsection
