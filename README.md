efgoptin
========

Double Opt-In for Contao EFG Store-FormData

Installation
---------------------

1. Installieren Sie Contao efg dev-develop

2. Die Zip-Datei vom contao3-compat Branch von Github herunterladen (https://github.com/cboelter/efgoptin/archive/contao3-compat.zip)

3. Den Inhalts des Zip-Archivs nach TL_ROOT/system/modules/efgoptin kopieren

4. Datenbankupdate im Backend von Contao ausführen

Konfiguration
---------------------

1. Neues Formular erstellen

2. Die Basisfelder: token, optin-response und optin-timestamp anlegen (Verstecktes feld)

2. Die Option "(EFG) Formular-Daten speichern" auswählen

3. Die Option "Double Opt-In" auswählen

4. Die Felder entsprechend ausfüllen

5. Im Benachrichtigungscenter, neue Benachrichtigungen vom Typ: EFG-OptIn > OptIn Benachrichtigung, EFG-OptIn > OptIn Bestätigung erfolgreich

6. Die Felder "Erfolgsmeldung Opt-In" und "Weiterleitung Erfolgsseite" sind als entweder oder zu verstehen.
Wenn "Erfolgsmeldung Opt-In" ausgewählt wird, wird die Meldung auf der selben Seite angezeigt,
wenn "Weiterleitung Erfolgsseite" ausgewählt wird, wird der User auf eine separate Seite weitergeleitet.

7. Die Felder "Fehlermeldung Opt-In" und "Weiterleitung Fehlerseite" sind als entweder oder zu verstehen.
Wenn "Fehlermeldung Opt-In" ausgewählt wird, wird die Meldung auf der selben Seite angezeigt,
wenn "Weiterleitung Fehlerseite" ausgewählt wird, wird der User auf eine separate Seite weitergeleitet.

8. Frontend-Modul "EFG Double Opt-In Reader" auf der selben Seite wie das Formular einbinden.

Hinweise
---------------------
1. Wenn ein HTML-Template verwendet werden soll, muss dieses im templates-Ordner von Contao abgelegt werden.