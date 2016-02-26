# Dancer Deck

Keep track of yo dance shaight.


## Seeding the database

SSH into VM and `cd` into Dancer Deck working dir:

    $ cd /var/www/DancerDeck.com/dancer-deck/

To delete all the database entries:

    $ php artisan neo4j:clear

To seed the database:

    $ php artisan neo4j:seed

