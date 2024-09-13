<div class="flex justify-center items-center   ">
    <div class=" rounded-xl p-12 max-w-2xl text-center">
        @if(Auth::check() && Auth::user()->role == 2)

            <h1 class="text-5xl font-extrabold text-indigo-700 mb-8">Welcome, {{ Auth::user()->name }}!</h1>
            <p class="text-2xl text-gray-800 font-semibold mb-6">You're now a <span class="text-indigo-600">Service Provider</span>.</p>
            <p class="text-lg text-gray-600 leading-relaxed">We appreciate you joining our platform to offer your services. Let's make a difference together!</p>
        @endif
    </div>
</div>
