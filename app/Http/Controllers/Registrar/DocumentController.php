<?php

namespace App\Http\Controllers\Registrar;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Document;

class DocumentController extends Controller
{
    public function index()
    {
        $documents = Document::all();
        return view('registrar.documents', compact('documents'));
    }

    public function show(Document $document)
    {
        return view('registrar.documents.show', compact('document'));
    }

    public function approve(Document $document)
    {
        $document->status = 'approved';
        $document->save();

        return redirect()->route('registrar.documents.index')->with('success', 'Document approved.');
    }

    public function reject(Document $document)
    {
        $document->status = 'rejected';
        $document->save();

        return redirect()->route('registrar.documents.index')->with('error', 'Document rejected.');
    }
}
