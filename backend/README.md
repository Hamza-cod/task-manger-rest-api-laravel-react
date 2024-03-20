# Task Manager

Task Manager is a Laravel project for managing tasks and projects through a RESTful managing tasks and projects. Users can register, login, create projects, add tasks to their projects, and invite members to collaborate on their projects. Members can view tasks and perform operations on them,  with the creators of these tasks a having exclusive rights to modify or delete their own tasks.
- i use the policys  for make the rights authorization for the users , in ProjectPolicy : the creator just who can add members and update or delete this project and also the members who can acsses this project          
- observers event  : ise it for add the creator in members in the same time he create this project







## Usage

You can interact with the Task Manager API using the provided endpoints.

- **Register a new user**: `POST /api/register`
- **Login user**: `POST /api/login`
- **Create a new project**: `POST /api/projects`
- **Get all projects of the authenticated user**: `GET /api/projects`
- **Invite a user to a project by email**: `POST /api/projects/{project}/add_member`
- **Get details of a specific project**: `GET /api/projects/{project}`
- **Add a task to a project**: `POST /api/tasks`
- **Get all tasks**: `GET /api/tasks`
- **Update a task**: `PUT /api/tasks/{task}``
- **Delete a task**: `DELETE /api/tasks/{task}`



##### created by   :hamza maouhoub
