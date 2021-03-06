<?php
  // 変数の初期化
  $form = [
    'name' => '',
    'email' => '',
    'password' => '',
  ];
  $error = [];

  // ファンクション作成
  function h($value){
    return  htmlspecialchars($value, ENT_QUOTES);
  }

  // フォームが送信されたか判断する
  if($_SERVER['REQUEST_METHOD'] === 'POST'):
    // 空白除去
    $form['name'] = preg_replace( '/\A[\p{C}\p{Z}]++|[\p{C}\p{Z}]++\z/u', '', $_POST['name']);
    $form['email'] = preg_replace( '/\A[\p{C}\p{Z}]++|[\p{C}\p{Z}]++\z/u', '', $_POST['email']);
    $form['password'] = preg_replace( '/\A[\p{C}\p{Z}]++|[\p{C}\p{Z}]++\z/u', '', $_POST['password']);

    if(empty($form['name'])){
      $error['name'] = 'blank';
    }
    if(empty($form['email'])){
      $error['email'] = 'blank';
    }
    if(empty($form['password'])){
      $error['password'] = 'blank';
    } elseif( strlen($form['password']) < 4 ){
      $error['password'] = 'length';
    }

  endif;
  
  
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>会員登録</title>

    <link rel="stylesheet" href="../style.css"/>
</head>

<body>
<div id="wrap">
    <div id="head">
        <h1>会員登録</h1>
    </div>

    <div id="content">
        <p>次のフォームに必要事項をご記入ください。</p>
        <form action="" method="post" enctype="multipart/form-data">
            <dl>
                <dt>ニックネーム<span class="required">必須</span></dt>
                <dd>
                    <input type="text" name="name" size="35" maxlength="255" value="<?php echo h($form['name']); ?>"/>
                    <?php if(isset($error['name']) && $error['name'] === 'blank'): ?>
                      <p class="error">* ニックネームを入力してください</p>
                    <?php endif; ?>
                </dd>
                <dt>メールアドレス<span class="required">必須</span></dt>
                <dd>
                    <input type="text" name="email" size="35" maxlength="255" value="<?php echo h($form['email']); ?>"/>
                    <?php if( isset($error['email']) && $error['email'] === 'blank' ): ?>
                      <p class="error">* メールアドレスを入力してください</p>
                    <?php endif; ?>
                    <p class="error">* 指定されたメールアドレスはすでに登録されています</p>
                <dt>パスワード<span class="required">必須</span></dt>
                <dd>
                    <input type="password" name="password" size="10" maxlength="20" value="<?php echo h($form['password']) ?>"/>
                    <?php if( isset($error['password']) && $error['password'] === 'blank' ): ?>
                      <p class="error">* パスワードを入力してください</p>
                    <?php endif; ?>
                    <?php if( isset($error['password']) && $error['password'] === 'length' ): ?>
                      <p class="error">* パスワードは4文字以上で入力してください</p>
                    <?php endif; ?>
                </dd>
                <dt>写真など</dt>
                <dd>
                    <input type="file" name="image" size="35" value=""/>
                    <p class="error">* 写真などは「.png」または「.jpg」の画像を指定してください</p>
                    <p class="error">* 恐れ入りますが、画像を改めて指定してください</p>
                </dd>
            </dl>
            <div><input type="submit" value="入力内容を確認する"/></div>
        </form>
    </div>
</body>

</html>