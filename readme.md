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

### Additional rules, or rules interpretation notes
The game can handle more than 2 players. To add more players, go to `index.php` and add them in the same way as the example users:
```
$game->addPlayer(new \Dart\Player("Daenerys Targaryen"));
```

There is an additional limit of turns (set to 500), in case random scores couldn't hit the necessary value. 

## Running the simulation
To run the simulation, simply execute the `index.php` file in the **console**
```
php index.php
```

## Example output
The game generates a table with each player's score after each turn:
```
Player: | John Snow | Tyrion Lannister
Start   |       501 |              501
Turn  1 |       478 |              477
Turn  2 |       391 |              385
Turn  3 |       338 |              317
Turn  4 |       287 |              250
Turn  5 |       209 |              210
Turn  6 |       169 |              180
Turn  7 |       141 |              127
Turn  8 |        84 |              101
Turn  9 |        24 |               46
Turn 10 |        24 |                8
Turn 11 |        24 |                8
Turn 12 |        17 |                8
Turn 13 |        17 |                8
Turn 14 |        17 |                8
Turn 15 |        17 |                8
Turn 16 |        17 |                8
Turn 17 |        17 |                8
Turn 18 |        17 |                8
Turn 19 |        17 |                8
Turn 20 |        17 |                8
Turn 21 |        17 |                8
Turn 22 |        17 |                8
Turn 23 |        12 |                8
Turn 24 |        12 |                8
Turn 25 |        12 |                8
Turn 26 |         0
Winner: John Snow
```