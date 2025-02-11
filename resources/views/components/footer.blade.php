<footer class="bg-[#940000] text-white py-6 mt-auto">
    <div class="container mx-auto px-4">
        <!-- Logo dan Nama Dinas -->
        <div class="flex flex-col md:flex-row items-center justify-center md:justify-start gap-4 mb-6">
            <img src="{{ asset('images/Kab.Semarang.png') }}" alt="Logo Kabupaten Semarang" class="h-16 w-auto">
            <h2 class="text-center md:text-left text-sm md:text-base font-medium">Dinas Pendidikan, Kebudayaan, Kepemudaan, dan Olahraga<br>Kabupaten Semarang</h2>
        </div>
        
        <!-- Informasi Kontak -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
            <!-- Email -->
            <a href="mailto:disdikbudporakabsmg@gmail.com" class="flex items-center justify-center space-x-3 hover:text-gray-200 transition-colors">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"></path>
                    <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"></path>
                </svg>
                <span class="text-sm">disdikbudporakabsmg@gmail.com</span>
            </a>
            
            <!-- Telepon -->
            <a href="tel:(024)6921134" class="flex items-center justify-center space-x-3 hover:text-gray-200 transition-colors">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"></path>
                </svg>
                <span class="text-sm">(024) 6921134</span>
            </a>
            
            <!-- Alamat -->
            <div class="flex items-center justify-center space-x-3">
                <svg class="w-5 h-5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path>
                </svg>
                <span class="text-sm">Jl. Gatot Subroto No. 20B, Cirebon, Bandarjo, Kec. Ungaran Bar., Kabupaten Semarang</span>
            </div>
        </div>
        
        <!-- Copyright -->
        <div class="border-t border-white/10 pt-4">
            <div class="text-center">
                <p class="text-xs text-white/80">&copy; {{ date('Y') }} Disdikbudpora Kabupaten Semarang. All rights reserved.</p>
            </div>
        </div>
    </div>
</footer>