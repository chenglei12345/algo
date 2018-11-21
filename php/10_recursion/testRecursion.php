<?php
namespace Algo_10;

/**
 * 电影院 问当前是第几排问题
 * 
 * 第一步 写出递归公式 当前的是前一排的人的排数 + 1，f(n) = f(n-1) + 1
 * 设置终止条件 第一排的人 排数为1，f(1) = 1
 * 进行程序化
 * 
 */
function findLocation($n){
  if($n == 1) return 1;
  return findLocation($n-1) + 1;
}

$n = 10;
var_dump(findLocation($n));


/**
 * 走路 每次可以走1步 或者 走2步 走n步有多少种可能
 *
 * 第一步 写出递归公式 (n 个台阶的走法就等于先走 1 阶后，n-1 个台阶的走法 加上先走 2 阶后，n-2 个台阶的走法)
 * 设置终止条件
 * 进行程序化
 *
 * f(n) = f(n-1) + f(n-2)
 * n = 0 不可能
 * n = 1 f(1) = 1 
 * n = 2 f(2) = 2
 * n = 3 f(3) = 3
 * n = 4 f(4) = 4
 *
 */
$array = [];
function stairs($n){
  if($n == 1)  return 1;
  if($n == 2) return 2;
  if(empty($array[$n])){
    $array[$n] = stairs($n - 1) + stairs($n - 2);
  }
  return stairs($n - 1) + stairs($n - 2);
}

var_dump(stairs(5));
var_dump($array);die;


/**
 * 改良引入hashMap
 */