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

---
* [task: create new task](#create-new-task)
* [task: edit task](#edit-task)
* [task: get tasks list](#fetch-task-list)
* [task: get task details](#get-task-details)
* [task: delete task (admin privilege)](#delete-task)
* [task: get tasks which created by user](#get-created-tasks-by-user)
* [task: get tasks which applied in by user](#get-tasks-applied-in-by-user)

---
* [chat: get chat channel details](#get-chat-channel-details)
---

* [admin: signup](#admin-signup)
* [admin: login](#admin-login)
* [admin: get contact us forms](#admin-get-contact-us)
* [admin: get users](#admin-get-users)
* [admin: get transactions](#admin-get-transactions)
* [admin: get identities](#admin-get-identities)
* [admin: close or open user account](#admin-close-or-open-user-account)
* [admin: get task list](#admin-get-task-list)
* [admin: assign privilege](#admin-assign-privilege)
* [admin: verify identity](#admin-verify-identity)
* [admin: get statistics data](#admin-get-statistics-data)

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

## Create New Task
`POST`

    .../api/task

### Header

    {
        "Authentication" : "token"
    }

### Body

    {
	    "title":"task title...",
	    "task_status":1,
	    "description":"task description...",
	    "budget": 200,
        "payment_method": 2,
        "required_invoice": 1,
        "order_cost": 23000,
        "note": "it must me original",
        "delivery_date": "2022-02-15 00:00:00",
        "delivery_location_id": 2,
        "target_location_id": 1
    }

### Response

    {
        "success": true,
        "message": "task created successfully!",
        "data": {
            "id": 26,
            "title": "Buy Iphone for me",
            "task_status": 0,
            "description": "my first task Lorem Ipsum is simplk",
            "budget": 200,
            "order_cost": 23000,
            "payment_method": 1,
            "required_invoice": 1,
            "note": "it must me original",
            "order_status": 0,
            "travel_status": 0,
            "delivery_date": "2022-02-15 00:00:00",
            "user_id": 2,
            "delivery_location_id": 5,
            "target_location_id": 16,
            "created_at": "2022-02-25T18:02:09.000000Z",
            "updated_at": "2022-02-25T18:02:09.000000Z",
            "paid_service": null,
            "paid_order": null,
            "paid_both": null,
            "delivery_location": {
                "id": 5,
                "country": "Egypt",
                "state": "Cairo",
                "city": "Tebin",
                "streat": "25 st elwahaat",
                "address_note": "my address note",
                "longitude": 32.2767202,
                "latitude": 30.6107974
            }
        }
    }

[Back to endpoints list.](#endpoints)

---


## Edit Task
`PUT`

    .../api/task/edit

### Header

    {
        "Authentication": "token"
    }

### Body

    {
        'id': 1, ---> required
        'user_id': 5, ---> required
        ...remaining data optional...
    }
### Response

    {
        "success": true,
        "message": "task updated successfully!"
    }


[Back to endpoints list.](#endpoints)

---

## Get Task List
`GET`

    .../

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

## Admin Signup
`POST`

    .../api/admin/signup

### Body

    {
	    "email": "example@example.com",
        "password": "12345678",
        "secret_key": "fdfce#######ad"
    }

### Response

    {
        "success": true,
        "message": "login successfully",
        "token": "auth token...",
        "has_address": true,
        "token_expires_at": "2023-02-25T18:53:18.000000Z",
        "user": {
            "id": 1,
            "name": "example",
            "email": "example@example.com",
            "photo_url": "default-profile-image-2122202.png",
            "is_admin": 1,
            "created_at": "2022-02-12T17:40:14.000000Z"
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
                    "id": 9,
                    "name": "mostafas",
                    "email": "mostafas@gmail.com",
                    "photo_url": "063443-man.png",
                    "is_admin": 0,
                    "created_at": "2022-02-24T04:59:36.000000Z",
                    "profile": {
                        "about": "l,sdlf,slf,s;lf,sd",
                        "gender": "male",
                        "identity_status": 0,
                        "country": "Egypt",
                        "state": "Ismailia",
                        "city": "Qantara Gharb",
                        "phone": "201021545154",
                        "total_rate": 0,
                        "success_rate": 0,
                        "connects": 30,
                        "earning_amount": 0,
                        "spent_amount": 0,
                        "total_orders_amount": 0
                    }
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

[Back to endpoints list.](#endpoints)

---

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
                    "id": 7,
                    "identity_front": "194436-user (1).png",
                    "identity_back": "194436-profile.png",
                    "identity_selfy": "194436-profile.png",
                    "created_at": "20th of February 2022",
                    "verified": 0 or 1
                    "user": {
                        "id": 3,
                        "name": "Osama",
                        "email": "osama@gmail.com",
                        "photo_url": "default-profile-image-2122202.png",
                        "is_admin": 0,
                        "created_at": "2022-02-14T02:06:31.000000Z"
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


[Back to endpoints list.](#endpoints)

---

## Admin Close or Open User Account
`POST`

    .../api/admin/user/account

### Header
    {
        "Authentication": "token"
    }

### Body

    {
	    "id": 5,
        "status": 1 (open) OR 0 (close)
    }
### Response

    {
        "success": true,
        "message": "user account open successfully"
    }
    or
    {
        "success": true,
        "message": "user account close successfully"
    }
    or (if trying to close account which is already closed and vice versa)
    {
        "success": true,
        "message": "there is no action can happen!"
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


[Back to endpoints list.](#endpoints)

---

## Admin Assign Privilege
`POST`

    .../api/admin/assign-privilege

### Header
    
    {
        "Authentication" : "token"
    }

### Body
    
    {
        "privilege": 0 or 1 or 2 or 3 or 4,
        "user_id": 3
    }

### Response

    {
        "success": true,
        "message": "change privilege successfully",
        "data": {
            "updated": 1
        }
    }


[Back to endpoints list.](#endpoints)

---

## Admin Verify Identity
`POST`

    .../api/admin/identity

### Header

    {
        "Authentication": "token"
    }

### Body

    {
        "user_id" : 2,
        "identity_id" : 7,
        "verify" : true(verify) or false(reject)
    }

### Response

    {
        "success": true,
        "message": "verify identity successfully!"
    }


[Back to endpoints list.](#endpoints)

---


## Admin Get Statistics Data
`GET`
    
    .../api/admin/statistics

### Header

    {
        "Authentication" : "token"
    }

### Response

    {
        "success": true,
        "message": "get statistics data successfully",
        "data": {
            "tasks": [
                {
                    "task_status": 0,
                    "total": 3
                },
                {
                    "task_status": 1,
                    "total": 1
                },
                {
                    "task_status": 2,
                    "total": 1
                }
            ],
            "user_count": 6,
            "users": [
                {
                    "identity_status": 0,
                    "total": 3
                },
                {
                    "identity_status": 1,
                    "total": 3
                }
            ],
            "transactions": 25
        }
    }

    
[Back to endpoints list.](#endpoints)

---