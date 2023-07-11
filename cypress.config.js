const { defineConfig } = require("cypress");

module.exports = defineConfig({
  e2e: {
    baseUrl: 'http://localhost:8080',
    pageLoadTimeout: 120000,
    setupNodeEvents(on, config) {
      // implement node event listeners here
    },
    env: {
      username: 'soft_expert_1',
      password: 'soft_expert_1',
      wrongPassword: 'soft_expert_2',
    },
  },
});
