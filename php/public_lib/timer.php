<?php
/*
* 基本时间占用监测
*
* 缺点:需要在代码里增加时间点监控
*/
class Timer {
    private $start = 0;
    private $end = 0;

    private function now(){
        list($usec, $sec) = explode(' ', microtime());
        return ((float)$usec + (float)$sec);
    }

    public function start(){
        $this->start = $this->now();
    }
    public function end(){
        $this->end = $this->now();
    }
    public function getTime(){
        return (float)($this->end - $this->start);
    }
    public function printTime(){
        printf("Program run use time: %fs\n", $this->getTime());
    }
}
?>
