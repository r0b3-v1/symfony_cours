# Notes on Symfony
This file will compile notes regarding Symfony 5.4 

## Install a Symfony project
You'll first need **Composer** and have php installed on your computer. Check your environment variables to make sure that the php command is recognized.
 <font color=#F0C050>**You will need php 7.2.5 or higher to run a Symfony 5.4. project**</font>
Once this is done, go to your server folder then open the console in it.

Type `composer create-project symfony/skeleton:"^5.4" your_project_name`

This will create a folder with the specified name and create the structure for your symfony project
Then, if you have a git repo, make sure to link it to your project.
Once this is done, if you want to create a standard web project, type the command 

    composer require webapp
This will install all the required dependancies

You can then create a copy of your env file and rename it **env.local**
This will be used to define the developing environment of your project

## Server for testing
	php -S localhost:3000 -t public/
This command allows to run a local server. Go to localhost:3000/ to test

Alternatively, you can use the default localhost/your_project/ to test

## Create a <font color=#3d99e0>Controller</font>
Controllers's main purpose is to implement the logic of your code and render the views.
2 ways to do so : 

### The command line <font color=green> (prefered way) </font>
In the console, position yourself at the root of your project then type :

    php bin/console make:controller
The script will ask you to give a name to the controller and will take care of the rest.

### Manually
Go to **src/Controller** > new file > create a new class that extends AbstractController
Dont forget to import the required class.
A controller must return a **Response**
Several ways to do so : 

    return new Response('foo.html.twig');

    return $this->render('viewPath',['param1'=>$param1,...]);

    return $this->redirectToRoute('pathName',['param1'=>$param1,...]);

The **views** you will render are located in the **templates** folder. Those are twig files. 

## <font color=#3d99e0>Routing</font>

To access the controller, you need to specify a route. 2 ways to do so:
### Use annotations <font color=green> (prefered way) </font>

    /**
    * @Route("/home", name="home")
    */
    public  function  home(): Response{
    return  $this->render('home.html.twig',['coucou'=>'salut']);
    }
First param : the route the user will have to access via the url, second param : the name of the route you'll be able to use in redirections.
You will have to import the Route class in order to use annotations.

       use Symfony\Component\Routing\Annotation\Route;


**You can add `parameters` to the route url**

    /**
    * @Route("/jeux/{id}", name="app_jeux_details")
    */
You will have to add the parameters in the function arguments


### Change the routes.yaml file
Go to **config/routes.yaml** then type in the new route for the controller and its method

    home:
    path: /
    controller: App\Controller\HomeController::home

### Priority
If you put the same route in an annotation and in the routes.yaml file, the one in the file will be the one rendered, and the route of the annotation will be overwritten (ie : the url defined in the annotation won't be relevant anymore).
You can use the yaml file to make redirections to existing routes without needing to write new Controllers.

## The <font color=#3d99e0>Model</font>

### configure the DB
The model classes will be created in the Entity folder

First thing to do : configure the local env file to define the Database we are using

    DATABASE_URL="mysql://username:password@127.0.0.1:3306/databaseName?serverVersion=5.7&charset=utf8mb4"
Or
 
    DATABASE_URL="mysql://username:password@127.0.0.1:3306/databaseName"
Then to create the database, run:

    php bin/console doctrine:database:create


### Create an entity

This can be done manually however the prefered method is to use the command lines to do it: 

 

    php bin/console make:entity

This will create a new Entity in the Entity folder representing a table in the database containing the columns you will provide.

### Add relations between entities
Use the `php bin/console make:entity` to create a relation. In the type proposition, type relation to add the desired relation.
If you want doctrine to get all the related entities to an entity, you have to add the parameter `fetch="EAGER"` in the annotation of the attribute linking this entity to the other

### Migrations
Migrations are used to update the database accordingly to your entities. Creating a migration is like committing your entities.

    php bin/console make:migration

This will add a migration containing the informations needed to update the database with the new entities
Then, to execute the migration : 

    php bin/console doctrine:migrations:migrate
The database will be modified accordingly to the last migration created

## <font color=#3d99e0>Twig</font>


