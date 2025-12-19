@extends('layouts.master')

@section('content')
<div class="container py-4">

    <h3 class="mb-3">Data Peserta</h3>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- BUTTON CREATE -->
    <button class="btn btn-primary mb-3" onclick="openCreateModal()" data-bs-toggle="modal" data-bs-target="#participantModal">
        Tambah Peserta
    </button>

    <!-- CARD PESERTA -->
    <div class="row g-4">
        @forelse($participants as $item)
            <div class="col-md-4">
                <div class="card shadow-sm h-100 cursor-pointer position-relative"
                  onclick='openEditModal(@json($item))'>

                  <!-- BUTTON DELETE -->
                  <form action="{{ route('participant.destroy', $item->id) }}"
                        method="POST"
                        class="position-absolute top-0 end-0 m-2"
                        onclick="event.stopPropagation();">
                      @csrf
                      @method('DELETE')
                      <button type="submit"
                              class="btn btn-sm btn-danger"
                              onclick="return confirm('Yakin hapus peserta ini?')">
                          <i class="bi bi-trash"></i>
                      </button>
                  </form>

                  <div class="card-body">
                      <h5 class="card-title mb-2">{{ $item->nim }}</h5>
                      <h6 class="card-subtitle mb-2 text-muted">{{ $item->name }}</h6>

                      <p class="mb-1">
                          <strong>Event:</strong><br>
                          {{ $item->event_name }}
                      </p>

                      <p class="mb-2">
                          <strong>Template:</strong><br>
                          {{ str_replace('_', ' ', ucfirst($item->template_name)) }}
                      </p>

                      <p class="mb-1">
                            <strong>Tanggal:</strong><br>
                            {{ $item->issued_at->format('d F Y') }}
                      </p>

                      <span class="badge bg-success">{{ $item->status }}</span>
                      <br>
                      <a href="{{ route('certificate.preview', $item->id) }}"
                            target="_blank"
                            class="btn btn-sm btn-outline-primary mt-2"
                            onclick="event.stopPropagation();">
                                Preview Sertifikat
                       </a>
                       <a href="{{ route('certificate.pdf', $item->id) }}"
                            target="_blank"
                            class="btn btn-sm btn-outline-danger mt-2"
                            onclick="event.stopPropagation();">
                            Download PDF
                        </a>
                  </div>

              </div>


            </div>
        @empty
            <div class="col-12 text-muted">
                Belum ada peserta.
            </div>
        @endforelse
    </div>

    <!-- MODAL CREATE & UPDATE -->
    <div class="modal fade" id="participantModal" tabindex="-1">
        <div class="modal-dialog">
            <form method="POST" action="{{ route('participant.store') }}" class="modal-content">
                @csrf

                <!-- ID (UNTUK UPDATE) -->
                <input type="hidden" name="id" id="participant_id">

                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle">Tambah Peserta</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">

                    <div class="mb-3">
                        <label class="form-label">NIM</label>
                        <input type="text" name="nim" id="nim" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Nama Peserta</label>
                        <input type="text" name="name" id="name" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Nama Event</label>
                        <input type="text" name="event_name" id="event_name" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Tanggal Sertifikat</label>
                        <input type="date"
                            name="issued_at"
                            id="issued_at"
                            class="form-control"
                            required>
                    </div>


                    <div class="mb-3">
                        <label class="form-label">Template Sertifikat</label>
                        <select name="template_name" id="template_name" class="form-select" required>
                            <option value="">-- Pilih Template --</option>
                            @foreach($templates as $template)
                                <option value="{{ $template }}">
                                    {{ str_replace('_', ' ', ucfirst($template)) }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Batal
                    </button>
                    <button type="submit" class="btn btn-primary">
                        Simpan
                    </button>
                </div>

            </form>
        </div>
    </div>

</div>

<!-- SCRIPT LOGIKA CREATE & UPDATE -->
<script>
function openCreateModal() {
    document.getElementById('modalTitle').innerText = 'Tambah Peserta';
    document.getElementById('participant_id').value = '';
    document.getElementById('nim').value = '';
    document.getElementById('name').value = '';
    document.getElementById('event_name').value = '';
    document.getElementById('template_name').value = '';
    document.getElementById('issued_at').value = '';
}

function openEditModal(data) {
  console.log(data.name);
    document.getElementById('modalTitle').innerText = 'Edit Peserta';
    document.getElementById('participant_id').value = data.id;
    document.getElementById('nim').value = data.nim;
    document.getElementById('name').value = data.name ?? '';
    document.getElementById('event_name').value = data.event_name;
    document.getElementById('template_name').value = data.template_name;
    document.getElementById('issued_at').value = data.issued_at;

    // buka modal via JS (BUKAN attribute)
    const modal = new bootstrap.Modal(
        document.getElementById('participantModal')
    );
    modal.show();
}
</script>
@endsection
