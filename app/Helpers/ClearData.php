<?php

if (! function_exists('clearData')) {
    /**
     * Функция очищает код от возможных иньекций и взломов
     *
     * @param mixed $data
     * @return mixed
     */
    function clearData($data)
    {
        if (gettype($data) == 'array') {

            foreach ($data as $key => $value) {
                $data[$key] = addslashes(stripslashes(htmlspecialchars(strip_tags($value))));
            }

            return $data;

        } elseif (gettype($data) == 'string') {
            return addslashes(stripslashes(htmlspecialchars(strip_tags($data))));
        } else {
            //
        }
    }
}
