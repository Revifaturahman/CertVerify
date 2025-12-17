<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class CerticateController extends Controller
{
    public function index()
    {
         $templatePath = resource_path('views/templateCertificate');
         $templates = collect(File::files($templatePath))
        ->map(function ($file) {
            return [
                'name' => str_replace('.blade.php', '', $file->getFilename()),
                'view' => 'templatesCertificate.' . str_replace('.blade.php', '', $file->getFilename())
            ];
        });
        return view('certificate', compact('templates'));
    }
}
