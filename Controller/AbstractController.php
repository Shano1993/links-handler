<?php

namespace App\Controller;

use Exception;

abstract class AbstractController
{
    /**
     * @return mixed
     */
    abstract public function index();

    /**
     * @param string $temp
     * @param array $data
     * @return void
     */
    public function render(string $temp, array $data = [])
    {
        ob_start();
        require __DIR__ . '/../View/' . $temp . '.html.php';
        $html = ob_get_clean();
        require __DIR__ . '/../View/base.html.php';
    }

    /**
     * @param string $field
     * @param $default
     * @return mixed|string
     */
    public function getField(string $field, $default = null)
    {
        if (!isset($_POST[$field])) {
            return (null === $default) ? '' : $default;
        }
        return $_POST[$field];
    }

    /**
     * @return bool
     */
    public function isFormSubmitted(): bool
    {
        return isset($_POST['save']);
    }

    /**
     * @param string $param
     * @return string
     */
    public static function sanitizeString(string $param): string
    {
        return filter_var($param, FILTER_SANITIZE_STRING);
    }

    /**
     * @return bool
     */
    public static function userConnected(): bool
    {
        return isset($_SESSION['user']) && null !== ($_SESSION['user'])->getId();
    }

    /**
     * @param string $randomName
     * @return string
     * @throws Exception
     */
    public static function getRandomName(string $randomName): string
    {
        $infos = pathinfo($randomName);
        try {
            $bytes = random_bytes(20);
        }
        catch (Exception $exception) {
            $bytes = openssl_random_pseudo_bytes(20);
        }
        return bin2hex($bytes) . '.' . $infos['extension'];
    }

    /**
     * @param $tmpname
     * @return bool
     */
    public static function checkImageMime($tmpname): bool
    {
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mtype = finfo_file($finfo, $tmpname);
        if (strpos($mtype, 'image/') === 0) {
            return true;
        }
        finfo_close($finfo);
        return false;
    }
}
