const commands = require("../support/commands");
const actions = require("../support/system/front/actions");

describe('Try login', () => {
    beforeEach(() => {
        actions.login.goTo();
    });

    it('Try to login correctly', () => {
        actions.login.login(commands.env('username'), commands.env('password'));
        actions.login.checkHome();
    });

    it('Try to log in with incorrect credentials', () => {
        actions.login.login(commands.env('username'), commands.env('wrongPassword'));
        actions.application.checkMessage('Login or password is wrong');
    });

    it('Try to login with blank username', () => {
        actions.login.login('', commands.env('password'));
        actions.application.checkMessage('Login or password is wrong');
    });

    it('Try to login with blank password', () => {
        actions.login.login(commands.env('username'), '');
        actions.application.checkMessage('Login or password is wrong');
    });
});
