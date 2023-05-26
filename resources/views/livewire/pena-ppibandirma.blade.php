<div>
    <div class="flex mt-10">
        <div class="h-11 w-1 bg-blue-500 mr-2"></div>
        <div>
            <div class="text-xl font-semibold -mb-1 tracking-wider">Pena PPI Bandirma</div>
            <div class="text-sm">Akastrat</div>
        </div> 
    </div>
    <div class="mt-2 flex flex-wrap">
        @if($post)
        <div class="sm:w-1/2 lg:w-1/3 pr-1">
            <img class="w-full" src="{{ $post['_embedded']['wp:featuredmedia'][0]['source_url']}}" alt="">
            <a href="{{$post['link']}}" class="w-72 mt-2 text-lg">{{ $post['title']['rendered']}}</a>
        </div>
        @endif
        <div class="border-y sm:border-x sm:border-y-0 sm:px-2 lg:border-x lg:border-y-0 border-indigo-500/100 my-2 w-full sm:w-1/2 sm:my-0 lg:w-1/3">
            <ul class="list-disc px-0 py-2 lg:px-2">
                @if(!empty($posts))
                @foreach($posts as $post)
                <li class="ml-4 my-1"><a href="{{$post['link']}}" class="hover:italic">{{$post['title']['rendered']}}</a></li>
                <hr>
                @endforeach
                @endif
            </ul>
        </div>
        <div class="lg:w-1/3 sm:pt-2 sm:mt-2 lg:pl-2 sm:border-t lg:border-t-0 border-indigo-500/100">
            Ingin belajar nulis juga? Yuk gabung bareng kita di Pena PPI Bandirma
            <a target="__blank" href="https://bit.ly/3HZ7orp" class="py-1 px-4 bg-blue-600 hover:bg-blue-700 rounded-lg text-white">Gabung</a>
        </div>
    </div>
</div>
