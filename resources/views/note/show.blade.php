<x-app-layout>

    @if(session()->has('flash_message'))
        <div class="alert alert-{{ session('flash_message.type') }}">
            {{--custom response macro session flash--}}
            {{ session('flash_message.message') }}
            {{ session('flash_test.message') }}
        </div>
    @endif


    <div class="note-container single-note">
        <div class="note-header">
            <h1 class="text-3xl py-4">Note: {{ $note->created_at }}</h1>
            <div class="note-buttons">
                <a href="{{ route('note.edit', $note) }}" class="note-edit-button">Edit</a>
                <form action="{{ route('note.destroy', $note) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="note-delete-button">Delete</button>
                </form>
            </div>
        </div>
        <div class="note">
            <div class="note-body">
                {{ $note->note }}
            </div>
        </div>
    </div>
</x-app-layout>
