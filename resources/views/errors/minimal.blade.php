
<x-app-layout>
    <div class="flex justify-center -mb-12 min-h-screen bg-gray-100 items-center sm:pt-0">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <div class="flex items-center pt-8 sm:justify-start sm:pt-0">
                <div class="px-4 text-lg text-gray-700 border-r border-gray-400 tracking-wider">
                    @yield('code')
                </div>

                <div class="ml-4 text-lg text-gray-700 uppercase tracking-wider">
                    @yield('message')
                </div>
            </div>
            <div class="mt-2 ml-4 text-center">
                <a href="/" class="text-blue-400 hover:text-blue-600">Return to home</a>
            </div>
        </div>
    </div>
</x-app-layout>

