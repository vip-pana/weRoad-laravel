# weRoad-laravel

### Requisiti
- PHP versione 8.2+
- Composer
## Installazione
1. Clonare il repository
2. Eseguire `composer install` per installare le dipendenze necessarie
3. Eseguire `php artisan migrate --seed` per popolare il database con dati mock.
### Packages
- **Laravel Breeze**: Per l'autenticazione
- **Faker**: Per il seeding dei dati nel database
- **Pint**: Un Lint per la formattazione del codice
- **Pest**: Una libreria per il testing
## Descrizione
Il progetto utilizza SQLite come database di supporto, eliminando la necessità di creare un database separato. L'autenticazione con autorizzazione assegna funzionalità specifiche in base al ruolo dell'utente.
### Dati di accesso per i ruoli

Sono stati creati dati di accesso per gli utenti con ruoli predefiniti:

1. Admin: `admin@gmail.com` con password `password`
2. Editor: `editor@gmail.com` con password `password`

I dati di accesso sono gestiti nel file `/database/seeders/DatabaseSeeder.php`.
***
### Ruoli e Permessi
Sono definiti due ruoli: **Admin** e **Editor**. I ruoli sono implementati utilizzando un enum di Integer, accessibile tramite `/app/Enums/UserRole.php`.

- **Admin**:
    - Creare un viaggio (Travel)
    - Creare un tour associato a un viaggio
    - Eliminare un viaggio
    - Eliminare un tour
    - Modificare un tour

- **Editor**:
	- Modificare i dati dei viaggi

- **Funzionalità per gli utenti non autenticati**:
	- Visualizzare una lista paginata dei viaggi
	- Visualizzare i dettagli di un viaggio con i relativi tour
	- Filtrare i tour associati a un viaggio attraverso i campi di ricerca
***
## API Endpoints

Gli endpoint sono definiti nella cartella `routes`, gestendo le autorizzazioni tramite middlewares, disponibili su `/app/Http/Middleware`
### Percorsi Accessibili senza Autorizzazione

1. `GET /`: Visualizza l'indice di tutti i Travels, paginati.
2. `GET /travels/{slug}`: Visualizza un singolo travel e la tabella dei tours associati ad esso.

### Percorsi Raggiungibili solo dagli Amministratori e solo se Autenticati

1. `GET /travels/create`: Visualizza la pagina di creazione di un nuovo travel.
2. `POST /travels`: Crea un singolo travel.
3. `DELETE /travels/{travel}`: Elimina un singolo travel.
4. `GET /travels/{slug}/tours/create`: Visualizza la pagina di creazione di un nuovo tour associato al travel.
5. `POST /travels/{travel}/tours`: Crea un nuovo tour associato al travel.
6. `GET /tours/{tour}/edit`: Visualizza la pagina di modifica del singolo tour.
7. `PUT /tours/{tour}`: Modifica il singolo tour.
8. `DELETE /tours/{tour}`: Elimina il singolo tour.

### Percorsi Accessibili solo dagli Editor e solo se Autenticati

1. `GET /travels/{slug}/edit`: Visualizza la pagina di modifica del singolo travel.
2. `PUT /travels/{slug}`: Modifica un singolo travel.

#### Parametri degli Endpoints

1. `{slug}`: Il valore `{slug}` rappresenta la proprietà slug del travel, ad esempio "foo-bar".
2. `{travel}`: È l'ID del travel selezionato.
3. `{tour}`: È l'ID del tour selezionato.
***
## Controllers

I controller gestiscono le azioni richiamabili dagli endpoint. Oltre ai controller che gestiscono l'autenticazione, situati nel percorso `/app/Http/Controllers/Auth`, e il controller `ProfileController.php`, responsabile della gestione del profilo dell'utente, ci sono:

1. **TourController.php**: Si occupa della gestione CRUD dei Tour.
2. **TravelController.php**: Si occupa della gestione CRUD dei Travel. Inoltre, contiene un metodo privato per applicare i filtri di ricerca al percorso GET del singolo Travel.
***
## Database
SQLite è utilizzato come database, i modelli delle entità sono realizzati creando delle migrazioni per le singole entità.
### Modelli e Migrazioni
Tutte le entità utilizzano un UUID come chiave primaria
tutte le proprieta dei modelli sono obbligatorie e i modelli sono:
### User
- `id`: UUID, Primary Key
- `name`: string
- `email`: string, unique
- `password`: string (criptata alla registrazione)
- `role`: integer (basato sul enum `UserRole`)
### Travel
- `id`: UUID, Primary Key
- `slug`: string, unique
- `name`: string
- `name`: text
- `numberOfDays`: integer
- `moods`: Json Object
- `isPublic`: boolean
### Tour
- `id`: UUID, Primary Key
- `name`: string
- `startingDate`: Date
- `endingDate`: Date
- `price`: float
- `travelId`: UUID, Foreign Key di Travels
### Seeders e Factories
Sono state create le factories per ogni modello, queste vengono utilizzate nel database seeder per riempire il database di dati mock. 
*** 
### Frontend
Il frontend è basato su Blade con viste suddivise in cartelle per dominio, utilizzando componenti dalla cartella `components`. Le viste hanno degli elementi che sono visibili usando le direttive `@can` che permette di mostrare qualcosa in base a un controllo sui middlewares
