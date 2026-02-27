<footer class="bg-white text-[#057e2f] py-12 border-t border-gray-200 relative">
    <div class="container mx-auto grid grid-cols-1 md:grid-cols-4 gap-8">
        <div class="flex flex-col items-center text-center">
            <img src="{{ asset('images/fumces_logo.jpg') }}" alt="FUMCES Logo" class="h-24 w-auto mb-4">
            <p class="font-bold text-base">First United Methodist Church Ecumenical School Inc.</p>
        </div>

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

        <div>
            <h3 class="font-bold text-lg mb-4">Contact Us</h3>
            <p>123 School St., City, Country</p>
            <p>Email: info@fumces.edu.ph</p>
            <p>Phone: +63 912 345 6789</p>
        </div>

        <div>
            <h3 class="font-bold text-lg mb-4">Connect With Us</h3>
            <p class="mb-4">Follow our official pages for the latest announcements:</p>
            <div class="flex gap-4">
                <a href="#" class="text-2xl hover:text-[#e5db19] transition"><i class="fab fa-facebook"></i></a>
                <a href="#" class="text-2xl hover:text-[#e5db19] transition"><i class="fab fa-twitter"></i></a>
                <a href="#" class="text-2xl hover:text-[#e5db19] transition"><i class="fab fa-instagram"></i></a>
                <a href="#" class="text-2xl hover:text-[#e5db19] transition"><i class="fab fa-youtube"></i></a>
            </div>
        </div>
    </div>

    <hr class="mt-8 border-gray-200">

        <p class="text-sm text-gray-500 text-center">
            &copy; {{ date('Y') }} First United Methodist Church Ecumenical School Inc. All rights reserved.
        </p>
    </div>
</footer>