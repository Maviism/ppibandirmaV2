@extends('adminlte::page')

@section('title', 'Links manager')

@section('content_header')
    <h1>Links manager</h1>
@stop

@section('content')

    <div class="container">
        <div class="mx-2">
            <x-adminlte-modal id="linksModal" title="Add New Faq" theme="purple" icon="fas fa-plus" size='lg'>
                <form action="{{route('links.store')}}" method="POST">
                @csrf
                <x-adminlte-input name="iTitle" label="Nama" placeholder="masukan nama" required enable-old-support/>
                <x-adminlte-input name="iLink" label="Link" placeholder="masukan link" required enable-old-support/>
                
                <x-slot name="footerSlot">
                    <x-adminlte-button class="mr-auto" theme="danger" label="cancel" type="button" data-dismiss="modal"/>
                    <x-adminlte-button type="submit" theme="success" label="Add new"/>
                </form>
                </x-slot>
            </x-adminlte-modal>
        </form>
        <x-adminlte-button label="Add New" style="width:100%;" data-toggle="modal" data-target="#linksModal" class="shadow py-3 mb-2" icon="fas fa-plus"/>
        </div>
        <livewire:links />
    </div>
@stop 

@section('js')
@section('plugins.Summernote', true)
@livewireScripts
    <script>
        let root = document.querySelector('[drag-root]')

        root.querySelectorAll('[drag-item]').forEach(el =>{
            el.addEventListener('dragstart', e=>{
                e.target.setAttribute('dragging', true);
            })

            el.addEventListener('drop', e=>{
                e.target.classList.remove('bg-primary')

                let draggingEl = root.querySelector('[dragging]')

                if (e.target.getAttribute('drag-item') < draggingEl.getAttribute('drag-item')) {
                    e.target.before(draggingEl);
                } else {
                    e.target.after(draggingEl);
                }

                // Refresh the livewire component
                let component = Livewire.find(
                    e.target.closest('[wire\\:id]').getAttribute('wire:id')
                )

                let orderIds = Array.from(root.querySelectorAll('[drag-item]')).map(itemEl=> itemEl.getAttribute('drag-item'))

                let method = root.getAttribute('drag-root')

                component.call(method , orderIds)

            })

            el.addEventListener('dragenter', e=>{
                e.target.classList.add('bg-primary')

                e.preventDefault()
            })

            el.addEventListener('dragover', e => e.preventDefault());

            el.addEventListener('dragleave', e=>{
                e.target.classList.remove('bg-primary')
            })

            el.addEventListener('dragend', e=>{
                e.target.removeAttribute('dragging')
            })
        })
    </script>

    <script>
    document.addEventListener('click', function (e) {
        if (e.target.classList.contains('open-edit-modal')) {
            let link = e.target.getAttribute('data-faqid');
            
            let linkJSON = JSON.parse(link);
            $('#editForm input[name="iTitle"]').val(linkJSON.title);
            $('#editForm input[name="iLink"]').val(linkJSON.link);
            $('#editForm').attr('action', `/admin/links/${linkJSON.id}`); 
            $('#deleteLink').attr('href', `/admin/link/${linkJSON.id}/delete`);;
            
            $('#editModal').modal('show');
        }
    });
    </script>
@stop
