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

    <!-- Contact Content -->
    <section class="py-24">
      <div class="container mx-auto px-4">
        <div class="max-w-6xl mx-auto grid lg:grid-cols-2 gap-12">
    
          <!-- Contact Form -->
          <div class="bg-white rounded-3xl p-8 shadow hover:shadow-lg transition transform hover:-translate-y-2">
            <h2 class="text-2xl font-bold text-green-700 mb-6">Send Us a Message</h2>
    
            <form class="space-y-6">
              <div class="grid md:grid-cols-2 gap-4">
                <div>
                  <label class="block text-sm font-medium text-green-700 mb-2">Your Name</label>
                  <input type="text" required
                    class="w-full px-4 py-3 rounded-xl border border-green-700 text-green-700 focus:ring-2 focus:ring-green-700" />
                </div>
                <div>
                  <label class="block text-sm font-medium text-green-700 mb-2">Email Address</label>
                  <input type="email" required
                    class="w-full px-4 py-3 rounded-xl border border-green-700 text-green-700 focus:ring-2 focus:ring-green-700" />
                </div>
              </div>
    
              <div class="grid md:grid-cols-2 gap-4">
                <div>
                  <label class="block text-sm font-medium text-green-700 mb-2">Phone Number</label>
                  <input type="tel"
                    class="w-full px-4 py-3 rounded-xl border border-green-700 text-green-700 focus:ring-2 focus:ring-green-700" />
                </div>
    
                <div>
                  <label class="block text-sm font-medium text-green-700 mb-2">Subject</label>
                  <div class="relative">
                    <select class="appearance-none w-full px-4 py-3 rounded-xl border border-green-700 text-green-700 focus:ring-2 focus:ring-green-700">
                      <option value="">Select a topic</option>
                      <option>Admissions Inquiry</option>
                      <option>Schedule a Tour</option>
                      <option>Program Information</option>
                      <option>General Question</option>
                    </select>
                    <div class="absolute inset-y-0 right-4 flex items-center pointer-events-none">
                      <svg class="w-5 h-5 text-green-700" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                      </svg>
                    </div>
                  </div>
                </div>
              </div>
    
              <div>
                <label class="block text-sm font-medium text-green-700 mb-2">Message</label>
                <textarea rows="5"
                  class="w-full px-4 py-3 rounded-xl border border-green-700 text-green-700 focus:ring-2 focus:ring-green-700 resize-none"></textarea>
              </div>
    
              <button class="w-full bg-green-700 text-white font-bold py-3 rounded-xl hover:bg-green-800 transition flex items-center justify-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round"
                    d="M22 2L11 13M22 2l-6 20-5-9-9-5 20-6z"/>
                </svg>
                Send Message
              </button>
            </form>
          </div>
    
          <!-- Contact Info -->
          <div class="space-y-8">
            <div class="bg-white rounded-3xl p-8 shadow hover:shadow-lg transition transform hover:-translate-y-2">
              <h2 class="text-2xl font-bold text-green-700 mb-6">Contact Information</h2>
    
              <div class="space-y-6">
                <!-- Address -->
                <div class="flex gap-4">
                  <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-green-700" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round"
                        d="M12 11c1.1 0 2-.9 2-2s-.9-2-2-2-2 .9-2 2 .9 2 2 2z"/>
                      <path stroke-linecap="round" stroke-linejoin="round"
                        d="M19.5 10c0 7-7.5 12-7.5 12S4.5 17 4.5 10a7.5 7.5 0 0115 0z"/>
                    </svg>
                  </div>
                  <div>
                    <h3 class="font-semibold text-green-700">Address</h3>
                    <p class="text-green-700/70">Guagua, Pampanga</p>
                  </div>
                </div>
    
                <!-- Phone -->
                <div class="flex gap-4">
                  <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-green-700" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round"
                        d="M3 5a2 2 0 012-2h2l2 5-2 1a11 11 0 005 5l1-2 5 2v2a2 2 0 01-2 2A16 16 0 013 5z"/>
                    </svg>
                  </div>
                  <div>
                    <h3 class="font-semibold text-green-700">Phone</h3>
                    <p class="text-green-700/70">(0912) 345 6789</p>
                  </div>
                </div>
    
                <!-- Email -->
                <div class="flex gap-4">
                  <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-green-700" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round"
                        d="M3 8l9 6 9-6v10H3V8z"/>
                    </svg>
                  </div>
                  <div>
                    <h3 class="font-semibold text-green-700">Email</h3>
                    <p class="text-green-700/70">info@fumces.edu</p>
                  </div>
                </div>
    
                <!-- Hours -->
                <div class="flex gap-4">
                  <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-green-700" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round"
                        d="M12 6v6l4 2"/>
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
    
            <!-- Map Placeholder -->
            <div class="bg-green-100 rounded-3xl h-64 flex items-center justify-center">
              <span class="text-green-700 font-semibold">Interactive Map</span>
            </div>
          </div>
    
        </div>
      </div>
    </section>
    
  </main>

  @include('layouts.footer')

</body>
</html>
