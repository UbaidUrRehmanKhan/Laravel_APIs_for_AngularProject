# Laravel APIs for Sample Task Management Application using AngularJS 
***
## Project Configuration:

 - Clone or Download the projct. 
 - Put the project in localhost
 - Run the following Commands:
    - sudo chgrp -R www-data storage bootstrap/cache
    - sudo chmod -R ug+rwx storage bootstrap/cache
 - Open the browser
 - Open localhost to enusre that project is successfully configured.
 -  Configuration of Angular Project is necessary. 
    (https://github.com/UbaidUrRehmanKhan/AngularProject.git)

## End-Point API Calls:


#### 1- Login API
**URI:** `/login`
**Verb:** `POST`
**Request Params:** 
 - email [string] 
 - password [string]
 
**Response Formats:** 
 - `401`, Unauthorized 
     **Example**
```
    {
         "error": "Unauthorized"
    }
```
 - `200`, Success
    **Example**
```
    {
        "id": 2,
        "userName": "admin",
        "bearerToken": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vZXhhbXBsZS5jb20vYXBpL2xvZ2luIiwiaWF0IjoxNTI1ODU0MDgzLCJleHAiOjE1MjU4NTc2ODMsIm5iZiI6MTUyNTg1NDA4MywianRpIjoiT0NOdjk3bm1qVXNZV1RBNyIsInN1YiI6MiwicHJ2IjoiODdlMGFmMWVmOWZkMTU4MTJmZGVjOTcxNTNhMTRlMGIwNDc1NDZhYSJ9.XFuYQ14KIn2dSYuUFjL-58ylFKyJ2sahcdVq3fxWJCo",
        "isAuthenticated": 1,
        "isAdmin": 1
    }
```


#### 2- Logout API
**URI:** `/logout`
**Verb:** `POST`
**Request Params:** 
 - `no params`
 
**Response Formats:**
 - `401`, Unauthorized 
        **Example**
```
    {
        "message": "Unauthenticated."
    }
```
 - `200`, Success
     **Example**
```
    {
        'message' : 'Successfully logged out'
    }
```
 
#### 3- User Creation API
**URI:** `/user`
**Verb:** `POST`
**Request Params:** 
 - A User Object with the following Attributes:
    - name [string]
    - email [string]
    - password [string]
    - isActive [boolean]
    - isAdmin [boolean]
 
**Response Formats:** 
 - `422`, Unprocessable Entity
    **Example**
```
    {
        'message' : 'The object is incompatible'
    }
```
 - `500`, Internal Server Error
    **Example**
```
    {
        'message' : 'Internal Server Error/ The E-mail is already taken'
    }
```
 - `200`, Success
    **Example**
```
    {
        "name": "gsfdgfdsddd",
        "email": "mujaid@abc.com",
        "updated_at": "2018-05-09 10:35:24",
        "created_at": "2018-05-09 10:35:24",
        "id": 45
    }
```

#### 4- User Updation API
**URI:** `/user`
**Verb:** `PUT`
**Request Params:** 
 - A User Object with the following Attributes:
    - id [Number]
    - name [string]
    - email [string]
    - isActive [boolean]
    - isAdmin [boolean]
 
**Response Formats:** 
 - `404`, Not Found 
      **Example**
```
    {
        "errorCode": "404",
        "name": "Data not found."
    }
```
 - `200`, Success
    **Example**
```
    {
        "name": "gsfdgfdsddd",
        "email": "mujaid@abc.com",
        "updated_at": "2018-05-09 10:35:24",
        "created_at": "2018-05-09 10:35:24",
        "id": 45
    }
```
 - `304`, Not Updated
     **Example**
```
    { 
        "errorCode": "304",
        'message' : 'Data is not updated'
    }
```
 -  `422`, Unprocessable Entity
    **Example**
```
    {
        "errorCode": "422",
        'message' : 'The object is incompatible'
    }
```
 
#### 5- Users List API
**URI:** `/users`
**Verb:** `GET`
**Request Params:** 
 - `no params`
 
**Response Formats:** 
- `404`, Not Found 
      **Example**
```
    {
        "errorCode": "404",
        "name": "Data not found."
    }
```
 - `200`, Success
    A list of User Objects
 ``` 
[
    {
        "id": 1,
        "name": "khapa",
        "email": "abc@abc.com",
        "created_at": "2018-04-09 12:53:02",
        "updated_at": "2018-05-08 11:30:50",
        "isAdmin": 0,
        "isActive": 1
    },
    {
        "id": 41,
        "name": "new",
        "email": "new@new.com",
        "created_at": "2018-05-08 10:16:39",
        "updated_at": "2018-05-08 10:19:26",
        "isAdmin": 0,
        "isActive": 1
    }
] 
```

#### 6- User Detail API
**URI:** `/user/{user}`
**Verb:** `GET`
**Request Params:** 
 -  User ID [Number]
 
**Response Format:** 
- `404`, Not Found 
      **Example**
```
    {
        "errorCode": "404",
        "name": "Data not found."
    }
```
 - `200`, Success
    **Example**
 ```
    {
        "id": 1,
        "name": "khapa",
        "email": "abc@abc.com",
        "created_at": "2018-04-09 12:53:02",
        "updated_at": "2018-05-08 11:30:50",
        "isAdmin": 0,
        "isActive": 1,
        "taskCompleted": 1,
        "taskOngoing": 1
    }
 ```
 

#### 7- Update User Status API
**URI:** `updateStatus/{id}/{status}`
**Verb:** `PUT`
**Request Params:** 
 -   User ID [Number]
 -   Status [Boolean]
 
**Response Format:** 
 - `404`, Not Found 
      **Example**
```
    {
        "errorCode": "404",
        "name": "Data not found."
    }
```
 - `304`, Not Updated
     **Example**
```
    { 
        "errorCode": "304",
        'message' : 'Data is not updated'
    }
```
 - `200`, Success
  **Example**
 ```
      {
        "errorCode": "200",
        "name": "Data is successfully updated."
      }  
 ```

#### 8- Get User's Tasks API
**URI:** `user/{id}/tasks`
**Verb:** `GET`
**Request Params:** 
 -   User ID [Number]
 
**Response Format:** 
 - `404`, Not Found 
      **Example**
```
    {
        "errorCode": "404",
        "name": "Data not found."
    }
```
 - `200`, Success
   A list of assigned tasks to a user
  **Example**
```
    [
        {
            "id": 6,
            "name": "Angular 4",
            "description": "talentbooster",
            "created_at": {
                "date": "2018-05-08 05:56:17.000000",
                "timezone_type": 3,
                "timezone": "UTC"
            },
            "updated_at": {
                "date": "2018-05-08 10:38:45.000000",
                "timezone_type": 3,
                "timezone": "UTC"
            },
            "deleted_at": null,
            "status": 1
        },
        {
            "id": 9,
            "name": "laravel",
            "description": "nothing",
            "created_at": {
                "date": "2018-05-08 07:46:19.000000",
                "timezone_type": 3,
                "timezone": "UTC"
            },
            "updated_at": {
                "date": "2018-05-08 07:46:19.000000",
                "timezone_type": 3,
                "timezone": "UTC"
            },
            "deleted_at": null,
            "status": 0
        }
    ]
```

#### 9- Get User's Task Detail API
**URI:** `user/{userId}/tasks/{taskId}`
**Verb:** `GET`
**Request Params:** 
 -   User ID [Number]
 -   Task ID [Number]
 
**Response Format:** 
 - `404`, Not Found 
      **Example**
```
    {
        "errorCode": "404",
        "name": "Data not found."
    }
```
 - `200`, Success
  **Example**
```
 {
    "id": 6,
    "name": "Angular 4",
    "description": "talentbooster",
    "created_at": {
        "date": "2018-05-08 05:56:17.000000",
        "timezone_type": 3,
        "timezone": "UTC"
    },
    "updated_at": {
        "date": "2018-05-08 10:38:45.000000",
        "timezone_type": 3,
        "timezone": "UTC"
    },
    "deleted_at": null,
    "status": 1
}   
```
#### 10- Update Task's Status API (That was assigned to a user)
**URI:** `user/{userId}/tasks/{taskId}`
**Verb:** `PUT`
**Request Params:** 
 -   User ID [Number]
 -   Task ID [Number]
 
**Response Format:** 
 - `404`, Not Found 
      **Example**
```
    {
        "errorCode": "404",
        "name": "Data not found."
    }
```
  - `304`, Not Updated
     **Example**
```
    { 
        "errorCode": "304",
        'message' : 'Data is not updated'
    }
```
 - `200`, Success
  **Example**
 ```
      {
        "errorCode": "200",
        "name": "Data is successfully updated."
      }  
 ```
 
 #### 11- Create Task API
**URI:** `/task`
**Verb:** `POST`
**Request Params:** 
 -   Task Title [String]
 -   Task Description [String]
 
**Response Format:** 
- `422`, Unprocessable Entity
    **Example**
```
   {
        "message": "The given data was invalid.",
        "errors": {
            "name": [
                "The name field is required."
            ],
            "description": [
                "The description field is required."
            ]
        }
    }
```
 - `500`, Internal Server Error
    **Example**
```
    {
        'message' : 'Internal Server Error/ The E-mail is already taken'
    }
```
- `200`, Success
  **Example**
 ```
     {
        "name": "gsfdgfdsddd",
        "description": "dfdf",
        "updated_at": "2018-05-09 12:06:33",
        "created_at": "2018-05-09 12:06:33",
        "id": 14
    }
 ```
 
#### 12- Update Task API
**URI:** `/task/{task}`
**Verb:** `PUT`
**Request Params:** 
 -   Task Title [String]
 -   Task Description [String]
 
**Response Format:** 
- `422`, Unprocessable Entity
    **Example**
```
   {
        "message": "The given data was invalid.",
        "errors": {
            "name": [
                "The name field is required."
            ],
            "description": [
                "The description field is required."
            ]
        }
    }
```
 - `500`, Internal Server Error
    **Example**
```
    {
        'message' : 'Internal Server Error/ Creating default object from empty value'
    }
```
- `200`, Success
  **Example**
 ```
     {
        "name": "gsfdgfdsddd",
        "description": "dfdf",
        "updated_at": "2018-05-09 12:09:33",
        "created_at": "2018-05-09 12:06:33",
        "id": 14
    }
 ```
  - `304`, Not Updated
     **Example**
```
    { 
        "errorCode": "304",
        'message' : 'Data is not updated'
    }
```

#### 13- Tasks List API
**URI:** `/tasks`
**Verb:** `GET`
**Request Params:** 
 - `no params`
 
**Response Formats:** 
- `404`, Not Found 
      **Example**
```
    {
        "errorCode": "404",
        "name": "Data not found."
    }
```
 - `200`, Success
    A list of Task Objects
 ``` 
    [
        {
            "id": 5,
            "name": "php",
            "description": "task no.1",
            "created_at": "2018-05-04 13:21:07",
            "updated_at": "2018-05-04 13:21:07",
            "deleted_at": null
        },
        {
            "id": 6,
            "name": "Angular 4",
            "description": "talentbooster",
            "created_at": "2018-05-08 05:56:17",
            "updated_at": "2018-05-08 10:38:45",
            "deleted_at": null
        },
        {
            "id": 9,
            "name": "laravel",
            "description": "nothing",
            "created_at": "2018-05-08 07:46:19",
            "updated_at": "2018-05-08 07:46:19",
            "deleted_at": null
        }
    ]
```

#### 14- Task Detail API
**URI:** `/task/{task}`
**Verb:** `GET`
**Request Params:** 
 -   Task ID [Number]
 
**Response Formats:** 
- `404`, Not Found 
      **Example**
```
    {
        "errorCode": "404",
        "name": "Data not found."
    }
```
 - `200`, Success
    **Example**
 ```
    {
        "id": 5,
        "name": "php",
        "description": "task no.1",
        "created_at": "2018-05-04 13:21:07",
        "updated_at": "2018-05-04 13:21:07",
        "deleted_at": null
    }
 ```
 
#### 15- Task Deletion API
**URI:** `/task/{task}`
**Verb:** `DELETE`
**Request Params:** 
 -   Task ID [Number]
 
**Response Formats:** 
- `404`, Not Found 
      **Example**
```
    {
        "errorCode": "404",
        "name": "Data not found."
    }
```
- `422`, Not Deleted 
      **Example**
```
    {
        "errorCode": "422",
        "name": "Data not deleted."
    }
```
 - `200`, Success
    **Example**
 ```
     {
        "errorCode": "200",
        "name": "Data is deleted."
    }
 ```
 
 #### 16- Assigning Users to Task API
**URI:** `/assigningUsers/{id}`
**Verb:** `POST`
**Request Params:** 
 -   Task ID [Number]
 
**Response Formats:** 
- `404`, Not Found 
      **Example**
```
    {
        "errorCode": "404",
        "name": "Data not found."
    }
```
 - `200`, Success
    **Example**
 ```
     {
        "errorCode": "200",
        "name": "Task is assigned to users."
    }
 ```

#### 17- Detaching the Task from User API
**URI:** `/detachingUser/{userId}/{taskId}`
**Verb:** `GET`
**Request Params:** 
 -   Task ID [Number]
 -   User ID [Number]
 
**Response Formats:** 
- `404`, Not Found 
      **Example**
```
    {
        "errorCode": "404",
        "name": "Data not found."
    }
```
 - `200`, Success
    **Example**
 ```
     {
        "errorCode": "200",
        "name": "Task is detached from user."
    }
 ```

#### 18- Get Task's Users API (Users which are assigned to a task)
**URI:** `task/{id}/users`
**Verb:** `GET`
**Request Params:** 
 -   Task ID [Number]
 
**Response Format:** 
 - `404`, Not Found 
      **Example**
```
    {
        "errorCode": "404",
        "name": "Data not found."
    }
```
 - `200`, Success
   A list of assigned users to a task
  **Example**
```
    [
        {
            "id": 33,
            "name": "fdsdew",
            "email": "a@a.com",
            "isActive": 1,
            "isAdmin": 1
        },
        {
            "id": 1,
            "name": "khapa",
            "email": "abc@abc.com",
            "isActive": 1,
            "isAdmin": 0
        }
    ]
```
#### 19- Create Feedback API
**URI:** `registerFeedback/{user}/{task}`
**Verb:** `POST`
**Request Params:** 
 -   Task ID [Number]
 -   User ID [Number]
**Response Format:** 
 - `404`, Not Found 
      **Example**
```
    {
        "errorCode": "404",
        "name": "Data not found."
    }
```
 - `200`, Success
  **Example**
```
   {
        "description": "dfdf",
        "user_id": 33,
        "task_id": 6,
        "updated_at": "2018-05-09 13:22:25",
        "created_at": "2018-05-09 13:22:25",
        "id": 20
    }
```

#### 20- View Feedbacks API
**URI:** `viewFeedbacks/{user}/{task}`
**Verb:** `GET`
**Request Params:** 
 -   Task ID [Number]
 -   User ID [Number]
**Response Format:** 
 - `404`, Not Found 
      **Example**
```
    {
        "errorCode": "404",
        "name": "Data not found."
    }
```
 - `200`, Success
  **Example**
```
   [
        {
            "id": 18,
            "description": "1",
            "user_id": 1,
            "task_id": 6,
            "created_at": "2018-05-08 10:37:55",
            "updated_at": "2018-05-08 10:37:55"
        },
        {
            "id": 19,
            "description": "2",
            "user_id": 1,
            "task_id": 6,
            "created_at": "2018-05-08 10:37:58",
            "updated_at": "2018-05-08 10:37:58"
        }
    ]
```

#### 21- Feedback Deletion API
**URI:** `deleteFeedback/{id}`
**Verb:** `DELETE`
**Request Params:** 
 -   Feedback ID [Number]
 
**Response Formats:** 
- `404`, Not Found 
      **Example**
```
    {
        "errorCode": "404",
        "name": "Data not found."
    }
```
- `422`, Not Deleted 
      **Example**
```
    {
        "errorCode": "422",
        "name": "Data not deleted."
    }
```
 - `200`, Success
    **Example**
 ```
     {
        "errorCode": "200",
        "name": "Data is deleted."
    }
 ```
 

[//]: # (These are reference links used in the body of this note and get stripped out when the markdown processor does its job. There is no need to format nicely because it shouldn't be seen. Thanks SO - http://stackoverflow.com/questions/4823468/store-comments-in-markdown-syntax)


   [dill]: <https://github.com/joemccann/dillinger>
   [git-repo-url]: <https://github.com/joemccann/dillinger.git>
   [john gruber]: <http://daringfireball.net>
   [df1]: <http://daringfireball.net/projects/markdown/>
   [markdown-it]: <https://github.com/markdown-it/markdown-it>
   [Ace Editor]: <http://ace.ajax.org>
   [node.js]: <http://nodejs.org>
   [Twitter Bootstrap]: <http://twitter.github.com/bootstrap/>
   [jQuery]: <http://jquery.com>
   [@tjholowaychuk]: <http://twitter.com/tjholowaychuk>
   [express]: <http://expressjs.com>
   [AngularJS]: <http://angularjs.org>
   [Gulp]: <http://gulpjs.com>

   [PlDb]: <https://github.com/joemccann/dillinger/tree/master/plugins/dropbox/README.md>
   [PlGh]: <https://github.com/joemccann/dillinger/tree/master/plugins/github/README.md>
   [PlGd]: <https://github.com/joemccann/dillinger/tree/master/plugins/googledrive/README.md>
   [PlOd]: <https://github.com/joemccann/dillinger/tree/master/plugins/onedrive/README.md>
   [PlMe]: <https://github.com/joemccann/dillinger/tree/master/plugins/medium/README.md>
   [PlGa]: <https://github.com/RahulHP/dillinger/blob/master/plugins/googleanalytics/README.md>

 
 






















