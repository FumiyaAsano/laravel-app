<!DOCTYPE html>
<html lang="ja">
    <head>
        <link rel="stylesheet" type="text/css" href="{{ asset('/app.css') }}">
    </head>
    <body>
        <h1>商品一覧画面</h1>
        <div class="contents">
            <form action="" method="get" class="search-form">
                <input type="text" name="keyword" placeholder="検索キーワード"
                    class="search-form_keyword" value="{{ $keyword }}">
                <select name="company_id" class="search-form_company">
                    <option value=""
                        @if (empty($company_id)) selected @endif
                    >選択してください</option>
                    @foreach ($companies as $company)
                    <option value="{{ $company->id }}"
                        @if ($company->id == $company_id) selected @endif
                    >{{ $company->company_name }}</option>
                    @endforeach
                </select>
                <input type="submit" name="search" value="検索" class="search-form_search">
            </form>
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
                    @php
                    $current_url = route('product.index', [
                        'keyword' => $keyword,
                        'company_id' => $company_id,
                        'page' => $page,
                    ]);
                    @endphp
                    @foreach ($products as $product)
                    <tr>
                        <td>{{ $product->id }}.</td>
                        <td><img class="register-form_input" src="{{ asset($product->img_path) }}" /></td>
                        <td>{{ $product->product_name }}</td>
                        <td>\{{ $product->price }}</td>
                        <td>{{ $product->stock }}</td>
                        <td>{{ $company_names[$product->company_id] }}</td>
                        <td>
                            <a href="{{ route('product.detail', ['id' => $product->id]) }}"
                                class="product-list_detail">詳細</a>
                            <form method="post" class="product-list_delete_wrapper"
                                action="{{ route('product.delete', ['id' => $product->id]) }}">
                                @method('DELETE')
                                @csrf
                                <input type="hidden" name="return_url" value="{{ $current_url }}">
                                <input type="submit" value="削除" class="product-list_delete">
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="pagination">
                @php
                $prev_page_number = $page - 1;
                $next_page_number = $page + 1;
                @endphp
                <a @if ($prev_page_number >= 1) href="{{ route('product.index', [
                    'keyword' => $keyword,
                    'company_id' => $company_id,
                    'page' => $prev_page_number,
                ]) }}" @endif >＜</a>
                @for ($i = 1; $i <= $page_count; $i++)
                <a href="{{ route('product.index', [
                    'keyword' => $keyword,
                    'company_id' => $company_id,
                    'page' => $i,
                ]) }}">{{ $i }}</a>
                @endfor
                <a @if ($next_page_number <= $page_count) href="{{route('product.index', [
                    'keyword' => $keyword,
                    'company_id' => $company_id,
                    'page' => $next_page_number,
                ]) }}" @endif >＞</a>
            </div>
        </div>
    </body>
</html>