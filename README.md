# pilulka-twitter
Jedná se o jednoduchý agregátor zpráv z Twitteru, který načte zprávy z Twitter API dle zadaných tagů a zobrazí je v HTML, případně je možné přistoupit přes API a zprávy načíst ve formátu JSON.

# Požadavky
* PHP >= 7.2
* Nette = 3.1
* TwitterOAuth = 2.0 (https://github.com/abraham/twitteroauth)

# Instalace
Aplikaci je třeba nainstalovat na libovolný web server (Apache, Nginx, ...) s PHP 7.2 a následujícími moduly (mbstring, openssl, curl). URL projektu by mělo směrovat do `www` složky projektu.

# Nastavení
Veškeré nastavení je v souboru `config/common.neon`, případně je možné nahrát vlastní `config/local.neon` a paramety vložit tam

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
