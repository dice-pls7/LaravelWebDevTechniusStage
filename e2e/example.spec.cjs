// @ts-check
const { test, expect } = require('@playwright/test');

test('has title', async ({ page }) => {
  await page.goto('https://playwright.dev/');

  // Expect a title "to contain" a substring.
  await expect(page).toHaveTitle(/Playwright/);
});

test('get started link', async ({ page }) => {
  await page.goto('https://playwright.dev/');

  // Click the get started link.
  await page.getByRole('link', { name: 'Get started' }).click();

  // Expects page to have a heading with the name of Installation.
  await expect(page.getByRole('heading', { name: 'Installation' })).toBeVisible();
});

test('Kandidaat aanmaken', async ({ page }) => {
  await page.goto('http://127.0.0.1:8000/overzicht');
  await page.getByRole('link', { name: 'Inloggen' }).click();
  await page.getByLabel('Email').click();
  await page.getByLabel('Email').fill('Test@mail.com');
  await page.getByLabel('Email').press('Tab');
  await page.getByLabel('Password').fill('P@ssw0rd');
  await page.getByLabel('Password').press('Enter');
  await page.getByRole('link', { name: 'Kandidaat Toevoegen' }).click();
  await page.getByLabel('Voornaam *').click();
  await page.getByLabel('Voornaam *').fill('Test123');
  await page.getByLabel('Voornaam *').press('Tab');
  await page.getByLabel('Tussenvoegsel').press('Tab');
  await page.getByLabel('Achternaam *').fill('Test');
  await page.getByLabel('Achternaam *').press('Tab');
  await page.getByLabel('Geboortedatum *').fill('1999-01-01');
  await page.getByLabel('Geboortedatum *').press('Tab');
  await page.getByLabel('Beschikbaar vanaf: *').fill('1999-01-01');
  await page.getByLabel('Beschikbaar vanaf: *').press('Tab');
  await page.getByLabel('Functie *').selectOption('Loodgieter');
  await page.getByLabel('Beschikbaar *').selectOption('1');
  await page.getByLabel('Locatie *').click();
  await page.getByLabel('Locatie *').fill('Zwolle');
  await page.getByLabel('Taal *').click();
  await page.getByLabel('Taal *').fill('Spreekt code');
  await page.getByLabel('Taal *').press('Tab');
  await page.getByLabel('Werkervaring *').fill('Ja');
  await page.getByLabel('Werkervaring *').click();
  await page.getByLabel('Werkervaring *').fill('1');
  await page.getByLabel('Beschrijving kandidaat').click();
  await page.getByLabel('Beschrijving kandidaat').fill('Mr code');
  await page.getByRole('button', { name: 'Toevoegen' }).click();

});

test('Inloggen', async ({ page }) => {
  await page.goto('http://127.0.0.1:8000/overzicht');
  await page.getByRole('link', { name: 'Inloggen' }).click();
  await page.getByLabel('Email').click();
  await page.getByLabel('Password').click();
  await page.getByLabel('Email').click();
  await page.getByLabel('Email').fill('aw');
  await page.getByLabel('Password').click();
  await page.getByLabel('Password').fill('aw');
  await page.getByRole('button', { name: 'Log in' }).click();
  await page.getByLabel('Email').click();
  await page.getByLabel('Email').fill('Test@mail.com');
  await page.getByLabel('Email').press('Tab');
  await page.getByLabel('Password').fill('P@ssw0rd');
  await page.getByLabel('Password').press('Enter');
  
});

test('Gebruiker wijzigen', async ({ page }) => {
  await page.goto('http://127.0.0.1:8000/login');
  await page.getByLabel('Email').click();
  await page.getByLabel('Email').fill('test@mi');
  await page.locator('div').filter({ hasText: 'Heb je een account? Log dan' }).first().click();
  await page.getByLabel('Email').fill('test@mail.com');
  await page.getByLabel('Email').press('Tab');
  await page.getByLabel('Password').fill('P@ssw0rd');
  await page.getByRole('button', { name: 'Log in' }).click();
  await page.getByRole('link', { name: 'Pietje1234 V ' }).click();
  await page.getByRole('button', { name: '' }).click();
  await page.getByRole('button', { name: '' }).click();
  await page.getByRole('link', { name: 'Terug naar overzicht' }).click();
  await page.getByRole('link', { name: 'Pietje1234 V' }).click();
  await page.getByPlaceholder('Bedrijfsnaam').click();
  await page.getByPlaceholder('Bedrijfsnaam').fill('John deere trekkers');
  await page.getByPlaceholder('Bedrijfsnaam').press('Tab');
  await page.getByPlaceholder('Review').fill('trekt enorm');
  await page.getByRole('button', { name: 'Voeg referentie toe' }).click();
  page.once('dialog', dialog => {
    console.log(`Dialog message: ${dialog.message()}`);
    dialog.dismiss().catch(() => {});
  });
  await page.getByRole('button', { name: 'Stuur Email' }).click();
  await page.getByRole('link', { name: 'Wijzigen Kandidaat' }).click();
  await page.getByLabel('Geboortedatum *').fill('1999-02-02');
  await page.getByLabel('Functie *').selectOption('Elektromonteur');
  await page.getByLabel('Beschikbaar vanaf: *').fill('1234-02-11');
  await page.getByLabel('Achternaam *').click();
  await page.getByLabel('Achternaam *').fill('Van dijk123');
  await page.getByLabel('Tussenvoegsel').click();
  await page.getByLabel('Tussenvoegsel').fill('xxx');
  await page.getByLabel('Voornaam *').click();
  await page.getByLabel('Voornaam *').fill('Pietje1234');
  await page.getByLabel('Beschikbaar *').selectOption('1');
  await page.getByLabel('Locatie *').click();
  await page.getByLabel('Taal *').click();
  await page.getByLabel('Taal *').fill('schuttings');
  await page.getByLabel('Werkervaring *').click();
  await page.getByLabel('Werkervaring *').fill('chinese fabriek');
  await page.getByText('Voornaam * Tussenvoegsel').click();
  await page.getByLabel('Werkervaring *').click();
  await page.getByLabel('Werkervaring *').fill('10');
  await page.getByLabel('Werkervaring *').press('Tab');
  await page.getByLabel('Oude Opdrachtgevers').fill('Teveel om op te noemen');
  await page.getByLabel('Diploma\'s').click();
  await page.getByLabel('Certificaten').click();
  await page.getByLabel('Certificaten').fill('Heftruckcertificaat12');
  await page.getByLabel('Beschrijving kandidaat').click();
  await page.getByLabel('Beschrijving kandidaat').fill('De goated');
  
}); 


test('Detailpagina openen en interesse mail sturen', async ({ page }) => {
  await page.goto('http://127.0.0.1:8000/overzicht');
  await page.getByRole('link', { name: 'Pietje1234 V Elektromonteur' }).click();
  await page.getByRole('button', { name: 'Interesse? Mail ons!' }).click();
  await page.getByRole('link', { name: 'Terug naar overzicht' }).click();
});

test('Aanvraag doen', async ({ page }) => {
  await page.goto('http://127.0.0.1:8000/overzicht');
  await page.getByRole('link', { name: 'Aanvraag doen' }).click();
});
