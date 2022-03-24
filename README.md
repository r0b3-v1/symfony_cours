# Notes on Symfony
This file will compile notes regarding Symfony 5.4 

## Install a Symfony project
You'll first need **Composer** and have php installed on your computer. Check your environment variables to make sure that the php command is recognized.
Once this is done, go to your server folder then open the console in it.
type `composer create-project symfony/skeleton:"^5.4" your_project_name`
this will create a folder with the specified name and create the structure for your symfony project
then, if you have a git repo, make sure to link it to your project.
Once this is done, if you want to create a standard web project, type the command 

    composer require webapp
this will install all the required dependancies

you can then create a copy of your env file and rename it **env.local**
this will be used to define the developing environment of your project

## Server for testing
	php -S localhost:3000 -t public/
This command allows to run a local server. Go to localhost:3000/ to test

Alternatively, you can use the default localhost/your_project/ to test

## Create a controller

Go to **src/Controller** > new file > create a new class that extends AbstractController
***or***
In the console, position yourself at the root of your project then type :

    php bin/console make:controller

Dont forget to import the required class.
A controller must return a **Response**
several ways to do so : 

    return new Response('foo.html.twig');

    return $this->render('viewPath',['param1'=>$param1,...]);

    return $this->redirectToRoute('pathName',['param1'=>$param1,...]);

The **views** you will render are located in the **templates** folder. Those are twig files. 

## Routing

To access the controller, you need to specify a route. 2 ways to do so:
### Use annotations

    /**
    * @Route("/home", name="home")
    */
    public  function  home(): Response{
    return  $this->render('home.html.twig',['coucou'=>'salut']);
    }
first param : the route the user will have to access via the url, second param : the name of the route you'll be able to use in redirections.

### Change the routes.yaml file
go to **config/routes.yaml** then type in the new route for the controller and its method

    home:
    path: /
    controller: App\Controller\HomeController::home


