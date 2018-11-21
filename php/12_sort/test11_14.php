<?php

/**
 * 归并排序测试
 * 2018-11-14 练习
 */

function mergeSort(array &$arr,$l,$n){
  if($l >= $n) return [$arr[$n]];
  // 寻找中间节点
  $m = (int)(($l+$n)/2);
  $left = mergeSort($arr,$l,$m);
  $right = mergeSort($arr,$m+1,$n);
  // 合并
  return merge($left,$right);
}

function merge(array $left,array $right){
  $i = 0;
  $j = 0;
  $llength = count($left);
  $rlength = count($right);
  $tmp = [];
  while ($i < $llength && $j < $rlength) {
    if($left[$i] < $right[$j]){
      $tmp[] = $left[$i];
      $i++;
    }else{
      $tmp[] = $right[$j];
      $j++;
    }
  }
  $start = $i;
  $end = $llength;
  $copyArr = $left;
  if($j < $rlength){
    $start = $j;
    $end = $rlength;
    $copyArr = $right;
  }
  while ($start < $end) {
    $tmp[] = $copyArr[$start];
    $start++;
  }
  return $tmp;
}

$arr = [11, 8, 3, 9, 7, 1];
$length = count($arr);
$p = 0;
$r = $length - 1;
$result = mergeSort($arr, $p, $r);
var_dump($result);




/**
 * 快速排序测试
 */

function quickSort(array &$arr){
  $l = 0;
  $n = count($arr)-1;
  quick($arr,$l,$n);
}

function quick(array &$arr,$l,$n){
  if($l >= $n) return;
  $middle = findMind($arr,$l,$n);
  quick($arr,$l,$middle-1);
  quick($arr,$middle+1,$n);
}

function findMind(array &$arr,$l,$n){
  $middle = $arr[$n];
  $i = $l;
  $j = $l;
  while ($j < $n) {
    if($arr[$j] < $middle){
      list($arr[$i],$arr[$j]) = [$arr[$j],$arr[$i]];
      $i++;
    }
    $j++;
  }
  // 最后将基准点移动
  list($arr[$i],$arr[$n]) = [$arr[$n],$arr[$i]];
  return $i;
}
$low = 0;
$high = 100;
$mid =  $low + (($high - $low) >>1);
var_dump($mid);die;
// 测试快速排序
$arr = [5, -1, 9, 3, 7, 8, 3, -2, 9];
quickSort($arr);
var_dump($arr);