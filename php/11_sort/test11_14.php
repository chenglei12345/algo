<?php
/**
 * 2018-11-14 测试
 */

/**
 * 冒泡排序
 * [1,2,4,3,5]
 * 每次找出一个最大的数放到最右边
 */

function bubbo(array &$arr){
  $length = count($arr);
  // 外层循环标记
  $i=0;
  while ($i<$length) {
    $flag = false;
    // 内部比较次数
    // 每一次冒泡就会少比较一次，因为有一个最大的移到了右边
    $j = 0;
    for (; $j < $length - $i -1; $j++) { 
      if($arr[$j+1] < $arr[$j]){
        list($arr[$j],$arr[$j+1]) = [$arr[$j+1],$arr[$j]];
        $flag = true;
      }else{
        continue;
      }
    }
    if(!$flag) 
      break;
    $i++;
  }
}

$arr = [2,6,3,1,4];
bubbo($arr);
var_dump($arr);


/**
 * 插入排序
 * 分成两个区，已排序区，未排序区
 * 从未排序区找数字放入已排序区
 * [1,5,4,2,3]
 */
