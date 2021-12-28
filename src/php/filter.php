<?php
try{
  require_once("./connectAccount.php");
  $theme = $_POST['themes'];

  $sql = "select g.gro_show, g.gro_id, g.gro_name, s.sche_name, s.sche_starttime,s.sche_date, m.mem_name, mem_pt, gp.gpt_pt
  from igroup g join schedule s on g.gro_id = s.gro_id
                    join member m on g.mem_id = m.mem_id
                    join gro_pt gp on g.gro_id = gp.gro_id
                    where g.gro_type in ($theme)
                    group by g.gro_id"; 

$result = $pdo->query($sql);
$resultRows = $result->fetch(PDO::FETCH_ASSOC);

 
}catch(PDOException $e){
  echo $e->getMessage();
}
?>

