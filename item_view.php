<?
// 1. 공통 인클루드 파일
include ("./head.php");

// 2. 상품 존재 검사
$data = sql_fetch("select * from m__item where i_idx = '".$_GET[i_idx]."'");
if(!$data[i_idx]){
    alert("존재하지 않는 상품입니다.");
}
?>
<br/>
<table style="width:1000px;height:50px;border:5px #CCCCCC solid;">
    <tr>
        <td align="center" valign="middle" style="font-zise:15px;font-weight:bold;">상품보기</td>
    </tr>
</table>
<br/>
<form name="itemForm" method="post" action="./cart_save.php" style="margin:0px;">
<!-- 3. 장바구니나 바로구매 버튼 클릭시 mode 의 값을 채워서 전달 -->
<input type="hidden" name="mode" value="">
<input type="hidden" name="page" value="<?=$_GET[page]?>">
<input type="hidden" name="i_idx" value="<?=$data[i_idx]?>">
<input type="hidden" name="price" value="<?=$data[i_price]?>">

<table style="width:1000px;height:50px;border:0px;">
    <tr>
        <td align="center" valign="middle" style="width:200px;height:50px;background-color:#CCCCCC;">상품명</td>
        <td align="left" valign="middle" style="width:800px;height:50px;"><?=$data[i_name]?></td>
    </tr>
    <tr>
        <td align="center" valign="middle" style="width:200px;height:50px;background-color:#CCCCCC;">상품가격</td>
        <td align="left" valign="middle" style="width:800px;height:50px;"><?=$data[i_price]?></td>
    </tr>
    <tr>
        <td align="center" valign="middle" style="width:200px;height:50px;background-color:#CCCCCC;">상품설명</td>
        <td align="left" valign="middle" style="width:800px;height:50px;"><?=nl2Br($data[i_explain])?></td>
    </tr>
    <tr>
        <td align="center" valign="middle" style="width:200px;height:50px;background-color:#CCCCCC;">구매수량</td>
        <td align="left" valign="middle" style="width:800px;height:50px;"><input type="text" name="c_cnt" onChange="caluate_item();">개</td><!-- 4. 수량변경 시 체크 후 총가격값을 입력 -->
    </tr>
    <tr>
        <td align="center" valign="middle" style="width:200px;height:50px;background-color:#CCCCCC;">총가격</td>
        <td align="left" valign="middle" style="width:800px;height:50px;"><input type="text" name="c_price" value="0" readOnly>원</td>
    </tr>
    <!-- 5. 로그인 한 사람만 장바구니와 바로구매 버튼이 보기고 버튼 클릭시 cart_save함수로 검사 -->
    <tr>
        <td align="center" valign="middle" colspan="2">
        <?if($_SESSION[user_id]){?>
        <input type="button" value=" 장바구니 " onClick="cart_save('cart');"> 
        <input type="button" value=" 바로구매 " onClick="cart_save('direct');"> 
        <?}?>
        <input type="button" value=" 목록 " onClick="location.href='./index.php?page=<?=$_GET[page]?>';"></td>
    </tr>
</table>
</form>
<script>
// 수량 검사 밑 총 가격 만드는 함수
function caluate_item()
{
    var f = document.itemForm;
    var cnt_obj = f.c_cnt;    // 수량

    if(cnt_obj.value == ""){
        alert("구매수량을 입력해 주세요.");
        return false;
    }else{
        // 숫자인지 검사
        for (var i = 0; i < cnt_obj.value.length; i++){

            if (cnt_obj.value.charAt(i) < '0' || cnt_obj.value.charAt(i) > '9'){ 
                alert("구매수량을 숫자로 입력해 주세요.");
                return false;
            }
        }
    }

    // 수량과 가격을 곱해 총가격은 만듬
    var price = parseInt(f.price.value) * parseInt(cnt_obj.value);

    f.c_price.value = price;

    return true;
}

// 입력필드 검사함수
function cart_save(arg)
{
    // form 을 f 에 지정
    var f = document.itemForm;

    // 수량검사 후 장바구니담기인지 바로구매인지 값을 mode 에 저장 후 서브밋
    if(caluate_item()){
        f.mode.value = arg
        f.submit();
    }

}
</script>
