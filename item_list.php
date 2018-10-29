<?
// 1. 공통 인클루드 파일
include ("./head.php");

// 2. 로그인 하지 않은 회원은 로그인 페이지로 보내기
if(!$_SESSION[user_id]){
    alert("로그인하셔야 이용이 가능합니다.", "./login.php");
}

// 3. 페이지 변수 설정
if($_GET[page] && $_GET[page] > 0){
    // 현재 페이지 값이 존재하고 0 보다 크면 그대로 사용
    $page = $_GET[page];
}else{
    // 그 외의 경우는 현재 페이지를 1로 설정
    $page = 1;
}

// 한 페이지에 보일 상품 수
$page_row = 10;
// 한줄에 보여질 페이지 수
$page_scale = 10;
// 페이징을 출력할 변수 초기화
$paging_str = "";


// 4. 전체 상품 갯수 알아내기
$sql = "select count(*) as cnt from m__item where 1 ";
$total_count = sql_total($sql);


// 5. 페이지 출력 내용 만들기
$paging_str = paging($page, $page_row, $page_scale, $total_count, "");

// 6. 시작 열을 구함
$from_record = ($page - 1) * $page_row;

// 5. 상품목록 구하기
$query = "select * from m__item where 1 limit ".$from_record.", ".$page_row;
$result = mysql_query($query, $connect);

?>
<br/>
<table style="width:1000px;height:50px;border:5px #CCCCCC solid;">
    <tr>
        <td align="center" valign="middle" style="font-zise:15px;font-weight:bold;">상품관리 - 상품목록</td>
    </tr>
</table>
<br/>
<table cellspacing="1" style="width:1000px;height:50px;border:0px;background-color:#999999;">
    <tr>
        <td align="center" valign="middle" width="5%" style="height:30px;background-color:#CCCCCC;">번호</td>
        <td align="center" valign="middle" width="70%" style="height:30px;background-color:#CCCCCC;">상품명</td>
        <td align="center" valign="middle" width="25%" style="height:30px;background-color:#CCCCCC;">상품가격</td>
    </tr>
<?
// 6.데이터 갯수 체크를 위한 변수 설정
$i = 0;

// 7.데이터가 있을 동안 반복해서 값을 한 줄씩 읽기
while($data = mysql_fetch_array($result)){
?>
    <tr>
        <td align="center" valign="middle" style="height:30px;background-color:#FFFFFF;"><?=($total_count - (($page - 1) * $page_row) - $i )?></td>
        <td align="left" valign="middle" style="height:30px;background-color:#FFFFFF;"><a href="./item_modify.php?i_idx=<?=$data[i_idx]?>&page=<?=$page?>"><?=$data[i_name]?></a></td>
        <td align="center" valign="middle" style="height:30px;background-color:#FFFFFF;"><?=number_format($data[i_price])?>원</td>
    </tr>
<?
    // 8.데이터 갯수 체크를 위한 변수를 1 증가시킴
    $i++;
}

// 9.데이터가 하나도 없으면 
if($i == 0){
?>
    <tr>
        <td align="center" valign="middle" colspan="3" style="height:50px;background-color:#FFFFFF;">상품이 하나도 없습니다.</td>
    </tr>
<?
}
?>
</table>
<br/>
<table style="width:1000px;height:50px;">
    <tr>
        <td align="center" valign="middle"><?=$paging_str?></td>
    </tr>
    <tr>
        <td align="center" valign="middle"><input type="button" value=" 상품등록 " onClick="location.href='./item_insert.php';"></td>
    </tr>
</table>

