<?php

namespace App\Exceptions;

use Exception;
use Inertia\Inertia;

class MessageException extends Exception
{
  public $code;
  public $message;
  public function __construct($message, $code = 401){
    $this->message = $message;
    $this->code = $code;
  }
  /**
  * Report the exception.
  *
  * @return void
  */
  public function report()
  {

    return false;
  }

  public function render($request)
 {
   // the first function will give us nice errors
    //return response($e->getMessage(), $response->status());
    return response($this->message, $this->code);
  }

}
