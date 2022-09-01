render_cart_table();

function render_cart_table() {
    products = JSON.parse(sessionStorage.getItem("products")) || [];

    let trsNewProducts = "<tr><th>Count</th><th>Name</th><th>Cost</th></tr>";

    products.forEach((product) => {
        trsNewProducts += `<tr><td>${product.count}</td><td>${product.name}</td><td>${product.cost}</td></td>`;
    });

    document.querySelector(".table_cart").innerHTML = trsNewProducts;
}

function add_to_cart() {
    let allProducts = document.querySelectorAll(
        ".all-products__table tr:not(:first-child)"
    );

    let products = [];
    allProducts.forEach((product) => {
        productOpts = product.querySelectorAll("td");
        productObj = {
            sku: productOpts[0].innerHTML.trim(),
            name: productOpts[1].innerHTML.trim(),
            count: parseFloat(productOpts[2].innerHTML.trim()),
            cost: parseFloat(productOpts[3].innerHTML.trim()),
        };
        products.push(productObj);
    });

    let product_code = document.querySelector(".product_code_to_add").value;

    let product = products.filter((prod) => prod.sku == product_code);

    let countProduct = parseInt(
        document.querySelector(".product_count_to_add").value
    );
    if (product.length == 0)
        return alert("There is no product with such an SKU");
    let productsStorage = JSON.parse(sessionStorage.getItem("products")) || [];

    let productStorage = {
        sku: product_code,
        name: product[0].name,
        count: countProduct,
        cost: countProduct * product[0].cost,
    };
    if (productStorage.count > product[0].count) {
        alert("We have less then you entered");
        return false;
    }
    let productTr = Array.from(allProducts)
        .filter(
            (prod) =>
                prod.querySelectorAll("td")[0].innerHTML.trim() == product_code
        )[0]
        .querySelector("td:nth-child(3)");

    productTr.innerHTML = parseInt(productTr.innerHTML) - countProduct;

    if (
        productsStorage.length == 0 ||
        productsStorage.filter((prod) => prod.sku == product_code).length == 0
    ) {
        productStorage.cost = Math.round(productStorage.cost * 100) / 100;
        productsStorage.push(productStorage);
        sessionStorage.setItem("products", JSON.stringify(productsStorage));
    } else {
        for (var i = 0; productsStorage[i].sku != product_code; i++);
        productsStorage[i].count += countProduct;
        productsStorage[i].cost +=
            Math.round(countProduct * product[0].cost * 100) / 100;

        sessionStorage.setItem("products", JSON.stringify(productsStorage));
    }

    render_cart_table();
}

let totalSum = 0;
function total_payment() {
    let cart = JSON.parse(sessionStorage.getItem("products"));
    for (let i = 0; i < cart.length; i++) {
        totalSum += cart[i].cost;
    }
    document.querySelector(
        ".total_sum_output"
    ).innerHTML = `Total sum: ${totalSum} PLN`;
}
function total_cash() {
    sessionStorage.clear("products");
    sessionStorage.setItem("totalCash", JSON.stringify(totalSum));
    render_cart_table();
}
function total_card() {
    sessionStorage.removeItem("products");
    sessionStorage.setItem("totalCard", JSON.stringify(totalSum));
    render_cart_table();
}
