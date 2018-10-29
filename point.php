<?
// 1. 공통 인클루드 파일
include ("./head.php");

// 2. 로그인 하지 않은 회원은 로그인 페이지로 보내기
if(!$_SESSION[user_id]){
    alert("로그인하셔야 이용이 가능합니다.", "./login.php");
}

// 3. 회원 데이터 불러오기
$sql = "select * from m__member where m_idx = '".$_SESSION[user_idx]."'";
$m_data = sql_fetch($sql);

// 4. HTML 출력
?>
<br/>
<table style="width:1000px;height:50px;border:5px #CCCCCC solid;">
    <tr>
        <td align="center" valign="middle" style="width:200px;height:50px;background-color:#CCCCCC;font-zise:15px;font-weight:bold;">보유 포인트</td>
        <td align="left" valign="middle" style="width:800px;height:50px;"><?=number_format($m_data[m_point])?>점</td>
    </tr>
</table>
<br/>
<form name="registForm" method="post" action="./point_save.php" style="margin:0px;">
<table style="width:1000px;height:50px;border:5px #CCCCCC solid;">
    <tr>
        <td align="center" valign="middle" style="font-zise:15px;font-weight:bold;">포인트 구매</td>
    </tr>
    <tr>
        <td align="center" valign="middle" height="80">
        <input type="radio" name="b_point" value="1000" checked> 1,000 포인트
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <input type="radio" name="b_point" value="5000"> 5,000 포인트
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <input type="radio" name="b_point" value="10000"> 10,000 포인트
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <input type="radio" name="b_point" value="50000"> 50,000 포인트
        </td>
    </tr>
    <tr>
        <td align="center" valign="middle"><input type="submit" value=" 포인트 구매 "></td>
    </tr>
</table>
</form>
