<?php

namespace App\Livewire;

use Livewire\Component;

class CreatePost extends Component
{
    public PostForm $form;

    public function save()
    {
        $this->form->store();

        return $this->redirect('/posts');
    }
}
