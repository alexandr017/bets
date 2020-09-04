<?php

if (! function_exists('ResponseAPI')) {
    /**
     * Функция очищает код от возможных иньекций и взломов
     *
     * @param mixed $data
     * @return mixed
     */
    function ResponseAPI($data = [], $code = 200, $details = 'OK')
    {
        return response()->json([
            'data' => $data,
            'status' => $code,
            'details' => $details,
        ], $code);
    }
}
