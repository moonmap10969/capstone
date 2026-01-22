<!-- Footer -->
<footer class="bg-white text-[#057e2f] py-12 border-t border-gray-200">
    <div class="container mx-auto grid grid-cols-1 md:grid-cols-4 gap-8">
        <!-- Logo -->
        <div class="flex flex-col items-center text-center">
            <img src="{{ asset('images/fumces_logo.jpg') }}" alt="FUMCES Logo" class="h-24 w-auto mb-4">
            <p class="font-bold text-base">First United Methodist Church Ecumenical School Inc.</p>
        </div>

        <!-- Quick Links -->
        <div>
            <h3 class="font-bold text-lg mb-4">Quick Links</h3>
            <ul class="space-y-2">
                <li><a href="/" class="hover:text-[#e5db19] transition">Home</a></li>
                <li><a href="/admissions" class="hover:text-[#e5db19] transition">Admissions</a></li>
                <li><a href="/education" class="hover:text-[#e5db19] transition">Education</a></li>
                <li><a href="/about" class="hover:text-[#e5db19] transition">About</a></li>
                <li><a href="/contact" class="hover:text-[#e5db19] transition">Contact</a></li>
            </ul>
        </div>

        <!-- Contact Us -->
        <div>
            <h3 class="font-bold text-lg mb-4">Contact Us</h3>
            <p>123 School St., City, Country</p>
            <p>Email: info@fumces.edu.ph</p>
            <p>Phone: +63 912 345 6789</p>
        </div>

        <!-- Newsletter -->
        <div>
            <h3 class="font-bold text-lg mb-4">Newsletter</h3>
            <p class="mb-2">Subscribe to receive updates and news:</p>
            <form class="flex flex-col gap-2">
                <input type="email" placeholder="Your email"
                    class="px-3 py-2 rounded border border-gray-300 focus:outline-none focus:ring-2 focus:ring-[#057e2f] text-black" />
                <button type="submit"
                    class="bg-[#057e2f] text-white font-bold px-4 py-2 rounded hover:bg-[#045a1d] transition">
                    Subscribe
                </button>
            </form>
        </div>
    </div>
    <hr>
    <div class="text-center mt-8 text-sm text-gray-500">
        &copy; 2026 First United Methodist Church Ecumenical School Inc. All rights reserved.
    </div>
</footer>