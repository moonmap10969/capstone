<div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6">
    <div class="flex items-center gap-4 mb-6">
        <div>
            <h3 class="font-bold text-gray-800 text-sm">Attendance Log</h3>
            <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest">Daily Tracking</p>
        </div>

        {{-- Main Date Picker --}}
        <input type="date" value="{{ $date }}"
               onchange="window.location.href='?section={{ $selectedSectionId }}&date=' + this.value + '#attendance'"
               class="ml-auto border-2 border-gray-100 rounded-xl px-4 py-2 text-sm font-bold text-gray-600 outline-none focus:ring-2 focus:ring-[#057E2E]">

        {{-- Past Attendance Dropdown --}}
        @if(isset($attendanceDates) && count($attendanceDates) > 0)
            <select onchange="window.location.href='?section={{ $selectedSectionId }}&date=' + this.value + '#attendance'"
                    class="border-2 border-gray-100 rounded-xl px-4 py-2 text-sm font-bold text-gray-600 outline-none focus:ring-2 focus:ring-[#057E2E]">
                <option value="">Past Logs</option>
                @foreach($attendanceDates as $attendanceDate)
                    <option value="{{ $attendanceDate }}" {{ $attendanceDate == $date ? 'selected' : '' }}>
                        {{ \Carbon\Carbon::parse($attendanceDate)->format('M d, Y') }}
                    </option>
                @endforeach
            </select>
        @endif
    </div>

    <form action="{{ route('teacher.grades.attendance.store') }}" method="POST">
        @csrf
        <input type="hidden" name="section_id" value="{{ $selectedSectionId }}">
        <input type="hidden" name="date" value="{{ $date }}">

        <table class="min-w-full divide-y divide-gray-200">
            <thead>
                <tr class="bg-gray-50 text-left text-xs font-bold text-gray-500 uppercase">
                    <th class="px-6 py-3">Student Name</th>
                    <th class="px-6 py-3 text-center">Status</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach($enrollments as $enrollment)
                @php 
                    $studentNumber = $enrollment->studentNumber;
                    $savedStatus = $attendanceRecords[$studentNumber] ?? null; 
                @endphp
                <tr>
                    <td class="px-6 py-4">
                        <div class="text-sm font-bold text-gray-900">
                            {{ $enrollment->admission->studentLastName }}, {{ $enrollment->admission->studentFirstName }}
                        </div>
                        <div class="text-[10px] text-gray-400 font-mono">{{ $studentNumber }}</div>
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex justify-center gap-6">
                            @foreach(['Present', 'Absent', 'Late'] as $status)
                            <label class="inline-flex items-center group cursor-pointer">
                                <input type="radio" name="attendance[{{ $studentNumber }}]" value="{{ $status }}"
                                       class="w-4 h-4 text-[#057E2E] border-gray-300 focus:ring-[#057E2E]"
                                       {{ $savedStatus === $status ? 'checked' : '' }} required>
                                <span class="ml-2 text-xs font-bold text-gray-600 group-hover:text-[#057E2E]">{{ $status }}</span>
                            </label>
                            @endforeach
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-6 flex justify-end">
            <button type="submit" class="bg-[#057E2E] text-white px-8 py-3 rounded-xl font-bold text-sm shadow-lg shadow-[#057E2E]/20 hover:scale-105 transition-transform">
                Save Attendance ({{ \Carbon\Carbon::parse($date)->format('M d, Y') }})
            </button>
        </div>
    </form>
</div>