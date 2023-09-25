@push('head')
<link rel="preload" href="{{url('/assets/hero.webp')}}" as="image">
@endpush
<div class="rounded-b-3xl bg-cover bg-no-repeat" style="background-image: url('/assets/hero.webp'); background-position: 50%; height: 36rem">
    <div class="flex items-center rounded-b-4xl h-full bg-gradient-to-b from-[#302A59] from-10% via-[#4535A7]/30 via-30% to-[#C3189E]/30 to-100% ">
        <div class="font-semibold text-4xl text-center w-full text-white">Hello <span class="bg-[#FFBE3F] "> <span class="px-1 py-0 bg-gradient-to-r from-[#190041] to-[#8C0000] inline-block text-transparent bg-clip-text">Bandirmans</span></span></div>
    </div>
</div>
