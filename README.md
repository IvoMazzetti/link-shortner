URL Shortener Application
Introduction

This project is a URL shortening application built with Laravel, developed as part of a job application. The application allows users to shorten long URLs and redirect users to the original URLs through the shortened links.
Features

    Shorten long URLs
    Redirect users from shortened URLs to original URLs
    Simple and clean user interface
    RESTful API endpoints for URL shortening and redirection
    Validation for URLs to ensure proper formatting

Requirements

    PHP >= 7.4
    Composer
    Laravel 8.x
    MySQL
    Livewire

Application Usage Documentation:
Link :http://167.71.133.239/


Usage: 
    You can choose on the first field the link that you wish to be redirected to. (example: https://www.google.com)
        -Requirements for the first field:
            - IT MUST BE A VALID URL

    On the second field you must choose a code for the redirection. (example: HyT92x. The final link would look like: http://167.71.133.239/redirect/HyT92x )
        -Requirements for the second field:
            - STRING
            - UNIQUE
            - MAX DIGITS: 25

    Generate the link by clicking on the generate button.
    You will then find the generated link below.
    Clicking on the link will lead you to the desired URL.


Link:
    http://167.71.133.239/redirect/{code}

    This link will lead you to the desired URL, if the code is not valid you will be redirected to a 404 error page
    By clicking on the showned button you will be redirected to the page to generate a valid code/link

Link:
    http://167.71.133.239/login

    In this link you will be able to login into your own account.

Link:
    http://167.71.133.239/register
    
    In this link you will be able to create your own account.

Link:
    http://167.71.133.239/dashboard

    In order to access this link you will need to be user authenticated.
    In this page you will be able to manage all the existent links, so you will be able to edit, delete and create new links.
    Also on this page you will be able to access the final link


API DOCUMENTATION
    - IN ORDER TO ACCESS THE API YOU WILL NEED TO GET A AUTH CODE

    In order to get a code you can do this API call:

    http://167.71.133.239/api/generate, it will return you your access_token, it should look something like this: "1|UYo1obtP9LZWd7CXsrlcElhFulAHQJwhZfgG6Hzj7ff7a32b"

    You should then use this BEARER Token to auth yourself.

    If you want to get all the available links you can access through this api call:
    (USE A GET METHOD)
    
        - http://167.71.133.239/api/links

    (USE A POST METHOD)
    If you want to create a new link you should access this endpoint:
        - http://167.71.133.239/api/links/create

        and this should be your body message (this is an example):
            {
                "originalLink" : "https://www.facebook.com",
                "redirectString" : "cccc"
            }
            
    (USE A GET METHOD)
    If you want to get one specific code you can access like this:

        - http://167.71.133.239/api/{code}

        Example:

            - http://167.71.133.239/api/cccc

    (USE A DELETE METHOD)
    If you want to delete one link you can use this endpoint:
        - http://167.71.133.239/api/{code}/delete

    (USE A PUT METHOD)
    If you want to UPDATE one link you can use this endpoint:
        - http://167.71.133.239/api/edit/{code}

        and use the same body example:
            {
                "originalLink" : "https://www.facebook.com",
                "redirectString" : "cccc"
            }
    









            
