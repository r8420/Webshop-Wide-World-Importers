/***
 * Deze functie stuurt een POST request naar de shoppingCartFunctions.inc.php met de POST-waarden:
 * updateCart=true, productID=productID, amount=amount.
 * Deze gegevens worden gebruikt om de sessie aan te passen.
 * @param {Number} productID Het productID om aan te passen
 * @param {Number} amount De huidige hoeveelheid van het product
 * @param {Number} productPrice De UnitPrice, de standaardprijs per product
 */
function sendPostRequest(productID, amount, productPrice) {
    if (amount < 0)
        amount = 0;
    $.post('includes/shoppingCartFunctions.inc.php', {
        updateCart: true,
        productID: productID,
        amount: amount
    }, (json) => {
        //Als het gelukt is, update de prijzen in de winkelwagen
        updatePrices(productID, amount, productPrice);

        //En update het winkelwagen getal
        updateShoppingCartNumber(JSON.parse(json));
    });
}

/***
 * Deze functie update de prijzen in de winkelwagenpagina zelf.
 * Het ziet eerst wat de oorspronkelijke waardes zijn,
 * zet die om naar getallen waarmee het kan rekenen,
 * en daarna rekent het verschil uit tussen de oorspronkelijke waarden en wat de waarden zouden moeten zijn.
 * Daarna zet het die getallen weer om naar Nederlandse notatie, en zet dat neer als de tekst van het HTML element
 * @param productID Het productID om aan te passen
 * @param amount De huidige hoeveelheid van het product
 * @param productPrice De UnitPrice, de standaardprijs per product
 */
function updatePrices(productID, amount, productPrice) {
    let previousProductPrice = formatToNumber(document.getElementById(`productPrice${productID}`).innerText);
    let previousTotalPrice = formatToNumber(document.getElementById(`totalPrice`).innerText);

    let currentPrice = amount * productPrice;
    let difference = previousProductPrice - currentPrice;
    let currentTotalPrice = previousTotalPrice - difference;

    document.getElementById(`productPrice${productID}`).innerText = `€${formatToString(amount * productPrice)}`;
    if (amount <= 0) {
        document.getElementById(`row${productID}`).remove();
    }
    document.getElementById(`totalPrice`).innerText = `€${formatToString(currentTotalPrice)}`;
}

/**
 * Update het winkelwagen getal
 * @param {Object} SessionArrayJSON De SESSION array, maar dan als JSON ¯\_(ツ)_/¯
 */
function updateShoppingCartNumber(SessionArrayJSON) {
    let count = 0;
    Object.keys(SessionArrayJSON).forEach(key => {
        count += Number(SessionArrayJSON[key]);
    });
    let shoppingCartElements = document.getElementsByClassName('jsShoppingCart');
    for (let i = 0; i < shoppingCartElements.length; i++) {
        shoppingCartElements[i].dataset.count = count;
    }

}

/***
 * Deze functie zet de tekst van de prijs om voor gemakkelijk rekenen
 * @param {String} text De tekst om over te zetten naar een getal
 * @returns {Number} Het getal om mee te rekenen
 */
function formatToNumber(text) {
    text = text.replace('€', '');
    text = text.replace(/./g, '');
    text = text.replace(/,/g, '.');
    return Number(text);
}

/**
 * Deze functie zet het gegeven getal over naar Nederlandse getal-notatie.
 * @param number Het getal om om te zetten
 * @returns {String} De tekst met het geformatteerde getal
 */
function formatToString(number) {
    return new Intl.NumberFormat('nl-NL', {minimumFractionDigits: 2}).format(number);
}