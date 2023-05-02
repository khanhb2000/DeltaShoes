/*$('.table-add').on('click', 'i', () => {
    const $clone = $tableID.find('tbody tr ').last().clone(true).removeClass('hide table - line '); 
    if ($tableID.find('tbody tr ').length === 0) {
        $('tbody').append(newTr);
    }
    $tableID.find('table').append($clone);
});*/

/*edit*/

const tabs = $('.table-editable').length;

const addRow = (e) => {
    str = "<tr></tr>",
    html = $.parseHTML( str ),
    $('.table-editable > tbody:last-child').eq(e.currentTarget.id).append(
        `
            <tr>
                <td><input type="number" required/></td>;
                <td><input type="number" required/></td>";
                <td><input type="number" required/></td>";
                <td><input type="number" required/></td>";
                <td>
                    <button class="btn btn-success insert_product_sku" style="padding: 10px">
                        <i class="fa-solid fa-plus"></i>
                    </button>
                    <button class="btn btn-danger delete-row" style="padding: 10px">
                        <i class="fa-solid fa-trash"></i>
                    </button>
                </td>
            </tr>
        `
    );
}



const insertProductSku = (e, url) => {
    color = e.closest('.tab-pane').attr('id')
    size = e.closest("tr").find('td:eq(0)').children('input').val()
    price = e.closest("tr").find('td:eq(1)').children('input').val()
    discount_price = e.closest("tr").find('td:eq(2)').children('input').val()
    in_stock = e.closest("tr").find('td:eq(3)').children('input').val()
    if (size.length == 0 || price.length == 0 || discount_price.length == 0 || in_stock.length == 0) {
        $("#alert").html(`
            <div class="alert alert-danger" role="alert">
                Vui lòng chọn size giày, giá giày, số lượng hợp lý
            </div>
        `)
    } else {
        $.post({
            url: url,
            data: jQuery.param({ color: color, size: size, price : price, discount_price: discount_price, in_stock: in_stock}) ,
            success: function(result){
                location.reload();
            }
        })
    }
} 


$('#btn-new-color').on('click', function() {
    new_color = $('#new-color').val()
    new_color = new_color.charAt(0).toUpperCase() + new_color.slice(1).toLowerCase()
    $('#nav-add').before(
        `
        <a class="nav-item" role="presentation">
            <button class="nav-link" data-mdb-toggle="tab" href="#${new_color}" role="tab" aria-selected="false">${new_color}</i>
        </a>
        `
    )
    $('#pills-add').before(`
        <div class="tab-pane fade" id="${new_color}" role="tabpanel">
            <div class="table-add mb-3 mr-2" id = ${$('.table-editable').length}>
                <a class="text-success">
                    <i class="fas fa-plus fa-2x" aria-hidden="true"></i>
                </a>
            </div>
            <table class="table table-bordered table-responsive-md table-striped text-center table-editable">
                <thead>
                    <tr>
                        <th>Size</th>
                        <th>Giá gốc</th>
                        <th>Giá giảm</th>
                        <th>Số lượng</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    `)
})

$(document).on('click', '.table-add', addRow);




/*$(document).on('change','.new-size',function(){
    console.log($(this).closest('.table-editable').children('td-'));
});*/

/*$('.update_product_sku').on('click', function() {
    $.post("update_product_sku?id=<?= $data['product']->id ?>")
    console.log($(this).closest("tr").children('td:first').children('input').val());
    console.log($(this).closest("tr").find('td:eq(1)').children('input').val());
})*/


/*add category , sub category*/
$("#btn_new_category").click(function() {
    if ($('#new_category').val().length == 0) {
        $('#alert').html(`
            <div class="alert alert-danger" role="alert">
                Vui lòng nhập tên thể loại để thêm
            </div>
        `)
    } else {
        $.post({
            url: "add_category",
            data: jQuery.param({ name: $('#new_category').val()}) ,
            success: function(result){
                $('#alert').html(`
                    <div class="alert alert-success" role="alert">
                        Thêm thể loại mới thành công
                    </div>
                `)
                $('#category').append(`
                    <option value="${result}">${$('#new_category').val()}</option>
                `)
            }
        })
    }
})

$("#btn_remove_category").click(function() {
    id = $('#category').find(":selected").val()
    $.post({
        url: "remove_category",
        data: jQuery.param({id: id}),
        success: function(result){
            $('#alert').html(`
                <div class="alert alert-success" role="alert">
                    Xóa thành công
                </div>
            `)
        }
    })
    $("#category").find(`[value="${id}"]`).remove();
})

$("#btn_new_sub_category").click(function() {
    id = $('#category').val()
    if ($('#category').val()) {
        $.post({
            url: "add_sub_category?id="+ id,
            data: jQuery.param({ name: $('#new_sub_category').val()}) ,
            success: function(result){
                $('#alert').html(`
                    <div class="alert alert-success" role="alert">
                        Thêm tiểu thể loại mới thành công
                    </div>
                `)
                $('#sub_category').append(`
                    <option value="${result}">${$('#new_sub_category').val()}</option>
                `)
            }
        })
    } else {
        $('#alert').html(`
            <div class="alert alert-danger" role="alert">
                Vui lòng chọn thể loại để thêm vào
            </div>
        `)
    }
})

$("#btn_remove_sub_category").click(function() {
    id = $('#sub_category').find(":selected").val()
    $.post({
        url: "remove_sub_category",
        data: jQuery.param({id: id}),
        success: function(result){
            $('#alert').html(`
                <div class="alert alert-success" role="alert">
                    Xóa thành công
                </div>
            `)
        }
    })
    $("#sub_category").find(`[value="${id}"]`).remove();
})

$(".table-editable").on("click", ".delete-row", function(e) {
    $(this).parent().parent().remove()
    //$('.table-editable').eq(e.currentTarget.id).
})