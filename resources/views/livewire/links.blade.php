<div>
    <ul drag-root="reorder" class="d-flex flex-column container">
        @foreach($links as $faq)
            <li drag-item="{{ $faq['id'] }}" draggable="true" wire:key="{{ $faq->id }}" class="btn btn-light shadow my-1 d-flex justify-content-between">
                <div>{{ $faq->title }}</div>
                <x-adminlte-button label="Edit" data-toggle="modal" data-target="#editModal" data-faqid="{{ $faq }}" class="bg-warning btn-xs px-2 open-edit-modal" />
            </li>
            
        @endforeach
    </ul>

    <form id="editForm" method="POST">
    <x-adminlte-modal id="editModal" title="Edit link" theme="purple" size='lg'>
        <a href="" id="deleteLink" class="btn btn-danger btn-xs">Delete</a>
        @csrf
        @method('PUT')
        <x-adminlte-input name="iTitle" label="Title" placeholder="masukan title" required enable-old-support/>
        <x-adminlte-input name="iLink" label="Link" placeholder="masukan link" required enable-old-support/>
        
        <x-slot name="footerSlot">
            <x-adminlte-button class="mr-auto" theme="light" label="Cancel" type="button" data-dismiss="modal"/>
            <x-adminlte-button type="submit" theme="success" label="Edit"/>
        </x-slot>
    </x-adminlte-modal>
    </form>
    
</div>



