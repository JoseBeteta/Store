Mytheresa store challenge by Jose Beteta
========================================

This is my implementation of your tech challenge, hope you like it.
###Requirements
* docker | https://docs.docker.com/get-docker/
* docker-compose | https://docs.docker.com/compose/install/

## Implementation notes
As i understood in the challenge description the application of the discounts where free to 
choose, so, I applied due the categories.

Also i didn't put manny comments in the code because i like to think that my code its self explanatory/ubiquitous.
If you have any doubt about the implementation don't hesitate to ask.

I've developed the challenge with my best practices experience, and my Hexagonal Architecture and DDD knowledge. 

### Raise project

The following command will:
* First make => start the containers (nginx, php, mysql) and runs composer.
* Second make initialize the bd, and dump the requested data.


    make start
    make iv



### Usage
I developed a restfull api with the endpoint requested:
* Allowed params (category, priceLessThan).
* Category mandatory, priceLessThan optional.



    curl --location --request GET 'localhost:80/api/clothes/get?category=sneakers&priceLessThan=58999'

###Expected Response
As you requested the response it will be something like:


    [{
        "sku": "000005",
        "name": "Nathane leather sneakers",
        "category": "sneakers",
        "price": {
            "original": 59000,
            "final": 59000,
            "discount_percentage": null,
            "currency": "EUR"
        }
    }]

###Execute test

    make rt 

Regards, Jose Beteta
