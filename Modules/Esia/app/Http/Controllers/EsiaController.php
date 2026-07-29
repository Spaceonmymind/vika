<?php

namespace Modules\Esia\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;
use Modules\Esia\Clients\CasClient;
use Modules\Esia\Http\Requests\EsiaCallbackRequest;

final class EsiaController extends Controller
{
    public function __construct(
        private readonly CasClient $cas
    )
    {
        parent::__construct();
    }

    public function redirect(): RedirectResponse
    {
        return $this->cas->loginRedirect();
    }

    public function callback(EsiaCallbackRequest $request): RedirectResponse
    {
        $serviceTicket = $request->validated('ticket');

        $response = $this->cas->validateTicket($serviceTicket);

        if (!$response->ok) {
            Log::warning(
                'CAS ticket validation failed',
                ['code' => $response->errorCode, 'msg' => $response->errorMessage],
            );

            return redirect()->route('esia.error');
        }

        $request->session()->put('snils', $response->snils);

        return redirect()->to(config('esia.callback_redirect_url'));
    }
}
