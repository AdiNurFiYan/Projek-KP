<x-guest-layout>
    <div class="min-h-screen bg-cover bg-center bg-no-repeat bg-fixed w-full" style="background-image: url('{{ asset('images/homee.jpeg') }}');">
        <div class="flex justify-center items-center min-h-screen bg-black/50">
            <div class="w-full max-w-md">
                <div class="bg-white p-8 rounded-lg shadow-2xl">
                    <div class="text-center mb-8">
                        <div class="flex justify-center mb-4">
                            <svg class="w-16 h-16 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 11V7a4 4 0 118 0m-4 8v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <h2 class="text-3xl font-bold text-gray-900">Admin Login</h2>
                        <p class="mt-2 text-gray-600">Silakan masukkan email dan password anda untuk melanjutkan.</p>
                    </div>

                    <form method="POST" action="{{ route('admin.login') }}" class="space-y-6">
                        @csrf
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                            <input id="email" type="email" name="email" required 
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-[#297BBF] focus:border-[#297BBF]">
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <div class="relative">
                            <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                            <div class="mt-1 relative">
                                <input id="password" type="password" name="password" required 
                                    class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-[#297BBF] focus:border-[#297BBF]">
                                <button type="button" onclick="togglePassword('password')" class="absolute inset-y-0 right-0 px-3 flex items-center">
                                    <svg class="h-5 w-5 text-gray-400" id="password-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                        <script>
                            function togglePassword(inputId) {
                                const input = document.getElementById(inputId);
                                const icon = document.getElementById(inputId + '-icon');
                                
                                if (input.type === 'password') {
                                    input.type = 'text';
                                    icon.innerHTML = `
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                                    `;
                                } else {
                                    input.type = 'password';
                                    icon.innerHTML = `
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    `;
                                }
                            }
                        </script>
                        <button type="submit" class="w-full bg-[#297BBF] text-white py-2 rounded-md hover:bg-[#64B5F6] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#297BBF]">
                            Login
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>