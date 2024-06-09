<div>
    @vite('resources/css/app.css')


    <x-mary-header title="Todos" subtitle="Simple To Do CRUD" separator />

    <livewire:todos.create />

    <div class="pt-16">
        <livewire:todos.list />
    </div>


</div>
