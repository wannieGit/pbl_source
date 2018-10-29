<?
// 1. 공통 인클루드 파일
include ("./head.php");

// 2. 로그인 하지 않은 회원은 로그인 페이지로 보내기
if(!$_SESSION[user_id]){
    alert("로그인하셔야 이용이 가능합니다.", "./login.php");
}

// 3. 상품 존재 검사
$data = sql_fetch("select * from m__item where i_idx = '".$_GET[i_idx]."'");
if(!$data[i_idx]){
    alert("존재하지 않는 상품입니다.");
}
?>
<br/>
<table style="width:1000px;height:50px;border:5px #CCCCCC solid;">
    <tr>
        <td align="center" valign="middle" style="font-zise:15px;font-weight:bold;">상품관리 - 상품수정</td>
    </tr>
</table>
<br/>
<form name="itemForm" method="post" action="./item_save.php" style="margin:0px;">
<!-- 4. 등록이면 mode 의 값은 insert 수정이면 modify -->
<input type="hidden" name="mode" value="modify">
<input type="hidden" name="page" value="<?=$_GET[page]?>">
<input type="hidden" name="i_idx" value="<?=$data[i_idx]?>">

<table style="width:1000px;height:50px;border:0px;">
    <tr>
        <td align="center" valign="middle" style="width:200px;height:50px;background-color:#CCCCCC;">상품명</td>
        <td align="left" valign="middle" style="width:800px;height:50px;"><input type="text" name="i_name" style="width:800px;" value="<?=$data[i_name]?>"></td>
    </tr>
    <tr>
        <td align="center" valign="middle" style="width:200px;height:50px;background-color:#CCCCCC;">상품가격</td>
        <td align="left" valign="middle" style="width:800px;height:50px;"><input type="text" name="i_price" style="width:100px;" value="<?=$data[i_price]?>">원</td>
    </tr>
    <tr>
        <td align="center" valign="middle" style="width:200px;height:50px;background-color:#CCCCCC;">상품설명</td>
        <td align="left" valign="middle" style="width:800px;height:50px;"><textarea name="i_explain" style="width:800px;height:200px;"><?=$data[i_explain]?></textarea></td>
    </tr>
    <!-- 5. 상품수정 버튼 클릭시 입력필드 검사 함수 item_save 실행 -->
    <tr>
        <td align="center" valign="middle" colspan="2"><input type="button" value=" 상품수정 " onClick="item_save();"> <input type="button" value=" 목록 " onClick="location.href='./item_list.php?page=<?=$_GET[page]?>';"></td>
    </tr>
</table>
</form>
<script>
// 6.입력필드 검사함수
function item_save()
{
    // 7.form 을 f 에 지정
    var f = document.itemForm;

    // 8.입력폼 검사
    if(f.i_name.value == ""){
        // 9.값이 없으면 경고창으로 메세지 출력 후 함수 종료
        alert("상품명을 입력해 주세요.");
        return false;
    }

    if(f.i_price.value == ""){
        alert("상품가격을 입력해 주세요.");
        return false;
    }else{
        // 10.숫자인지 검사
        for (var i = 0; i < f.i_price.value.length; i++){
            if (f.i_price.value.charAt(i) < '0' || f.i_price.value.charAt(i) > '9'){ 
                alert("상품가격은 숫자로 입력해 주세요.");
                return false;
            }
        }
    }

    if(f.i_explain.value == ""){
        alert("상품설명을 입력해 주세요.");
        return false;
    }

    // 11.검사가 성공이면 form 을 submit 한다
    f.submit();

}
</script>
