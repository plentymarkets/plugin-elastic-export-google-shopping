
# User Guide für das Elastic Export Google Shopping Plugin

<div class="container-toc"></div>

## 1 Bei Google Shopping registrieren

Das Preisvergleichsportal Google Shopping bietet Such- und Vergleichsfunktionen sowie Links zu den Produktseiten anderer Online-Shops. Betreiber von Online-Shops können ihre Produkte durch Abrechnung auf Klickbasis auf GoogleShopping-Listen in der Google-Suche anzeigen lassen. Dieses Format basiert auf Google Shopping International. Dementsprechend müssen verknüpfte Merkmalwerte und Verfügbarkeiten im elastischen Export auf englisch gepflegt sein.
Um das Plugin für Google Shopping einzurichten, registrieren Sie sich zunächst als Händler.

## 2 Elastic Export GoogleShopping-Plugin in plentymarkets einrichten

Um dieses Format nutzen zu können, benötigen Sie das Plugin Elastic Export.

Auf der Handbuchseite [Daten exportieren](https://knowledge.plentymarkets.com/basics/datenaustausch/daten-exportieren#30) werden die einzelnen Formateinstellungen beschrieben.

In der folgenden Tabelle finden Sie Hinweise zu den Einstellungen, Formateinstellungen und empfohlenen Artikelfiltern für das Format **GoogleShopping-Plugin**.
<table>
    <tr>
        <th>
            Einstellung
        </th>
        <th>
            Erläuterung
        </th>
    </tr>
    <tr>
        <td class="th" colspan="2">
            Einstellungen
        </td>
    </tr>
    <tr>
        <td>
            Format
        </td>
        <td>
            <b>GoogleShopping-Plugin</b> wählen.
        </td>        
    </tr>
    <tr>
        <td>
            Bereitstellung
        </td>
        <td>
            <b>URL</b> wählen.
        </td>        
    </tr>
    <tr>
        <td>
            Dateiname
        </td>
        <td>
            Der Dateiname muss auf <b>.csv</b> oder <b>.txt</b> enden, damit Google Shopping die Datei erfolgreich importieren kann.
        </td>        
    </tr>
    <tr>
        <td class="th" colspan="2">
            Artikelfilter
        </td>
    </tr>
    <tr>
        <td>
            Aktiv
        </td>
        <td>
            <b>Aktiv</b> wählen.
        </td>        
    </tr>
    <tr>
        <td>
            Märkte
        </td>
        <td>
            Eine oder mehrere Auftragsherkünfte wählen. Die gewählten Auftragsherkünfte müssen an der Variante aktiviert sein, damit der Artikel exportiert wird.
        </td>        
    </tr>
    <tr>
        <td class="th" colspan="2">
            Formateinstellungen
        </td>
    </tr>
    <tr>
        <td>
            Auftragsherkunft
        </td>
        <td>
            Die Auftragsherkunft wählen, die beim Auftragsimport zugeordnet werden soll.
        </td>        
    </tr>
    <tr>
		<td>
			Vorschautext
		</td>
		<td>
			Diese Option ist für dieses Format nicht relevant.
		</td>        
	</tr>
    <tr>
        <td>
            UVP
        </td>
        <td>
            Diese Option ist für dieses Format nicht relevant.
        </td>        
    </tr>
    <tr>
        <td>
            MwSt.-Hinweis
        </td>
        <td>
            Diese Option ist für dieses Format nicht relevant.
        </td>        
    </tr>
</table>


## 3 Übersicht der verfügbaren Spalten

<table>
    <tr>
        <th>
            Spaltenbezeichnung
        </th>
        <th>
            Erläuterung
        </th>
    </tr>
    <tr>
		<td>
			id
		</td>
		<td>
			<b>Inhalt:</b> Die <b>SKU</b> für Google Shopping der Variante.
		</td>        
	</tr>
	<tr>
		<td>
			title
		</td>
		<td>
			<b>Inhalt:</b> Entsprechend der Formateinstellung <b>Artikelname</b>.
		</td>        
	</tr>
	<tr>
		<td>
			description
		</td>
		<td>
			<b>Inhalt:</b> Entsprechend der Formateinstellung <b>Beschreibung</b>.
		</td>        
	</tr>
	<tr>
		<td>
			google_product_category
		</td>
		<td>
			<b>Inhalt:</b> Entsprechend der Einstellung <b>Einstellungen » Märkte » Google » Google Shopping Int.</b> die Google Shopping Kategorie der Standardkategorie.
		</td>        
	</tr>
	<tr>
		<td>
			product_type
		</td>
		<td>
			<b>Inhalt:</b> Name der Standardkategorie, die mit der Variante verknüpft ist.
		</td>        
	</tr>
	<tr>
		<td>
			link
		</td>
		<td>
			<b>Inhalt:</b> Der <b>URL-Pfad</b> des Artikels abhängig vom gewählten <b>Mandanten</b> in den Formateinstellungen.
		</td>        
	</tr>
	<tr>
		<td>
			image_link
		</td>
		<td>
			<b>Inhalt:</b> URL des Bildes. Variantenbiler werden vor Artikelbildern priorisiert.
		</td>        
	</tr>
	<tr>
		<td>
			condition
		</td>
		<td>
			<b>Inhalt:</b> Der Zustand des Artikels. Anhand <b>Artikel » Artikel bearbeiten » Global » Grundeinstellungen » Zustand API</b>
		</td>        
	</tr>
	<tr>
		<td>
			availability
		</td>
		<td>
			<b>Inhalt:</b> Der <b>Name der Artikelverfügbarkeit</b> unter <b>Einstellungen » Artikel » Artikelverfügbarkeit</b> oder die Übersetzung gemäß der Formateinstellung <b>Artikelverfügbarkeit überschreiben</b>.
		</td>        
	</tr>
	<tr>
		<td>
			price
		</td>
		<td>
			<b>Inhalt:</b> Der <b>Verkaufspreis</b>.
		</td>        
	</tr>
	<tr>
		<td>
			sale_price
		</td>
		<td>
			<b>Inhalt:</b> Der <b>Angebotspreis</b> abhängig der Formatseinstellung **Angebotspreis**.
		</td>        
	</tr>
	<tr>
		<td>
			brand
		</td>
		<td>
			<b>Inhalt:</b> Der <b>Name des Herstellers</b> des Artikels. Der <b>Externe Name</b> unter <b>Einstellungen » Artikel » Hersteller</b> wird bevorzugt, wenn vorhanden.
		</td>        
	</tr>
	<tr>
		<td>
			gtin
		</td>
		<td>
			<b>Inhalt:</b> Entsprechend der Formateinstellung <b>Barcode</b>.
		</td>        
	</tr>
	<tr>
		<td>
			isbn
		</td>
		<td>
			<b>Inhalt:</b> Die <b>ISBN</b> für die Vartiante.
		</td>        
	</tr>
	<tr>
		<td>
			mpn
		</td>
		<td>
			<b>Inhalt:</b> Das <b>Model</b> der Vartiante.
		</td>        
	</tr>
	<tr>
		<td>
			color
		</td>
		<td>
			<b>Inhalt:</b> Die <b>Farbe</b> für die Vartiante anhand des Attibuts oder eines Merkmals. Merkmale werden bevorzugt behandelt.
		</td>        
	</tr>
	<tr>
		<td>
			size
		</td>
		<td>
			<b>Inhalt:</b> Die <b>Größe</b> für die Vartiante anhand des Attibuts oder eines Merkmals. Merkmale werden bevorzugt behandelt.
		</td>        
	</tr>
	<tr>
		<td>
			material
		</td>
		<td>
			<b>Inhalt:</b> Das <b>Material</b> für die Vartiante anhand des Attibuts oder eines Merkmals. Merkmale werden bevorzugt behandelt.
		</td>        
	</tr>
	<tr>
		<td>
			pattern
		</td>
		<td>
			<b>Inhalt:</b> Das <b>Muster</b> für die Vartiante anhand des Attibuts oder eines Merkmals. Merkmale werden bevorzugt behandelt.
		</td>        
	</tr>
	<tr>
		<td>
			item_group_id
		</td>
		<td>
			<b>Inhalt:</b> Die <b>Artikel-ID</b> der Variante.
		</td>        
	</tr>
	<tr>
		<td>
			shipping
		</td>
		<td>
			<b>Inhalt:</b> Entsprechend der Formateinstellung <b>Versandkosten</b>.
		</td>        
	</tr>
	<tr>
		<td>
			shipping_weight
		</td>
		<td>
			<b>Inhalt:</b> Das Versandgewicht der Variante.
		</td>        
	</tr>
	<tr>
		<td>
			gender
		</td>
		<td>
			<b>Inhalt:</b> Das Geschlecht in Bezug auf das Google-Merkmal **Geschlecht**.
		</td>        
	</tr>
	<tr>
		<td>
			age_group
		</td>
		<td>
			<b>Inhalt:</b> Die Altersgruppe in Bezug auf das Google-Merkmal **Altersgruppe**.
		</td>        
	</tr>
	<tr>
		<td>
			excluded_destination
		</td>
		<td>
			<b>Inhalt:</b> Leer.
		</td>        
	</tr>
	<tr>
		<td>
			adwords_redirect
		</td>
		<td>
			<b>Inhalt:</b> AdWords Redirect in Bezug auf das Google-Merkmal **AdWords Redirect**.
		</td>        
	</tr>
	<tr>
		<td>
			unit_pricing_measure
		</td>
		<td>
			<b>Inhalt:</b> Die <b>Einheit</b> der Variante.
		</td>        
	</tr>
	<tr>
		<td>
			unit_pricing_base_measure
		</td>
		<td>
			<b>Inhalt:</b> Die <b>Grundeinheit</b> der Variante in Bezug auf **unit_pricing_measure**.
		</td>        
	</tr>
	<tr>
		<td>
			energy_efficiency_class
		</td>
		<td>
			<b>Inhalt:</b> Die Energieefizienzklasse in Bezug auf das Google-Merkmal **Energieefizienzklasse**.
		</td>        
	</tr>
	<tr>
		<td>
			size_system
		</td>
		<td>
			<b>Inhalt:</b> Das Größensystem in Bezug auf das Google-Merkmal **Größensystem**.
		</td>        
	</tr>
	<tr>
		<td>
			size_type
		</td>
		<td>
			<b>Inhalt:</b> Das Größensystem in Bezug auf das Google-Merkmal **Größensystem**.
		</td>        
	</tr>
	<tr>
		<td>
			mobile_link
		</td>
		<td>
			<b>Inhalt:</b> Mobiler Link in Bezug auf das Google-Merkmal **Mobiler-Link**.
		</td>        
	</tr>
	<tr>
		<td>
			sale_price_effective_date
		</td>
		<td>
			<b>Inhalt:</b> Der Sonderangebotszeitraum in Bezug auf das Google-Merkmal **Sonderangebotszeitraum**.
		</td>        
	</tr>
	<tr>
		<td>
			adult
		</td>
		<td>
			<b>Inhalt:</b> Leer.
		</td>        
	</tr>
	<tr>
		<td>
			custom_label_0
		</td>
		<td>
			<b>Inhalt:</b> Das Benutzerdefinierte Label 0 in Bezug auf das Google-Merkmal **Benutzerdefiniertes Label 0**.
		</td>        
	</tr>
	<tr>
		<td>
			custom_label_1
		</td>
		<td>
			<b>Inhalt:</b> Das Benutzerdefinierte Label 1 in Bezug auf das Google-Merkmal **Benutzerdefiniertes Label 1**.
		</td>        
	</tr>
	<tr>
		<td>
			custom_label_2
		</td>
		<td>
			<b>Inhalt:</b> Das Benutzerdefinierte Label 2 in Bezug auf das Google-Merkmal **Benutzerdefiniertes Label 2**.
		</td>        
	</tr>
	<tr>
		<td>
			custom_label_3
		</td>
		<td>
			<b>Inhalt:</b> Das Benutzerdefinierte Label 3 in Bezug auf das Google-Merkmal **Benutzerdefiniertes Label 3**.
		</td>        
	</tr>
	<tr>
		<td>
			custom_label_4
		</td>
		<td>
			<b>Inhalt:</b> Das Benutzerdefinierte Label 4 in Bezug auf das Google-Merkmal **Benutzerdefiniertes Label 4**.
		</td>        
	</tr>
	<tr>
		<td>
			availability_​date
		</td>
		<td>
			<b>Inhalt:</b> Das Erscheinungsdatum der Variante.
		</td>        
	</tr>
</table>

## 4 Lizenz

Das gesamte Projekt unterliegt der GNU AFFERO GENERAL PUBLIC LICENSE – weitere Informationen finden Sie in der [LICENSE.md](https://github.com/plentymarkets/plugin-elastic-export-google-shopping/blob/master/LICENSE.md).
