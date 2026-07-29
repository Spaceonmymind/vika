<?php

namespace Modules\Esia\Clients;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Http;
use Modules\Esia\Dto\CasTicketValidationResult;
use SimpleXMLElement;
use Throwable;

final class CasClient
{
    public function loginRedirect(): RedirectResponse
    {
        return redirect()->away($this->loginUrl());
    }

    public function loginUrl(): string
    {
        return config('esia.login_url') . '?service=' . urlencode(route('esia.callback'));
    }

    public function logoutRedirect(?string $redirectAfterLogout = null): RedirectResponse
    {
        return redirect()->away($this->logoutUrl($redirectAfterLogout));
    }

    public function logoutUrl(?string $redirectAfterLogout = null): string
    {
        if ($redirectAfterLogout === null) {
            return config('esia.logout_url');
        }

        return config('esia.logout_url') . '?service=' . urlencode($redirectAfterLogout);
    }

    public function validateTicket(string $ticket): CasTicketValidationResult
    {
        try {
            $res = Http::timeout(5)->get(config('esia.validate_ticket_url'), [
                'ticket' => $ticket,
                'service' => route('esia.callback'),
            ]);
        } catch (Throwable) {
            return CasTicketValidationResult::failure('HTTP_EXCEPTION', 'CAS not reachable');
        }

        if (!$res->ok() ? $res->body() : null) {
            return CasTicketValidationResult::failure('HTTP_ERROR', 'CAS not reachable');
        }

        // success:
        // <cas:serviceResponse xmlns:cas='http://www.yale.edu/tp/cas'>
        //    <cas:authenticationSuccess>
        //        <cas:user>12345678901</cas:user>
        //    </cas:authenticationSuccess>
        // </cas:serviceResponse>
        //
        // failure:
        // <cas:serviceResponse xmlns:cas='http://www.yale.edu/tp/cas'>
        //    <cas:authenticationFailure code='INVALID_SERVICE'>
        //            текст ошибки
        //    </cas:authenticationFailure>
        // </cas:serviceResponse>
        $xml = simplexml_load_string($res->body());
        if (!($xml instanceof SimpleXMLElement)) {
            return CasTicketValidationResult::failure('BAD_XML', 'Cannot parse CAS XML');
        }
        $xml->registerXPathNamespace('cas', '');

        $fail = $xml->xpath('//cas:authenticationFailure');
        if ($fail && isset($fail[0])) {
            $code = (string)$fail[0]['code'];
            $msg = trim((string)$fail[0]);

            return CasTicketValidationResult::failure($code, $msg);
        }

        $success = $xml->xpath('//cas:authenticationSuccess');
        if (!$success || !isset($success[0])) {
            return CasTicketValidationResult::failure('NO_SUCCESS', 'No success node');
        }

        $userNode = $success[0]->xpath('cas:user');
        $snils = $userNode && isset($userNode[0]) ? trim((string)$userNode[0]) : null;

        if (!$snils) {
            return CasTicketValidationResult::failure('NO_SNILS', 'Empty snils');
        }

        return CasTicketValidationResult::success($snils);
    }
}
