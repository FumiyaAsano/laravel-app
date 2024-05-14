<!DOCTYPE html>
<html lang="ja">
    <head>
        <link href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" rel="stylesheet"/>
        <link rel="stylesheet" type="text/css" href="{{ asset('/app.css') }}">

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
        <script src="{{ asset('/app.js') }}"></script>
    </head>
    <body>
        <h1>商品一覧画面</h1>
        <div class="contents">
            <div action="" method="get" class="search-form">
                <input type="text" name="keyword" placeholder="検索キーワード"
                    class="search-form_keyword" value="">
                <select name="company_id" class="search-form_company">
                    <option value="" selected>選択してください</option>
                    @foreach ($companies as $company)
                    <option value="{{ $company->id }}" >{{ $company->company_name }}</option>
                    @endforeach
                </select>
                価格：
                <input type="number" name="price_gte" class="search-form_price-gte" value="" placeholder="下限">
                ～
                <input type="number" name="price_lte" class="search-form_price-lte" value="" placeholder="上限">
                在庫数：
                <input type="number" name="stock_gte" class="search-form_stock-gte" value="" placeholder="下限">
                ～
                <input type="number" name="stock_lte" class="search-form_stock-lte" value="" placeholder="上限">
                <button type="button" class="search-form_search">検索</button>
            </div>
            <table class="product-list">
                <thead>
                    <tr>
                        <td>ID</td>
                        <td>商品画像</td>
                        <td>商品名</td>
                        <td>価格</td>
                        <td>在庫数</td>
                        <td>メーカー名</td>
                        <td><a href="{{ route('product.register') }}" class="product-list_new">新規登録</a></td>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
        <script>
            $(function () {
                createProductList();
            });
        </script>
    </body>
</html>