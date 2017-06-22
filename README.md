# TIC TAC TOE

 A Simple game written in PHP as a test for Docler Holding Hiring Process
 
## Instructions to execute

From the console, execute the following commands:

```
composer update
```

```
php -S 0.0.0.0:8000
```
 
If you want to execute the test cases, execute: 

```
./vendor/bin/phpunit 
```

Note: Folder resources/cache should have write permissions

## Existing Routes

```
(GET) /
``` 

Shows game interface

```
(GET) /reset
``` 
Used to reset game state on backend

```
(GET) /getGameState
``` 
Retrieves current game state, used to render UI

```
(GET) /getBotMove?mode=random
```
Calls backend to ask for a random bot move position (x,Y)


```
(GET) /getBotMove?mode=smart
```
Calls backend to ask for a smart bot move position (x,Y)

```
(POST) /makeMove 
```
Send a move to be stored

Parameter: x, y, type ('human' or 'bot')
