<?php
    $ret = db_read();
    $mailad ="";
    $cnt = count($ret);
        foreach ($ret as $cnt => $value) {
//            echo "num：" . $cnt . "\n";
//            $nna = $value['nname'];
//            echo "nname：" . $nna." / ";
            $mailad .= $value['mail']."@isehara-3lv.sakura.ne.jp,";
//            echo "mail：" . $mailad;
//            echo "\n";
        }
    $mailad .= "postmaster@isehara-3lv.sakura.ne.jp";
    $mail = explode(',', $mailad);
    print_r($mail);
$tos = explode(',', $_ENV['TOS']);
print_r($tos);
//
// Mysqlに接続して、email tableから読み出して配列で返す。
//
    function db_read()
{
define('DB_HOST', 'mysql57.isehara-3lv.sakura.ne.jp');
define('DB_NAME', 'isehara-3lv_members');
define('DB_USER', '<user>');
define('DB_PASSWORD', '<pw>');

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
