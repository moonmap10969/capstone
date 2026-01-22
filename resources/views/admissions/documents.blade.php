<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>FUMCES - Upload Documents</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-green-50 font-sans">

  @include('layouts.header')

  <main>

    <!-- Hero Section -->
    <section class="py-24 bg-green-700 relative text-white text-center">
      <div class="max-w-3xl mx-auto px-4">
        <h1 class="text-4xl md:text-5xl font-bold mb-4">Upload Required Documents</h1>
        <p class="text-xl">Please submit all necessary documents to complete your child's application to FUMCES.</p>
      </div>
    </section>

    <!-- Document Upload Form -->
    <section class="py-24 bg-[#faf9f5]">
      <div class="max-w-4xl mx-auto px-4">
        <div class="text-center mb-12">
          <h2 class="text-3xl font-bold text-green-700 mb-4">Upload Documents</h2>
          <p class="text-green-700/70">Ensure all required files are uploaded in PDF or image format (jpg, jpeg, png).</p>
        </div>

        @if(session('success'))
          <div class="bg-green-100 text-green-700 px-6 py-4 rounded-xl mb-6 text-center font-semibold">
            {{ session('success') }}
          </div>
        @endif

        <form action="{{ route('admissions.documents.upload') }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-3xl p-8 md:p-12 shadow-lg space-y-6">
          @csrf

          @php
            $documents = [
              ['label' => 'Birth Certificate – Official copy (PSA-issued or authenticated copy)', 'name' => 'birth_certificate', 'required' => false],
              ['label' => 'Baptismal Certificate – Optional', 'name' => 'baptismal_certificate', 'required' => false],
              ['label' => 'Report Card / Form 138 – Previous year’s grades', 'name' => 'report_card', 'required' => false],
              ['label' => 'Certificate of Good Moral Character', 'name' => 'good_moral_certificate', 'required' => false],
              ['label' => 'Medical Records / Health Certificate', 'name' => 'medical_records', 'required' => false],
              ['label' => '1x1 or 2x2 ID Photos', 'name' => 'id_photos', 'required' => false, 'multiple' => false],
              ['label' => 'Parent/Guardian ID', 'name' => 'parent_id', 'required' => false],
              ['label' => 'Proof of Residence – Barangay', 'name' => 'proof_of_residence', 'required' => false],
            ];
          @endphp

          @foreach($documents as $doc)
            <div>
              <label class="block text-sm font-medium text-green-700 mb-2">
                {{ $doc['label'] }} @if($doc['required']) <span class="text-red-500">*</span> @endif
              </label>
              <input type="file"
                     name="{{ $doc['name'] }}@if(!empty($doc['multiple']))[]@endif"
                     @if(!empty($doc['multiple'])) multiple @endif
                     @if($doc['required']) required @endif
                     accept=".pdf,.jpg,.jpeg,.png"
                     class="w-full px-4 py-3 rounded-xl border border-green-700 focus:outline-none focus:ring-2 focus:ring-green-700">
            </div>
          @endforeach

          <div class="text-center">
            <button type="submit"
                    class="bg-green-700 text-white px-6 py-3 rounded-xl font-bold hover:bg-green-800 transition">
              Upload Documents
            </button>
          </div>
        </form>
      </div>
    </section>

  </main>

  @include('layouts.footer')
</body>
</html>


