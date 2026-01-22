<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Document Upload</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen flex bg-gray-100">

    {{-- Sidebar --}}
    @include('student.layouts.sidebar')

    <main class="flex-1 p-8 w-full">

        <div class="mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Document Upload</h1>
            <p class="text-sm text-gray-600 mt-1">
                Upload your required documents individually. Accepted formats: PDF, JPG, PNG | Max size: 5MB per file
            </p>
        </div>

        {{-- Documents Accordion (Full Width) --}}
        <div class="space-y-4 w-full">

            @php
                $documents = [
                    'Birth Certificate – Official copy (PSA-issued or authenticated copy)',
                    'Baptismal Certificate – Optional',
                    'Report Card / Form 138 – Previous year’s grades',
                    'Certificate of Good Moral Character',
                    'Medical Records / Health Certificate',
                    '1x1 or 2x2 ID Photos',
                    'Parent/Guardian ID'
                ];
            @endphp

            @foreach($documents as $doc)
            <div class="bg-white rounded-xl shadow w-full flex items-start border-l-4 border-green-700 pl-4">

                {{-- Status Icon --}}
                <div class="flex-shrink-0 p-6 flex items-center">
                    <svg class="submission-icon w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <circle cx="12" cy="12" r="10" stroke-width="2"/>
                    </svg>
                </div>

                {{-- Card Content --}}
                <div class="flex-1">

                    {{-- Header --}}
                    <button type="button" class="w-full flex justify-between items-center px-6 py-4 text-left hover:bg-gray-50 focus:outline-none collapse-toggle">
                        <span class="font-semibold text-gray-700">{{ $doc }}</span>
                        <svg class="w-5 h-5 text-gray-500 transform transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>

                    {{-- Collapsible Content --}}
                    <div class="p-6 hidden collapse-content w-full">

                        <div
                            class="border-2 border-dashed border-gray-300 rounded-xl p-8 text-center hover:border-green-700 transition cursor-pointer document-area w-full"
                        >
                            <svg class="mx-auto h-12 w-12 text-gray-400 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M7 16V4a1 1 0 011-1h8a1 1 0 011 1v12M7 16l-4 4m0 0l4 4m-4-4h18" />
                            </svg>
                            <p class="text-gray-700 font-medium mb-1">Drag and drop file here</p>
                            <p class="text-xs text-gray-500 mb-4">or click to browse</p>

                            <input type="file" class="hidden file-input w-full" />
                            <label class="inline-block px-6 py-2 bg-green-700 text-white rounded-lg text-sm cursor-pointer hover:opacity-90">
                                Select File
                            </label>

                            {{-- Progress Bar --}}
                            <div class="mt-6 hidden progress-container">
                                <div class="w-full bg-gray-200 rounded-full h-4">
                                    <div class="progress-bar bg-green-700 h-4 rounded-full w-0"></div>
                                </div>
                                <p class="text-sm text-gray-600 mt-1 progress-text">0%</p>
                            </div>
                        </div>

                        <div class="mt-4 text-sm text-gray-500 file-name w-full">No file chosen</div>

                        {{-- Individual Submit Button --}}
                        <div class="mt-4 text-right">
                            <button class="px-5 py-2 bg-green-700 text-white rounded-lg text-sm hover:opacity-90 submit-btn" disabled>
                                Submit
                            </button>
                        </div>

                    </div>
                </div>
            </div>
            @endforeach

        </div>
    </main>

    <script>
        // Collapsible toggle
        document.querySelectorAll('.collapse-toggle').forEach(button => {
            button.addEventListener('click', () => {
                const content = button.nextElementSibling;
                content.classList.toggle('hidden');
                const icon = button.querySelector('svg');
                icon.classList.toggle('rotate-180');
            });
        });

        // File upload logic per card
        document.querySelectorAll('.document-area').forEach(area => {
            const input = area.querySelector('.file-input');
            const label = area.querySelector('label');
            const progressContainer = area.querySelector('.progress-container');
            const progressBar = area.querySelector('.progress-bar');
            const progressText = area.querySelector('.progress-text');
            const fileNameDisplay = area.parentElement.querySelector('.file-name');
            const submitBtn = area.parentElement.querySelector('.submit-btn');
            const icon = area.closest('.flex').querySelector('.submission-icon');

            label.addEventListener('click', () => input.click());

            input.addEventListener('change', () => {
                if(input.files.length > 0){
                    fileNameDisplay.textContent = input.files[0].name;
                    submitBtn.disabled = false;
                } else {
                    fileNameDisplay.textContent = 'No file chosen';
                    submitBtn.disabled = true;
                }
            });

            area.addEventListener('dragover', e => {
                e.preventDefault();
                area.classList.add('border-green-700');
            });
            area.addEventListener('dragleave', e => {
                e.preventDefault();
                area.classList.remove('border-green-700');
            });
            area.addEventListener('drop', e => {
                e.preventDefault();
                input.files = e.dataTransfer.files;
                input.dispatchEvent(new Event('change'));
            });

            // Simulated submit
            submitBtn.addEventListener('click', () => {
                submitBtn.textContent = 'Submitted';
                submitBtn.disabled = true;

                // Animate progress bar
                progressContainer.classList.remove('hidden');
                let progress = 0;
                progressBar.style.width = '0%';
                progressText.textContent = '0%';
                const interval = setInterval(() => {
                    if(progress >= 100){
                        clearInterval(interval);
                        progressText.textContent = 'Upload complete';
                        // Change icon to check
                        icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />';
                        icon.classList.remove('text-gray-400');
                        icon.classList.add('text-green-600');
                    } else {
                        progress += 5;
                        progressBar.style.width = progress + '%';
                        progressText.textContent = progress + '%';
                    }
                }, 50);
            });
        });
    </script>
</body>
</html>
