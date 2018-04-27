
# Google Shopping plugin user guide

<div class="container-toc"></div>

## 1 Registering with Google Shopping

The price comparison portal Google Shopping offers search and comparison functions as well as links to the product pages in other online stores.
 
Store owners can display their products in Google Shopping lists within the Google search. Stores are billed for the service per click.

Before you can transfer your export format, you have to register with Google Shopping first.

## 2 Setting up the data format GoogleShopping-Plugin in plentymarkets

By installing this plugin you will receive the export format **GoogleShopping-Plugin**. Use this format to exchange data between plentymarkets and Google Shopping. It is required to install the Plugin **Elastic Export** from the plentyMarketplace first before you can use the format **GoogleShopping-Plugin** in plentymarkets.

Once both plugins are installed, you can create the export format **GoogleShopping-Plugin**. Refer to the [Exporting data formats for price search engines](https://knowledge.plentymarkets.com/en/basics/data-exchange/exporting-data#30) page of the manual for further details about the individual format settings.

Creating a new export format:

1. Go to **Data » Elastic export**.
2. Click on **New export**.
3. Carry out the settings as desired. Pay attention to the information given in table 1.
4. **Save** the settings.
→ The export format will be given an ID and it will appear in the overview within the **Exports** tab.

The following table lists details for settings, format settings and recommended item filters for the format **GoogleShopping-Plugin**.

| **Setting**                                           | **Explanation** | 
| :---                                                  | :--- |
| **Settings**                                          |
| **Name**                                              | Enter a name. The export format will be listed under this name in the overview within the **Exports** tab. |
| **Type**                                              | Select the type **Item** from the drop-down list. |
| **Format**                                            | Select **GoogleShopping-Plugin**. |
| **Limit**                                             | Enter a number. If you want to transfer more than 9,999 data records to the price search engine, then the output file will not be generated again for another 24 hours. This is to save resources. If more than 9,999 data records are necessary, the setting **Generate cache file** has to be active. |
| **Generate cache file**                               | Place a check mark if you want to transfer more than 9,999 data records to the price search engine. The output file will not be generated again for another 24 hours. We recommend not to activate this setting for more than 20 export formats. This is to save resources. |
| **Provisioning**                                      | Select **URL**. This option generates a token for authentication in order to allow external access. |
| **Token, URL**                                        | If you have selected the option **URL** under **Provisioning**, then click on **Generate token**. The token will be entered automatically. When the token is generated under **Token**, the URL is entered automatically. |
| **File name**                                         | The file name must have the ending **.csv** or **.txt** for Google Shopping to be able to import the file successfully. |
| **Item filters**                                      |
| **Add item filters**                                  | Select an item filter from the drop-down list and click on **Add**. There are no filters set in default. It is possible to add multiple item filters from the drop-down list one after the other.<br/> **Variations** = Select **Transfer all** or **Only transfer main variations**.<br/> **Markets** = Select one market, several or **ALL**.<br/> The availability for all markets selected here has to be saved for the item. Otherwise, the export will not take place.<br/> **Currency** = Select a currency.<br/> **Category** = Activate to transfer the item with its category link. Only items belonging to this category will be exported.<br/> **Image** = Activate to transfer the item with its image. Only items with images will be transferred.<br/> **Client** = Select client.<br/> **Stock** = Select which stocks you want to export.<br/> **Flag 1 - 2** = Select the flag.<br/> **Manufacturer** = Select one, several or **ALL** manufacturers.<br/> **Active** = Only active variations will be exported. |
| **Format settings**                                   |
| **Product URL**                                       | Choose wich URL should be transferred to the price comparison portal, the item’s URL or the variation’s URL. Variation SKUs can only be transferred in combination with the Ceres store. |
| **Client**                                            | Select a client. This setting is used for the URL structure. |
| **URL parameter**                                     | Enter a suffix for the product URL if this is required for the export. If you have activated the transfer option for the product URL further up, then this character string will be added to the product URL. |
| **Order referrer**                                    | Choose the order referrer that should be assigned during the order import from the drop-down list. |
| **Marketplace account**                               | Select the marketplace account from the drop-down list. The selected referrer is added to the product URL so that sales can be analysed later. |
| **Language**                                          | Select the language from the drop-down list. |
| **Item name**                                         | Select **Name 1**, **Name 2** or **Name 3**. These names are saved in the **Texts** tab of the item. Enter a number into the **Maximum number of characters (def. Text)** field if desired. This specifies how many characters should be exported for the item name. |
| **Preview text**                                      | This option does not affect this format. |
| **Description**                                       | Select the text that you want to transfer as description.<br/> Enter a number into the **Maximum number of characters (def. text)** field if desired. This specifies how many characters should be exported for the description.<br/> Activate the option **Remove HTML tags** if you want HTML tags to be removed during the export. If you only want to allow specific HTML tags to be exported, then enter these tags into the field **Permitted HTML tags, separated by comma (def. Text)**. Use commas to separate multiple tags. |
| **Target country**                                    | Select the target country from the drop-down list. |
| **Barcode**                                           | Select the ASIN, ISBN or an EAN from the drop-down list. The barcode has to be linked to the order referrer selected above. If the barcode is not linked to the order referrer it will not be exported. |
| **Image**                                             | Select **Position 0** or **First image** to export this image.<br/> **Position 0** = An image with position 0 will be transferred.<br/> **First image** = The first image will be transferred. |
| **Image position of the energy efficiency label**     | Enter the position. Every image that should be transferred as an energy efficiency label must have this position. |
| **Stockbuffer**                                       | This option does not affect this format. |
| **Stock for variations without stock limitation**     | This option does not affect this format. |
| **Stock for variations with no stock administration** | This option does not affect this format. |
| **Live currency conversion**                          | Activate this option to convert the price into the currency of the selected country of delivery. The price has to be released for the corresponding currency. |
| **Retail price**                                      | Select gross price or net price from the drop-down list. |
| **Offer price**                                       | Activate to transfer the offer price. |
| **RRP**                                               | This option does not affect this format. |
| **Shipping costs**                                    | Activate this option if you want to use the shipping costs that are saved in a configuration. If this option is activated, then you will be able to select the configuration and the payment method from the drop-down lists.<br/> Activate the option **Transfer flat rate shipping charge** if you want to use a fixed shipping charge. If this option is activated, a value has to be entered in the line underneath. |
| **VAT Note**                                          | This option does not affect this format. |
| **Item availability**                                 | Activate the **overwrite** option and enter item availabilities into the fields **1** to **10**. The fields represent the IDs of the availabilities. This will overwrite the item availabilities that are saved in the menu **System » Item » Availability**. |

_Tab. 1: Settings for the data format **GoogleShopping-Plugin**_

## 3 Available columns of the export file

| **Spaltenbezeichnung**        | **Erläuterung** |
| :---                          | :--- |
| **id**                        | The Google Shopping **SKU** of the variation. |
| **title**                     | According to the format setting **Item name**. |
| **description**               | According to the format setting **Description**. |
| **google_product_category**   | According to the setting **Settings » Markets » Google » Google Shopping Int.**. The Google Shopping category for the default category. |
| **product_type**              | The name of the default category. |
| **link**                      | The **URL path** of the item depending on the chosen **client** in the format settings. |
| **image_link**                | The image URL. Variation images are prioritised over item images. |
| **additional_image_link**     | Additional comma separated image URLs for up to 10 images. |
| **condition**                 | The condition of the item. According to **Item » Edit item » Global » Basic settings » Condition for API**. |
| **availability**              | The name of the **item availability** under **Settings » Item » Item availability** or the translation according to the format setting **Item availability**. |
| **price**                     | The **sales price** of the variation. |
| **sale_price**                | The **offer price** of the variation. |
| **brand**                     | The **name of the manufacturer** of the item. The **external name** within **Settings » Items » Manufacturer** is preferred if existing. |
| **gtin**                      | According to the format setting **Barcode**. |
| **isbn**                      | The **ISBN** of the variation. |
| **mpn**                       | The **model** of the variation. |
| **color**                     | The **colour** of the variation according to the attribute or property. Properties are prioritised. |
| **size**                      | The **size** of the variation according to the attribute or property. Properties are prioritised. |
| **material**                  | The **material** of the variation according to the attribute or property. Properties are prioritised. |
| **pattern**                   | The **pattern** of the variation according to the attribute or property. Properties are prioritised. |
| **item_group_id**             | The **item ID** of the variation. |
| **shipping**                  | According to the format setting **Shipping costs**. |
| **shipping_weight**           | The shipping weight of the variation. |
| **gender**                    | The gender according to the Google Shopping property **gender**. |
| **age_group**                 | The age group according to the Google Shopping property **age group**. |
| **excluded_destination**      | Empty. |
| **adwords_redirect**          | Adwords Redirect according to the Google Shopping property **AdWords Redirect**. |
| **identifier_exists**         | The value is **true** if a combination of the attributes **brand** + **GTIN** or **brand** + **mpn** is available. Otherwise the value is **false**. |
| **unit_pricing_measure**      | The **unit** of the variation. |
| **unit_pricing_base_measure** | The **base unit** of the variation according to **unit_pricing_measure**. |
| **energy_efficiency_class**   | The energy efficiency class according to the Google Shopping property **energy efficiency class**. |
| **size_system**               | The size system according to the Google Shopping property **size system**. |
| **size_type**                 | The size type according to the Google Shopping property **size type**. |
| **mobile_link**               | The mobile link according to the Google Shopping property **mobile link**. |
| **sale_price_effective_date** | The sale price effective date according to the Google Shopping property **sale price effective date**. |
| **adult**                     | Empty. |
| **custom_label_0**            | The custom label 0 according to the Google Shopping property **Custom label 0**. |
| **custom_label_1**            | The custom label 1 according to the Google Shopping property **Custom label 1**. |
| **custom_label_2**            | The custom label 2 according to the Google Shopping property **Custom label 2**. |
| **custom_label_3**            | The custom label 3 according to the Google Shopping property **Custom label 3**. |
| **custom_label_4**            | The custom label 4 according to the Google Shopping property **Custom label 4**. |
| **availability_date**         | The release date of the variation. |

## 4 License

This project is licensed under the GNU AFFERO GENERAL PUBLIC LICENSE.- find further information in the [LICENSE.md](https://github.com/plentymarkets/plugin-elastic-export-google-shopping/blob/master/LICENSE.md).
