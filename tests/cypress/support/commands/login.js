Cypress.Commands.add('loginAsUser', () => {
    cy.request('/login')
        .its('body')
        .then((body) => {
            const $html = Cypress.$(body);
            const csrf = $html.find('input[name=_csrf_token]').val();

            cy.request({
                method: 'POST',
                url: '/login_check',
                form: true,
                body: {
                    _username: Cypress.env('user'),
                    _password: Cypress.env('userPassword'),
                    _csrf_token: csrf,
                    _submit: 'connexion'
                }
            });
        });
});
