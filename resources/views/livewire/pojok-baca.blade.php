<div class="w-full">
    <div class="flex mt-10 justify-end mb-2">
        <div class="text-end">
            <div class="text-xl font-semibold -mb-1 tracking-wider">Pojok Baca</div>
            <div class="text-sm">Akastrat</div>
        </div> 
        <div class="h-11 w-1 bg-pink-500 ml-2"></div>
    </div>
    <div class="flex flex-col lg:flex-row w-full justify-end">
        <div class="flex flex-col lg:w-1/2 border-b lg:border-r lg:border-b-0 mb-2">
            <div class="border-b">
            Sarana membaca yang disediakan untuk para anggota dalam bentuk perpustakaan sederhana yang mengoleksi berbagai macam bahan bacaan secara fisik maupun digital
            </div>
            <!-- <div class="">
                <div class="text-lg font-semibold">E-book</div>
                <div>Not 1</div>
                <div>Not 1</div>
                <div>Not 1</div>
            </div> -->
        </div>
        <div class="lg:w-2/3">
            <div class="flex flex-wrap space-x-4 justify-center items-center">
                @foreach($books as $book)
                <div class="bg-cover mb-2 w-40 ">
                    <img class="" src="/storage/images/books/{{$book->thumbnail_url}}" alt="">
                </div>
                @endforeach
            </div>
            <a class="ml-2 lg:ml-3">Lihat lebih banyak..</a>
        </div>
    </div>
</div>
