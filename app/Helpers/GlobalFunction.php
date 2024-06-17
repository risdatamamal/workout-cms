<?php
// Ini untuk custom function

namespace App\Helpers;

use Illuminate\Support\Str;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Jenssegers\Agent\Agent;
use App\Database\T_GeneralSetting;

trait GlobalFunction
{
    public static function itWorks()
    {
        return 'it works!';
    }

    public static function getPath($pathname = 'public')
    {
        $path = null;

        if ($pathname == 'public') {
            $path = public_path();
        }

        if ($pathname == 'app') {
            $path = app_path();
        }

        if ($pathname == 'base') {
            $path = base_path();
        }

        if ($pathname == 'config') {
            $path = config_path();
        }

        if ($pathname == 'database') {
            $path = database_path();
        }

        if ($pathname == 'resource') {
            $path = resource_path();
        }

        if ($pathname == 'storage') {
            $path = storage_path();
        }

        return $path;
    }

    public static function checkVersion($laravel_version = 6)
    {
        $current_version = app()->version();
        $pattern_version = '/^' . $laravel_version . '\.(.*)\.(.*)$/i';

        $result = preg_match($pattern_version, $current_version);
        return $result ? true : false;
    }

    public static function truncated($string = null, $len = 30, $append = '...')
    {
        $string     = trim(strip_tags($string));
        $cutstring  = substr($string, 0, $len);
        return strlen($string) > 200
            ? $cutstring . '...'
            : $cutstring;
    }

    public static function pad($string = null, $len = 0, $position = 'both', $append = '')
    {
        $result = null;
        $isVersion6 = self::checkVersion(6);

        if ($isVersion6 === true) {
            if ($position == 'both') {
                $result = str_pad($string, (int) $len, $append, STR_PAD_BOTH);
            }

            if ($position == 'left') {
                $result = str_pad($string, (int) $len, $append, STR_PAD_LEFT);
            }

            if ($position == 'right') {
                $result = str_pad($string, (int) $len, $append, STR_PAD_RIGHT);
            }
        } else {
            if ($position == 'both') {
                $result = Str::padBoth($string, (int) $len, $append);
            }

            if ($position == 'left') {
                $result = Str::padLeft($string, (int) $len, $append);
            }

            if ($position == 'right') {
                $result = Str::padRight($string, (int) $len, $append);
            }
        }

        return $result;
    }

    public static function replaceString($string, $keywords, $replace = null, $openTag = '', $closeTag = '')
    {
        $replace = empty($replace) ? $keywords : $replace;

        if (is_array($keywords)) {
            $pattern = array_map(function ($item) {
                return $item;
            }, $keywords);

            $replacement    = array_map(function ($item) use ($openTag, $closeTag) {
                return $openTag . $item . $closeTag;
            }, $replace);
        } else {
            $pattern        = $keywords;
            $replacement    = $openTag . $replace . $closeTag;
        }

        // return preg_replace( $pattern, $replacement, $string );
        return str_replace($pattern, $replacement, $string);
    }

    public static function strFindPos($string, $keywords)
    {
        $len    = strlen($string);
        $find   = strpos($string, $keywords);

        if ($find === false) return false;

        $start = $find < 200 ? 0 : $find;

        $substring = substr($string, $start, $len);
        return $substring;
    }

    public static function boldString($string, $keywords, $replace = null)
    {
        $replace = empty($replace) ? $keywords : $replace;

        if (is_array($replace)) {
            $replacement = array_map(function ($item) use ($replace) {
                return '<strong></strong>';
            }, $replace);
        } else {
            $replacement = '<strong>' . $replace . '</strong>';
        }

        return self::replaceString($string, $replace, $replacement);
    }

    public static function escapeHtml($html)
    {
        return trim(strip_tags($html));
    }

