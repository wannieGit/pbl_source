<?
// 1. 공통 인클루드 파일
include ("./head.php");

// 2. 로그인 하지 않은 회원은 로그인 페이지로 보내기
if(!$_SESSION[user_id]){
    alert("로그인하셔야 이용이 가능합니다.", "./login.php");
}

// 3. 넘어온 변수 검사
if(trim($_POST[mode]) != "insert" && trim($_POST[mode]) != "modify"){
    alert("정상적인 접근이 아닙니다.");
}


if(trim($_POST[i_name]) == ""){
    alert("상품명을 입력해 주세요.");
}

if(trim($_POST[i_price]) == ""){
    alert("상품가격을 입력해 주세요.");
}

if(!is_numeric($_POST[i_price])){
    alert("상품가격을 숫자로 입력해 주세요.");
}

if(trim($_POST[i_explain]) == ""){
    alert("상품설명을 입력해 주세요.");
}

// 4. 등록, 수정인지에 따라서 상품정보 적기
if($_POST[mode] == "insert"){
    $sql = "insert into m__item (i_name, i_price, i_explain) values ('".trim($_POST[i_name])."', ".trim($_POST[i_price]).", '".$_POST[i_explain]."')";
    sql_query($sql);

    // 5. 상품등록 고유번호 알아내기
    $i_idx = mysql_insert_id();

    alert("상품등록이 완료 되었습니다.","./item_modify.php?i_idx=".$i_idx);

}else if($_POST[mode] == "modify" && $_POST[i_idx]){

    $i_idx = $_POST[i_idx];
    $sql = "update m__item set i_name = '".trim($_POST[i_name])."', i_price = ".trim($_POST[i_price]).", i_explain = '".$_POST[i_explain]."' where i_idx = '".$i_idx."'";
    sql_query($sql);
    alert("상품등록이 완료 되었습니다.","./item_modify.php?i_idx=".$i_idx."&page".$_POST[page]);

}else{
    alert("정상적인 접근이 아닙니다.");
}
?>