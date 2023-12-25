<?php

class ApiConsumer
{
    /**
     * Método responsável por requerer os dados da API
     * @param string $endpoint
     * @param string $method
     * @param array $post_fields
     */
    private function api($endpoint, $method = 'GET', $post_fields = [])
    {
        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => "https://restcountries.com/v3.1/$endpoint",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => $method,
            CURLOPT_HTTPHEADER => [
                "Accept: */*"
            ],
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
            die(0);
        } else {
            return json_decode($response, true);
        }
    }

    /**
     * Método responsável por obter todos os dados da API
     */
    public function get_all_countries()
    {
        $results  =  $this->api('all');
        $coutries = [];
        foreach ($results as $result) {
            $coutries[] = $result['name']['common'];
        }
        sort($coutries);
        return $coutries;
    }

    /**
     * Método responsável por obter os dados de um determinado
     * país da API
     * @param string $country_name
     */
    public function get_country($country_name)
    {   
        $country_name = str_replace(' ', '%20', $country_name);
        return $this->api("name/$country_name");
    }
}
