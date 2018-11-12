# facebooklogin - Facebook Login Plugin für TYPO3

Login mit Facebook, schnelle Einrichtung, einfacher gehts kaum :)

* **TER**: https://extensions.typo3.org/extension/facebooklogin/
* **CMS**: TYPO3 8
* **Type**: plugin

# Changelog

* **12.11.2018** - [1.0.0]  First release

# Funktionsweise

Nutzer werden eingeloggt, insofern es eine E-Mail Adresse gibt die mit dem Facebook Account übereinstimmt.
Existiert der Nutzer nicht, wird automatisch ein FrontendUser Account mit definierbaren Rollen und einem Zufallspasswort angelegt.

# Installation

* Hier eine Facebook App anlegen: https://developers.facebook.com/apps
* Auf Facebook die App einrichten, Du benötigst in jedem Fall die "ClientID" und "ClientSecret"
* "facebooklogin" Extension installieren
* TypoScript Integration nicht notwendig, alle Einstellungen werden im Plugin selbst vorgenommen
* Eine versteckte Seite "Facebook Login" (oder ähnlich) anlegen
* Plugin einfügen
* Einstellungen vornehmen (es muss ALLES korrekt ausgefüllt werden)
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