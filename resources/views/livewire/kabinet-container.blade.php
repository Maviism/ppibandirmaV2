<div>
    {{-- Stop trying to control. --}}
    <div>
        <div class="text-center text-lg font-semibold">
            Kabinet {{ $kabinet->name }}
        </div>
        <div class="text-center text-gray-700">Periode {{$kabinet->periode}}</div>
        <div class="flex">
            @foreach($kabinet->kabinetPerson as $person)
                <div class="m-4 p-5 bg-yellow-300">
                    <img src="/storage/images/kabinet/{{$person->profile_pict_url}}" alt="">
                    {{$person->name}}
                    <div>{{$person->position}}</div>
                    {{$person->instagram}}
                </div>
            @endforeach
        </div>
    </div>
</div>
