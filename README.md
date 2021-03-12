# pilulka-twitter
Jedná se o jednoduchý agregátor zpráv z Twitteru, který načte zprávy z Twitter API dle zadaných tagů a zobrazí je v HTML, případně je možné přistoupit přes API a zprávy načíst ve formátu JSON.

# Požadavky
* PHP >= 7.2
* Nette = 3.1
* TwitterOAuth = 2.0 (https://github.com/abraham/twitteroauth)

# Instalace
1. Aplikaci je třeba nainstalovat na libovolný web server (Apache, Nginx, ...) s PHP 7.2 a následujícími moduly (mbstring, openssl, curl).
2. URL web serveru by mělo směrovat do `www` složky projektu.
3. Po stažení projektu je třeba zavolat `composer update` pro stažení dodatečných knihoven.
4. Je třeba nahrát vlastní `config/local.neon` s následující strukturou a doplnit klíče a tokeny pro Twitter API

```
parameters:
	twitterSettings:
		consumerKey: ''
		consumerSecret: ''
		oauthAccessToken: ''
		oauthAccessTokenSecret: ''
```

# Nastavení
Veškeré nastavení je v souboru `config/common.neon` a `config/local.neon`.

Pro napojení na Twitter API je třeba doplnit klíče a tokeny:
* `consumerKey`
* `consumerSecret`
* `oauthAccessToken`
* `oauthAccessTokenSecret`

Pro nastavení parametrů vyhledávání se používají tyto hodnoty:
* `orQueryParams` - pole s jednotlivými parametry dle https://developer.twitter.com/en/docs/twitter-api/v1/rules-and-filtering/search-operators
* `count` - počet výsledků vyhledávání - Twitter Standard API zobrazí jen příspěvky ne starší než 7 dní

Pro nastavení HTML výstupu je možné nastavit:
* `showRetweeted` - zda se budou zobrazovat i retweeted zprávy

# Použití
Zprávy z Twitteru se zobrazí na úvodní stránce projektu.
API výstup v JSON je přístupný na `/api/posts`
