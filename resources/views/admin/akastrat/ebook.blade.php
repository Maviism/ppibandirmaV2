<div class="card">
    <div class="card-header">
        <h3 class="card-title">List E-Book</h3>
        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse">
            <i class="fas fa-minus"></i>
            </button>
        </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body ">
        <form action="{{ route('ebook.store') }}" method="POST">
        <x-adminlte-modal id="ebookModal" title="Add E-Book" theme="purple" icon="fas fa-plus" size='md'>
            @csrf
            <x-adminlte-input name="iFolderName" label="Folder Name" placeholder="" required enable-old-support/>
            <x-adminlte-input name="iFolderUrl" label="Url" placeholder="" required enable-old-support/>
            <x-slot name="footerSlot">
                <x-adminlte-button class="mr-auto" theme="danger" label="cancel" type="button" data-dismiss="modal"/>
                <x-adminlte-button type="submit" theme="success" label="Submit"/>
            </x-slot>
        </x-adminlte-modal>
        </form>
        <x-adminlte-button label="Add E-Book" data-toggle="modal" data-target="#ebookModal" class="bg-teal mb-2" icon="fas fa-plus"/>
        <x-adminlte-datatable id="ebookList" :heads="[
                ['label' => 'No', 'width' => 1],
                'Folder Name',
                'Url',
                ['label' => 'Action', 'width' => 1]
            ]" head-theme="dark" striped compressed>
            @foreach($ebooks as $ebook)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $ebook->folder_name }}</td>
                <td>{{ $ebook->folder_url }}</td>
                <td>
                    <button onclick="deleteEbook({{$ebook->id}})" class="btn btn-xs btn-default text-danger shadow" title="Delete">
                        <i class="fa fa-lg fa-fw fa-trash"></i>
                    </button></td>
                </td>
            </tr>
            @endforeach            
        </x-adminlte-datatable>
    </div>
    <!-- /.card-body -->
</div>
