# facebooklogin - Facebook Login Plugin für TYPO3

Login mit Facebook, schnelle Einrichtung, einfacher gehts kaum :)

* **CMS**: TYPO3
* **Type**: plugin

# Working on 1.1

n/a

# Changelog

* **12.11.2018** - [1.0.0]  First release

# Installation

* Hier eine Facebook App anlegen: https://developers.facebook.com/apps
* "facebooklogin" Extension installieren
* TypoScript Integration nicht notwendig, alle Einstellungen werden im Plugin selbst vorgenommen
* Eine versteckte Seite "Facebook Login" (oder ähnlich) anlegen
* Plugin einfügen
* Einstellungen vornehmen
* Button einbauen und auf Facebook Login Seite verlinken (siehe unten)

# Auf Anmeldeseite Button einbauen

Hier ein Beispiel

```
<a href="/anmelden/facebook" class="btn btn-primary btn-lg"><i class="fab fa-facebook-square"></i> Jetzt direkt mit Facebook einloggen</a>
```

oder mit Fluid:

```
<f:link pageUid="122" class="btn btn-primary btn-lg"><i class="fab fa-facebook-square"></i> Jetzt direkt mit Facebook einloggen</f:link>
```

# Demo

Hier: https://filmmusic.io/anmelden/