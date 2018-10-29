<?
// 1. 공통 인클루드 파일
include ("./head.php");

// 2. 로그인 하지 않은 회원은 로그인 페이지로 보내기
if(!$_SESSION[user_id]){
    alert("로그인하셔야 이용이 가능합니다.", "./login.php");
}

// 3. 내 포인트 구하기
$sql = "select * from m__member where m_id = '".$_SESSION[user_id]."'";
$my_data = sql_fetch($sql);
$my_point = $my_data[m_point];

// 4. 장바구니 총합 구하기
$sql = "select sum(c_price) as sum_c_price from m__cart where c_m_idx = '".$_SESSION[user_idx]."' and c_o_idx = '0'";
$cart_data = sql_fetch($sql);
$total_price = $cart_data[sum_c_price];

// 5. 포인트가 합계보다 작으면 포인트 충전으로 보내기
if($my_point < $total_price){
    alert("포인트가 부족합니다.","./point.php");
}

// 6. 주문테이블에 적기
$sql = "insert into m__order (o_m_idx, o_m_name, o_amount, o_status, o_regdate) values ('".$my_data[m_idx]."', '".$my_data[m_name]."', '".$total_price."', '결재완료', now())";
sql_query($sql);

// 7. 주문번호 구하기
$o_idx = mysql_insert_id();

// 8. 장바구니 물건들을 구매상태로(주문번호를 적어주면 됨)
$sql = "update m__cart set c_o_idx = '".$o_idx."' where c_m_idx = '".$_SESSION[user_idx]."' and c_o_idx = '0'";
sql_query($sql);


// 9. 포인트 빼기
$sql = "update m__member set m_point = m_point - ".$total_price." where m_id = '".$_SESSION[user_id]."'";
sql_query($sql);

// 10. 구매내역 페이지로 보내기
alert("상품구매가 완료 되었습니다.","./member.php");
?>
