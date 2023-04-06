Cypress.Commands.add('remplirControles', (index) => {
    for(let i = 2; i <= 8; i++) {
        if(i <= 6) {
            cy.get('#add-btn_' + index).click({force: true});

            cy.get('#add-column_dropdown_' + index)
                .find('#add-column_list_ajouter_pv')
                .find('#add-column_list_ajouter_pv__list')
                .find('#add-column_list_ajouter_pv__item_' + i)
                .click({force: true});
        } else {
            cy.get('#add-btn_' + index).click({force: true});
            cy.get('#add-column_dropdown_' + index)
                .find('#add-column_list_ajouter_pv__item_' + i)
                .click({force: true});
        }
    }

    cy.get('#controle_op_table_' + index).find('#nb_pv_equipement_securite').should('be.visible');
    cy.get('#controle_op_table_' + index).find('#nb_pv_titre_nav').should('be.visible');
    cy.get('#controle_op_table_' + index).find('#nb_pv_police').should('be.visible');
    cy.get('#controle_op_table_' + index).find('#nb_pv_env_pollution').should('be.visible');
    cy.get('#controle_op_table_' + index).find('#nb_autre_pv').should('be.visible');
    cy.get('#controle_op_table_' + index).find('#nb_nav_deroute').should('be.visible');
    cy.get('#controle_op_table_' + index).find('#nb_nav_interroge').should('be.visible');

    cy.get('#controle_op_table_' + index).find('#nb_navire_controle').clear({force: true}).type('16');
    cy.get('#controle_op_table_' + index).find('#nb_pv_peche_sanitaire').clear({force: true}).type('23');
    cy.get('#controle_op_table_' + index).find('#nb_pv_equipement_securite').clear({force: true}).type('3');
    cy.get('#controle_op_table_' + index).find('#nb_pv_titre_nav').clear({force: true}).type('7');
    cy.get('#controle_op_table_' + index).find('#nb_pv_police').clear({force: true}).type('9');
    cy.get('#controle_op_table_' + index).find('#nb_pv_env_pollution').clear({force: true}).type('11');
    cy.get('#controle_op_table_' + index).find('#nb_autre_pv').clear({force: true}).type('14');
    cy.get('#controle_op_table_' + index).find('#nb_nav_deroute').clear({force: true}).type('4');
    cy.get('#controle_op_table_' + index).find('#nb_nav_interroge').clear({force: true}).type('2');
})

