<!DOCTYPE html>
<html lang="ja">
    <head>
        <link rel="stylesheet" type="text/css" href="{{ asset('/app.css') }}">
    </head>
    <body>
        <h1>商品新規登録画面</h1>
        <div class="contents">
            <form action="" method="post" class="register-form" enctype="multipart/form-data">
                @method('post')
                @csrf
                <div class="register-form_row">
                    <label class="register-form_label">商品名</label>
                    <input type="text" name="product_name" class="register-form_input" required>
                </div>
                <div class="register-form_row">
                    <label class="register-form_label">メーカー名</label>
                    <select name="company_id" class="register-form_input" required>
                        <option value="" selected>選択してください</option>
                        @foreach ($companies as $company)
                        <option value="{{ $company->id }}">{{ $company->company_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="register-form_row">
                    <label class="register-form_label">価格</label>
                    <input type="number" name="price" class="register-form_input" required>
                </div>
                <div class="register-form_row">
                    <label class="register-form_label">在庫数</label>
                    <input type="number" name="stock" class="register-form_input" required>
                </div>
                <div class="register-form_row">
                    <label class="register-form_label">コメント</label>
                    <textarea name="comment" class="register-form_input"></textarea>
                </div>
                <div class="register-form_row">
                    <label class="register-form_label">商品画像</label>
                    <input type="file" name="image" class="register-form_input">
                </div>
                <div class="register-form_row">
                    <input type="submit" name="register" value="新規登録" class="register-btn">
                    <a href="{{ route('product.index') }}" class="back-btn">戻る</a>
                </div>
            </form>
        </div>
    </body>
</html>
