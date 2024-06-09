<?php

namespace App\Livewire\Forms;

use App\Models\Post;
use Livewire\Attributes\Validate;
use Livewire\Form;

class PostForm extends Form
{
    public ?Post $post;
    public $editForm = false;

    #[Validate(['required','min:3'])]
    public $title;

    #[Validate(['required','min:3'])]
    public $body;

    public function store()
    {
        $this->validate();

        Post::create($this->all());
    }
}
