<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Certificate;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ParticipantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Ambil semua template dari folder
        $templatePath = resource_path('views/templateCertificate');

        $templates = collect(File::files($templatePath))
            ->map(fn ($file) => str_replace('.blade.php', '', $file->getFilename()));

        $participants = Certificate::all();

        return view('participant', compact('templates', 'participants'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'          => 'required|string',
            'nim'           => 'required|string',
            'event_name'    => 'required|string',
            'template_name' => 'required|string',
            'issued_at'     => 'required|date'
        ]);

        if($request->id){
            $certificate = Certificate::find($request->id);
            $certificate->update($validated);
            $message = 'Peserta berhasil diupdate';
        }else{
            Certificate::create([
                'certificate_id' => 'CERT-' . now()->format('Y') . '-' . strtoupper(Str::random(6)),
                'nim'            => $request->nim,
                'name'           => $request->name,
                'event_name'     => $request->event_name,
                'template_name'  => $request->template_name,
                'issued_at'      => $request->issued_at,
                'status'         => 'ISSUED',
                'hash_value'     => null
            ]);
            $message = 'Peserta berhasil ditambahkan';
        }

        return redirect()->route('participant.index')->with('success', $message);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Certificate $participant)
    {
        $participant->delete();
        return redirect()->route('participant.index')->with('success','Berhasil dihapus');
    }
}
