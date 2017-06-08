<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/5/14
 * Time: 21:08
 */
use Illuminate\Database\Capsule\Manager as DB;

class Log
{
    const EMERGENCY = 'emergency';
    const ALERT = 'alert';
    const CRITICAL = 'critical';
    const ERROR = 'error';
    const WARNING = 'warning';
    const NOTICE = 'notice';
    const INFO = 'info';
    const DEBUG = 'debug';
    /**
     * [日志log]
     * @param  [type] $message  [description]
     * @param  [type] $level    [description]
     * @param  [type] $fileName [description]
     * @return [type]           [description]
     */
    public static function write($message, $level, $fileName)
    {
        $debugInfo = debug_backtrace();
        $filePath = Yaf\Registry::get('config')->app->log;
        $message = date('Y/m/d H:i:s') . ' [' . $level . ']' .' ['.$fileName.'] '. $message . PHP_EOL;
        $message .= $debugInfo[0]['file']. ' ('.$debugInfo[0]['line'].')'.PHP_EOL;
        file_put_contents($filePath.$fileName."-".date('Y-m-d').'.log', $message, FILE_APPEND);
    }
    /**
     * [记录程序错误日志]
     * @param  [type] $level   [description]
     * @param  [type] $message [description]
     * @param  [type] $context [description]
     * @return [type]          [description]
     */
    public static function error($level, $message)
    {
        $filePath = Yaf\Registry::get('config')->app->log;
        $message = '[' . date('Y-m-d H:i:s') . '][' . $level . ']' . $message . PHP_EOL;
        file_put_contents($filePath.$level."-".date('Y-m-d').'.log', $message, FILE_APPEND);
    }
    public static function addDBLog($data)
    {
        DB::table('admin_user_log')->insert($data);
    }
}
