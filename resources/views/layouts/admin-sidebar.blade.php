<aside class="w-64 bg-white shadow-md">
    <div class="p-6 text-xl font-bold border-b">
        Admin Panel
    </div>

    <nav class="p-4 space-y-3">
        <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 rounded hover:bg-gray-100">
            Dashboard
        </a>

        <a href="{{ route('admin.places.index') }}" class="block px-4 py-2 rounded hover:bg-gray-100">
            Places
        </a>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="w-full text-left px-4 py-2 rounded hover:bg-gray-100 text-red-600">
                Logout
            </button>
        </form>
    </nav>
</aside>