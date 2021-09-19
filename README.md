Mytheresa store chalange by Jose Beteta
========================================

This is my implementation of your tech challenge, hope you like it.
###Requirements
* docker | https://docs.docker.com/get-docker/
* docker-compose | https://docs.docker.com/compose/install/

## Implementation notes
As i understood in the challenge description the application of the discounts where free to 
choose, so, I applied due the categories.

### Raise containers

First lets build the necessary images to raise the containers with the following command inside the project directory.

    sudo docker-compose build 

This will build the images of `nginx` exposing the port 80 to send the requests and `php`.
Then let's raise the containers.

    sudo docker-compose up -d 

Let's install the dependencies with composer.

    sudo docker exec -it php_con composer install 


This should start all the stack necessary to run the challenge.

### Usage
I developed the challenge using a restful api, which contains 8 endpoints.

###Request
- Get clothes with discounts applied by the expected criteria.


    curl --location --request GET 'localhost:80/api/clothes/get?category=boots&priceLessThan=600000'

Body request example with header "application/javascript":

    {
    	"seller_name" : "Cruz roja"
    } 

Response resource uuid:


    {"resource_id":"cfa1f58d-a235-480d-adad-71bad26f8bae"}

- Delete Seller


    DELETE /api/shopping_cart/seller

###Product
- Add Product


    POST /api/shopping_cart/product

Body request example with header "application/javascript":

    {
    	"product_name" : "tiritas",
    	"product_price" : 12.1,
    	"seller_id": "cfa1f58d-a235-480d-adad-71bad26f8bae",
    	"product_amount": 30
    } 

Response resource uuid:


    {"resource_id":"cfa1f58d-a235-480d-adad-71bad26f8bae"}

- Delete product


    DELETE /api/shopping_cart/product

#### Cart

- Add/Delete products to cart

- Increase / Decrease the number of units of a product (0 means deleted).

- Remove a product from the cart


    PUT /api/shopping_cart/cart


Body request example with header "application/javascript":


    {
        "cart_id": "aa0e2259-b73e-48d3-8f1d-49582b6daddc",
        "products" : [
            {
                "product_id": "e44ec3df-f092-4f28-b65c-693217e361e4",
                "product_amount": 5
            },
            {
                "product_id": "689df021-37c9-40fb-b0d0-d82d6da6ffce",
                "product_amount": 2
            }
        ]
    }

- Delete the entire cart


    DELETE /api/shopping_cart/cart/{cart_id}

- Get the total amount of the cart.


    GET /api/shopping_cart/cart/price/{cart_id}

- Confirm Cart -> commit to buy.


    POST /api/shopping_cart/confirm

Body request example with header "application/javascript":

    {
        "cart_id" : "aa0e2259-b73e-48d3-8f1d-49582b6daddc"
    }
_______________________________________

Regards, Jose Beteta
