
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    @foreach([
        'Report Card' => $admission->report_card,
        'Birth Certificate' => $admission->birth_certificate,
        'Applicant Photo' => $admission->applicant_photo,
        'Father Photo' => $admission->father_photo,
        'Mother Photo' => $admission->mother_photo,
        'Guardian Photo' => $admission->guardian_photo,
        'Transferee Docs' => $admission->transferee_docs
    ] as $label => $file)
    <div class="bg-gray-100 p-4 rounded-xl border">
        <h4 class="font-bold mb-3">{{ $label }}</h4>
        @if($file)
            <img src="{{ asset('storage/' . $file) }}" 
                 class="w-full h-48 object-cover rounded cursor-pointer hover:opacity-90 transition"
                 onclick="openModal(this.src)">
            <div class="mt-4 flex gap-2">
                <a href="{{ asset('storage/' . $file) }}" download class="flex-1 bg-green-700 text-white text-center py-2 rounded text-sm">Download</a>
            </div>
        @else
            <p class="text-gray-400 text-sm italic">No file uploaded</p>
        @endif
    </div>
    @endforeach
</div>

<div id="imageModal" class="hidden fixed inset-0 bg-black/90 z-[200] flex items-center justify-center p-4" onclick="this.classList.add('hidden')">
    <img id="modalImg" src="" class="max-w-full max-h-full shadow-2xl">
</div>

<script>
    function openModal(src) {
        document.getElementById('modalImg').src = src;
        document.getElementById('imageModal').classList.remove('hidden');
    }
</script>