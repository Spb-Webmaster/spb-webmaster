<?php

namespace App\Http\Controllers\Axios;

use App\Http\Controllers\Controller;
use App\Http\Requests\CallMeBlueRequest;
use App\Jobs\Form\CallMeBlueJob;
use Illuminate\Http\Request;

class AxiosController extends Controller
{
    public function async(Request $request)
    {
        if ($request->template === 'call_me_blue') {
            return view('axios.forms.call_me_blue');
        }

        return view('axios.forms.error.error_form');
    }

    public function callMeBlue(CallMeBlueRequest $request)
    {
        $data = array_filter([
            'Имя'       => $request->input('name'),
            'Телефон'   => $request->input('phone'),
            'Тип'       => $request->input('type'),
            'Сообщение' => $request->input('msg'),
        ]);

        CallMeBlueJob::dispatch($data);

        return response()->json(['response' => 'ok']);
    }
}
