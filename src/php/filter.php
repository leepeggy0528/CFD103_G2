<?php
try{
  require_once("./connectAccount.php");
  $theme = $_POST['themes'];

  // $theme="'美食','燒腦'";
  $sql = "select g.gro_show, g.gro_id, g.gro_name, s.sche_name, s.sche_starttime,s.sche_date, m.mem_name, mem_pt, gp.gpt_pt
  from igroup g join schedule s on g.gro_id = s.gro_id
                    join member m on g.mem_id = m.mem_id
                    join gro_pt gp on g.gro_id = gp.gro_id
                    where g.gro_type in ($theme)
                    group by g.gro_id"; 

$themes = $pdo->query($sql);
if($themes->rowCount()==0){
    echo "{}";
}else{
  $themesRows = $themes->fetchAll(PDO::FETCH_ASSOC);
  
    echo json_encode($themesRows);
}

 
}catch(PDOException $e){
  echo $e->getMessage();
}
?>

