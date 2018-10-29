<?
// 1. 공통 인클루드 파일
include ("./head.php");

// 2. 로그인 하지 않은 회원은 로그인 페이지로 보내기
if(!$_SESSION[user_id]){
    alert("로그인하셔야 이용이 가능합니다.", "./login.php");
}

// 3. 포인트 더하기
$sql = "update m__member set m_point = m_point + ".$_POST[b_point]." where m_id = '".$_SESSION[user_id]."'";
sql_query($sql);

// 4. 포인트관리 페이지로 보내기
alert("포인트 구매가 완료 되었습니다.","./point.php");
?>
