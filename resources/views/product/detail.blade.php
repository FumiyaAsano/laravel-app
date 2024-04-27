<!DOCTYPE html>
<html lang="ja">
    <head>
        <link rel="stylesheet" type="text/css" href="{{ asset('/app.css') }}">
    </head>
    <body>
        <h1>商品情報詳細画面</h1>
        <div class="contents">
            <form action="" method="post" class="register-form" enctype="multipart/form-data">
                <div class="register-form_row">
                    <label class="register-form_label">ID.</label>
                    <label class="register-form_input">{{ $product->id }}.</label>
                </div>
                <div class="register-form_row">
                    <label class="register-form_label">商品画像</label>
                    <img class="register-form_input" src="{{ asset($product->img_path) }}" />
                </div>
                <div class="register-form_row">
                    <label class="register-form_label">商品名</label>
                    <label class="register-form_input">{{ $product->product_name }}</label>
                </div>
                <div class="register-form_row">
                    <label class="register-form_label">メーカー名</label>
                    <label class="register-form_input">{{ $company->company_name }}</label>
                </div>
                <div class="register-form_row">
                    <label class="register-form_label">価格</label>
                    <label class="register-form_input">{{ $product->price }}</label>
                </div>
                <div class="register-form_row">
                    <label class="register-form_label">在庫数</label>
                    <label class="register-form_input">{{ $product->stock }}</label>
                </div>
                <div class="register-form_row">
                    <label class="register-form_label">コメント</label>
                    <label class="register-form_input">{{ $product->comment }}</label>
                </div>
                <div class="register-form_row">
                    <a href="{{ route('product.edit', ['id' => $product->id]) }}" class="edit-btn">編集</a>
                    <a href="{{ route('product.index') }}" class="back-btn">戻る</a>
                </div>
            </form>
        </div>
    </body>
</html>
