<div class="-mb-12 min-h-screen">
    <div class="bg-gray-900 h-60 p-10 flex flex-col justify-center items-center">
        <div class="mt-10 text-2xl text-white">Kabinet {{ $kabinet->name }}</div>
        <div class="text-center text-gray-200">Periode {{$kabinet->periode}}</div>
    </div>
    <div class="flex flex-wrap justify-center mb-12 ">
        @foreach($kabinet->kabinetPerson as $person)
        <div class="relative w-44 m-1">
            <img src="{{ env('APP_URL') }}/storage/images/kabinet/{{$person->profile_pict_url ?: 'undefined-pp.png'}}" alt="">
            <div class="absolute bottom-0 left-0 w-full flex flex-col text-center bg-gradient-to-t from-black h-16">
                <div class="text-gray-100 text-sm font-bold">{{$person->name}}</div>
                <div class="text-gray-100 text-xs">{{$person->position}}</div>
            </div>
        </div>
        @endforeach
    </div>
</div>
