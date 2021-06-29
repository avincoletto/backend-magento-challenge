# Deviget backend challenge

This is a module to create custom links to add product(s) directly to cart based 
on a friendly url. Below the instructions to use the module. 

### Installation

- Upload the folder *AndersonVincoletto* to the path app/code of your Magento
- Run the commands below to actually install the module:
```bash
    php bin/magento setup:upgrade
    php bin/magento setup:di:compile
    php bin/magento setup:static-content:deploy -f en_US
    php bin/magento cache:flush
    php bin/magento cache:clean
```
- In Magento's admin panel check the menu *Deviget > Add To Cart Links*

### How to use

- Access the menu *Deviget > Add To Cart Links*
- All registered links will appear in the grid panel
- To create a new link just click in button *Add New Link* and fill the form 
showed in next page
- After saving the link will be showed in links grid and you can share it in 
any website

  
