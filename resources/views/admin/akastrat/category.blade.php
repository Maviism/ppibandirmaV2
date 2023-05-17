<div class="card">
    <div class="card-header">
        <h3 class="card-title">List category</h3>
        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse">
            <i class="fas fa-minus"></i>
            </button>
        </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body ">
        <form action="{{ route('category.store') }}" method="POST">
        <x-adminlte-modal id="categoryModal" title="Add Category" theme="purple" icon="fas fa-plus" size='md'>
            @csrf
            <x-adminlte-input name="iCategory" label="New Category" placeholder="contoh: Edukasi/Parenting/Novel" required enable-old-support/>
            <x-slot name="footerSlot">
                <x-adminlte-button class="mr-auto" theme="danger" label="cancel" type="button" data-dismiss="modal"/>
                <x-adminlte-button type="submit" theme="success" label="Submit"/>
            </x-slot>
        </x-adminlte-modal>
        </form>
        <x-adminlte-button label="Add Category" data-toggle="modal" data-target="#categoryModal" class="bg-purple mb-2" icon="fas fa-plus"/>
        <x-adminlte-datatable id="categoryList" :heads="[
                ['label' => 'No', 'width' => 1],
                'Category',
                'Action'
            ]" head-theme="dark" striped compressed>
            @foreach($categories as $category)
            <tr>
                <td>1</td>
                <td>{{ $category->name }}</td>
                <td>
                    <a href="" class="btn btn-xs btn-default text-primary shadow" title="Edit">
                        <i class="fa fa-lg fa-fw fa-pen"></i>
                    </a>
                    <button onclick="deleteCategory({{$category->id}})" class="btn btn-xs btn-default text-danger shadow" title="Delete">
                        <i class="fa fa-lg fa-fw fa-trash"></i>
                    </button></td>
                </tr>
            @endforeach
        </x-adminlte-datatable>
    </div>
    <!-- /.card-body -->
</div>
