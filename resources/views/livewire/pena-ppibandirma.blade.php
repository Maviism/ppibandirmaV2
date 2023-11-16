<div class="bg-[#F5F5F5] p-4 rounded-md">
    <div>
        <div class="text-xl font-semibold -mb-1 tracking-wider">Pena PPI Bandirma</div>
        <div class="text-sm">Artikel</div>
    </div> 
    <div class="mt-2 flex flex-wrap">
        @if($post)
        <div class="sm:w-1/2 lg:w-1/3 pr-1">
            <div class="bg-[#D9D9D9] rounded-md px-2 py-3">
                <img class="w-full h-full" src="{{ $post['_embedded']['wp:featuredmedia'][0]['source_url'] ?? '-' }}" alt="">
                <a href="{{$post['link']}}" class="w-72 mt-2 text-lg">{!! $post['title']['rendered'] !!}</a>
            </div>
        </div>
        @endif
        <div class="flex-col border-y-2 sm:border-y-0 pt-2 sm:pt-0 sm:mt-0 sm:px-2 my-2 space-y-3 w-full sm:w-1/2 sm:my-0 lg:w-1/3">
            @if(!empty($posts))
            @foreach($posts as $post)
            <div class="bg-[#D9D9D9] rounded-md px-2 py-3">
                <a href="{{$post['link']}}" class=" hover:italic">
                    {!! $post['title']['rendered'] !!}
                </a>    
            </div>
            @endforeach
            @endif
            <div class="mt-2">
                <a href="https://blog.ppibandirma.com" class="italic text-gray-700 hover:text-gray-900">Lihat artikel lain...</a>
            </div>
        </div>
        <div class="lg:w-1/3 sm:pt-2 sm:mt-2 lg:pl-2 ">
            Ingin belajar nulis juga? Yuk gabung bareng kita di Pena PPI Bandirma
            <a target="__blank" href="https://bit.ly/3HZ7orp" class="py-1 px-4 bg-blue-600 hover:bg-blue-700 rounded-lg text-white">Gabung</a>
        </div>
    </div>
</div>
