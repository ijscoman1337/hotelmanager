HOTEL MANAGER by Julian Hoogendoorn
Quick assignment to demonstrate Laravel

Install PHP 7.4+
Install Composer
Install Laravel
Clone or download project
create a (i used mysql) database
hook it up in the config file 
run migration
TODO: create seed data
For now, do this manually to create data which will let you properly test the app:
- read controller method descriptions to figure out which parameters to use
- add two users on the /auth/register, 
- adjust one user by giving that user the role "admin" in the DB manually.
- add a couple of rooms with different prices and people_count's in the DB manually
- use the API to make reservations, confirm/deny them to test the API

For as far as possible all API functionality is implemented.
The rest should be done in the frontend which is still to be made.

PRIMAIRE VOORWAARDEN:
API entry point: {your http entry (example: http://127.0.0.1)}
1. De applicatie moet een landingspagina hebben waarop het hotel wordt ingeleid.
TODO: Frontend
API: /home
PARAMS: n.a.
2. Op de reserveringspagina moet de klant zijn naam, emailadres, geboortedatum,
telefoonnummer (optioneel), aantal personen en gewenste datum en eventuele
opmerkingen invullen.
TODO: Frontend
API: /makereservation
3. De gegevens van de reservering moeten worden opgeslagen en kunnen worden terug
gelezen door een administrator van het systeem.
TODO: Frontend
API: /admin/getreservation
4. De reservering kan worden bevestigd of worden afgewezen door de administrator.
TODO: Frontend
API: /admin/confirmreservation
5. De klant kan kiezen uit verschillende kamers.
TODO: Frontend
API: /rooms
6. xx De klant moet na het kiezen van een kamer en het invullen van het reserveringsformulier
een betaling doorlopen (simulatie).
7. xx Na de correct voltooide betaling wordt er een bevestiging gestuurd naar het
emailadres van de klant
xx TODO: Frontend
    Deze ga ik niet doen op de API, 
   want op de API hier hoeft daar denk ik niks voor gedaan te worden.
   Ik zou kijken naar een oplossing die puur in de frontend bestaat 
   en uitsluitend gebruikt maakt van SaaS' (zoals iFrames) 
   en redirects van en naar de API's van betalingsoplossing providers. 
   Als de betaling gelukt is zou ik dan een post sturen
   naar deze API met iets van een Hash oid waarmee gechecked kan worden bij de API van de betalingsaanbieder
   of het ook echt gelukt is en of de betaling ook echt van deze gebruiker is, 
   maar daar heb ik nog nooit wat mee gedaan, en hoe interessant me dit ook lijkt, 
   dit ga ik niet nu uitzoeken.

SECUNDAIRE VOORWAARDEN
1. De kamers zijn te filteren op het aantal personen en de datum die door de klant is
gekozen.
TODO: Frontend
API: /rooms
2. De klant kan inloggen op de website van het hotel en kan zijn reserveringen inzien.
TODO: Frontend
API: /auth/register -> /auth/login -> /user/reservations
3. De bevestiging na de reservering bevat een factuur opgemaakt in PDF.
TODO: Frontend and API
4. De reservering wordt automatisch afgewezen als de kamer al bezet is in het gekozen
tijdvak.
TODO: Frontend
API: /makereservation
5. Automatische prijsberekening aan de hand van de gekozen datum door de klant.
  Voorbeeld: Een kamer kost 45 euro per nacht, de klant reserveert de kamer voor 4
  dagen. De totaalprijs wordt op de reserveringspagina getoond als 180 euro.
TODO: Frontend
API: /makereservation
