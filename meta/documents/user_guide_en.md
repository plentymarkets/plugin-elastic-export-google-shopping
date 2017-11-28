
# Google Shopping plugin user guide

<div class="container-toc"></div>

## 1 Registering with Google Shopping

The price comparison portal Google Shopping offers search and comparison functions as well as links to the product pages in other online stores. Store owners can display their products in Google Shopping lists within the Google search. Stores are billed for the service per click.
Before you can transfer your export format, you will have to register with Google Shopping first.

## 2 Setting up the data format GoogleShopping-Plugin in plentymarkets

The plugin Elastic Export is required to use this format.

Refer to the [Exporting data formats for price search engines](https://knowledge.plentymarkets.com/en/basics/data-exchange/exporting-data#30) page of the manual for further details about the individual format settings.

The following table lists details for settings, format settings and recommended item filters for the format **GoogleShopping-Plugin**.

<table>
    <tr>
        <th>
            Settings
        </th>
        <th>
            Explanation
        </th>
    </tr>
    <tr>
        <td class="th" colspan="2">
            Settings
        </td>
    </tr>
    <tr>
        <td>
            Format
        </td>
        <td>
            Choose <b>GoogleShopping-Plugin</b>.
        </td>        
    </tr>
    <tr>
        <td>
            Provisioning
        </td>
        <td>
            Choose <b>URL</b>.
        </td>        
    </tr>
    <tr>
        <td>
            File name
        </td>
        <td>
            The file name must have the ending <b>.csv</b> for Google Shopping to be able to import the file successfully.
        </td>        
    </tr>
    <tr>
        <td class="th" colspan="2">
            Item filter
        </td>
    </tr>
    <tr>
        <td>
            Active
        </td>
        <td>
            Choose <b>active</b>.
        </td>        
    </tr>
    <tr>
        <td>
            Markets
        </td>
        <td>
            Choose one or multiple order referrer. The chosen order referrer has to be active at the variation for the item to be exported.
        </td>        
    </tr>
    <tr>
        <td class="th" colspan="2">
            Format settings
        </td>
    </tr>
    <tr>
        <td>
            Order referrer
        </td>
        <td>
            Choose the order referrer that should be assigned during the order import.
        </td>        
    </tr>
    <tr>
        <td>
            Preview text
        </td>
        <td>
            This option is not relevant for this format.
        </td>        
    </tr>
    <tr>
        <td>
            Offer price
        </td>
        <td>
            This option is not relevant for this format.
        </td>        
    </tr>
    <tr>
        <td>
            VAT note
        </td>
        <td>
            This option is not relevant for this format.
        </td>        
    </tr>
</table>

## 3 Overview of available columns

<table>
    <tr>
        <th>
            Column name
        </th>
        <th>
            Explanation
        </th>
    </tr>
    <tr>
		<td>
			id
		</td>
		<td>
			The Google Shopping <b>SKU</b> for the variation.
		</td>        
	</tr>
	<tr>
		<td>
			title
		</td>
		<td>
			According to the format setting <b>Item Name</b>.
		</td>        
	</tr>
	<tr>
		<td>
			description
		</td>
		<td>
			According to the format setting <b>Description</b>.
		</td>        
	</tr>
	<tr>
		<td>
			google_product_category
		</td>
		<td>
			According to the setting <b>Settings » Markets » Google » Google Shopping Int.</b> the Google Shopping category for the default category.
		</td>        
	</tr>
	<tr>
		<td>
			product_type
		</td>
		<td>
			The names of the default category.
		</td>        
	</tr>
	<tr>
		<td>
			link
		</td>
		<td>
			The <b>URL path</b> of the item depending on the chosen <b>client</b> in the format settings.
		</td>        
	</tr>
	<tr>
		<td>
			image_link
		</td>
		<td>
			The image url. Variation images are prioritizied over item images.
		</td>        
	</tr>
	<tr>
		<td>
			additional_image_link
		</td>
		<td>
			Additional comma separated image URLs for up to 10 images. Variation images are prioritizied over item images.
		</td>        
	</tr>
	<tr>
		<td>
			condition
		</td>
		<td>
			The condition of the item. According to <b>Item » Edit item » Global » Basic Settings » Condition for API</b>.
		</td>        
	</tr>
	<tr>
		<td>
			availability
		</td>
		<td>
			<b>Content:</b>The <b>name of the item availability</b> under <b>Settings » Item » Item availability</b> or the translation according to the format setting <b>Item availability</b>.
		</td>        
	</tr>
	<tr>
		<td>
			price
		</td>
		<td>
			The <b>sales price</b> of the variation.
		</td>        
	</tr>
	<tr>
		<td>
			sale_price
		</td>
		<td>
			The <b>sales price</b> of the variation.
		</td>        
	</tr>
	<tr>
		<td>
			brand
		</td>
		<td>
			The <b>name of the manufacturer</b> of the item. The <b>external name</b> from the menu <b>Settings » Items » Manufacturer</b> will be preferred if existing.
		</td>        
	</tr>
	<tr>
		<td>
			gtin
		</td>
		<td>
			According to the format setting <b>Barcode</b>.
		</td>        
	</tr>
	<tr>
		<td>
			isbn
		</td>
		<td>
			The <b>ISBN</b> of the variation.
		</td>        
	</tr>
	<tr>
		<td>
			mpn
		</td>
		<td>
			The <b>Model</b> of the variation.
		</td>        
	</tr>
	<tr>
		<td>
			color
		</td>
		<td>
			The <b>color</b> of the variation according to the attribute or property. Properties are prioritizied.
		</td>        
	</tr>
	<tr>
		<td>
			size
		</td>
		<td>
			The <b>size</b> of the variation according to the attribute or property. Properties are prioritizied.
		</td>        
	</tr>
	<tr>
		<td>
			material
		</td>
		<td>
			The <b>material</b> of the variation according to the attribute or property. Properties are prioritizied.
		</td>        
	</tr>
	<tr>
		<td>
			pattern
		</td>
		<td>
			The <b>pattern</b> of the variation according to the attribute or property. Properties are prioritizied.
		</td>        
	</tr>
	<tr>
		<td>
			item_group_id
		</td>
		<td>
			The <b>Item ID</b> of the variation.
		</td>        
	</tr>
	<tr>
		<td>
			shipping
		</td>
		<td>
			According to the format setting <b>Shipping costs</b>.
		</td>        
	</tr>
	<tr>
		<td>
			shipping_weight
		</td>
		<td>
			The shipping weigtht of the variation.
		</td>        
	</tr>
	<tr>
		<td>
			gender
		</td>
		<td>
			The gender according to the Google Shopping property **gender**.
		</td>        
	</tr>
	<tr>
		<td>
			age_group
		</td>
		<td>
			The age group according to the Google Shopping property **age group**.
		</td>        
	</tr>
	<tr>
		<td>
			excluded_destination
		</td>
		<td>
			Empty.
		</td>        
	</tr>
	<tr>
		<td>
			adwords_redirect
		</td>
		<td>
			AdWords redirect according to the Google Shopping property **AdWords Redirect**.
		</td>        
	</tr>
	<tr>
		<td>
			unit_pricing_measure
		</td>
		<td>
			The <b>Unit</b> of the variation.
		</td>        
	</tr>
	<tr>
		<td>
			unit_pricing_base_measure
		</td>
		<td>
			The <b>base unit</b> of the variation according to **unit_pricing_measure**.
		</td>        
	</tr>
	<tr>
		<td>
			energy_efficiency_class
		</td>
		<td>
			The energy efficiency class according to the Google Shopping property **energy efficiency class**.
		</td>        
	</tr>
	<tr>
		<td>
			size_system
		</td>
		<td>
			The size system according to the Google Shopping property **size system**.
		</td>        
	</tr>
	<tr>
		<td>
			size_type
		</td>
		<td>
			The size type according to the Google Shopping property **size type**.
		</td>        
	</tr>
	<tr>
		<td>
			mobile_link
		</td>
		<td>
			The mobile link according to the Google Shopping property **mobile link**.
		</td>        
	</tr>
	<tr>
		<td>
			sale_price_effective_date
		</td>
		<td>
			The sale price effective date according to the Google Shopping property **sale price effective date**.
		</td>        
	</tr>
	<tr>
		<td>
			adult
		</td>
		<td>
			Empty.
		</td>        
	</tr>
	<tr>
		<td>
			custom_label_0
		</td>
		<td>
			The custom label 0 according to the Google Shopping property **Custom label 0**.
		</td>        
	</tr>
	<tr>
		<td>
			custom_label_1
		</td>
		<td>
			The custom label 1 according to the Google Shopping property **Custom label 1**.
		</td>        
	</tr>
	<tr>
		<td>
			custom_label_2
		</td>
		<td>
			The custom label 2 according to the Google Shopping property **Custom label 2**.
		</td>        
	</tr>
	<tr>
		<td>
			custom_label_3
		</td>
		<td>
			The custom label 3 according to the Google Shopping property **Custom label 3**.
		</td>        
	</tr>
	<tr>
		<td>
			custom_label_4
		</td>
		<td>
			The custom label 4 according to the Google Shopping property **Custom label 4**.
		</td>        
	</tr>
	<tr>
		<td>
			availability_​date
		</td>
		<td>
			The release date of the variation.
		</td>        
	</tr>
</table>

## 4 License

This project is licensed under the GNU AFFERO GENERAL PUBLIC LICENSE.- find further information in the [LICENSE.md](https://github.com/plentymarkets/plugin-elastic-export-google-shopping/blob/master/LICENSE.md).
