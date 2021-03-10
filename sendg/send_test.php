<?php

//mb_language("japanese");
//mb_internal_encoding("UTF-8");

//ソースを全部読み込ませる
//パスは自分がPHPMailerをインストールした場所で
//require 'PHPMailer/src/PHPMailer.php';
//require 'PHPMailer/src/SMTP.php';
//require 'PHPMailer/src/POP3.php';
//require 'PHPMailer/src/Exception.php';
//require 'PHPMailer/src/OAuth.php';
//require 'PHPMailer/language/phpmailer.lang-ja.php';

//公式通り
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//autoloderはcomposerでのインストールじゃないとないので
// Composer のオートローダーの読み込み（ファイルの位置によりパスを適宜変更）
require 'vendor/autoload.php';

//SMTPの設定
$mailer = new PHPMailer();//インスタンス生成
$mailer->IsSMTP();//SMTPを作成
$mailer->Host = 'smtp.sendgrid.net';
//$mailer->Host = 'smtp.gmail.com';
$mailer->CharSet = 'utf-8';	//文字セットこれでOK
$mailer->SMTPAuth = TRUE;	//SMTP認証を有効にする
$mailer->Username = 'apikey'; 	// ユーザー名
$mailer->Password = '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'; 	// パスワード
//$mailer->SMTPSecure = 'tls';			//SSLも使えると公式で言ってます
$mailer->Port = 587;				//tlsは587
$mailer->SMTPDebug = 2;				//2は詳細デバッグ1は簡易デバッグ本番はコメントアウトして

//メール本体
//$message="フォームで送ったよ!"."\n".$_POST['message01'];	//メール本文
$mailer->From     = 'rusami-0325@ksh.biglobe.ne.jp'; 		//差出人の設定
//$mailer->FromName = mb_convert_encoding("表示名だよ","UTF-8","AUTO");	//表示名おまじない付…
$mailer->Subject  = 'sendgrid';	//件名の設定
$mailer->Body = 'plain text';	//メッセージ本体
$mailer->AddAddress('rusami-0325@ksh.biglobe.ne.jp'); 		// To宛先

//送信する
if($mailer->Send()){}
else{
    echo "送信に失敗しました" . $mailer->ErrorInfo;
}

?>

