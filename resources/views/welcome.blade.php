<x-app-layout>
@section('title', 'Home | ')
    <x-hero/>
    <x-about-us/>
    <x-program-kerja/>
    @if(isset($faqs))
    <x-faq :faqs="$faqs"/>
    @endif
</x-app-layout>

