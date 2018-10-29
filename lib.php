<?
//######################################
//
//  사용자정의함수파일 : lib.php
//
//######################################

$mysql_host = 'localhost';
$mysql_user = '';
$mysql_password = '';
$mysql_db = '';

//DB 접속 및 데이터 베이스 선택 사용자 함수
function sql_connect($db_host, $db_user, $db_pass, $db_name)
{
    $result = mysql_connect($db_host, $db_user, $db_pass) or die(mysql_error());
    mysql_select_db($db_name) or die(mysql_error());
    return $result;
}

// 쿼리 함수
function sql_query($sql)
{
    global $connect;
    $result = @mysql_query($sql, $connect) or die("<p>$sql<p>" . mysql_errno() . " : " .  mysql_error() . "<p>error file : $_SERVER[PHP_SELF]");
    return $result;
}

// 갯수 구하는 함수
function sql_total($sql)
{
    global $connect;
    $result_total = sql_query($sql, $connect);
    $data_total = mysql_fetch_array($result_total);
    $total_count = $data_total[cnt];
    return $total_count;
}

// 쿼리를 실행한 후 결과값에서 한행을 구하는 함수
function sql_fetch($sql, $error=TRUE)
{
    $result = sql_query($sql, $error);
    $row = mysql_fetch_array($result);
    return $row;
}

// 쿼리를 실행 한 후 결과값의 목록을 배열로 구하는 함수
function sql_list($sql)
{
    $sql_q = sql_query($sql);
    $sql_list = array();
    while($sql_r = mysql_fetch_array($sql_q)){
        $sql_list[]= $sql_r;
    }

    return $sql_list;
}


// 경고창 띄우고 이동시키는 함수
function alert($msg='', $url='')
{
    if (!$msg) $msg = '올바른 방법으로 이용해 주십시오.';
    echo "<script language='javascript'>alert('$msg');";
    echo "</script>";
    if($url){
        goto_url($url);
    }else{
        echo "<script language='javascript'>history.back();";
        echo "</script>";
    }
    exit;
}

// 페이지 이동시키는 함수
function goto_url($url)
{
    echo "<script language='JavaScript'> location.replace('$url'); </script>";
    exit;
}


// 페이징 사용자 함수
function paging($page, $page_row, $page_scale, $total_count, $ext = '')
{
    // 1. 전체 페이지 계산
    $total_page  = ceil($total_count / $page_row);

    // 2. 페이징을 출력할 변수 초기화
    $paging_str = "";

    // 3. 처음 페이지 링크 만들기
    if ($page > 1) {
        $paging_str .= "<a href='".$_SERVER[PHP_SELF]."?page=1&'".$ext.">처음</a>";
    }

    // 4. 페이징에 표시될 시작 페이지 구하기
    $start_page = ( (ceil( $page / $page_scale ) - 1) * $page_scale ) + 1;

    // 5. 페이징에 표시될 마지막 페이지 구하기
    $end_page = $start_page + $page_scale - 1;
    if ($end_page >= $total_page) $end_page = $total_page;

    // 6. 이전 페이징 영역으로 가는 링크 만들기
    if ($start_page > 1){
        $paging_str .= " &nbsp;<a href='".$_SERVER[PHP_SELF]."?page=".($start_page - 1)."&'".$ext.">이전</a>";
    }

    // 7. 페이지들 출력 부분 링크 만들기
    if ($total_page > 1) {
        for ($i=$start_page;$i<=$end_page;$i++) {
            // 현재 페이지가 아니면 링크 걸기
            if ($page != $i){
                $paging_str .= " &nbsp;<a href='".$_SERVER[PHP_SELF]."?page=".$i."&'".$ext."><span>$i</span></a>";
            // 현재페이지면 굵게 표시하기
            }else{
                $paging_str .= " &nbsp;<b>$i</b> ";
            }
        }
    }

    // 8. 다음 페이징 영역으로 가는 링크 만들기
    if ($total_page > $end_page){
        $paging_str .= " &nbsp;<a href='".$_SERVER[PHP_SELF]."?page=".($end_page + 1)."&'".$ext.">다음</a>";
    }

    // 9. 마지막 페이지 링크 만들기
    if ($page < $total_page) {
        $paging_str .= " &nbsp;<a href='".$_SERVER[PHP_SELF]."?page=".$total_page."&'".$ext.">맨끝</a>";
    }

    return $paging_str;
}

// 세션사용은 위한 초기화
session_start();

// DB 연결
$connect = sql_connect($mysql_host, $mysql_user, $mysql_password, $mysql_db);
?>
