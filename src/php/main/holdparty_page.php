<?php 
try{
    require_once("php/connectAccount.php");
	//igroup 表單上傳
	$mem_id= $_POST['MEM_ID']; //欄位2 NOT_NULL ---->要改
	$gro_name= $_POST['GRO_NAME']; //欄位3 NOT_NULL
	$gro_startd= $_POST['GRO_STARTD']; //欄位4 NOT_NULL
	$gro_endd= $_POST['GRO_ENDD']; //欄位5 NOT_NULL
	$gro_endadd= $_POST['GRO_ENDADD']; //欄位6 NOT_NULL
	$gro_paytype= $_POST['GRO_PAYTYPE']; //欄位7
	$gro_pay= $_POST['GRO_PAY']; //欄位8	
	$gro_type= $_POST['GRO_TYPE']; //欄位9 NOT_NULL
	$gro_loc= $_POST['GRO_LOC']; //欄位10 NOT_NULL
	$gro_supnumber= $_POST['GRO_SUPNUMBER']; //欄位11 NOT_NULL
	$gro_infnumber= $_POST['GRO_INFNUMBER']; //欄位12 NOT_NULL
	$gro_number= '0'; //欄位13 NOT_NULL ------->目前參團人數
	$gro_explan= $_POST['GRO_EXPLAN']; //欄位14
	$sql = "INSERT INTO `igroup` (`mem_id`,`gro_name`,`gro_startd`,`gro_endd`,`gro_endadd`,`gro_paytype`,`gro_pay`,`gro_type`,`gro_loc`,`gro_supnumber`,`gro_infnumber`,`gro_number`,`gro_explan`)
	VALUES ('{$mem_id}','{$gro_name}','{$gro_startd}','{$gro_endd}','{$gro_endadd}','{$gro_paytype}','{$gro_pay}','{$gro_type}','{$gro_loc}','{$gro_supnumber}','{$gro_infnumber}','{$gro_number}','{$gro_explan}')";
	$result = $pdo->query($sql);
	$insert_id = $pdo->lastInsertId();
	if(!$result){
		throw new Exception($pdo->error);
	}


	//gro_pt 表單上傳
	$gro_id= $insert_id;
	$gpt_pt= $_POST['GPT_PT'];

	
	// $nowtime=strtotime(date("Y-m-d H:i:s"));
	// echo $nowtime,'<br/>';
	// echo $gpt_pt,'<br/>';
	
	$sql_1 = "INSERT INTO `gro_pt` (`gro_id`,`gpt_pt`)
	VALUES ('{$gro_id}','{$gpt_pt}')";
	$result_1 = $pdo->query($sql_1);
	if(!$result_1){
		throw new Exception($pdo->error);
	}	
	//schedule 取天數
	$SCHEDULE = [];
	$SCHEDULE = $_POST['SCHEDULE'];
	$days_count = count($SCHEDULE,0);  
	$spot_count = [];
	for($i=0; $i<$days_count; $i++){
		$spot_count[$i] = count($SCHEDULE[$i],0);
	}
	//schedul 表單上傳
	for($a=0; $a < $days_count; $a++){
		$gro_id= $insert_id;
		$sche_date = date("Ymd",strtotime("+$a day",strtotime("$gro_startd"))); //欄位5 NOT_NULL

		for($b=0; $b < $spot_count[$a]; $b++){
			$sche_name=  $SCHEDULE[$a][$b]["place_view"]; //欄位3 NOT_NULL
			$sche_adress=  $SCHEDULE[$a][$b]["place_address"]; //欄位4 NOT_NULL
			$sche_starttime=  $SCHEDULE[$a][$b]["input_time"]; //欄位6 NOT_NULL
			$sche_endtime=  $SCHEDULE[$a][$b]["input_time_end"]; //欄位7 NOT_NULL
			$sql_2 = "INSERT INTO `schedule` (`gro_id`,`sche_name`,`sche_adress`,`sche_date`,`sche_starttime`,`sche_endtime`)
			VALUES ('{$gro_id}','{$sche_name}','{$sche_adress}','{$sche_date}','{$sche_starttime}','{$sche_endtime}')";
		
			$result_2 = $pdo->query($sql_2);
			if(!$result_2){
				throw new Exception($pdo->error);
			}
		}
	}
	echo "建立成功";
}catch (Exception $e){
	echo "錯誤行號 : ", $e->getLine(), "<br>";
	echo "錯誤原因 : ", $e->getMessage(), "<br>";
	// echo "系統暫時不能正常運行，請稍後再試<br>";	
}
?>