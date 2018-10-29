<?
// 1. 공통 인클루드 파일
include ("./head.php");

// 2. 로그인 하지 않은 회원은 로그인 페이지로 보내기
if(!$_SESSION[user_id]){
    alert("로그인하셔야 이용이 가능합니다.", "./login.php");
}

// 3. 장바구니 목록 뽑기
$sql = "select c.*, i.i_name, i.i_price from m__cart as c left join m__item as i on c.c_i_idx = i.i_idx where c.c_m_idx = '".$_SESSION[user_idx]."' and c.c_o_idx = '0'";
$result = mysql_query($sql, $connect);
?>
<br/>
<table style="width:1000px;height:50px;border:5px #CCCCCC solid;">
    <tr>
        <td align="center" valign="middle" style="font-zise:15px;font-weight:bold;">장바구니</td>
    </tr>
</table>
<br/>
<table style="width:1000px;height:50px;border:0px;">
<table cellspacing="1" style="width:1000px;height:50px;border:0px;background-color:#999999;">
    <tr>
        <td align="center" valign="middle" width="40%" style="height:30px;background-color:#CCCCCC;">상품명</td>
        <td align="center" valign="middle" width="20%" style="height:30px;background-color:#CCCCCC;">상품단가</td>
        <td align="center" valign="middle" width="20%" style="height:30px;background-color:#CCCCCC;">상품수량</td>
        <td align="center" valign="middle" width="20%" style="height:30px;background-color:#CCCCCC;">소계</td>
    </tr>
<?
// 4.데이터 갯수화 총합 체크를 위한 변수 설정
$i = 0;
$sum = 0;


// 5.데이터가 있을 동안 반복해서 값을 한 줄씩 읽기
while($data = mysql_fetch_array($result)){
?>
    <tr>
        <td align="center" valign="middle" style="height:30px;background-color:#FFFFFF;"><?=$data[i_name]?></td>
        <td align="center" valign="middle" style="height:30px;background-color:#FFFFFF;"><?=number_format($data[i_price])?>원</td>
        <td align="center" valign="middle" style="height:30px;background-color:#FFFFFF;"><?=number_format($data[c_cnt])?>개</td>
        <td align="center" valign="middle" style="height:30px;background-color:#FFFFFF;"><?=number_format($data[c_price])?>원</td>
    </tr>
<?

    // 6.데이터 갯수 체크를 위한 변수를 1 증가시키고 총합을 더하기
    $i++;
    $sum += $data[c_price];
}

// 7.데이터가 하나도 없으면 
if($i == 0){
?>
    <tr>
        <td align="center" valign="middle" colspan="4" style="height:50px;background-color:#FFFFFF;">상품이 하나도 없습니다.</td>
    </tr>
<?
}
?>
    <tr>
        <td align="center" valign="middle" colspan="4" style="height:50px;background-color:#FFFFFF;">총 합 : <?=number_format($sum)?>원</td>
    </tr>
</table>
<br/>
<?
// 8. 내 포인트 구하기
$sql = "select * from m__member where m_id = '".$_SESSION[user_id]."'";
$my_data = sql_fetch($sql);
?>
<table style="width:1000px;height:50px;border:5px #CCCCCC solid;">
    <tr>
        <td align="center" valign="middle" style="font-zise:15px;font-weight:bold;">내 포인트 : <?=number_format($my_data[m_point])?>점</td>
    </tr>
</table>
<br>
<table style="width:1000px;height:50px;">
    <tr>
        <td align="center" valign="middle">
        <?
        // 9. 내 포인트가 총합보다 크면 구매 작으면 포인트 충전
        if($my_data[m_point] >= $sum){
        ?>
        <input type="button" value=" 구매하기 " onClick="location.href='./order_save.php';">
        <?}else{?>
        <input type="button" value=" 포인트 충전" onClick="location.href='./point.php';">
        <?}?>
        </td>
    </tr>
</table>
