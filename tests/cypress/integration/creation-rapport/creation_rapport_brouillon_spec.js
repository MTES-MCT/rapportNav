describe('Creation d\'un brouillon', () => {

    beforeEach(() => {
        cy.loginAsUser();
        cy.visit('/pam');
    });

    it('Je dois arriver sur la page de création de rapport et sauvegarder un brouillon', () => {
        cy.viewport('macbook-15')

        // Accès à la page de création de rapport
        cy.get('#home_header_creer_un_rapport_btn').click();

        // Remplissage des dates du rapport
        cy.get('#datetimePicker_start').click();
        cy.get('#datetimePicker_start__day__1').click();
        cy.get('#datetimePicker_start').click();
        cy.get('#datetimePicker_start_timepicker__group_hour').find('input').clear();
        cy.get('#datetimePicker_start_timepicker__group_hour').find('input').type('15');
        cy.get('#datetimePicker_start_timepicker__group_minute').find('input').clear();
        cy.get('#datetimePicker_start_timepicker__group_minute').find('input').type('15');

        cy.get('#datetimePicker_end').click();
        cy.get('#datetimePicker_end__day__12').click();
        cy.get('#datetimePicker_end').click();
        cy.get('#datetimePicker_end_timepicker__group_hour').find('input').clear();
        cy.get('#datetimePicker_end_timepicker__group_hour').find('input').type('12');
        cy.get('#datetimePicker_end_timepicker__group_minute').find('input').clear();
        cy.get('#datetimePicker_end_timepicker__group_minute').find('input').type('15');


        // Agent des agents
        cy.get('#input_ajouter_membres').type('Mar', {force: true});
        cy.get('#ajout_suggestion_1').click({force: true});
        cy.get('.members-list').contains('Marceline Desbordes-Valmore');
        cy.get('#input_ajouter_membres').clear().type('John Doe').type('{enter}');
        cy.get('#fonction_select').select('Commandant');
        cy.get('#input_ajout_agent_observation').type('Je suis un agent test');
        cy.get('#btn_ajout_nouveau_agent').click();


        cy.get('.members-list').contains('John Doe');

        // Check des missions à réaliser
        cy.get('#checkboxes-1').check({force: true});
        cy.get('.main-task-active').should('exist');

        //Activités du navire
        cy.get('#nb_jours_mer').type('15');
        cy.get('#nav_eff').type('3');
        cy.get('#mouillage').type('4');
        cy.get('#maintenance').type('5').type('{enter}');


        cy.get('.dayInSea').contains('15 jours en mer');
        cy.get('.missionTrackTime').contains('12 heures de mission');


        //Controles opérationnels
        remplissageControles(1); // Remplissage controles en mer de navires de pêche professionnelle

        cy.get('.btn-add-controle').click();
        cy.get('#controle_mer_plaisance_pro').click(); //Ajout controles en mer de plaisance professionnelle

        remplissageControles(2); // Remplissage en controles en mer de navires de plaisance professionnelle


        //Indicateurs de missions
        const $tdFillableIndicateurs = cy.get('#accordion-indicateurs-1').find('.td-fillable');

        $tdFillableIndicateurs.each(($el, index) => {
            cy.wrap($el).type('3')
        });


        cy.get('#header_enregistrer_brouillon_btn').click();
        cy.get('.Vue-Toastification__toast--info').should('be.visible');
        cy.get('.Vue-Toastification__toast--success').should('be.visible');
    })
})

/**
 * Remplissage formulaire contrôles opérationnels
 *
 * @param index id de la categorie de Controle
 */
function remplissageControles(index) {
    for(let i = 2; i <= 8; i++) {
        if(i <= 6) {
            cy.get('#add-btn_' + index)
                .trigger('mouseover')
                .find('#add-column_dropdown')
                .find('#add-column_list')
                .find('#add-column_list_ajouter_pv')
            cy.get('#controle_op_table_' + index)
                .find('#add-column_list_ajouter_pv__list')
                .find('#add-column_list_ajouter_pv__item_' + i)
                .click({force: true});
        } else {
            cy.get('#add-btn_' + index)
                .trigger('mouseover')
                .find('#add-column_dropdown')
                .find('#add-column_list')
            cy.get('#controle_op_table_' + index)
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

    cy.get('#controle_op_table_' + index).find('#nb_navire_controle').clear().type('16');
    cy.get('#controle_op_table_' + index).find('#nb_pv_peche_sanitaire').clear().type('23');
    cy.get('#controle_op_table_' + index).find('#nb_pv_equipement_securite').clear().type('3');
    cy.get('#controle_op_table_' + index).find('#nb_pv_titre_nav').clear().type('7');
    cy.get('#controle_op_table_' + index).find('#nb_pv_police').clear().type('9');
    cy.get('#controle_op_table_' + index).find('#nb_pv_env_pollution').clear().type('11');
    cy.get('#controle_op_table_' + index).find('#nb_autre_pv').clear().type('14');
    cy.get('#controle_op_table_' + index).find('#nb_nav_deroute').clear().type('4');
    cy.get('#controle_op_table_' + index).find('#nb_nav_interroge').clear().type('2');
}
