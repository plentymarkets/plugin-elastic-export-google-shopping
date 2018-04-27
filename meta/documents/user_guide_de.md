
# User Guide für das Elastic Export Google Shopping Plugin

<div class="container-toc"></div>

## 1 Bei Google Shopping registrieren

Das Preisvergleichsportal Google Shopping bietet Such- und Vergleichsfunktionen sowie Links zu den Produktseiten anderer Online-Shops. 

Betreiber von Online-Shops können ihre Produkte durch Abrechnung auf Klickbasis auf GoogleShopping-Listen in der Google-Suche anzeigen lassen. Dieses Format basiert auf Google Shopping International. Dementsprechend müssen verknüpfte Merkmalwerte und Verfügbarkeiten im elastischen Export auf Englisch gepflegt sein.

Um das Plugin für Google Shopping einzurichten, registrieren Sie sich zunächst als Händler.

## 2 Das Format GoogleShopping-Plugin in plentymarkets einrichten

Mit der Installation dieses Plugins erhalten Sie das Exportformat **GoogleShopping-Plugin**, mit dem Sie Daten über den elastischen Export zu Google Shopping übertragen. Um dieses Format für den elastischen Export nutzen zu können, installieren Sie zunächst das Plugin **Elastic Export** aus dem plentyMarketplace, wenn noch nicht geschehen. 

