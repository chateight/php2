<?php
    $ret = db_read();
    $cnt = count($ret);
        foreach ($ret as $cnt => $value) {
            echo "num：" . $cnt . "\n";
            $nna = $value['nname'];
            echo "nname：" . $nna." / ";
            $mailad = $value['mail'];
            echo "mail：" . $mailad . "@isehara-3lv.sakura.ne.jp";
            echo "\n";
        }
//
// Mysqlに接続して、email tableから読み出して配列で返す。
//
    function db_read()
{
//define('DB_HOST', 'localhost');
define('DB_HOST', '127.0.0.1;port=8889');
define('DB_NAME', 'members');
define('DB_USER', 'root');
define('DB_PASSWORD', 'root');

// 文字化け対策
$options = array(PDO::MYSQL_ATTR_INIT_COMMAND=>"SET CHARACTER SET 'utf8'");

// データベースの接続
try {
    $dbh = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME,DB_USER, DB_PASSWORD, $options);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//    echo 'success';
} catch (PDOException $e) {
    echo $e->getMessage();
    exit;
}
// DBからメールアドレス読み出して返却
    $stmt = $dbh->prepare("SELECT * FROM `email`");
    $stmt->execute();
    $results = $stmt->fetchAll();
    return $results;
// connection close
    $dbh = null;
}
?>
