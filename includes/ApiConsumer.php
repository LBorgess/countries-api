<?php

class ApiConsumer
{
    /**
     * Método responsável por requerer os dados da API
     * @param string $endpoint
     * @param string $method
     * @param array $post_fields
     * @return void
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
     * @return void
     */
    public function get_all_countries()
    {       
        return $this->api('all');
    }

    /**
     * Método responsável por obter os dados de um determinado
     * país da API
     * @param string $country_name
     * @return void
     */
    public function get_country($country_name)
    {           
        return $this->api("name/$country_name");
    }
}
