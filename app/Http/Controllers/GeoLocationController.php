<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\App;

class GeoLocationController extends Controller
{
    public function showMessage(Request $request) {
        try {
            $satelites = $request->all()["satelites"];
            $distances = [];
            $messages = [];
            foreach ($satelites as $satelite) {
                $distances[] = $satelite["distance"];
                $messages[] = $satelite["message"];
            }
            $response = [];
            $response["position"] = $this->getLocation($distances);
            $response["message"] = $this->getMessage($messages);
            return response()->json($response, 200);
        } catch (\Exception $e) {
            return response()->json(["message" => "No se pudo determinar la posición o el mensaje"], 404);
        }
    }

    public function splitMode(Request $request, $satelite_name) {
        Cache::put($satelite_name, $request->all());
        return response()->json(["message" => "satelite store"], 200);
    }

    public  function showSplitMode() {
        try {
            $kenobi = Cache::get('kenobi');
            $skywalker = Cache::get('skywalker');
            $sato = Cache::get('sato');
            if($kenobi == null || $skywalker == null || $sato == null) {
                return response()->json(["message" => "No existe suficiente información"], 404);
            }
            $distances = [];
            $distances[] = $kenobi['distance'];
            $distances[] = $skywalker['distance'];
            $distances[] = $sato['distance'];
            $messages = [];
            $messages[] = $kenobi['message'];
            $messages[] = $skywalker['message'];
            $messages[] = $sato['message'];
            $response["position"] = $this->getLocation($distances);
            $response["message"] = $this->getMessage($messages);
            Artisan::call('cache:clear');
            return response()->json($response, 200);
        } catch (\Exception $e) {
            return response()->json(["message" => "No se pudo determinar la posición o el mensaje"], 404);
        }
    }

    public function getLocation($distances) {
        $a1x = env('KENOBIX', -500);
        $a1y = env('KENOBIY', -200);
        $a2x = env('SKYWALKERX', 100);
        $a2y = env('SKYWALKERY', -100);
        $a3x = env('SATOX', 500);
        $a3y = env('SATOY', 100);
        $r1 = $distances[0];
        $r2 = $distances[1];
        $r3 = $distances[2];
        $d = $a2x - $a1x;
        $i = $a3x - $a1x;
        $j = $a3y - $a1y;
        $x = ($r1 ** 2 - $r2 ** 2 + $d ** 2) / (2 * $d);
        $y = ($r1 ** 2 - $r3 ** 2 - $x ** 2 + ($x - $i) ** 2 + $j ** 2) / (2 * $j);
        $x += $a1x;
        $y += $a1y;
        return ["x" => $x, "y" => $y];
    }

    public function getMessage($messages) {
        $str_message = "";
        for ($j = 0; $j < count($messages[0]); $j++) {
            for ($i = 0; $i < count($messages); $i++) {
                $word = $messages[$i][$j];
                if($word != "") {
                    if(!str_contains($str_message, $word . " ")) {
                        $str_message = $str_message . $word . " ";
                    }
                }
            }
        }
        return trim($str_message);
    }
}