    public static function foreignKeyEnable()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
    }

    public static function foreignKeyDisable()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }

    public static function showError($line, $message, $file = null)
    {
        return 'There is an error on -> Line (' . $line . ') | Message: ' . $message . ' | File: ' . $file;
    }

    public static function responseView($view, $data = [])
    {
        return response()->view($view, $data)
            ->header('X-Content-Type-Options', 'nosniff')
            ->header('X-XSS-Protection', '1; mode=block')
            ->header('Cache-control', 'no-cache, max-age=86400, must-revalidate')
            ->header('X-Frame-Options', 'SAMEORIGIN')
            ->header('Strict-Transport-Security', 'max-age=31536000; includeSubDomains; preload')
            ->header('Referrer-Policy', 'no-referrer');
    }

    public static function responseJson($response = [], $status_code = 200, $cors = 'no')
    {
        $agent = new Agent;

        $response = response()->json($response, $status_code)
            ->header('X-Content-Type-Options', 'nosniff')
            ->header('X-XSS-Protection', '1; mode=block')
            ->header('Cache-control', 'no-cache, max-age=0, no-store, must-revalidate')
            ->header('X-Frame-Options', 'SAMEORIGIN')
            ->header('Strict-Transport-Security', 'max-age=31536000; includeSubDomains; preload')
            ->header('Referrer-Policy', 'no-referrer');

        if ($cors == 'yes') {
            $response = $response->header('Access-Control-Allow-Origin', '*')
                ->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
                ->header('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Authorization');
        }

        return $response;
    }

    public static function generateId()
    {
        return Str::uuid()->toString();
    }

    public static function rand($length = 36)
    {
        if (!is_numeric($length)) $length = 36;
        return Str::random($length);
    }

    public static function kebab($string)
    {
        return Str::kebab($string);
    }

    public static function slug($string, $divider = '-')
    {
        return Str::slug($string, $divider);
    }

    public static function isEmpty($data = [])
    {
        $data = is_array($data) ? $data : func_get_args();

        $filter = array_filter($data, function ($item) {
            return empty($item);
        });

        return count($filter) > 0
            ? true
            : false;
    }

    public static function isArrayExist($data = [], $key = null)
    {
        if (!is_array($data)) return false;
        return Arr::exists($data, $key);
    }

    public static function getRouteName()
    {
        return Route::currentRouteName();
    }

    public static function getModifiedBy($created_by = '', $modified_by = '')
    {
        return empty($modified_by)
            ? $created_by
            : $modified_by;
    }

    public static function getModifiedDate($created_date = '', $modified_date = '', $format = 'Y-m-d')
    {
        return empty($modified_date)
            ? date($format, strtotime($created_date))
            : date($format, strtotime($modified_date));
    }

    public static function getPageByUrl($url = null, $key = 'page')
    {
        $page = null;

        if (!empty($url)) {
            $parse = parse_url($url, PHP_URL_QUERY);
            parse_str($parse, $data);
            $page = (int) $data[$key];
        }

        return $page;
    }

    public static function getBadgeLabel($label)
    {
        $result = '';
        if (in_array($label, ['New'])) {
            $result = 'badge-warning';
        } else if (in_array($label, ['Connected', 'Approved'])) {
            $result = 'badge-success';
        } else {
            $result = 'badge-danger';
        }

        return $result;
    }

    public static function getPaymentStatusLabel($status)
    {
        $result = '';

        if ($status == 1) {
            $result = 'badge-success';
        } else {
            $result = 'badge-warning';
        }

        return $result;
    }

    public static function getOrderStatusLabel($status)
    {
        $result = '';

        if ($status == 2) {
            $result = 'badge-info';
        } else if ($status == 3) {
            $result = 'badge-success';
        } else if (in_array($status, ['0', '1'])) {
            $result = 'badge-warning';
        } else {
            $result = 'badge-danger';
        }

        return $result;
    }

    public static function randomNumber($digit = 4)
    {
        $number = '0123456789';
        $length = strlen($number);
        $result = '';

        for ($i = 0; $i < $digit; $i++) {
            $random = mt_rand(0, $length);
            $result .= $number[$random - 1];
        }

        return $result;
    }

    public static function replacePhoneNumber($phone_number, $replacement = '', $prefix = [])
    {
        if (count($prefix) == 0) {
            $pattern = ['/^62/', '/^0/'];
        } else {
            array_push($prefix, '/^0/');

            $pattern = array_map(function ($item) {
                return '/^' . $item . '/';
            }, $prefix);
        }

        $phone_number = str_replace('+', '', $phone_number);

        if ($replacement == '') $replacement = '62';
        return preg_replace($pattern, $replacement, $phone_number);
    }

    public static function censorString($string)
    {
        $explode = explode(" ", $string);
        $result = "";
        foreach ($explode as $key => $item) {
            $lenght = strlen($item);
            if ($lenght > 3) {
                $count = $lenght - 3;
                $output = substr_replace($item, str_repeat('*', $count), 3);
            } else {
                $count = $lenght - 1;
                $output = substr_replace($item, str_repeat('*', $count), 1);
            }

            if ($key == 0) {
                $result = $output;
            } else {
                $result .= " " . $output;
            }
        }

        return $result;
    }

    public static function validationUpload($file, $maxImageSize = 3097152, $arrayExtension = ['png', 'jpg', 'jpeg'])
    {
        $response = true;
        if (!in_array_any([$file->getClientOriginalExtension()], $arrayExtension)) {

            $response = false;
        } else {

            if ($file->getSize() > $maxImageSize) {

                $response = false;
            }
        }

        return $response;
    }

    public static function writeLog($url, $message, $log_channel = '', $request_data = [], $request_method = 'GET', $status_code = 200, $ip = null)
    {
        $request_data = is_array($request_data) ? json_encode($request_data) : '{}';
        $result = (empty($ip) ? '' : '[' . $ip . '] | ');
        $result .= '[' . $request_method . '] ' . $url;
        $result .= ' | MESSAGE: ' . $message;
        $result .= ' | REQUEST: ' . $request_data;
        $result .= ' | STATUS_CODE: ' . $status_code;

        if (in_array($status_code, [200, 201])) {
            Log::channel($log_channel)
                ->info($result);
        } else {
            Log::channel($log_channel)
                ->error($result);
        }
    }

    public static function displayDuration($days = 0, $lang = 'en')
    {
        if (in_array($lang, ['en', 'id'])) {
            \App::setLocale($lang);
        } else {
            \App::setLocale('en');
        }

        $month = $days <= 31
            ? $days
            : (int) ($days / 30); // example: 30 / 30 = 1 bulan

        if ($days <= 31) {
            $result = $days . ' ' . __('timezone.hari');
        } else {
            if ($month < 12) {
                $result = $month . ' ' . __('timezone.bulan');
            } else {
                $year = (int) ($month / 12);
                $result = $year . ' ' . __('timezone.tahun');
            }
        }

        return $result;
    }

    public static function getIpAddress()
    {
        $ip = "";
        if (isset($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } else if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }

        return $ip;
    }

    public function addFeePercentage($price)
    {
        $getPercentage = T_GeneralSetting::getDetail();
        $fee_prifat = (int)$price * ((float)$getPercentage->prifat_fee_percentage / 100);
        $priceAfterFee = $price + $fee_prifat;
        return $priceAfterFee;
    }
}
