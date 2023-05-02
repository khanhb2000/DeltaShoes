const display = {
    data_set: users,
    list: users,
    cur_page: 1,
    per_page: 10,
    total_page: Math.ceil(users.length / 10)
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

const renderUsersList = () => {
    $('#users-list').html(``)
    display.data_set.filter(data=> data['fullname'].includes($('#search').val())).slice((display.cur_page - 1) * display.per_page, display.cur_page * display.per_page).map((item, index) => {
        //console.log(data['status'] === $('#status').val(), data['status'], $('#status').val())
        $('#users-list').append(
            `<tr>
                <td>${item.email}</td>
                <td>${item.fullname}</td>
                <td>${item.phone}</td>
                <td>${item.created_at}</td>
                <td>${item.orders}</td>
                <td>
                    <a>
                        <button id=${item.id} class="btn btn-primary btn-user-info" style="padding: 10px" data-mdb-toggle="modal" data-mdb-target="#user-info">
                            <i class="fa-solid fa-eye"></i>
                        </button>
                    </a>
                    <a href="http://localhost/assignment-ltw/public/admin/delete_user?id=${item.id}"? >
                        <button type="button" class="btn btn-danger" style="padding: 10px">
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
    renderUsersList()
}

$("#btn-prev").on('click', function() {
    changePage(display.cur_page - 1);
})

$("#btn-next").on('click', function() {
    changePage(display.cur_page + 1);
})

$(".page-item").on('click', function() {
    changePage($(".page-item").index(this) + 1);
})


$("#search").change(function() {
    renderUsersList()
})

user_info = []
$(document).on('click', '.btn-user-info', function() {
    $.get({
        url: "user_info?id=" + $(this).attr('id'),
        success: function(result) {
            result = jQuery.parseJSON(result);
            html = `
                <div class="row">
                <div class="col-12 mb-4">
                    <label for="name" class="form-label">Họ và tên</label>
                    <input type="text" name="name" class="form-control form-control-lg" value=${result.fullname}>
                </div>
                <div class="col-6 mb-4">
                    <label for="name" class="form-label">Email</label>
                    <input type="text" name="name" class="form-control form-control-lg" value=${result.email}>
                </div>
                <div class="col-6 mb-4">
                    <label for="name" class="form-label">Số điện thoại</label>
                    <input type="text" name="name" class="form-control form-control-lg" value=${result.phone}>
                </div>
                <div class="col-12 mb-4">
                    <label for="name" class="form-label">Địa chỉ</label>
                    <input type="text" name="name" class="form-control form-control-lg" value=${result.address}>
                </div>
                </div>
            `
            $('#info').html(html)
        }
    })
})


renderUsersList()