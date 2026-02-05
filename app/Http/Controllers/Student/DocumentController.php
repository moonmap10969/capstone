<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Document;

class DocumentController extends Controller
{
    // Show all documents for the student portal
    public function index()
    {
        $student = Auth::user();

        // Fetch all documents (admissions + portal)
        $documents = $student->documents;

        $totalRequired = 6;

        $stats = [
            'total'     => $totalRequired,
            'submitted' => $documents->where('status', 'approved')->count(),
            'pending'   => $documents->where('status', 'pending')->count(),
            'rejected'  => $documents->where('status', 'rejected')->count(),
        ];

        $progress = ($stats['submitted'] / $totalRequired) * 100;

        return view('student.documents.index', compact('documents', 'stats', 'progress'));
    }

    // Handle uploads from BOTH admission form & student portal
   public function store(Request $request)
{
    $student = Auth::user();

    // Determine type: 'admission' if coming from admission form, else 'student_upload'
    $type = $request->input('type') ?? 'student_upload';

    // Admission form files
    $admissionFiles = [
        'report_card',
        'birth_certificate',
        'applicant_photo',
        'father_photo',
        'mother_photo',
        'guardian_photo',
        'transferee_docs'
    ];

    foreach ($admissionFiles as $fileKey) {
        if ($request->hasFile($fileKey)) {
            $file = $request->file($fileKey);
            $path = $file->store('documents', 'public');

            Document::updateOrCreate(
                ['user_id' => $student->id, 'file_name' => $fileKey], // use file_name
                [
                    'file_path' => $path,
                    'status'    => 'pending',
                    'type'      => $type,
                ]
            );
        }
    }

    // Student portal single file upload
    if ($request->hasFile('file') && $request->has('file_name')) {
        $file = $request->file('file');
        $path = $file->store('documents', 'public');

        Document::updateOrCreate(
            ['user_id' => $student->id, 'file_name' => $request->file_name],
            [
                'file_path' => $path,
                'status'    => 'pending',
                'type'      => $type,
            ]
        );
    }

    $message = $type === 'admission'
        ? 'Admission documents uploaded successfully.'
        : 'Document uploaded successfully.';

    return back()->with('success', $message);
}

    // Delete a document
    public function destroy(Document $document)
    {
        $student = Auth::user();

        if ($document->user_id !== $student->id) {
            abort(403, 'Unauthorized');
        }

        if ($document->file_path) {
            Storage::disk('public')->delete($document->file_path);
        }

        $document->delete();

        return back()->with('success', 'Document deleted successfully.');
    }
}
