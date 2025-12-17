@extends('layouts.master')

@section('content')
<h2 class="text-center mb-6"> Hello User</h2>
<div class="row text-center g-3">
    <div class="col-md-4">
        <div class="p-4 bg-white shadow-sm rounded">
            <h6>Jumlah Verifikasi</h6>
            <h2 class="text-primary">10</h2>
        </div>
    </div>
    <div class="col-md-4">
        <div class="p-4 bg-white shadow-sm rounded">
            <h6>Verifikasi Berhasil</h6>
            <h2 class="text-success">245</h2>
        </div>
    </div>
    <div class="col-md-4">
        <div class="p-4 bg-white shadow-sm rounded">
            <h6>Verifikasi Gagal</h6>
            <h2 class="text-warning">3</h2>
        </div>
    </div>
</div>
@endsection
