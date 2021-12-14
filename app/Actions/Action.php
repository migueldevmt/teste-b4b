<?php

namespace App\Actions;

use App\Events\ActionExecuted;
use Illuminate\Support\Facades\Auth;

class Action
{
    public function __construct()
    {
        $user = Auth::user();
        $userName = $user?->name ?? "Anonymous";
        $actionName = get_class($this);

        ActionExecuted::dispatch("$userName executed $actionName");
    }
}