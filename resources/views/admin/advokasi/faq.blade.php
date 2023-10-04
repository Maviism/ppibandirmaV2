@extends('adminlte::page')

@section('title', 'FAQ')

@section('content_header')
    <h1>Frequently Ask Question (FAQ)</h1>
@stop

@section('content')
@php
$config = [
    "height" => "100",
    "toolbar" => [
        // [groupName, [list of button]]
        ['style', ['bold', 'italic', 'underline', 'clear']],
        ['para', ['ul', 'ol', 'paragraph']],
        ['insert', ['link']],
        ['color', ['color']],
    ],
]
@endphp
    <div class="container">
        <div class="mx-2">
            <x-adminlte-modal id="faqModal" title="Add New Faq" theme="purple" icon="fas fa-plus" size='lg'>
                <form action="{{route('faq.store')}}" method="POST">
                @csrf
                <x-adminlte-input name="iQuestionNew" label="Question" placeholder="masukan pertanyaan disini" required enable-old-support/>
                <x-adminlte-text-editor required name="tAnswerNew" label="Answer"
                igroup-size="sm" placeholder="tulis jawaban disini..." :config="$config"/>
                
                <x-slot name="footerSlot">
                    <x-adminlte-button class="mr-auto" theme="danger" label="cancel" type="button" data-dismiss="modal"/>
                    <x-adminlte-button type="submit" theme="success" label="Add new"/>
                </form>
                </x-slot>
            </x-adminlte-modal>
        </form>
        <x-adminlte-button label="Add New" style="width:100%;" data-toggle="modal" data-target="#faqModal" class="shadow py-3 mb-2" icon="fas fa-plus"/>
        </div>
        <livewire:faq />
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
            let faq = e.target.getAttribute('data-faqid');
            
            let faqJSON = JSON.parse(faq);
            $('#editForm input[name="iQuestion"]').val(faqJSON.question);
            // $('#editForm textarea[name="tAnswer"]').val(faqJSON.answer); 
            $('#editForm .note-editable').html(faqJSON.answer); 
            $('#editForm').attr('action', `/admin/faq/${faqJSON.id}`); 
            $('#deleteFaq').attr('href', `/admin/faq/${faqJSON.id}/delete`);;
            
            $('#editModal').modal('show');
        }
    });
    </script>
@stop
