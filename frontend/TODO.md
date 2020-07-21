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

Page structure:
Landing page: Menu, Body: Article
Reservation: Menu, Body: Form(Reservation)

Data structure:
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
    room, 
    admin_confirmation, 
    payment_confirmed

Secret_admin_question