﻿<?
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

if($_POST[m_pass] == ""){
    alert("비밀번호를 입력해 주세요.");
}

// 4. 같은 아이디가 있는지 검사
$chk_sql = "select * from m__member where m_id = '".trim($_POST[m_id])."'";
$chk_result = sql_query($chk_sql);
$chk_data = mysql_fetch_array($chk_result);

// 5. 아이디가 존재 하는 경우
if($chk_data[m_idx]){

    // 6. 입력된 비밀번호와 저장된 비밀번호가 같은지 비교해서
    if($_POST[m_pass] == $chk_data[m_pass]){
        // 7. 비밀번호가 같으면 세션값 부여 후 이동
        $_SESSION[user_idx] = $chk_data[m_idx];
        $_SESSION[user_id] = $chk_data[m_id];
        $_SESSION[user_name] = $chk_data[m_name];
        
        alert("환영합니다.", "./index.php");
    }else{
        // 8. 비밀번호가 다르면
        alert("비밀번호가 다릅니다.");
    }
}else{
    // 9. 아이디가 존재하지 않으면
    alert("존재하지 않는 회원입니다.");
}
?>
