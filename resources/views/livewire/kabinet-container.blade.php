<div class="-mb-12 min-h-screen">
    <div class="bg-gray-900 h-60 p-10 flex flex-col justify-center items-center">
        <div class="mt-10 text-2xl text-white">Kabinet {{ $kabinet->name }}</div>
        <div class="text-center text-gray-200">Periode {{$kabinet->periode}}</div>
    </div>
    <div class="flex flex-wrap justify-center mb-12">
        @foreach($kabinet->kabinetPerson as $person)
        <div class="relative bg-cover bg-center bg-no-repeat w-48 h-72" style="background-image: url({{ env('APP_URL') }}/storage/images/kabinet/{{$person->profile_pict_url}})">
            <div class="absolute bottom-0 left-0 w-full h-18 flex flex-col text-center bg-white/75">
                <div class="text-gray-900 text-md font-bold">{{$person->name}}</div>
                <div class="text-gray-700 text-sm">{{$person->position}}</div>
                <div class="text-black text-sm">{{$person->instagram}}</div>
            </div>
        </div>
        @endforeach
    </div>
</div>
