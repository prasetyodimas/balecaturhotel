<?php
//file cek.php untuk cek data
$last   = $_GET['last'];
$sql 	= "select * from nama_tabel where id='$last'";
$rs     = mysql_query($sql);


//output berupa json
if(mysql_num_rows($rs) > 0){

	$lastSql = "select max(id) from nama_tabel";
	$lastId = mysql_fetch_array(mysql_query($lastSql));
		echo '{"result":"new data","last":"'.$lastId[0].'"}';
}else{
		echo '{"result":false}';
}


?>

<div id="notif"></div>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js";;></script>
<script type="text/javascript">
var last = 0;
function check(){
	var url = 'cek.php?last='+last;
	$.get(url, {}, function(resp){
		if(resp.result != false){
			$("#notif").html(resp.result);
			last = resp.last;
		}
		setTimeout("check()", 1000);
	}, 'json');
}
$(document).ready(function(){
	check();
});
</script>