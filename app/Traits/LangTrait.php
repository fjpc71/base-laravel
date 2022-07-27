<?php

namespace App\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use App\Models\Lang;

trait LangTrait {


    public function getLangIsoCode() {

        $langId = Session::get('lang_id');

        $langData = Lang::where('id', $langId)->first();

        return $langData->iso_code;


    }

}