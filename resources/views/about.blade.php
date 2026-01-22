<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>About First United Methodist
Church Ecumenical School Inc.</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
              <style>
                .byline span {
                  transform: scaleX(0);
                  transform-origin: left;
                  animation: drawLine 1s forwards;
                }
              
                @keyframes drawLine {
                  to {
                    transform: scaleX(1);
                  }
                }
              </style>


  @include('layouts.header')


    <!-- Hero -->
    <section class="py-24 bg-green-700 relative text-white text-center">
      <div class="container mx-auto px-4 relative z-10">
        <h1 class="text-4xl md:text-5xl font-bold mb-6">About First United Methodist
            Church Ecumenical School Inc.
            </h1>
        <p class="text-xl">
          For over 25 years, we've been nurturing young minds and building bright futures in our community.
        </p>
      </div>
    </section>

    <!-- Story -->
    <section class="py-24 bg-[#f5f6f1]">
        <div class="container mx-auto px-4">
          <div class="text-center mb-16">
            <h2 class="text-3xl font-bold text-green-700 mb-6">Our Story</h2>
            <p class="text-lg text-green-700/70 leading-relaxed">
              First United Methodist Church Ecumenical School Inc. was founded in 1999 with a simple vision,
              to create a school where every child feels valued, inspired, and empowered.
              What started as a small community school has grown into a thriving learning community
              serving over 500 students from diverse backgrounds.
            </p>
          </div>
      
          <div class="grid md:grid-cols-2 gap-8 mb-16">
            <!-- Mission -->
            <div class="bg-white rounded-3xl p-10 shadow hover:shadow-lg transition transform hover:-translate-y-2 flex flex-col w-full">
              <div class="w-20 h-20 bg-green-200 rounded-2xl flex items-center justify-center mb-6">
                <svg class="w-10 h-10 text-green-700" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round"
                    d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                </svg>
              </div>
              <h3 class="text-xl font-bold text-green-700 mb-4">Our Mission</h3>
              <p class="text-green-700/70 leading-relaxed">
                To provide a nurturing, inclusive environment where every child develops academic excellence,
                emotional intelligence, and a lifelong love of learning.
              </p>
            </div>
      
            <!-- Vision -->
            <div class="bg-white rounded-3xl p-10 shadow hover:shadow-lg transition transform hover:-translate-y-2 flex flex-col w-full">
              <div class="w-20 h-20 bg-green-200 rounded-2xl flex items-center justify-center mb-6">
                <svg class="w-10 h-10 text-green-700" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round"
                    d="M12 2l7 4v6c0 5.25-3.5 9.75-7 10-3.5-.25-7-4.75-7-10V6l7-4z"/>
                </svg>
              </div>
              <h3 class="text-xl font-bold text-green-700 mb-4">Our Vision</h3>
              <p class="text-green-700/70 leading-relaxed">
                To be a model elementary school where innovative teaching practices and strong community
                partnerships create confident, compassionate future leaders.
              </p>
            </div>
          </div>
        </div>
      </section>
            
    <!-- Core Values -->
    <section class="py-24 bg-green-700">
        <div class="container mx-auto px-4">
          <div class="text-center max-w-2xl mx-auto mb-16">
            <h2 class="text-3xl font-bold text-white mb-4">Our Core Values</h2>
            <p class="text-lg text-white">
              These principles guide everything we do at First United Methodist Church Ecumenical School Inc.
            </p>
          </div>
      
          <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6 max-w-5xl mx-auto">
            
            <!-- Respect -->
            <div class="bg-white rounded-3xl p-6 text-center shadow hover:shadow-lg transition transform hover:-translate-y-2">
              <div class="w-14 h-14 bg-green-100 rounded-2xl flex items-center justify-center mx-auto mb-4 text-green-700">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                  <path d="M12 17.27L18.18 21 16.54 13.97 22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24 7.46 13.97 5.82 21z"/>
                </svg>
              </div>
              <h3 class="text-lg font-bold text-green-700 mb-2">Respect</h3>
              <p class="text-sm text-green-700/70">We treat everyone with dignity and kindness.</p>
            </div>
      
            <!-- Excellence -->
            <div class="bg-white rounded-3xl p-6 text-center shadow hover:shadow-lg transition transform hover:-translate-y-2">
              <div class="w-14 h-14 bg-green-100 rounded-2xl flex items-center justify-center mx-auto mb-4 text-green-700">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                  <path d="M12 2l3 7h7l-5.5 4.5 2 7-6-4-6 4 2-7L2 9h7z"/>
                </svg>
              </div>
              <h3 class="text-lg font-bold text-green-700 mb-2">Excellence</h3>
              <p class="text-sm text-green-700/70">We strive for our best in all we do.</p>
            </div>
      
            <!-- Integrity -->
            <div class="bg-white rounded-3xl p-6 text-center shadow hover:shadow-lg transition transform hover:-translate-y-2">
              <div class="w-14 h-14 bg-green-100 rounded-2xl flex items-center justify-center mx-auto mb-4 text-green-700">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                  <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 
                    4.42 3 7.5 3c1.74 0 3.41 0.81 4.5 2.09C13.09 3.81 14.76 
                    3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 
                    11.54L12 21.35z"/>
                </svg>
              </div>
              <h3 class="text-lg font-bold text-green-700 mb-2">Integrity</h3>
              <p class="text-sm text-green-700/70">We are honest and do what's right.</p>
            </div>
      
            <!-- Community -->
            <div class="bg-white rounded-3xl p-6 text-center shadow hover:shadow-lg transition transform hover:-translate-y-2">
              <div class="w-14 h-14 bg-green-100 rounded-2xl flex items-center justify-center mx-auto mb-4 text-green-700">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                  <path d="M12 12c2.7 0 5-2.3 5-5s-2.3-5-5-5-5 
                    2.3-5 5 2.3 5 5 5zm0 2c-3.3 0-10 1.7-10 
                    5v3h20v-3c0-3.3-6.7-5-10-5z"/>
                </svg>
              </div>
              <h3 class="text-lg font-bold text-green-700 mb-2">Community</h3>
              <p class="text-sm text-green-700/70">We work together and support each other.</p>
            </div>
      
          </div>
        </div>
      </section>
      
    <!-- Stats -->
    <section class="py-24 bg-[#f5f6f1]">
        <div class="container mx-auto px-4 max-w-4xl">
          <div class="bg-green-700 rounded-3xl p-12 text-center text-white">
            <h2 class="text-3xl font-bold mb-12 relative inline-block byline">
                By the Numbers
                <span class="absolute left-0 bottom-0 w-full h-1 bg-yellow-400 block"></span>
              </h2>
              
              <style>
                .byline span {
                  transform: scaleX(0);
                  transform-origin: left;
                  animation: drawLine 1s forwards;
                }
              
                @keyframes drawLine {
                  to {
                    transform: scaleX(1);
                  }
                }
              </style>
                          <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
              <div>
                <div class="text-4xl font-bold mb-2 text-white counter" data-target="500">0</div>
                <div>Students</div>
              </div>
              <div>
                <div class="text-4xl font-bold mb-2 text-white counter" data-target="35">0</div>
                <div>Teachers</div>
              </div>
              <div>
                <div class="text-4xl font-bold mb-2 text-white counter" data-target="25">0</div>
                <div>Years</div>
              </div>
              <div>
                <div class="text-4xl font-bold mb-2 text-white counter" data-target="98">0</div>
                <div>Satisfaction</div>
              </div>
            </div>
          </div>
        </div>
      </section>
      
      
  </main>

  @include('layouts.footer')

  <script>
    const counters = document.querySelectorAll('.counter');
  
    counters.forEach(counter => {
      const updateCount = () => {
        const target = +counter.getAttribute('data-target');
        const count = +counter.innerText;
  
        // Adjust speed by changing the divisor
        const increment = target / 200;
  
        if(count < target) {
          counter.innerText = Math.ceil(count + increment);
          setTimeout(updateCount, 20);
        } else {
          counter.innerText = target + (counter.getAttribute('data-target').includes('+') ? '+' : '');
        }
      };
  
      updateCount();
    });
  </script>


</body>
</html>
