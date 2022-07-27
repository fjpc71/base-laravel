<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Support\Facades\Redirect;

class OrderExists extends Exception
{
    public function render()
    {
        session()->flash("danger", __('custom.order_already_exists'));
        return Redirect::back()->withErrors(__('custom.order_already_exists'));
    }
}
