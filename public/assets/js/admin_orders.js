const display = {
    data_set: orders,
    list: orders,
    cur_page: 1,
    per_page: 10,
    total_page: Math.ceil(orders.length / 10)
}

const status = ["Đang xử lí", "Đang vận chuyển", "Đã hoàn thành", "Đã hủy"]

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

const renderOrdersList = () => {
    $('#orders-list').html(``)
    display.list.slice((display.cur_page - 1) * display.per_page, display.cur_page * display.per_page).map((item, index) => {
        $('#orders-list').append(
            `<tr>
                <td>${item.id}</td>
                <td>${item.user_id}</td>
                <td>${item.created_at}</td>
                <td>${status[item.status]}</td>
                <td>${(parseInt(item.total_price) +  parseInt(item.shipping_cost)).toLocaleString("de-DE")}</td>
                <td>
                    <a href="http://localhost/assignment-ltw/public/admin/edit_order?id=${item.id}"?>
                        <button class="btn btn-primary" style="padding: 10px">
                            <i class="fa-solid fa-pen-to-square"></i>
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
    renderOrdersList()
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
    display.list = display.data_set.filter(data => data['status'] === $('#status').val()).filter(data=> data['id'].includes($('#search').val()))
    display.cur_page = 1
    display.total_page = Math.ceil(display.list.length / display.per_page)
    renderOrdersList()
})

$('#status').change(function() {
    display.list = display.data_set.filter(data => data['status'] === $('#status').val()).filter(data=> data['id'].includes($('#search').val()))
    display.cur_page = 1
    display.total_page = Math.ceil(display.list.length / display.per_page)
    renderOrdersList()
})

renderOrdersList()