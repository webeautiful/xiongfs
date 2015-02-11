<?php
/*
* 日志记录类
*
*优点:等对象析构的时候再执行日志物理写入操作,只有一次磁盘IO,性能大大提升
*
*/
class MyLog {
    private $str = '';
    const LOG_LEVEL_ERROR = 1;
    const LOG_LEVEL_WARNING = 2;
    const LOG_LEVEL_NOTICE = 3;
    const LOG_FILE = "./log/PHP_LOG_%s.log";

    function __construct(){}
    function __destruct(){
        if($this->str != ''){
            $file = sprintf(self::LOG_FILE,date('Ymd'));
            file_put_contents($file, $this->str, FILE_APPEND);
        }
    }
    function log($str, $level){
        switch($level){
            case self::LOG_LEVEL_NOTICE:
                $this->str .= '['.date('Y-m-d H:i:s').'] Notice: '.$str."\n";
                break;
            case self::LOG_LEVEL_WARNING:
                $this->str .= '['.date('Y-m-d H:i:s').'] WARNING: '.$str."\n";
                break;
            case self::LOG_LEVEL_ERROR:
                $this->str .= '['.date('Y-m-d H:i:s').'] Error: '.$str."\n";
                break;
        }
    }
    function notice($str){
        $this->log($str, self::LOG_LEVEL_NOTICE);
    }
    function warn($str){
        $this->log($str, self::LOG_LEVEL_WARNING);
    }
    function error($str){
        $this->log($str, self::LOG_LEVEL_ERROR);
    }
}

//测试代码
$log = new MyLog;
for($i=0;$i<10;$i++){
    $log->notice("test $i");
    sleep(1);
}
?>
