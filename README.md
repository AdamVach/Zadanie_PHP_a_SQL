# Evidencia a databáza kníh
## Prihlásenie
(Pri otvorení index.php sa vytvorí databáza a vložia sa do nej údaje, ale to len v prípade, že databáza neexistuje alebo nemá žiadne záznamy)
- Používateľ sa môže prihlásiť menom a heslom, ak tak urobí bude presmerovaný na stránku s registráciou a výberom kníh (Zadanie_PHP_a_SQL.php)
- Ak používateľ nemá účet môže sa menom, emailom a heslom registrovať
## Registrácia
- Ak používateľ klikne na odkaz registrovať sa, je presmerovaný na stránku s registráciou (register.php)
- Používateľ zadá meno, email a heslo
- Po registrácií je používateľ automaticky presmerovaný na stránku s registráciou a výberom kníh (Zadanie_PHP_a_SQL.php) 
## Hlavná stránka
- Po prihlásení sa zobrzí formulár na vybratie knihy alebo jej registráciu (pozri nižšie)
- V pravom hornóm rohu si môže používateľ zmeniť heslo, vymazať účet alebo sa odhlásiť
### Zmena hesla
- Po kliknutí na "Zmena hesla" je používateľ presmerovaný na stránku so zemnou hesla (zmena_hesla.php)
- Používateľ músí zadať aktuálne heslo, a nové heslo dvakrát (používateľské meno je uložené v SESSION na serveri)
- Po zmene hesla je používateľ presmerovaný späť na stránku s registráciou a výberom kníh (Zadanie_PHP_a_SQL.php)
### Vymazanie účtu
- Po kliknutí na "Vymazať účet" je používateľ presmerovaný na stránku vymazania účtu (account_delete.php)
- Ak používateľ potvrdí vymazanie, účet sa vymaže a používateľ je presmerovaný na login stránku (index.php)
- Ak používateľ nepotvrdí vymazanie je presmerovaný späť na stránku s registráciou a výberom kníh (Zadanie_PHP_a_SQL.php)
### Odhlásenie
- Po kliknutí na "Odhlásiť sa" je používateľ presmerovaný na stránku logout.php, ktorá vymaže session a automaticky používateľa presmeruje ďalej na stránku s prihlásením (index.php)
## Výber knihy
- Na hlavnej stránke je formulár na výber kníh
- V tomto formuláry je jeden input, do ktorého používateľ zadáva meno knihy alebo jej autora alebo jej rok vydania
- Ak je vložený údaj správny zobrazý sa zoznam kníh s takýmto názvom alebo autorom alebo rokom vydania
## Registrácia kníh
- Ak používateľ knihu nenájde môže ju registrovať
- Pre registráciu sú tri samostatné inputy, do ktorých používateľ vkladá "Názov knihy", "Autora knihy" a "Rok vydania knihy"
> [!WARNING]
> Vložené údaje sa nekontrolujú
- Po vložení sa vypíše oznámenie o tom, že kniha bola registrovaná, ak registrácia neprebehne úspešne vypíše sa oznámenie o tom, že sa tak stalo