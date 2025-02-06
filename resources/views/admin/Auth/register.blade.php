<x-guest-layout>
    <div class="min-h-screen bg-cover bg-center bg-no-repeat bg-fixed w-full" style="background-image: url('{{ asset('images/homee.jpeg') }}');">
        <div class="flex justify-center items-center min-h-screen bg-black/50">
            <div class="w-full max-w-md">
                <div class="bg-white p-8 rounded-lg shadow-2xl">
                    <div class="text-center mb-8">
                        <div class="flex justify-center mb-4">
                            <svg class="w-16 h-16 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                        <h2 class="text-3xl font-bold text-gray-900">Admin Register</h2>
                        <p class="mt-2 text-gray-600">Silakan lengkapi data berikut untuk membuat akun baru</p>
                    </div>

                    <form method="POST" action="{{ route('admin.register') }}" class="space-y-6">
                        @csrf
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                            <input id="name" type="text" name="name" required 
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-[#297BBF] focus:border-[#297BBF]">
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                            <input id="email" type="email" name="email" required 
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-[#297BBF] focus:border-[#297BBF]">
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                            <input id="password" type="password" name="password" required 
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-[#297BBF] focus:border-[#297BBF]">
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>

                        <div>
                            <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm Password</label>
                            <input id="password_confirmation" type="password" name="password_confirmation" required 
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-[#297BBF] focus:border-[#297BBF]">
                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                        </div>

                        <button type="submit" class="w-full bg-[#297BBF] text-white py-2 rounded-md hover:bg-[#64B5F6] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#297BBF]">
                            Register
                        </button>

                        <div class="text-center mt-4">
                            <p class="text-gray-600">
                                Sudah memiliki akun? 
                                <a href="{{ route('admin.login') }}" class="font-bold text-[#297BBF] hover:text-[#64B5F6]">
                                    Masuk
                                </a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>