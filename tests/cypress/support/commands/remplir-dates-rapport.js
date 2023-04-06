Cypress.Commands.add('remplirDatesRapport', () => {
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
})

