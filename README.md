<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About eDelivery

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

# Dependancy
* doctrine/dbal : migrate change on existing column

# REST API

The REST API to the eDelivery system is described below.

## EndPoints
* [get user address](#get-user-address)
* [update user address](#update-user-address)
* [create feedback](#create-feedback)
* [get my feedback](#get-my-feedback)
* [get another user feedback](#get-another-user-feedback)
* [contact us - Post](#contact-us)
* [load image from server](#load-image-from-server)
* [is user admin](#is-user-admin)
* [delete task](#delete-task)
* [get tasks which created by user](#get-created-tasks-by-user)
* [get tasks which applied in by user](#get-tasks-applied-in-by-user)
* [get chat channel details](#get-chat-channel-details)
---

* [admin: login](#admin-login)
* [admin: get contact us forms](#admin-get-contact-us)
* [admin: get users](#admin-get-users)
* [admin: get transactions](#admin-get-transactions)
* [admin: get identities](#admin-get-identities)
* [admin: delete user](#admin-delete-user)
* [admin: get task list]("admin-get-task-list)


## Get User Address
`GET`

    .../api/user/address
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

## Update User Address
`POST`
    
    .../api/user/address

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


[Back to endpoints list.](#endpoints)

---

## Feedback

- add feedback after task competed .
- get all your feedback added by others.
### Create Feedback 
`POST`

    .../api/feedback

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


[Back to endpoints list.](#endpoints)

---
### Get My Feedback
`GET`

    ../api/feedback/me

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

## Get Another User Feedback
`GET`
    
    .../api/feedback?user_id=5

### Heaser
    {
        "Authorization" : "token required"
    }

### Response
    {
        "success": true,
        "message": "get all user feedbacks successfully",
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


[Back to endpoints list.](#endpoints)

---
## Contact US
`POST`
    
    .../api/contact-us

### Header
    not required, any user can send contact us form.
### Body
    {
        "full_name" : "user full name",
        "email": "example@example.com",
        "phone": "01095xxxxxx",
        "subject": "can not buy new connects",
        "message": "Hi in last time I am trying to ...."
    }

### Response
    {
        "success": true,
        "message": "your message was sent successfully",
        "data": {
            "id": 1
            "full_name" : "user full name",
            "email": "example@example.com",
            "phone": "01095xxxxxx",
            "subject": "can not buy new connects",
            "message": "Hi in last time I am trying to ....",
            "updated_at": "2022-02-21T00:01:48.000000Z",
            "created_at": "2022-02-21T00:01:48.000000Z",
        }
    }


[Back to endpoints list.](#endpoints)

---
## Load Image From Server
`local server`
    
    <img src="http://localhost:8000/img/example.png" alt="">
`remote server`

    <img src="https://www.remote-server.com/img/example.png" alt="">

## Is User Admin
`GET`

    .../api/is-admin

### Header

    {
        "Authorization": "token required"
    }

### response

    {
        "success": true,
        "message": "user is admin",
        "data": {
            "is_admin": true
        }
    }

    or

    {
        "success": true,
        "message": "user is not admin",
        "data": {
            "is_admin": false
        }
    }

[Back to endpoints list.](#endpoints)

---

## Delete Task
`DELETE`

    .../api/task?id=7

### Header
    
    {
        "Authorization": "token is required"
    }

### Response

    success:
    
    {
        "success": true,
        "message": "task deleted successfully!"
    }

    failuer:
    
    {
        "success": false,
        "errors": "unauthorized operation!"
    }

[Back to endpoints list.](#endpoints)

---

## Get Created Tasks by User
`GET`

    .../api/task/me

### Header
    
    {
        "Authorization": "token is required"
    }

### Response

    {
        "success": true,
        "message": "get my created tasks successfully",
        "data": [
            {
                "id": 9,
                "title": "task title",
                "task_status": 0,
                "description": "this skdms dsldmsd fdlmfd ldmfd  this skdms dsldmsd fdlmfd ldmfd",
                "budget": 100,
                "order_cost": 0,
                "payment_method": 1,
                "required_invoice": 1,
                "note": "",
                "order_status": 0,
                "travel_status": 0,
                "delivery_date": "2022-02-22 00:00:00",
                "user_id": 1,
                "delivery_location_id": 7,
                "target_location_id": 18,
                "created_at": "2022-02-20T19:29:15.000000Z",
                "updated_at": "2022-02-20T19:29:15.000000Z",
                "paid_service": null,
                "paid_order": null,
                "paid_both": null,
                "feedback": [
                    {
                        "sender_id": 1,
                        "reciver_id": 2,
                        "task_id": 9,
                        "rate": 4.5,
                        "content": "Good work Ali you delivery the order on time.",
                        "created_at": "2022-02-21T21:01:07.000000Z",
                        "updated_at": "2022-02-21T21:01:07.000000Z"
                    },
                    {
                        "sender_id": 2,
                        "reciver_id": 1,
                        "task_id": 9,
                        "rate": 5,
                        "content": "Pleased to deal with you ahmed i hope to work again with you!",
                        "created_at": "2022-02-22T21:01:53.000000Z",
                        "updated_at": "2022-02-22T21:01:53.000000Z"
                    }
                ],
                "offers": [
                    {
                        "user_id": 5
                    }
                ]
            }
        ]
    }


[Back to endpoints list.](#endpoints)

---
## Get Tasks Applied in by User
`GET`
    
    .../api/task/applied

### Header
    {
        "Authorization": "token is required"
    }

### Response

    {
        "success": true,
        "message": "get my applied in tasks successfully",
        "data": [
            {
                "id": 9,
                "title": "task title",
                "task_status": 0,
                "description": "this skdms dsldmsd fdlmfd ldmfd  this skdms dsldmsd fdlmfd ldmfd",
                "budget": 100,
                "order_cost": 0,
                "payment_method": 1,
                "required_invoice": 1,
                "note": "",
                "order_status": 0,
                "travel_status": 0,
                "delivery_date": "2022-02-22 00:00:00",
                "user_id": 1,
                "delivery_location_id": 7,
                "target_location_id": 18,
                "created_at": "2022-02-20T19:29:15.000000Z",
                "updated_at": "2022-02-20T19:29:15.000000Z",
                "paid_service": null,
                "paid_order": null,
                "paid_both": null,
                "feedback": [
                    {
                        "sender_id": 1,
                        "reciver_id": 2,
                        "task_id": 9,
                        "rate": 4.5,
                        "content": "Good work Ali you delivery the order on time.",
                        "created_at": "2022-02-21T21:01:07.000000Z",
                        "updated_at": "2022-02-21T21:01:07.000000Z"
                    },
                    {
                        "sender_id": 2,
                        "reciver_id": 1,
                        "task_id": 9,
                        "rate": 5,
                        "content": "Pleased to deal with you ahmed i hope to work again with you!",
                        "created_at": "2022-02-22T21:01:53.000000Z",
                        "updated_at": "2022-02-22T21:01:53.000000Z"
                    }
                ]
            }
        ]
    }

[Back to endpoints list.](#endpoints)

---

## Get Chat Channel Details
`GET`

    .../api/channel?id=5

### Header

    {
        "Authentication": "token"
    }

### Response

    {
        "success": true,
        "message": "success",
        "data": {
            "me": {
                "id": 1,
                "name": "ahmed",
                "email": "ahmed3@gmail.com",
                "photo_url": "default-profile-image-2122202.png",
                "created_at": "2022-02-12T17:40:14.000000Z"
            },
            "chat_with": {
                "id": 5,
                "name": "khaled",
                "email": "khaled@gmail.com",
                "photo_url": "default-profile-image-2122202.png",
                "created_at": "2022-02-17T21:33:47.000000Z"
            },
            "on_channel_id": 1
        }
    }

[Back to endpoints list.](#endpoints)

---

## Admin Login
`POST`

    .../api/admin/login

### body
    {
        "email" : "example@example.com",
        "password" : "454551545"
    }

### Response

    {
        "success": true,
        "message": "login successfully",
        "token": "eyJ0eXAiOiJK...",
        "has_address": true,
        "token_expires_at": "2023-02-24T18:07:43.000000Z",
        "user": {
            "id": 1,
            "name": "ahmed",
            "email": "ahmed3@gmail.com",
            "photo_url": "default-profile-image-2122202.png",
            "created_at": "2022-02-12T17:40:14.000000Z"
        }
    }
    


[Back to endpoints list.](#endpoints)

---
## Admin Get Contact Us
`GET`

    .../api/admin/contact-us

### Header

    {
        "Authentication" : "token"
    }

### Response

    {
        "success": true,
        "message": "success",
        "data": {
            "forms": [
                {
                    "id": 1,
                    "full_name": "ahmed eid",
                    "email": "ahmed@gmail.com",
                    "phone": "01095454548",
                    "subject": "can not buy new connects",
                    "message": "hi my namasdsd dkfmdf dlfsd fsd;fldmsf",
                    "created_at": "2022-02-21T00:01:48.000000Z"
                },
                {
                    ...
                }
            ],
            "paginate": {
                "current_page": 1,
                "from": 1,
                "last_page": 1,
                "links": [
                    {
                        "url": null,
                        "label": "&laquo; Previous",
                        "active": false
                    },
                    {
                        "url": "http://localhost:8000/api/admin/contact-us?page=1",
                        "label": "1",
                        "active": true
                    },
                    {
                        "url": null,
                        "label": "Next &raquo;",
                        "active": false
                    }
                ],
                "path": "http://localhost:8000/api/admin/contact-us",
                "per_page": 1,
                "to": 1,
                "total": 1
            }
        }
    }
    
[Back to endpoints list.](#endpoints)

---

## Admin Get Users
`GET`

    .../api/admin/users

### Header
    {
        "Authentication" : "token"
    }

### Response

    {
        "success": true,
        "message": "success",
        "data": {
            "users": [
                {
                    "id": 1,
                    "name": "ahmed",
                    "email": "ahmed3@gmail.com",
                    "photo_url": "default-profile-image-2122202.png",
                    "created_at": "2022-02-12T17:40:14.000000Z"
                },
                {
                    ...
                }
            ],
            "paginate": {
                "current_page": 1,
                "from": 1,
                "last_page": 6,
                "links": [
                    {
                        "url": null,
                        "label": "&laquo; Previous",
                        "active": false
                    },
                    {
                        "url": "http://localhost:8000/api/admin/users?page=1",
                        "label": "1",
                        "active": true
                    },
                    {
                        "url": "http://localhost:8000/api/admin/users?page=2",
                        "label": "2",
                        "active": false
                    },
                    {
                        "url": "http://localhost:8000/api/admin/users?page=3",
                        "label": "3",
                        "active": false
                    },
                    {
                        "url": "http://localhost:8000/api/admin/users?page=4",
                        "label": "4",
                        "active": false
                    },
                    {
                        "url": "http://localhost:8000/api/admin/users?page=5",
                        "label": "5",
                        "active": false
                    },
                    {
                        "url": "http://localhost:8000/api/admin/users?page=6",
                        "label": "6",
                        "active": false
                    },
                    {
                        "url": "http://localhost:8000/api/admin/users?page=2",
                        "label": "Next &raquo;",
                        "active": false
                    }
                ],
                "path": "http://localhost:8000/api/admin/users",
                "per_page": 1,
                "to": 1,
                "total": 6
            }
        }
    }

[Back to endpoints list.](#endpoints)

---

## Admin Get Transactions
`GET`

    .../api/admin/transactions

### Header
    {
        "Authentication": "token"
    }

### Response

    {
    "success": true,
    "message": "success",
    "data": {
        "transactions": [
            {
                'id': 4,
                'trans_ref': 'TST2204901064398',
                'user_id': 1
                'task_id': null
                'trans_amount': 50,
                'trans_currency': 'EGP',
                'trans_desc': '',
                'trans_type': 'connects',
                'res_status': 'A',
                'res_msg': 'Authorised',
                'trans_time': '2022-02-18T19:29:14Z',
                'payment_method': 'MasterCard',
                'payment_card': '5200 00## #### 0007',
                'ipn_trace': 'IPNS0003.620FF604.000023E8'
            },
            {
                ...
            }
        ],
        "paginate": {
            "current_page": 1,
            "from": null,
            "last_page": 1,
            "links": [
                {
                    "url": null,
                    "label": "&laquo; Previous",
                    "active": false
                },
                {
                    "url": "http://localhost:8000/api/admin/transactions?page=1",
                    "label": "1",
                    "active": true
                },
                {
                    "url": null,
                    "label": "Next &raquo;",
                    "active": false
                }
            ],
            "path": "http://localhost:8000/api/admin/transactions",
            "per_page": 5,
            "to": null,
            "total": 0
        }
    }
}

## Admin Get Identities
`GET`

    .../api/admin/identities

### Header

    {
        "Authentication": "token"
    }

### Response

    {
        "success": true,
        "message": "success",
        "data": {
            "identities": [
                {
                    "id": 3,
                    "identity_front": "132501-download.jpeg",
                    "identity_back": "132501-download (1).jpeg",
                    "identity_selfy": "132501-download (2).jpeg",
                    "created_at": "14th of February 2022"
                },
                {
                    ...
                }
            ],
            "paginate": {
                "current_page": 1,
                "from": 1,
                "last_page": 1,
                "links": [
                    {
                        "url": null,
                        "label": "&laquo; Previous",
                        "active": false
                    },
                    {
                        "url": "http://localhost:8000/api/admin/identities?page=1",
                        "label": "1",
                        "active": true
                    },
                    {
                        "url": null,
                        "label": "Next &raquo;",
                        "active": false
                    }
                ],
                "path": "http://localhost:8000/api/admin/identities",
                "per_page": 5,
                "to": 4,
                "total": 4
            }
        }
    }

## Admin Delete User
`DELETE`

    .../api/admin/user?id=7

### Header
    {
        "Authentication": "token"
    }

### Response

    {
        "success": true,
        "message": "user deleted successfully",
        "data": 1
    }

## Admin Get Task list
`GET`

    .../api/admin/tasks

### (Optional) query

    .../api/admin/tasks?task_status=0 or 1 or 2
    0: open tasks
    1: in progress tasks
    2: completed tasks

### Header 
    {
        "Authentication": "token"
    }

### Response

        {
            "success": true,
            "message": "success",
            "data": {
                "tasks": [
                    {
                        "id": 14,
                        "title": "sdl,sdl;,sdlf,sd",
                        "task_status": 0,
                        "description": "s;ldflsd,fsdl,f;    sdl,fsdl,fsd;lf,sd;,fsd;f,sd;f,sdf,d",
                    "budget": 150,
                        "order_cost": 0,
                        "payment_method": 1,
                        "required_invoice": 0,
                        "note": ";s,dlf,sd;f,ds",
                        "order_status": 0,
                        "travel_status": 0,
                        "delivery_date": "2022-03-03    00:00:00",
                    "user_id": 1,
                        "delivery_location_id": 7,
                        "target_location_id": 18,
                        "created_at":   "2022-02-24T01:18:12.000000Z",
                    "updated_at":   "2022-02-24T01:18:12.000000Z",
                    "paid_service": null,
                        "paid_order": null,
                        "paid_both": null,
                        "delivery_location": {
                            "id": 7,
                            "country": "Egypt",
                            "state": "Red Sea",
                            "city": "Safaga",
                            "streat": "streat name",
                            "address_note": "note",
                            "longitude": 32.2767202,
                            "latitude": 30.6107974
                        }
                    },
                    {
                        ...
                    }
                ],
                "paginate": {
                    "current_page": 1,
                    "from": 1,
                    "last_page": 1,
                    "links": [
                        {
                            "url": null,
                            "label": "&laquo; Previous",
                            "active": false
                        },
                        {
                            "url": "http://localhost:8000/  api/admin/tasks?page=1",
                        "label": "1",
                            "active": true
                        },
                        {
                            "url": null,
                            "label": "Next &raquo;",
                            "active": false
                        }
                    ],
                    "path": "http://localhost:8000/api/ admin/tasks",
                "per_page": 15,
                    "to": 5,
                    "total": 5
            }
        }
    }   