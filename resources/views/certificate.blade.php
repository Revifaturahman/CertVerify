@extends('layouts.master')

@section('content')
<div class="container py-4">
    <h3 class="mb-4">Template Sertifikat</h3>

    <div class="row g-4">
        @foreach($templates as $template)
            <div class="col-md-4">
                <div class="card shadow-sm h-100">
                    <div class="card-body">

                        <h6 class="card-title text-capitalize mb-2">
                            {{ str_replace('_', ' ', $template['name']) }}
                        </h6>

                        <!-- PREVIEW -->
                        <div class="template-preview mb-3">
                            <iframe
                                src="{{ route('template.preview', $template['name']) }}">
                            </iframe>
                        </div>

                        <!-- BUTTON -->
                        <a href="{{ route('template.preview', $template['name']) }}"
                           target="_blank"
                           class="btn btn-outline-primary btn-sm w-100 mt-auto">
                            Preview
                        </a>

                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

<style>
.template-preview {
    position: relative;
    height: 220px;
    background: #f8f9fa;
    border: 1px solid #dee2e6;
    border-radius: 8px;
    overflow: hidden;
}

.template-preview iframe {
    position: absolute;
    top: 50%;
    left: 50%;
    width: 1100px;
    height: 750px;
    border: 0;
    transform: translate(-50%, -50%) scale(0.28);
}

</style>
@endsection
