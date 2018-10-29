<?
// 1. 공통 인클루드 파일
include ("./head.php");

// 2. 로그인 하지 않은 회원은 로그인 페이지로 보내기
if(!$_SESSION[user_id]){
    alert("로그인하셔야 이용이 가능합니다.", "./login.php");
}

// 3. 넘어온 변수 검사
if(trim($_POST[mode]) != "cart" && trim($_POST[mode]) != "direct"){
    alert("정상적인 접근이 아닙니다.");
}

if(!$_POST[i_idx]){
    alert("상품페이지에서 상품을 선택 후 구매해주세요.");
}

if(!is_numeric($_POST[c_cnt])){
    alert("상품수량을 숫자로 입력해 주세요.");
}

// 4. 장바구니에 적어 넣기
$sql = "insert into m__cart (c_m_idx, c_i_idx, c_cnt, c_price) values ('".$_SESSION[user_idx]."', ".$_POST[i_idx].", ".$_POST[c_cnt].", '".$_POST[c_price]."')";
sql_query($sql);

// 5. 장바구니인지 바로구매인지에 따라서 이동
if($_POST[mode] == "cart"){
    alert("장바구니에 담았습니다.","./cart.php");
}else if($_POST[mode] == "direct"){
    alert("구매페이지로 이동합니다.","./order.php");
}else{
    alert("정상적인 접근이 아닙니다.");
}

?>
