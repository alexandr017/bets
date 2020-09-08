<?php

if (! function_exists('ResponseAPI')) {
    /**
     * Модифицированная отправка данных
     *
     * @param mixed $data
     * @return mixed
     */
    function ResponseAPI($data = [], $code = 200, $details = 'OK')
    {
        $data->code = $code;
        $data->details = $details;

        return [
            'response_status' => $code,
            'response_details' => $details,
            'response_data' => $data
        ];
    }
}
