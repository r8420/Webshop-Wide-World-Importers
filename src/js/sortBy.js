/**
 * @param {HTMLSelectElement} selectObject
 * @param {Array<{StockItemName: string, RecommendedRetailPrice: Number}>} array
 * @param {Number} offset
 * @param {Number} numProducts
 * @param {Number} page
 * */
function sortBy(selectObject, array, offset, numProducts, page) {
    console.log(`${offset}, ${numProducts}, ${page}`);
    switch (selectObject.value) {
        case 'nameAZ':
            console.log("az");
            array.sort((a, b) => (a.StockItemName > b.StockItemName) ? 1 : ((b.StockItemName > a.StockItemName) ? -1 : 0));
            break;
        case 'nameZA':
            console.log("za");
            array.sort((a, b) => (a.StockItemName > b.StockItemName) ? -1 : ((b.StockItemName > a.StockItemName) ? 1 : 0));
            break;
        case 'priceLowHigh':
            array.sort((a, b) => a.RecommendedRetailPrice - b.RecommendedRetailPrice);
            break;
        case 'priceHighLow':
            array.sort((a, b) => b.RecommendedRetailPrice - a.RecommendedRetailPrice);
            break;
    }
    let list = document.getElementById("productList");
    let html = "";
    for (let i = offset; i < numProducts * page; i++) {
        let product = array[i];
        html += `<li class="list-group-item shadow"><img src="data:image/jpeg;base64, ${product.Photo}" width="100" height="100" alt="Artikel foto"><span class="col-8">${product.StockItemName}</span><span class="col-4">${product.RecommendedRetailPrice}</span></li>`;
    }
    list.innerHTML = html;
}
