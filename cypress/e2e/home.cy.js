const login = {
    goTo() {
        cy.log('Go to login screen');
        cy.visit('/');
    },
    fill(username, password) {
        cy.log('Fill user and password');

        const usernameElement = cy.get('section#login input[name="username"]').eq(0);
        const passwordElement = cy.get('section#login input[name="password"]').eq(0);
            
        usernameElement.type(username);
        passwordElement.type(password);
    },
    login() {
        cy.log('Try login');
        cy.get('section#login button[name="login"]').click();
    },   
    checkHome() {
        cy.log('Check if is in home');
        cy.get('section#home h2').contains('Lista de produtos');
    },
};

describe('Try login', () => {
    it('Try login', () => {
        login.goTo();
        login.fill('soft_expert_1', 'soft-expert');
        login.login();
        login.checkHome();
    });
});
