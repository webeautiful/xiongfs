<?php
$prizeArr = array(
    '0'=>array('id'=>1,'txt'=>'小台灯','jl'=>10),
    '1'=>array('id'=>2,'txt'=>'继续努力','jl'=>17),
    '2'=>array('id'=>3,'txt'=>'n次帖','jl'=>20),
    '3'=>array('id'=>4,'txt'=>'明天再来','jl'=>16),
    '4'=>array('id'=>5,'txt'=>'户外双肩包','jl'=>5),
    '5'=>array('id'=>6,'txt'=>'继续加油','jl'=>16),
    '6'=>array('id'=>7,'txt'=>'香港迪士尼夏令营','jl'=>0),
    '7'=>array('id'=>8,'txt'=>'再接再厉','jl'=>16)
);


foreach($prizeArr as $k=>$v){
    $proArr[$v['id']] = $v['jl'];
}

//摸奖盒
$cjbox = array();
foreach($proArr as $in=>$jl){
    for($i=0;$i<$jl;$i++){
        $cjbox[] = $in;
    }
}

//摇一摇
shuffle($cjbox);

//摸一个
$sum = count($cjbox);
$index = mt_rand(0,$sum-1);
$id = $cjbox[$index];

print_r($cjbox);
echo "\n";
echo '盒子中总数'.$sum;
echo "\n";
echo '抽中:'.$id;
echo "\n";
echo "\n";
