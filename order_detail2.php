<?
// 1. 공통 인클루드 파일
include ("./head.php");

// 2. 로그인 하지 않은 회원은 로그인 페이지로 보내기
if(!$_SESSION[user_id]){
    alert("로그인하셔야 이용이 가능합니다.", "./login.php");
}

// 3. 주문번호가 있는지 확인
$sql = "select * from m__order where o_idx = '".$_GET[o_idx]."'";
$order_data = sql_fetch($sql);
if(!$order_data[o_idx]){
    alert("주문번호가 정확하지 않습니다.");
}

// 4. 상품 목록 뽑기
$sql = "select c.*, i.i_name, i.i_price from m__cart as c left join m__item as i on c.c_i_idx = i.i_idx where c.c_o_idx = '".$order_data[o_idx]."'";
$result = mysql_query($sql, $connect);
?>
<br/>
<table style="width:1000px;height:50px;border:5px #CCCCCC solid;">
    <tr>
        <td align="center" valign="middle" style="font-zise:15px;font-weight:bold;">상세주문 보기</td>
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
// 5.데이터 갯수화 총합 체크를 위한 변수 설정
$i = 0;
$sum = 0;


// 6.데이터가 있을 동안 반복해서 값을 한 줄씩 읽기
while($data = mysql_fetch_array($result)){
?>
    <tr>
        <td align="center" valign="middle" style="height:30px;background-color:#FFFFFF;"><?=$data[i_name]?></td>
        <td align="center" valign="middle" style="height:30px;background-color:#FFFFFF;"><?=number_format($data[i_price])?>원</td>
        <td align="center" valign="middle" style="height:30px;background-color:#FFFFFF;"><?=number_format($data[c_cnt])?>개</td>
        <td align="center" valign="middle" style="height:30px;background-color:#FFFFFF;"><?=number_format($data[c_price])?>원</td>
    </tr>
<?

    // 7.데이터 갯수 체크를 위한 변수를 1 증가시키고 총합을 더하기
    $i++;
    $sum += $data[c_price];
}

// 8.데이터가 하나도 없으면 
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
<table style="width:1000px;height:50px;">
    <tr>
        <td align="center" valign="middle"><input type="button" value=" 돌아가기 " onClick="location.href='./order_list.php?page=<?=$_GET[page]?>';"></td>
    </tr>
</table>
