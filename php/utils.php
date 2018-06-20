<?php

/**
 * test case
 * case 1: The Bee Token -> THE_BEE_TOKEN
 * case 2: BCharity - International Charity Exchange -> BCHARITY_INTERNATIONAL_CHARITY_EXCHANGE
 * case 3: Aimedis ICO (AIM) -> AIMEDIS_ICO_AIM
 * case 4: Ravn's Korrax -> RAVNS_KORRAX
 * case 5: SIX.Network -> SIX_NETWORK
 * case 6: REPORTER / News Token -> REPORTER_NEWS_TOKEN
 * case 7: C Ξ Y B I T -> C_Y_B_I_T
 * case 8: MITO Pre-Sale ->
 * case 9: INCREMINT.IO_(PREICO) -> INCREMINT_IO_PREICO
 * case 10: PATRON / パトロン -> PATRON
 * */

// 命名方式转换成: 蛇底式小写
function snake_case($name)
{
    $name = str_replace("'", '', $name);
    $name = preg_replace('/[^0-9a-zA-Z]+/', ' ', $name);
    return preg_replace('/\s+/', '_', trim(strtoupper($name)));
}

// 命名方式转换成: 驼峰式大小写
function camelCase($text) {
    $text = strtolower($text);
    $text = preg_replace('/[^a-z0-9_\s-]/', ' ', $text);
    $text = preg_replace('/[\s-]+/', ' ', $text);
    $text = preg_replace('/[\s_]/', ' ', $text);
    $text = ucwords(trim($text));
    $text = str_replace(' ', '', $text);
    $text = lcfirst($text);
    return $text;
}
