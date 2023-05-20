<x-app-layout>
@section('title', 'Kabinet | ')


    @livewire('kabinet-container', ['periode' => request('periode')])
</x-app-layout>