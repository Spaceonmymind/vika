<?php

use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('App.Models.UserProfile.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});
