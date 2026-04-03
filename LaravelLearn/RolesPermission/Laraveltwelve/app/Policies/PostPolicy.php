<?php

use App\Models\Post;
use App\Models\User;

class PostPolicy
{
    public function viewAny(User $user)
    {
        return $user->can('post.view');
    }

    public function update(User $user, Post $post)
    {
        return $user->can('post.update') && $user->id === $post->user_id;
    }

    public function delete(User $user, Post $post)
    {
        return $user->can('post.delete') && $user->id === $post->user_id;
    }
}
