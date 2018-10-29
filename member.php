<?
// 1. 공통 인클루드 파일
include ("./head.php");

// 2. 로그인 하지 않은 회원은 로그인 페이지로 보내기
if(!$_SESSION[user_id]){
    alert("로그인하셔야 이용이 가능합니다.", "./login.php");
}

// 3. 구매 목록 뽑기
$sql = "select * from m__order where o_m_idx = '".$_SESSION[user_idx]."' order by o_idx desc";
$result = mysql_query($sql, $connect);
?>
<br/>
<table style="width:1000px;height:50px;border:5px #CCCCCC solid;">
    <tr>
        <td align="center" valign="middle" style="font-zise:15px;font-weight:bold;">구매내역</td>
    </tr>
</table>
<br/>
<table style="width:1000px;height:50px;border:0px;">
<table cellspacing="1" style="width:1000px;height:50px;border:0px;background-color:#999999;">
    <tr>
        <td align="center" valign="middle" width="20%" style="height:30px;background-color:#CCCCCC;">주문번호</td>
        <td align="center" valign="middle" width="40%" style="height:30px;background-color:#CCCCCC;">주문금액</td>
        <td align="center" valign="middle" width="40%" style="height:30px;background-color:#CCCCCC;">주문일시</td>
    </tr>
<?
// 4.데이터 갯수화 총합 체크를 위한 변수 설정
$i = 0;
$sum = 0;


// 5.데이터가 있을 동안 반복해서 값을 한 줄씩 읽기
while($data = mysql_fetch_array($result)){
?>
    <tr>
        <td align="center" valign="middle" style="height:30px;background-color:#FFFFFF;"><?=$data[o_idx]?></td>
        <td align="center" valign="middle" style="height:30px;background-color:#FFFFFF;"><a href="./order_detail.php?o_idx=<?=$data[o_idx]?>"><?=number_format($data[o_amount])?>원</a></td>
        <td align="center" valign="middle" style="height:30px;background-color:#FFFFFF;"><?=$data[o_regdate]?></td>
    </tr>
<?

    // 6.데이터 갯수 체크를 위한 변수를 1 증가시키고 총합을 더하기
    $i++;
    $sum += $data[o_amount];
}

// 7.데이터가 하나도 없으면 
if($i == 0){
?>
    <tr>
        <td align="center" valign="middle" colspan="3" style="height:50px;background-color:#FFFFFF;">주문이 하나도 없습니다.</td>
    </tr>
<?
}
?>
    <tr>
        <td align="center" valign="middle" colspan="3" style="height:50px;background-color:#FFFFFF;">총 합 : <?=number_format($sum)?>원</td>
    </tr>
</table>

