function createProductList() {
    fetchProducts();

    $('.search-form_search').on('click', fetchProducts);
    $(document).on('click', '.product-list_delete', deleteProduct);
}

function fetchProducts() {
    const parameters =
        '?keyword=' + document.getElementsByClassName('search-form_keyword')[0].value +
        '&company_id=' + document.getElementsByClassName('search-form_company')[0].value +
        '&price_gte=' + document.getElementsByClassName('search-form_price-gte')[0].value +
        '&price_lte=' + document.getElementsByClassName('search-form_price-lte')[0].value +
        '&stock_gte=' + document.getElementsByClassName('search-form_stock-gte')[0].value +
        '&stock_lte=' + document.getElementsByClassName('search-form_stock-lte')[0].value;
    $.ajax({
        url: '/api/product' + parameters,
        type: 'GET',
        dataType: 'json',
        success: data => {
            const option = {
                data: data.map(row => {
                    const img = row['img_path']
                        ? $('<img />')
                            .addClass('register-form_input')
                            .attr('src', row['img_path'])
                            .prop('outerHTML')
                        : '';

                    const detailBtn = $('<a />')
                        .addClass('product-list_detail')
                        .attr('href', '/product/detail/' + row['id'])
                        .html('詳細')
                        .prop('outerHTML');

                    const deleteBtn = $('<a />')
                        .addClass('product-list_delete')
                        .attr('data-id', row['id'])
                        .html('削除')
                        .prop('outerHTML');

                    return [
                        row['id'],
                        img,
                        row['product_name'],
                        row['price'],
                        row['stock'],
                        row['company_name'],
                        detailBtn + deleteBtn,
                    ];
                }),
                info: false,
                paging: true,
                searching: false,
                ordering: true,
                columnDefs: [
                    {targets: 6, sortable: false},
                ],
                destroy: true,
            }
            $('.product-list').DataTable(option);
        },
        error: (xhr, status, error) => {
            alert('一覧の取得に失敗');
            // console.log(error);
        },
    });
}

function deleteProduct(e) {
    const row = $(e.target).parents('tr');
    $.ajax({
        url: '/api/product/delete/' + $(e.target).data('id'),
        type: 'DELETE',
        dataType: 'json',
        success: () => {
            $('.product-list').DataTable().row(row).remove().draw();
        },
        error: (xhr, status, error) => {
            alert('削除に失敗');
            // console.log(error);
        },
    });
}
