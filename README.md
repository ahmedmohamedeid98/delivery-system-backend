<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About eDelivery

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

# REST API

The REST API to the eDelivery system is described below.

## Profile

### Address (GET)
`GET user/address`

### Header
    {
        "Authorization": "token"
    }

### Response (status_code = 200)
    {
    "success": true,
    "message": "get address successfully",
    "data": {
        "country": "Egypt",
        "state": "Ismailia",
        "city": "Salam"
    }

}

### Address (POST)
`POST user/address`

### Header
    {
        "Authorization": "token"
    }
### Body
    {
        "country": "Egypt",
        "state": "Cairo",
        "city": "Giza",
    }
### Response
    {
        "success": true,
        "message": "update address successfully",
        "data": {
            "country": "Egypt",
            "state": "Cairo",
            "city": "non-valid city"
        }
    }


## Feedback

- add feedback after task competed .
- get all your feedback added by others.
### Request (Create)
`POST /feeback`

    - https://ds-marketplace-api.herokuapp.com/api/feedback
    - http://localhost:8000/api/feedback

### Header
    {
        "Authorization": "token is required"
    }
### body
    {
        "reciver_id": 3,
        "task_id": 5,
        "rate": 4.5,
        "content": "Ali is a great man..."
    }
### Success Response

    {
        "success": true,
        "message": "feedback added successfully!",
        "data": {
            "sender_id": 1,
            "reciver_id": 3,
            "task_id": 1,
            "rate": "4.5",
            "content": "this user is amazing",
            "updated_at": "2022-02-16T14:08:27.000000Z",
            "created_at": "2022-02-16T14:08:27.000000Z"
        }
    }

### Failure Response

    {
        "success": false,
        "errors": [
            "you already add feedback for client who complete this task"
        ]
    }

### Request (fetch)
`Get /feeback`

    - https://ds-marketplace-api.herokuapp.com/api/feedback
    - http://localhost:8000/api/feedback

### Header
    {
        "Authorization": "token is required"
    }
### Response

    {
        "success": true,
        "message": "get all your feedbacks successfully",
        "data": [
            {
                "sender_id": 1,
                "reciver_id": 3,
                "task_id": 1,
                "rate": 4.5,
                "content": "this user is amazing",
                "created_at": "2022-02-16T14:08:27.000000Z",
                "updated_at": "2022-02-16T14:08:27.000000Z"
            },
            {
                ...
            }
        ]
    }
