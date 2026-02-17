<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contact First United Methodist
Church Ecumenical School</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-[#f5f6f1]">
  @include('layouts.header')


    <!-- Hero -->
    <section class="py-24 bg-green-700 relative text-white text-center">
      <div class="container mx-auto px-4 relative z-10">
        <h1 class="text-4xl md:text-5xl font-bold mb-6">Get in Touch</h1>
        <p class="text-xl">
          We'd love to hear from you! Reach out with questions, schedule a visit, or learn more about our programs.
        </p>
      </div>
    </section>

    <section class="grid grid-cols-1 md:grid-cols-2 gap-8 my-12">
  <div class="bg-white rounded-3xl p-8 shadow hover:shadow-lg transition transform hover:-translate-y-2">
    <h2 class="text-2xl font-bold text-green-700 mb-6">Contact Information</h2>

    <div class="space-y-6">
      <div class="flex gap-4">
        <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center">
          <svg class="w-6 h-6 text-green-700" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 11c1.1 0 2-.9 2-2s-.9-2-2-2-2 .9-2 2 .9 2 2 2z"/>
            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10c0 7-7.5 12-7.5 12S4.5 17 4.5 10a7.5 7.5 0 0115 0z"/>
          </svg>
        </div>
        <div>
          <h3 class="font-semibold text-green-700">Address</h3>
          <p class="text-green-700/70">Guagua, Pampanga</p>
        </div>
      </div>

      <div class="flex gap-4">
        <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center">
          <svg class="w-6 h-6 text-green-700" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h2l2 5-2 1a11 11 0 005 5l1-2 5 2v2a2 2 0 01-2 2A16 16 0 013 5z"/>
          </svg>
        </div>
        <div>
          <h3 class="font-semibold text-green-700">Phone</h3>
          <p class="text-green-700/70">(0912) 345 6789</p>
        </div>
      </div>

      <div class="flex gap-4">
        <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center">
          <svg class="w-6 h-6 text-green-700" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l9 6 9-6v10H3V8z"/>
          </svg>
        </div>
        <div>
          <h3 class="font-semibold text-green-700">Email</h3>
          <p class="text-green-700/70">info@fumces.edu</p>
        </div>
      </div>

      <div class="flex gap-4">
        <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center">
          <svg class="w-6 h-6 text-green-700" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6l4 2"/>
            <circle cx="12" cy="12" r="9"/>
          </svg>
        </div>
        <div>
          <h3 class="font-semibold text-green-700">Office Hours</h3>
          <p class="text-green-700/70">Mon–Fri: 8:00 AM – 5:00 PM</p>
        </div>
      </div>
    </div>
  </div>

  <div class="rounded-3xl h-full min-h-[300px] overflow-hidden border-2 border-green-700 shadow-md">
    <iframe
    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3854.6611913367447!2d120.62722657600347!3d14.9559577855736!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x33965930c6853987%3A0x390ac8379b6d64e3!2sFirst%20United%20Methodist%20Church%20Ecumenical%20School!5e0!3m2!1sen!2sph!4v1770363776848!5m2!1sen!2sph"
    class="w-full h-full border-0"
    allowfullscreen
    loading="lazy"
    referrerpolicy="no-referrer-when-downgrade">
    </iframe>
  </div>
</section>
  </main>

  @include('layouts.footer')

</body>
</html>
