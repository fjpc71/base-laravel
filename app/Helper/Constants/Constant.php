<?php

namespace App\Helper\Constants;

use Illuminate\Support\Facades\Storage;

class Constant
{
    public static function find($keys = null)
    {
        $value = json_decode(Storage::disk('local')->get('constants.json'), true);
        try {
            if (!$keys) {
                return $value;
            }
            $v = $value;
            $keys = explode(".", $keys);

            foreach ($keys as $key) {
                $v = $v[$key];
            }
            return $v;
        } catch (\Exception $e) {
            return null;
        }
    }
    public static function set($array, $group = null)
    {
        if (!Storage::disk('local')->exists('constants.json')) {
            $dict = [];
        } else {
            $dict = json_decode(Storage::disk('local')->get('constants.json'), true);
        }

        if ($group) {
            if (!array_key_exists($group, $dict)) {
                $dict[$group] = [];
            }

            foreach ($array as $key => $value) {
                $dict[$group][$key] = $value;
            }
        } else {
            foreach ($array as $key => $value) {
                $dict[$key] = $value;
            }
        }
        Storage::disk('local')->put('constants.json', json_encode($dict));
    }
}
