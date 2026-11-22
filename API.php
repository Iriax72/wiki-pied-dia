<?php
class API {
    public function __construct () {}

    public function request(string $request, string $lang): array {
        $url = "https://$lang.wikipedia.org/w/api.php";
        $params = [
            'action' => 'query',
            'list' => 'search',
            'srsearch' => $request,
            'format' => 'json',
            'utf8' => 1
        ];
        $url .= '?' . http_build_query($params);
        $curl = curl_init($url);
        curl_setopt_array($curl, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 10,
            CURLOPT_USERAGENT => 'Wiki-pied-dia'
        ]);

        $data = curl_exec($curl);

        $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        $curlError = curl_error($curl);

        if ($data === false || $httpCode !== 200) {
            curl_close($curl);
            throw new Exception('API request failed: ' . $curlError);
        }

        curl_close($curl);
        $response = json_decode($data, true);

        if (!is_array($response) || !isset($response['query']['search'])) {
            throw new Exception('API returned an invalid response');
        }

        return $response['query']['search'];
    }
}
?>