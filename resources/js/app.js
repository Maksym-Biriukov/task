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
    let countProduct = document.querySelector(".product_count_to_add").value;
    if (product.length == 0)
        return alert("There is no product with such an SKU");

    if (countProduct > product.count)
        return alert("We have less count then you want");

    let trNewProduct = `<tr><td>${countProduct}</td><td>${
        product[0].name
    }</td><td>${product[0].cost * countProduct}</td></td>`;

    document.querySelector(".table_cart").innerHTML += trNewProduct;
}