Sobald beide Plugins in Ihrem System installiert sind, kann das Exportformat **GoogleShopping-Plugin** erstellt werden. Mehr Informationen finden Sie auch auf der Handbuchseite [Daten exportieren](https://knowledge.plentymarkets.com/basics/datenaustausch/daten-exportieren#60).

Neues Exportformat erstellen:

1. Öffnen Sie das Menü **Daten » Elastischer Export**.
2. Klicken Sie auf **Neuer Export**.
3. Nehmen Sie die Einstellungen vor. Beachten Sie dazu die Erläuterungen in Tabelle 1.
4. **Speichern** Sie die Einstellungen.
→ Eine ID für das Exportformat **GoogleShopping-Plugin** wird vergeben und das Exportformat erscheint in der Übersicht **Exporte**.

In der folgenden Tabelle finden Sie Hinweise zu den einzelnen Formateinstellungen und empfohlenen Artikelfiltern für das Format **GoogleShopping-Plugin**.

| **Einstellung**                                     | **Erläuterung** | 
| :---                                                | :--- |
| **Einstellungen**                                   |
| **Name**                                            | Name eingeben. Unter diesem Namen erscheint das Exportformat in der Übersicht im Tab **Exporte**. |
| **Typ**                                             | Typ **Artikel** aus der Dropdown-Liste wählen. |
| **Format**                                          | **GoogleShopping-Plugin** wählen. |
| **Limit**                                           | Zahl eingeben. Wenn mehr als 9999 Datensätze an die Preissuchmaschine übertragen werden sollen, wird die Ausgabedatei wird für 24 Stunden nicht noch einmal neu generiert, um Ressourcen zu sparen. Wenn mehr mehr als 9999 Datensätze benötigt werden, muss die Option **Cache-Datei generieren** aktiv sein. |
| **Cache-Datei generieren**                          | Häkchen setzen, wenn mehr als 9999 Datensätze an die Preissuchmaschine übertragen werden sollen. Um eine optimale Performance des elastischen Exports zu gewährleisten, darf diese Option bei maximal 20 Exportformaten aktiv sein. |
| **Bereitstellung**                                  | **URL** wählen. Mit dieser Option kann ein Token für die Authentifizierung generiert werden, damit ein externer Zugriff möglich ist. |
| **Token, URL**                                      | Wenn unter **Bereitstellung** die Option **URL** gewählt wurde, auf **Token generieren** klicken. Der Token wird dann automatisch eingetragen. Die URL wird automatisch eingetragen, wenn unter **Token** der Token generiert wurde. |
| **Dateiname**                                       | Der Dateiname muss auf **.csv** oder **.txt** enden, damit Google Shopping die Datei erfolgreich importieren kann. |
| **Artikelfilter**                                   |
| **Artikelfilter hinzufügen**                        | Artikelfilter aus der Dropdown-Liste wählen und auf **Hinzufügen** klicken. Standardmäßig sind keine Filter voreingestellt. Es ist möglich, alle Artikelfilter aus der Dropdown-Liste nacheinander hinzuzufügen.<br/> **Varianten** = **Alle übertragen** oder **Nur Hauptvarianten übertragen** wählen.<br/> **Märkte** = Einen, mehrere oder **ALLE** Märkte wählen. Die Verfügbarkeit muss für alle hier gewählten Märkte am Artikel hinterlegt sein. Andernfalls findet kein Export statt.<br/> **Währung** = Währung wählen.<br/> **Kategorie** = Aktivieren, damit der Artikel mit Kategorieverknüpfung übertragen wird. Es werden nur Artikel, die dieser Kategorie zugehören, übertragen.<br/> **Bild** = Aktivieren, damit der Artikel mit Bild übertragen wird. Es werden nur Artikel mit Bildern übertragen.<br/> **Mandant** = Mandant wählen.<br/> **Bestand** = Wählen, welche Bestände exportiert werden sollen.<br/> **Markierung 1 - 2** = Markierung wählen.<br/> **Hersteller** = Einen, mehrere oder **ALLE** Hersteller wählen.<br/> **Aktiv** = Nur aktive Varianten werden übertragen. |
| **Formateinstellungen**                             |
| **Produkt-URL**                                     | Wählen, ob die URL des Artikels oder der Variante an das Preisportal übertragen wird. Varianten URLs können nur in Kombination mit dem Ceres Webshop übertragen werden. |
| **Mandant**                                         | Mandant wählen. Diese Einstellung wird für den URL-Aufbau verwendet. |
| **URL-Parameter**                                   | Suffix für die Produkt-URL eingeben, wenn dies für den Export erforderlich ist. Die Produkt-URL wird dann um die eingegebene Zeichenkette erweitert, wenn weiter oben die Option **übertragen** für die Produkt-URL aktiviert wurde. |
| **Auftragsherkunft**                                | Aus der Dropdown-Liste die Auftragsherkunft wählen, die beim Auftragsimport zugeordnet werden soll. |
| **Marktplatzkonto**                                 | Marktplatzkonto aus der Dropdown-Liste wählen. Die Produkt-URL wird um die gewählte Auftragsherkunft erweitert, damit die Verkäufe später analysiert werden können. |
| **Sprache**                                         | Sprache aus der Dropdown-Liste wählen. |
| **Artikelname**                                     | **Name 1**, **Name 2** oder **Name 3** wählen. Die Namen sind im Tab **Texte** eines Artikels gespeichert. Im Feld **Maximale Zeichenlänge (def. Text)** optional eine Zahl eingeben, wenn die Preissuchmaschine eine Begrenzung der Länge des Artikelnamen beim Export vorgibt. |
| **Vorschautext**                                    | Diese Option ist für dieses Format nicht relevant. |
| **Beschreibung**                                    | Wählen, welcher Text als Beschreibungstext übertragen werden soll.<br/> Im Feld **Maximale Zeichenlänge (def. Text)** optional eine Zahl eingeben, wenn die Preissuchmaschine eine Begrenzung der Länge der Beschreibung beim Export vorgibt.<br/> Option **HTML-Tags entfernen** aktivieren, damit die HTML-Tags beim Export entfernt werden.<br/> Im Feld **Erlaubte HTML-Tags, kommagetrennt (def. Text)** optional die HTML-Tags eingeben, die beim Export erlaubt sind. Wenn mehrere Tags eingegeben werden, mit Komma trennen. |
| **Zielland**                                        | Zielland aus der Dropdown-Liste wählen. |
| **Barcode**                                         | ASIN, ISBN oder eine EAN aus der Dropdown-Liste wählen. Der gewählte Barcode muss mit der oben gewählten Auftragsherkunft verknüpft sein. Andernfalls wird der Barcode nicht exportiert. |
| **Bild**                                            | **Position 0** oder **Erstes Bild** wählen, um dieses Bild zu exportieren.<br/> **Position 0** = Ein Bild mit der Position 0 wird übertragen.<br/> **Erstes Bild** = Das erste Bild wird übertragen. |
| **Bildposition des Energieetiketts**                | Position des Energieetikettes eintragen. Alle Bilder die als Energieetikette übertragen werden sollen, müssen diese Position haben. |
| **Bestandspuffer**                                  | Diese Option ist für dieses Format nicht relevant. |
| **Bestand für Varianten ohne Bestandsbeschränkung** | Diese Option ist für dieses Format nicht relevant. |
| **Bestand für Varianten ohne Bestandsführung**      | Diese Option ist für dieses Format nicht relevant. |
| **Währung live umrechnen**                          | Aktivieren, damit der Preis je nach eingestelltem Lieferland in die Währung des Lieferlandes umgerechnet wird. Der Preis muss für die entsprechende Währung freigegeben sein. |
| **Verkaufspreis**                                   | Brutto- oder Nettopreis aus der Dropdown-Liste wählen. |
| **Angebotspreis**                                   | Aktivieren, um den Angebotspreis zu übertragen. |
| **UVP**                                             | Diese Option ist für dieses Format nicht relevant. |
| **Versandkosten**                                   | Aktivieren, damit die Versandkosten aus der Konfiguration übernommen werden. Wenn die Option aktiviert ist, stehen in den beiden Dropdown-Listen Optionen für die Konfiguration und die Zahlungsart zur Verfügung. Option **Pauschale Versandkosten übertragen** aktivieren, damit die pauschalen Versandkosten übertragen werden. Wenn diese Option aktiviert ist, muss im Feld darunter ein Betrag eingegeben werden. |
| **MwSt.-Hinweis**                                   | Diese Option ist für dieses Format nicht relevant. |
| **Artikelverfügbarkeit**                            | Option **überschreiben** aktivieren und in die Felder **1** bis **10**, die die ID der Verfügbarkeit darstellen, Artikelverfügbarkeiten eintragen. Somit werden die Artikelverfügbarkeiten, die im Menü **System » Artikel » Verfügbarkeit** eingestellt wurden, überschrieben. |
       
_Tab. 1: Einstellungen für das Datenformat **GoogleShopping-Plugin**_

## 3 Verfügbare Spalten der Exportdatei

| **Spaltenbezeichnung**        | **Erläuterung** |
| :---                          | :--- |
| **id**                        | Die **SKU** der Variante für Google Shopping. |
| **title**                     | Entsprechend der Formateinstellung **Artikelname**. |
| **description**               | Entsprechend der Formateinstellung **Beschreibung**. |
| **google_product_category**   | Entsprechend der Einstellung **Einstellungen » Märkte » Google » Google Shopping Int.**. Die Google Shopping Kategorie der Standardkategorie. |
| **product_type**              | Der Name der Standardkategorie, die mit der Variante verknüpft ist. |
| **link**                      | Der **URL-Pfad** des Artikels abhängig vom gewählten Mandanten in den Formateinstellungen. |
| **image_link**                | URL des Bildes. Variantenbilder werden vor Artikelbildern priorisiert. |
| **additional_image_link**     | Zusätzliche kommagetrennte URLs für bis zu 10 zusätzliche Bilder. Variantenbilder werden vor Artikelbildern priorisiert. |
| **condition**                 | Der Zustand des Artikels anhand **Artikel » Artikel bearbeiten » Global » Grundeinstellungen » Zustand API**. |
| **availability**              | Der Name der **Artikelverfügbarkeit** unter **Einstellungen » Artikel » Artikelverfügbarkeit** oder die Übersetzung gemäß der Formateinstellung **Artikelverfügbarkeit überschreiben**. |
| **price**                     | Der **Verkaufspreis**. |
| **sale_price**                | Der **Angebotspreis** abhängig der Formateinstellung **Angebotspreis**. |
| **brand**                     | Der **Name des Herstellers** des Artikels. Der **Externe Name** unter **Einstellungen » Artikel » Hersteller** wird bevorzugt, wenn vorhanden. |
| **gtin**                      | Entsprechend der Formateinstellung **Barcode**. |
| **isbn**                      | Die **ISBN** für die Variante. |
| **mpn**                       | Das **Modell** der Variante. |
| **color**                     | Die **Farbe** der Variante anhand des Attributs oder eines Merkmals. Merkmale werden bevorzugt behandelt. |
| **size**                      | Die **Größe** für die Variante anhand des Attributs oder eines Merkmals. Merkmale werden bevorzugt behandelt. |
| **material**                  | Das **Material** der Variante anhand des Attributs oder eines Merkmals. Merkmale werden bevorzugt behandelt. |
| **pattern**                   | Das **Muster** der Variante anhand des Attributs oder eines Merkmals. Merkmale werden bevorzugt behandelt. |
| **item_group_id**             | Die **Artikel-ID** der Variante. |
| **shipping**                  | Entsprechend der Formateinstellung **Versandkosten**. |
| **shipping_weight**           | Das Versandgewicht der Variante. |
| **gender**                    | Das Geschlecht in Bezug auf das Google-Merkmal **Geschlecht**. |
| **age_group**                 | Die Altersgruppe in Bezug auf das Google-Merkmal **Altersgruppe**. |
| **excluded_destination**      | Leer. |
| **adwords_redirect**          | Adwords Redirect in Bezug auf das Google-Merkmal **Adwords Redirect**. |
| **identifier_exists**         | Die Kombination der Attribute **brand** + **GTIN** oder **brand** + **mpn** muss vorhanden sein, damit der Wert auf **true** gesetzt wird. Andernfalls wird der Wert auf **false** gesetzt. |
| **unit_pricing_measure**      | Die **Einheit** der Variante. |
| **unit_pricing_base_measure** | Die **Grundeinheit** der Variante in Bezug **unit_pricing_measure**. |
| **energy_efficiency_class**   | Die Energieeffizienzklasse in Bezug auf das Google-Merkmal **Energieeffizienzklasse**. |
| **size_system**               | Das Größensystem in Bezug auf das Google-Merkmal **Größensystem**. |
| **size_type**                 | Der Größentyp in Bezug auf das Google-Merkmal **Größentyp**. |
| **mobile_link**               | Mobiler Link in Bezug auf das Google-Merkmal **Mobiler Link**. |
| **sale_price_effective_date** | Der Sonderangebotszeitraum in Bezug auf das Google-Merkmal **Sonderangebotszeitraum**. |
| **adult**                     | Leer. |
| **custom_label_0**            | Das benutzerdefinierte Label 0 in Bezug auf das Google-Merkmal **Benutzerdefiniertes Label 0**. |
| **custom_label_1**            | Das benutzerdefinierte Label 1 in Bezug auf das Google-Merkmal **Benutzerdefiniertes Label 1**. |
| **custom_label_2**            | Das benutzerdefinierte Label 2 in Bezug auf das Google-Merkmal **Benutzerdefiniertes Label 2**. |
| **custom_label_3**            | Das benutzerdefinierte Label 3 in Bezug auf das Google-Merkmal **Benutzerdefiniertes Label 3**. |
| **custom_label_4**            | Das benutzerdefinierte Label 4 in Bezug auf das Google-Merkmal **Benutzerdefiniertes Label 4**. |
| **availability_date**         | Das **Erscheinungsdatum** der Variante. |

## 4 Lizenz

Das gesamte Projekt unterliegt der GNU AFFERO GENERAL PUBLIC LICENSE – weitere Informationen finden Sie in der [LICENSE.md](https://github.com/plentymarkets/plugin-elastic-export-google-shopping/blob/master/LICENSE.md).
