<?php
function db_conection()
{
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "portariaviasolov1";
    $port = "3306";

// Create connection
    $conn = new mysqli($servername, $username, $password, $dbname,$port);
    return $conn;
}
function entrada_caminhao_interno($rec_id,$userID,$username)
{
    $tz = 'America/Sao_Paulo';
    $timestamp = time();
    $dt = new DateTime("now", new DateTimeZone($tz)); //first argument "must" be a string
    $dt->setTimestamp($timestamp); //adjust the object to correct timestamp

    $datetime =  $dt->format('Y-m-d H:i:s');//date("Y-m-d H:i:s");
    $conn = db_conection();
    $sql = "UPDATE controle_acesso_caminhoes_internos SET entrada = '".$datetime."', users_id = '".$userID."',nome_responsavel_entrada = '".$username."' WHERE id = ".$rec_id;
    $conn->query($sql);


}


function saida_caminhao($rec_id,$userID,$username)
{
    $tz = 'America/Sao_Paulo';
    $timestamp = time();
    $dt = new DateTime("now", new DateTimeZone($tz)); //first argument "must" be a string
    $dt->setTimestamp($timestamp); //adjust the object to correct timestamp

    $datetime =  $dt->format('Y-m-d H:i:s');//date("Y-m-d H:i:s");
    $conn = db_conection();
    $sql = "UPDATE controle_acesso_caminhoes SET saida = '".$datetime."', users_id1 = '".$userID."',nome_responsavel_saida = '".$username."' WHERE id = ".$rec_id;
    $conn->query($sql);


}


function saida_caminhao_chorume($rec_id,$userID,$username)
{
    $tz = 'America/Sao_Paulo';
    $timestamp = time();
    $dt = new DateTime("now", new DateTimeZone($tz)); //first argument "must" be a string
    $dt->setTimestamp($timestamp); //adjust the object to correct timestamp

    $datetime =  $dt->format('Y-m-d H:i:s');//date("Y-m-d H:i:s");
    $conn = db_conection();
    $sql = "UPDATE controle_acesso_caminhoes_chorume SET saida = '".$datetime."', users_id1 = '".$userID."',nome_responsavel_saida = '".$username."' WHERE id = ".$rec_id;
    $conn->query($sql);


}
function saida_veiculo_leve($rec_id)
{
    $tz = 'America/Sao_Paulo';
    $timestamp = time();
    $dt = new DateTime("now", new DateTimeZone($tz)); //first argument "must" be a string
    $dt->setTimestamp($timestamp); //adjust the object to correct timestamp

    $datetime =  $dt->format('Y-m-d H:i:s');//date("Y-m-d H:i:s");

    $conn = db_conection();
    $sql = "UPDATE controle_acesso_veiculos_leves SET saida = '".$datetime."' WHERE id = ".$rec_id;
    $conn->query($sql);


}

function saida_visitante($rec_id)
{
    $tz = 'America/Sao_Paulo';
    $timestamp = time();
    $dt = new DateTime("now", new DateTimeZone($tz)); //first argument "must" be a string
    $dt->setTimestamp($timestamp); //adjust the object to correct timestamp

    $datetime =  $dt->format('H:i:s');//date("Y-m-d H:i:s");
    //$datetime = date("H:i:s");

    $conn = db_conection();
    $sql = "UPDATE controle_acesso_visitantes SET saida = '".$datetime."'  WHERE id = ".$rec_id;
    $conn->query($sql);

}




?>