<?php

namespace App\Helpers;

use Illuminate\Http\Request;


class RequestHelper {
    public static function sanitize(Request $request, array $keys): array {
        $results = [];
        foreach($keys as $key) {
            $results[$key] = strip_tags($request->input($key));
        }
        return $results;
    }
}

?>
