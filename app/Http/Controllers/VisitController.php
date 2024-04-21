<?php

namespace App\Http\Controllers;

use App\Models\Library;
use App\Models\Visit;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class VisitController extends Controller
{
    public function __invoke(Request $request)
    {
        $data = $request->validate([
            'id' => ['required', 'string', 'uuid']
        ]);

        $library = Library::where('uuid', $data['id'])
            ->first();
        if ($library === null) {
            return new JsonResponse([
                'message' => 'Kutubxona topilmadi',
            ], 400);
        }

        $visit = new Visit();
        $visit->user()->associate($request->user());
        $visit->library()->associate($library);
        $visit->save();

        return new JsonResponse([
            'message' => 'Ro\'yxatdan o\'tildi',
        ]);
    }
}
