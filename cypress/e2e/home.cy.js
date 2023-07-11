const commands = require("../support/commands");
const actions = require("../support/system/front/actions");
const elements = require("../support/system/front/elements");

describe('Check home', () => {
    beforeEach(() => {
        actions.login.goTo();
        actions.login.login(commands.env('username'), commands.env('password'));
    });

    it('Check visual elements', () => {
        elements.home.title().contains('Home');
        elements.home.subtitle().contains('Lista de produtos');
        elements.menu.home().contains('Home');
        elements.menu.register().contains('Register');
        elements.menu.buy().contains('Buy');
    });

    it('Try add and remove product from cart', () => {
        elements.home.firstProduct()
            .find('h3')
            .invoke('text')
            .then((productName) => {
                cy.log('Add product to cart');
                elements.home.firstAddToCart().click();

                cy.log('Check minicart popup is visible and added product');
                elements.minicart.list().should('be.visible');
                elements.minicart.firstItemName().should('have.text', productName);
                
                cy.log('Remove product');
                elements.minicart.removeButton().click();
                
                cy.log('Check empty product list');
                elements.minicart.list().should('not.have.descendants');
            });        
    });
});
