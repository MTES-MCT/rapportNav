describe('Creation d\'un brouillon', () => {

    beforeEach(() => {
        cy.loginAsUser();
        cy.visit('/pam');
    });

    it('Je dois arriver sur la page de création de rapport et remplir les dates du rapport', () => {

        cy.get('#home_header_creer_un_rapport_btn').click();
        cy.remplirDatesRapport();
        cy.get('#datetimePicker_start')
            .find('.selected-date')
            .should('have.css', 'background-color')
            .and('eq', 'rgb(242, 249, 245)');

        cy.get('#datetimePicker_end')
            .find('.selected-date')
            .should('have.css', 'background-color')
            .and('eq', 'rgb(242, 249, 245)');
    })

    it('Je dois pouvoir ajouter un agent', () => {
        cy.get('#home_header_creer_un_rapport_btn').click();
        cy.get('#input_ajouter_membres').type('Mar', {force: true});
        cy.get('#ajout_suggestion_1').click({force: true});
        cy.get('.members-list').contains('Marceline Desbordes-Valmore');
        cy.get('#input_ajouter_membres').clear().type('John Doe').type('{enter}');
        cy.get('#fonction_select').select('Commandant');
        cy.get('#input_ajout_agent_observation').type('Je suis un agent test');
        cy.get('#btn_ajout_nouveau_agent').click();


        cy.get('.members-list').contains('John Doe');
    })


    it('Je dois pouvoir cocher une mission réalisé', () => {
        cy.get('#home_header_creer_un_rapport_btn').click();
        cy.get('#checkboxes-1').check({force: true});
        cy.get('.main-task-active').should('exist');
    })

    it('Je dois pouvoir remplir les activités du navire ', () => {
        cy.get('#home_header_creer_un_rapport_btn').click();
        cy.get('#nb_jours_mer').type('15');
        cy.get('#nav_eff').type('3');
        cy.get('#mouillage').type('4');
        cy.get('#maintenance').type('5').type('{enter}');
        cy.get('.dayInSea').contains('15 jours en mer');
        cy.get('.missionTrackTime').contains('12 heures de mission');
    });

    it('Je dois pouvoir remplir les controles opérationnel ', () => {
        cy.get('#home_header_creer_un_rapport_btn').click();
        cy.remplirControles(1);

        cy.get('.btn-add-controle').click();
        cy.get('#controle_mer_plaisance_pro').click(); //Ajout controles en mer de plaisance professionnelle

        cy.remplirControles(2); // Remplissage en controles en mer de navires de plaisance professionnelle + assertions
    });

    it('Je dois pouvoir remplir les indicateurs de missions ', () => {
        cy.get('#home_header_creer_un_rapport_btn').click();
        const $tdFillableIndicateurs = cy.get('#accordion-indicateurs-1').find('.td-fillable');
        $tdFillableIndicateurs.each(($el, index) => {
            cy.wrap($el).type('3', {force: true})
        });
    });

    it('Je dois pouvoir sauvegarder un rapport en brouillon', () => {
        cy.get('#home_header_creer_un_rapport_btn').click();
        cy.remplirDatesRapport();
        cy.get('#header_enregistrer_brouillon_btn').click();
        cy.get('.Vue-Toastification__toast--info').should('be.visible');
        cy.get('.Vue-Toastification__toast--success').should('be.visible');
    })
})


