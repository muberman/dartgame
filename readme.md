# Dart Game
This project is a dart game simulator. 

## Installation
This project requires PHP 7 and utilizes Composer's Autoloader. Before you start the simulation, run
 ```
 composer dump-autoload
 ```
 in the project's root folder.

## Game Rules
Game rules are based on this: https://gist.github.com/llubosz/8d129ec28fe01c4d30e598e963b09fd6
```
Zasady: w grze bierze udział zawsze dwóch graczy, każdy gracz startuje z liczbą punktów równą 501. 
Każdy gracz może oddać trzy rzuty do tarczy, przy czym jeżeli trafi w sektor podwójny, 
punkty naliczają się podwójnie i analogicznie w przypadku trafienia w pole potrójne, 
punkty zostaną przyznane potrójnie, zatem maksymalna ilość punktów jaką gracz może uzyskać 
w jednej turze to 180 (3x3x20). 
Grę można zakończyć jedynie trafiając w pole podwójne lub bullseye o wartości równej pozostałej 
ilości punktów na liczniku. W momencie kiedy gracz przekroczy pozostałą ilość punktów 
(trafi wyższą wartość niż pozostała na liczniku) licznik wraca do wartości z początku tury.
```

The game can handle more than 2 players. To add more players, go to `index.php` and add them in the same way as the example users:
```
$game->addPlayer(new \Dart\Player("Daenerys Targaryen"));
```

## Running the simulation
To run the simulation, simply execute the `index.php` file in the **console**
```
php index.php
```