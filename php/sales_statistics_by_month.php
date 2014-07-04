<?php
/*
* 2014年1～6月各商户的销售统计
*
* @author - xiongfusong
* @date - 2014-07-02
*/
$year = 2013;
$textData = 'excel2.txt';//excel1.txt为已达起征的数据;excel2.txt为未达起征的数据
excelHeader($year.'年1～6月各商户的销售统计(未达起征)',0);
$mysqlHost = 'localhost';
$mysqlUser = 'common';
$mysqlPasswd = 'common';
$con = mysql_connect($mysqlHost,$mysqlUser,$mysqlPasswd) or die('数据库连接失败');
mysql_select_db('db_ljlj');
mysql_query('set names utf8');

$arr = file($textData);
foreach($arr as $v)
{
    echo '<tr>';
    $arr =  explode('  ',$v);
    $num = $arr[0];
    $showNum = $arr[1];
    $showName = $arr[2];
    $tax = $arr[3];
    echo '<td>'.$num.'</td><td>'.$showNum.'</td><td>'.$showName.'</td><td>'.$tax.'</td>';
    for($month=1;$month<7;$month++)
    {
        extract(getStartAndEndTime($year,$month));
        if(strpos($showNum,',') === false)
        {
            $where = 'consume_merchant_show = "'.$showNum.'" AND consume_date >= "'.$startTime.'" AND consume_date <= "'.$endTime.'"';
            $sum = getFactValue($where);
            $factTotal = intval($sum['total']);
        }
        else
        {
            $showArr = explode(',',$showNum);
            $factTotal = 0;
            foreach($showArr as $val)
            {
                $where = 'consume_merchant_show = "'.$val.'" AND consume_date >= "'.$startTime.'" AND consume_date <= "'.$endTime.'"';
                $sum = getFactValue($where);
                $factTotal += intval($sum['total']);
            }
        }
        echo '<td>'.$factTotal.'</td>';
    }
    echo '</tr>';
}
footer();

/*
* 导出excel与页面显示数据的切换
*
* string - $excelName - 导出excel文件名
* integar - $isExport - 标识：1,导出excel文件;0,直接打印出
*/
function excelHeader($excelName,$isExport=1)
{
    if($isExport === 1)
    {
        header("Content-Type:application/vnd.ms-excel");
        header("Content-Disposition:attachment;filename=$excelName.xls");
        header("Content-type: text/html; charset=utf-8");
    }
    //输出内容如下：
    echo
    '
    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>'.$excelName.'</title>
        <style>
        td{text-align:center;font-size:12px;font-family:Arial, Helvetica, sans-serif;border:#1C7A80 1px solid;color:#152122;width:100px;}
        table,tr{border-style:none;}
        .title{background:#7DDCF0;color:#FFFFFF;font-weight:bold;}
        </style>
    </head>
    <body>
        <table width="1200">
            <tr>
                <td>序号</td>
                <td>摊位编号</td>
                <td>摊位名称</td>
                <td>核定税额</td>
                <td>1月</td>
                <td>2月</td>
                <td>3月</td>
                <td>4月</td>
                <td>5月</td>
                <td>6月</td>
            </tr>';
}
function footer()
{
    echo
    '
        </table>
    </body>
    </html>
    ';
    exit;
}

/*
* 根据where条件,查询实际付款总额
*
*/
function getFactValue($where)
{
    $sql = 'SELECT SUM(consume_fact_value) AS total FROM product_conume WHERE '.$where;
    $res = mysql_query($sql);
    return mysql_fetch_assoc($res);
}

/*
* 根据月份获取该月的第一天和最后一天(暂不考虑闰年)
*/
function getStartAndEndTime($year,$month)
{
    if(in_array($month,array(1,3,5,7,8,10,12)))
    {
        if($month > 0 && $month < 10)
        {
            $month = '0'.$month;
        }
        $lastDay = 31;
    }
    elseif(in_array($month,array(4,6,9,11)))
    {
        if($month != 11)
        {
            $month = '0'.$month;
        }
        $lastDay = 30;
    }
    elseif($month == 2)
    {
        $month = '0'.$month;
        $lastDay = 28;
    }
    else
    {
        echo $month.'不在1~12之间';
        exit;
    }
    $date['startTime'] = $year.'-'.$month.'-01 00:00:00';
    $date['endTime'] = $year.'-'.$month.'-'.$lastDay.' 23:59:59';
    return $date;
}
?>
