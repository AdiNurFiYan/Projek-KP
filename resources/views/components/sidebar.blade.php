<aside class="sidebar bg-gray-800 w-64 min-h-screen flex flex-col transition-transform duration-300 ease-in-out md:translate-x-0 -translate-x-full fixed md:relative z-50">
    <!-- Logo/Brand -->
    <div class="px-6 py-4 border-b border-gray-700">
        <div class="flex items-center justify-between">
            <span class="text-white text-xl font-bold">ADMIN PANEL</span>
            <!-- Close button for mobile -->
            <button class="md:hidden text-gray-300 hover:text-white">
                <i class="fas fa-times"></i>
            </button>
        </div>
    </div>

    <!-- Navigation Menu -->
    <nav class="flex-1 px-4 py-6 space-y-6">
        <!-- Dashboard -->
        <div>
            <a href="{{ route('admin.dashboard') }}" 
               class="flex items-center px-4 py-2.5 text-gray-300 hover:bg-gray-700 hover:text-white rounded-lg transition-colors {{ request()->routeIs('admin.dashboard') ? 'bg-gray-700 text-white' : '' }}">
                <i class="fas fa-home w-5 h-5 mr-3"></i>
                <span>Dashboard</span>
            </a>
        </div>

        <!-- Data Management Section -->
        <div>
            <p class="px-4 text-xs font-semibold text-gray-400 uppercase tracking-wider">
                Data Management
            </p>
            <div class="mt-3 space-y-2">
                <a href="{{ route('data.sekolah') }}" 
                   class="flex items-center px-4 py-2.5 text-gray-300 hover:bg-gray-700 hover:text-white rounded-lg transition-colors {{ request()->routeIs('data.sekolah*') ? 'bg-gray-700 text-white' : '' }}">
                    <i class="fas fa-school w-5 h-5 mr-3"></i>
                    <span>Data Sekolah</span>
                </a>
                <a href="{{ route('data.barang') }}" 
                   class="flex items-center px-4 py-2.5 text-gray-300 hover:bg-gray-700 hover:text-white rounded-lg transition-colors {{ request()->routeIs('data.barang*') ? 'bg-gray-700 text-white' : '' }}">
                    <i class="fas fa-box w-5 h-5 mr-3"></i>
                    <span>Data Barang</span>
                </a>
            </div>
        </div>

        <!-- Account Management Section -->
        <div class="mt-auto">
            <p class="px-4 text-xs font-semibold text-gray-400 uppercase tracking-wider">
                Account
            </p>
            <div class="mt-3 space-y-2">
                <a href="{{ route('profile.edit') }}" 
                   class="flex items-center px-4 py-2.5 text-gray-300 hover:bg-gray-700 hover:text-white rounded-lg transition-colors">
                    <i class="fas fa-user w-5 h-5 mr-3"></i>
                    <span>Profile</span>
                </a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" 
                            class="w-full flex items-center px-4 py-2.5 text-gray-300 hover:bg-gray-700 hover:text-white rounded-lg transition-colors">
                        <i class="fas fa-sign-out-alt w-5 h-5 mr-3"></i>
                        <span>Logout</span>
                    </button>
                </form>
            </div>
        </div>
    </nav>
</aside>