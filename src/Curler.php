<?php
declare(strict_types=1);

namespace WernerDweight\Curler;

class Curler
{
    /**
     * @param Request $request
     *
     * @return Response
     */
    public function request(Request $request): Response
    {
        $endpoint = $request->getEndpoint();
        $curl = curl_init();

        switch ($request->getMethod()) {
            case 'POST':
                curl_setopt($curl, CURLOPT_POST, 1);
                if (null !== $request->getPayload()) {
                    curl_setopt($curl, CURLOPT_POSTFIELDS, $request->getPayload());
                }
                break;
            case 'PUT':
                curl_setopt($curl, CURLOPT_PUT, 1);
                break;
            case 'GET':
            default:
                if (null !== $request->getPayload()) {
                    $endpoint = sprintf('%s?%s', $endpoint, http_build_query($request->getPayload()));
                }
                break;
        }

        // set headers
        if (null !== $request->getHeaders()) {
            curl_setopt($curl, CURLOPT_HTTPHEADER, $request->getHeaders());
        }

        // authenticate
        if (null !== $request->getAuthentication()) {
            curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
            curl_setopt(
                $curl,
                CURLOPT_USERPWD,
                sprintf('%s:%s', $request->getAuthentication()['user'], $request->getAuthentication()['password'])
            );
        }

        curl_setopt($curl, CURLOPT_URL, $endpoint);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);

        // ecetuce the call
        $result = (string)curl_exec($curl);

        // get response info
        $responseInfo = [];
        if (!curl_errno($curl)) {
            $responseInfo = curl_getinfo($curl);
        }

        curl_close($curl);

        return new Response($result, $responseInfo);
    }
}
