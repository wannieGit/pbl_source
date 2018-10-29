<?
include "./lib.php";
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<title>PBL</title>
</head>
<table style="width:1000px;height:50px;border:5px #FFFFFF solid;">
    <tr>
        <td align="center" valign="middle" style="font-zise:15px;font-weight:bold;">
        PBL PAGE
        </td>
    </tr>
</table>
<table style="width:1000px;height:50px;border:5px #FFFFFF solid;">
    <tr>
        <td align="center" valign="middle" style="font-size:12px;"><a href="./index.php">PBLMALL</a></td>
    <?
    // 1.로그인 여부에 따라 상단 메뉴가 다르게
    if($_SESSION[user_idx]){
    ?>
        <td align="center" valign="middle" style="font-size:12px;"><a href="./cart.php">장바구니</a></td>
        <td align="center" valign="middle" style="font-size:12px;"><a href="./member.php">구매내역</a></td>
        <td align="center" valign="middle" style="font-size:12px;"><a href="./point.php">포인트관리</a></td>
        <td align="center" valign="middle" style="font-size:12px;"><a href="./order_list.php">판매내역</a></td>
        <td align="center" valign="middle" style="font-size:12px;"><a href="./item_list.php">상품관리</a></td>
        <td align="center" valign="middle" style="font-size:12px;"><a href="./logout.php">로그아웃</a></td>
    <?}else{?>
        <td align="center" valign="middle" style="font-size:12px;"><a href="./member_join.php">회원가입</a></td>
        <td align="center" valign="middle" style="font-size:12px;"><a href="./login.php">로그인</a></td>
    <?}?>
    </tr>
</table>
<br>
