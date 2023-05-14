<x-app-layout>
@section('title', 'Event | ')
    <div class="bg-gray-900 h-60 p-10 flex justify-center items-center">
        <div class="mt-10 text-2xl text-white">
            Kabinet
        </div>
    </div>

    @livewire('kabinet-container')
</x-app-layout>