<?php
header('Content-type: text/html; charset=utf-8');
$list = array (
  110106 =>
    array (
        '北京市太平桥中学' =>
        array (
            'cnt' => 52,
            'essay_cnt' => 28,
            'school' => '北京市太平桥中学',
            'version' => 627
        ),
        '北京市芳星园中学' =>
        array (
            'cnt' => 4,
            'essay_cnt' => 3,
            'school' => '北京市芳星园中学',
            'version'=> 85
        ),
        '北京市丰台区看丹中学' =>
        array (
            'cnt' => 140,
            'essay_cnt' => 98,
            'school' => '北京市丰台区看丹中学',
            'version'=> 2449
        )
    ),
110101 =>
    array (
        '北京市第一零九中学' =>
        array (
            'cnt' => 61,
            'essay_cnt' => 32,
            'school' => '北京市第一零九中学',
            'version' => 432
        ),
        '北京市第二十七中学' =>
        array (
            'cnt' => 54,
            'essay_cnt' => 33,
            'school' => '北京市第二十七中学',
            'version' => 326
        ),
        '北京市第二中学分校' =>
        array (
            'cnt' => 31,
            'essay_cnt' => 23,
            'school' => '北京市第二中学分校',
            'version' => 193
        )
    )
);
//倒序
$newlsit = array();
if( isset($_GET['order']) ){
    if( $_GET['order']=='cnt' ){
        $func = create_function('$a,$b', 'return $a[\'cnt\']<$b[\'cnt\']?1:-1;');
    }elseif($_GET['order']=='essay_cnt'){
        $func = create_function('$a,$b', 'return $a[\'essay_cnt\']<$b[\'essay_cnt\']?1:-1;');
    }else{
        //匿名函数
        $func = function($a,$b){
            return $a['version']<$b['version'] ? 1:-1;
        };
    }
}
foreach( $list as $k=>$var ){
    unset( $school_var );
    foreach($var as $k2=>$v2 ){
        $v2['school']= $k2;
        $school_var[]=$v2;
        //$newlsit[$k][]=$v2;
    }
    if( isset($_GET['order']) and $_GET['order']!=''  ){
         usort($school_var ,$func );
    }
    $newlsit[$k] =$school_var;
}
print_r($newlsit);

