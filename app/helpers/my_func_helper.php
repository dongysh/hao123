<?php
/**
 * 常用函数
 */

/**
 * 用户登陆状态检查
 * @return boolean
 * @author dongysh
 */
function checkAdminLogin()
{
	$isLogin = false;
	if (!isset($_SESSION['admin_id']) || empty($_SESSION['admin_id']))
    {
        $isLogin = false;
    }
    else
    {
        $isLogin = true;
    }
    return $isLogin;
}

/**
 * 将csv文件数据转为数组
 * @return array
 * @author dongysh
 */
function input_csv($csvfile)
{
    $out = array (); 
    $n = 0; 
    while ($data = fgetcsv($csvfile, 10000)) { 
        $num = count($data); 
        for ($i = 0; $i < $num; $i++) { 
            $out[$n][$i] = $data[$i]; 
        } 
        $n++; 
    } 
    return $out;
}

/**
 * 得到文件类型
 * @return string
 * @author dongysh
 */
function get_file_type($filename)
{
    $fileArr = explode('.', $filename);
    $count = count($fileArr);
    $type = $fileArr[$count-1];
    return $type;
}