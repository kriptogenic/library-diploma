<?php

namespace App\Http\Controllers;

use App\Models\Library;
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

        return new JsonResponse([
            'message' => 'Ro\'yxatdan o\'tildi',
        ]);
    }
}
