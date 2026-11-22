<?php
class API {
    public function __construct () {}

    public function request(string $request, string $lang): array {
        $url = "https://$lang.wikipedia.org/w/api.php";
        $params = [
            'action' => 'query',
            'list' => 'search',
            'srsesrch' => $request,
            'format' => 'json',
            'utf8' => 1
        ];
        $url .= '?' . http_build_query($params);
        $curl = curl_init($url);
        curl_setopt_array($curl, [
            CURLOPT_RETURNTRANSFERE => true,
            CURLOPT_TIMEOUT => 10,
            CURLOPT_USERAGENT => 'Wiki-pied-dia'
        ]);

        $data = curl_exec($curl);

        if ($data == false || curl_getinfo($curl, CURLINFO_HTTP_CODE) !== 200) {
            curl_close($curl);
            throw new Exception('API request failed: ' . curl_error($curl));
        }

        curl_close($curl);
        return json_decode($data, true);
    }
}
?>