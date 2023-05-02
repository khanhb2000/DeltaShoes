const display = {
    data_set: products,
    list: products,
    cur_page: 1,
    per_page: 10,
    total_page: Math.ceil(products.length / 10)
}

const renderPagnition = () => {
    if (display.cur_page % 3 === 1) {
        $('#pagination').html(``);
        $('#pagination').append(`
            <li>
                <a class="page-link" aria-label="Previous" id="btn-prev" disabled>
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>
            <li class="page-item active"><a class="page-link">${display.cur_page}</a></li>
        `)


        for(let i = display.cur_page + 1, j = 0; j < 2 && i <= display.total_page; ++i, ++j) {
            $('#pagination').append(`
                <li class="page-item"><a class="page-link">${i}</a></li>
            `)
        }

        $('#pagination').append(`
        <li>
            <a class="page-link" aria-label="Next" id="btn-next">
                <span aria-hidden="true">&raquo;</span>
            </a>
        </li>
        `)
    }
}

const renderProductList = () => {
    $('#products-list').html(``)
    display.data_set.filter(data=> data['name'].toLowerCase().includes($('#search').val().toLowerCase())).slice((display.cur_page - 1) * display.per_page, display.cur_page * display.per_page).map((item, index) => {
        $('#products-list').append(
            `<tr>
                <td>${item.name}</td>
                <td>${item.category}</td>
                <td>${item.type}</td>
                <td>${item.brand}</td>
                <td>${item.stock}</td>
                <td>
                    <a href="edit_product?id=${item.id}"?>
                        <button class="btn btn-primary" style="padding: 10px">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </button>
                    </a>
                    <a href="delete_product?id=${item.id}"? >
                        <button type="button" class="btn btn-dark" style="padding: 10px">
                            <i class="fa-solid fa-trash"></i>
                        </button>  
                    </a>                      
                </td>
            </tr>`   
        )
    })
    renderPagnition()
}

function changePage(newpage) {
    if (newpage >= 1 && newpage <= display.total_page) {
        $(".page-item").eq(display.cur_page % 3 - 1).removeClass('active')
        $(".page-item").eq(newpage % 3 - 1).addClass('active')
        display.cur_page = newpage;
    }
    renderProductList()
}

$(document).on("click", "#btn-prev", function() {
    changePage(display.cur_page - 1);
})

$(document).on("click", "#btn-next", function() {
    changePage(display.cur_page + 1);
})

$(".page-item").on('click', function() {
    changePage($(".page-item").index(this) + 1);
})


$("#search").change(function() {
    renderProductList()
})

renderProductList()
