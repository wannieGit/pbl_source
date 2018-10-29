<?
// 1. 공통 인클루드 파일
include ("./head.php");

// 2. 로그인한 회원은 뒤로 보내기
if($_SESSION[user_id]){
    alert("로그인 하신 상태입니다.");
}

// 3. 넘어온 변수 검사
if(trim($_POST[m_id]) == ""){
    alert("아이디를 입력해 주세요.");
}

if(trim($_POST[m_name]) == ""){
    alert("이름을 입력해 주세요.");
}

if($_POST[m_pass] == ""){
    alert("비밀번호를 입력해 주세요.");
}

if($_POST[m_pass] != $_POST[m_pass2]){
    alert("비밀번호를 확인해 주세요.");
}

// 4. 같은 아이디가 있는지 검사
$chk_sql = "select * from m__member where m_id = '".trim($_POST[m_id])."'";
$chk_result = sql_query($chk_sql);
$chk_data = mysql_fetch_array($chk_result);

// 5. 가입된 아이디가 있으면 되돌리기
if($chk_data[m_idx]){
    alert("이미 가입된 아이디 입니다.");
}

// 6. 회원정보 적기
$sql = "insert into m__member (m_id, m_name, m_pass, m_point) values ('".trim($_POST[m_id])."', '".trim($_POST[m_name])."', '".$_POST[m_pass]."', 0)";
sql_query($sql);

// 7. 로그인 페이지로 보내기
alert("회원가입이 완료 되었습니다.","./index.php");
?>
