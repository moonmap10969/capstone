@extends('teacher.layouts.app')
@section('title','Class List & Grades')
@section('content')

<h1 class="text-2xl font-bold mb-4">Class List & Grades</h1>

@foreach($courses as $course)
<div class="mb-6 bg-white rounded-lg shadow p-4">
    <h2 class="font-semibold text-lg">{{ $course->course_name }} - {{ $course->section }} ({{ $course->grade_level }})</h2>
    <table class="min-w-full mt-2 border">
        <thead class="bg-gray-100">
            <tr>
                <th class="border px-4 py-2">#</th>
                <th class="border px-4 py-2">Student Name</th>
                <th class="border px-4 py-2">Final Grade</th>
                <th class="border px-4 py-2">Remarks</th>
            </tr>
        </thead>
        <tbody>
            @foreach($course->students as $i => $student)
            @php
                $grades = $student->grades->where('course_id',$course->id);
                $quiz = $grades->where('assessment.type','quiz')->sum('score') / max($grades->where('assessment.type','quiz')->sum('total_score'),1) * 100;
                $long = $grades->where('assessment.type','long_quiz')->sum('score') / max($grades->where('assessment.type','long_quiz')->sum('total_score'),1) * 100;
                $assign = $grades->where('assessment.type','assignment')->sum('score') / max($grades->where('assessment.type','assignment')->sum('total_score'),1) * 100;
                $exam = $grades->where('assessment.type','exam')->sum('score') / max($grades->where('assessment.type','exam')->sum('total_score'),1) * 100;
                $final = ($quiz*0.15)+($long*0.25)+($assign*0.2)+($exam*0.4);
                if($final >= 90) $remark = "Outstanding";
                elseif($final >= 85) $remark = "Very Satisfactory";
                elseif($final >= 80) $remark = "Satisfactory";
                elseif($final >= 75) $remark = "Fairly Satisfactory";
                else $remark = "Needs Improvement";
            @endphp
            <tr>
                <td class="border px-4 py-2">{{ $i+1 }}</td>
                <td class="border px-4 py-2">{{ $student->name }}</td>
                <td class="border px-4 py-2">{{ number_format($final,2) }}</td>
                <td class="border px-4 py-2">{{ $remark }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endforeach

@endsection