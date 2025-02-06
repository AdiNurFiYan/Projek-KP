<x-app-layout>
    <div class="relative bg-cover bg-center h-64" style="background-image: url('/images/datasekolah.jpg');">
        <div class="absolute inset-0 bg-black bg-opacity-50"></div>
        <div class="absolute inset-0 flex items-center justify-center">
            <h1 class="text-5xl font-bold text-white uppercase">DATA SEKOLAH</h1>
        </div>
    </div>

    <div class="container mx-auto px-4 py-8">
        <div class="bg-white rounded-lg shadow-lg p-6">
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
                @foreach($korwils as $korwil)
                <a href="{{ route('data-sekolah.list', $korwil) }}" class="cursor-pointer">
                    <div class="relative group">
                        <div class="aspect-square overflow-hidden rounded-lg shadow-md hover:shadow-xl transition-all duration-300">
                            <img 
                                src="{{ $korwil->image_url }}" 
                                alt="{{ $korwil->nama }}"
                                class="w-full h-full object-cover"
                            >
                            <div class="absolute bottom-0 left-0 right-0 bg-[#FFB930] text-black p-2">
                                <p class="text-center font-semibold">{{ $korwil->nama }}</p>
                            </div>
                        </div>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>