<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Document;

class DocumentController extends Controller
{
    /**
     * Display a listing of the student's documents.
     */
public function index() {
    $student = Auth::user();
    // Retrieve documents linked to the student's admission record
    $documents = $student->admissions()->with('documents')->get()->pluck('documents')->flatten();
    
    return view('student.documents.index', compact('documents'));
}

    /**
     * Upload a new document for the student.
     */
    public function upload(Request $request)
    {
        $request->validate([
            'file' => 'required|file|max:10240', // max 10MB
            'title' => 'required|string|max:255',
        ]);

        $student = Auth::user();

        $path = $request->file('file')->store('student_documents');

        $document = $student->documents()->create([
            'title' => $request->title,
            'file_path' => $path,
        ]);

        return redirect()->route('student.documents.index')->with('success', 'Document uploaded successfully.');
    }

    /**
     * Optional: Delete a student's document
     */
    public function destroy(Document $document)
    {
        $this->authorize('delete', $document); // ensure student owns the document

        Storage::delete($document->file_path);
        $document->delete();

        return redirect()->route('student.documents.index')->with('success', 'Document deleted successfully.');
    }
}
