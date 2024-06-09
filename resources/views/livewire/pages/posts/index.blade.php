<?php

use App\Livewire\Forms\PostForm;
use App\Models\Post;

use function Livewire\Volt\{layout, form, with};

form(PostForm::class);
with([
    'posts' => fn() =>  auth()->user()->posts,
]);

$store = function (){
    $this->form->store();
};

$edit = function (Post $post){
    $this->form->edit($post);
};

$update = function (){
    $this->form->update();
};

$delete = function (Post $post){
    $post->delete();
};

?>

<div>
    <x-slot name="header    ">Posts</x-slot>

    <div class="flex">
        <div class="flex-1">
            @forelse($posts as $post)

                <div>{{ $post->title  }}</div>
                <div>{{ $post->body  }}</div>
                <div class="flex space-x-2">
                    <x-primary-button  wire:click="edit({{ $post->id  }})"  class="">
                        Edit
                    </x-primary-button>
                    <x-primary-button  wire:click="delete({{ $post->id  }})"  class="">
                        Delete
                    </x-primary-button>
                </div>

            @empty
                    NO post
            @endforelse
        </div>
        <div class="flex-1">
            <form class="bg-white shadow-md rounded-lg px-8 pt-6">
                <!-- Title  -->
                <div>
                    <x-input-label for="title" :value="__('Title')" />
                    <x-text-input wire:model="form.title" id="title" class="block mt-1 w-full" type="text" name="title"/>
                    <x-input-error :messages="$errors->get('form.title')" class="mt-2" />
                </div>
                  <!-- Body  -->
                <div>
                    <x-input-label for="body" :value="__('Body')" />
                    <x-text-input wire:model="form.body" id="body" class="block mt-1 w-full" type="text" name="body"/>
                    <x-input-error :messages="$errors->get('form.body')" class="mt-2" />
                </div>

                <div class="flex items-center justify-end mt-4">
                    @if( $this->form->editForm )
                        <x-primary-button type="button" wire:click="update"  class="ms-3">
                            Update
                        </x-primary-button>
                    @else
                        <x-primary-button type="button" wire:click="store"  class="ms-3">
                            Store
                        </x-primary-button>
                    @endif
                </div>
            </form>
        </div>
    </div>
</div>

