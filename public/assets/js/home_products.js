console.log(product_items)
const display = {
    data_set: product_items,
    list: product_items,
    cur_page: 1,
    per_page: 8,
    total_page: Math.ceil(product_items.length / 8)
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
    $('#product-list').html(``)
    let product_items = ''
    display.list.slice((display.cur_page - 1) * display.per_page, display.cur_page * display.per_page).forEach((item, index) => {
    product_items += `<div class = "col-6 col-sm-3 mb-4">
                                            <div class = "card rounded-0">
                                                <img src="${root}/assets/img/${item['image']}" class="card-img-top" alt="...">
                                                <div class="card-body">`
    if (item["discount_price"] !== item.price) product_items += `<div class="flash"></div>`
    product_items +=            `<p class="card-text text-center">${item.name}</p>
                                                    <div class = "product-price border-top pt-3" style = "min-height: 58px">
                                                        <div class = "float-start" >
                                                            <h6 class="card-title text-primary">${(item["discount_price"]).toLocaleString("de-DE")}đ</h6>`
    if (item["discount_price"] !== item.price) product_items += `<p class = "card-text text-decoration-line-through" style = "font-size: 12px">${(item.price).toLocaleString("de-DE")}đ</p>`
    product_items +=                `</div>
                                                    <a href = 'product?id=${item['id']}' alt='detail' class="btn--primary float-end">Chi tiết</a>
                                                    </div> 
                                                </div> 
                                            </div>
                                        </div>`
    })
    $('#product-list').html(product_items)
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

renderProductList()

function detail(id) {
    console.log(id)
}

const prices = ["Giá dưới 100.000đ", "100.000đ - 200.000đ", "200.000đ - 300.000đ",  "300.000đ - 500.000đ", "500.000đ - 1.000.000đ", "Giá trên 1.000.000đ"]
const sizes = [38, 39, 40, 41, 42]
$.each(prices, function(index, price) {
    $("#prices > ul").append(`
        <li class="list-group-item border border-0 text-hover-primary">
            <input class="form-check-input me-2 border rounded-0" name="prices" type="checkbox" value="${index}" id = "filter-price-${index}">
            <label for = "filter-price-${index}" class="form-check-label">
                ${price}
            </label>
        </li>
    `)
})

/*$.each(sizes, function(index, size) {
    $("#sizes > .d-flex").append(`
        <div class="form-check form-check-inline text-hover-primary">
            <input class="form-check-input me-2 border rounded-0" name="sizes" type="checkbox" value="${size}"id="filter-size-${index}">
            <label class="form-check-label" for="filter-size-${index}">${size}</label>
        </div>
    `)
})*/

$.each(sub_categories, function(index, sub_category) {
    $("#sub_categories > ul").append(`
        <li class="list-group-item border border-0 text-hover-primary">
            <input class="form-check-input me-2 border rounded-0" name="brands" type="checkbox" value="${sub_category.name}" id = "filter-sub-${index}">
            <label for = "filter-sub-${index}" class="form-check-label">
                ${sub_category.name}
            </label>
        </li>
    `)
})

$.each(categories, function(index, category) {
    $("#categories > ul").append(`
        <li class="list-group-item border border-0 text-hover-primary">
            <input class="form-check-input me-2 border rounded-0" name="brands" type="checkbox" value="${category.name}" id = "filter-category-${index}">
            <label for = "filter-category-${index}" class="form-check-label">
                ${category.name}
            </label>
        </li>
    `)
})

/*$.each(colors, function(index, color) {
            $("#colors > .d-flex").append(`
                <div class="form-check form-check-inline text-hover-primary">
                    <input class="form-check-input me-2 border rounded-0" name="colors" type="checkbox" value="${color.color}" id="filter-color-${index}">
                    <label class="form-check-label" for="filter-color-${index}">${color.color}</label>
                </div>
            `)
})*/

$.each(brands, function(index, brand) {
            $("#brands > ul").append(`
                <li class="list-group-item border border-0 text-hover-primary">
                    <input class="form-check-input me-2 border rounded-0" name="brands" type="checkbox" value="${brand.brand}" id = "filter-brand-${index}">
                    <label for = "filter-brand-${index}" class="form-check-label">
                        ${brand.brand}
                    </label>
                </li>
            `)
})

$(document).on("change", "#aside .form-check-input", function() {
    const filter_products = []
    //console.log($("#aside .form-check-input:checked").length)
    
    if ($("#aside .form-check-input:checked").length != 0) {
        $.each(product_items, function(index, product) {
            $("#aside .form-check-input:checked").each(function(){
                const val = $(this).val();
                console.log($(this).closest(".card").attr("id"))
                if ($(this).closest(".card").attr("id") === "prices") {
                    console.log(product.discount_price < 100000, val)
                    if (val === '0' && product.discount_price < 100000 ||
                    val === '1' && product.discount_price >= 100000 && product.discount_price < 200000 ||
                    val === '2' && product.discount_price >= 200000 && product.discount_price < 300000 ||
                    val === '3' && product.discount_price >= 300000 && product.discount_price < 500000 ||
                    val === '4' && product.discount_price >= 500000 && product.discount_price < 1000000 ||
                    val === '5' && product.discount_price >= 1000000) {
                        filter_products.push(product);
                        return false;
                    } 
                }
                else {
                    for (const [key, value] of Object.entries(product)) {
                        if (typeof value === 'string' && value.includes(val)) {
                            filter_products.push(product);
                            return false;
                        } else if (value.toString().includes(val)) {
                            filter_products.push(product);
                            return false;
                        }
                    }
                }
            })
            
        })
        display.list = filter_products;
    } else {
        display.list = display.data_set;
    }
    
    display.cur_page = 1
    display.total_page = Math.ceil(display.list.length / display.per_page)
    renderProductList()
})

$(document).on("change", "#sort .form-check-input", function() {
    if ($("#sort .form-check-input:checked").val() === "increase") {
        display.list = display.list.sort(function(a, b) {
            return a.discount_price - b.discount_price;
        });
    } else {
        display.list = display.list.sort(function(a, b) {
            return b.discount_price - a.discount_price;
        });
    }

    //display.total_page = Math.ceil(display.list.length / display.per_page)
    renderProductList()
})
       