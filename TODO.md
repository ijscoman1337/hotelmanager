Hotel opdracht

Primaire functionaliteiten
1. De applicatie moet een landingspagina hebben waarop het hotel wordt ingeleid.
2. Op de reserveringspagina moet de klant zijn naam, emailadres, geboortedatum,
telefoonnummer (optioneel), aantal personen en gewenste datum en eventuele
opmerkingen invullen.
3. De gegevens van de reservering moeten worden opgeslagen en kunnen worden terug
gelezen door een administrator van het systeem.
4. De reservering kan worden bevestigd of worden afgewezen door de administrator.
5. De klant kan kiezen uit verschillende kamers.
6. De klant moet na het kiezen van een kamer en het invullen van het reserveringsformulier
een betaling doorlopen (simulatie).
7. Na de correct voltooide betaling wordt er een bevestiging gestuurd naar het
emailadres van de klant

PAGES:
Landing page: Menu, Body: Article
Reservation: Menu, Body: Add-reservation-form(Reservation) 
Admin: Menu, List of Reservations(Confirm-reservation-form(Reservation))

FORMS:

Add-reservation-form
    name (text)
    email (text, validation: email),
    date_of_birth (datetime),
    phone (int),
    number_of_persons (int),
    date_start (datetime, validation: date_start > date_end),
    date_end (datetime),

Confirm-reservation-form
    Room(choiceList(Rooms(filter: !(date_start - date_end), Room.number_of_persons <= number_of_persons))),
    admin_confirmed (checkbox)

DATA STRUCTURE:
Article
    title, 
    Paragraphs

Paragraph
    title, 
    description, 
    image

Reservation
    name, 
    email, 
    date_of_birth, 
    phone, 
    number_of_persons, 
    date_start, 
    date_end, 
    Room, 
    admin_confirmed,
    price_total, 
    payment_confirmed

Secundaire functionaliteiten
1. De kamers zijn te filteren op het aantal personen en de datum die door de klant is
gekozen.
2. De klant kan inloggen op de website van het hotel en kan zijn reserveringen inzien.
3. De bevestiging na de reservering bevat een factuur opgemaakt in PDF.
4. De reservering wordt automatisch afgewezen als de kamer al bezet is in het gekozen
tijdvak.
5. Automatische prijsberekening aan de hand van de gekozen datum door de klant.
Voorbeeld: Een kamer kost 45 euro per nacht, de klant reserveert de kamer voor 4
dagen. De totaalprijs wordt op de reserveringspagina getoond als 180 euro.

PAGES:

Login: Menu, Body: User-login-form()

FORMS:

User-login-form
    email (text, validation: email),
    password(text, validation: password = password_confirmed)
    password_confirmed(text)
    
DATA STRUCTURE:

Room
    number_of_persons,
    price_per_night

User
    name, 
    email, 
    date_of_birth, 
    phone, 
    password,
    role,
    Reservations

