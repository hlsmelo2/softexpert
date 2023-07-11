const elements = require("./elements");

const actions = {
    application: {
        checkMessage(message) {
            elements.application.message().contains(message);
        },
    },
    login: {
        goTo() {
            cy.log('Go to login screen');
            cy.visit('/');
        },
        fill(username, password) {
            cy.log('Fill user and password');
    
            if (username !== '') {
                elements.login.username().type(username);
            }
            
            if (password !== '') {
                elements.login.password().type(password);
            }
        },
        login(username, password) {
            this.fill(username, password);
            cy.log('Try login');
            elements.login.button().click();
        },
        checkHome() {
            cy.log('Check if is in home');
            elements.home.subtitle().contains('Lista de produtos');
        },
    },
    registerUser: {},
    registerProduct: {},
    registerProductType: {},
    registerTax: {},
    home: {},
    cart: {},
}

module.exports = actions;
