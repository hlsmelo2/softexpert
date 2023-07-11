const commands = require("../../commands");

const elements = {
    application: {
        message() {
            return commands.get('main span.warning');
        },
    },
    login: {
        username() {
            return commands.get('section#login input[name="username"]', 0);
        },
        password() {
            return commands.get('section#login input[name="password"]', 0);
        },
        button() {
            return commands.get('section#login button[name="login"]');
        },
    },
    registerUser: {},
    registerProduct: {},
    registerProductType: {},
    registerTax: {},
    menu: {
        home() {
            return commands.get('nav#main-menu a[href="/home"]');
        },
        register() {
            return commands.get('nav#main-menu a[href="#"]');
        },
        buy() {
            return commands.get('nav#main-menu a[href="/buy"]');
        },
    },
    home: {
        title() {
            return commands.get('section#home h1');
        },
        subtitle() {
            return commands.get('section#home h2');
        },
        firstProduct() {
            return commands.get('ul#showcase li.card-style', 0);
        },
        firstAddToCart() {
            return this.firstProduct()
                .find('button')
                .contains('Add To Cart');
        },
    },
    cart: {},
    minicart: {
        self() {
            return commands.get('section#minicart');
        },
        list() {
            return commands.get('section#minicart ul#list');
        },
        firstItemName() {
            return this.list().find('li span.name');
        },
        removeButton() {
            return this.list().find('div.buttons a');
        },
    },
};

module.exports = elements;
