<?php
    /**
    * @backupGlobals disabled
    *$backupStaticAttribute disabled
    */

    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Client.php";
    require_once __DIR__."/../src/Stylist.php";

    $app = new Silex\Application();
    $app['debug'] = TRUE;

    //$DB = new PDO('pgsql:host=localhost;dbname=hair_salon');
    try {
    $DB = new PDO('mysql:host=localhost;dbname=suchi', 'root', 'chitraphp');
    $DB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $DB->exec("SET NAMES 'utf8'");
    } catch(PDOException $e) {
    echo 'ERROR: ' . $e->getMessage();
    }

    $servername = "localhost";
    $username = "root";
    $password = "chitraphp";

    $app->register(new Silex\Provider\TwigServiceProvider(), array(
        'twig.path' => __DIR__.'/../views'
    ));

    use Symfony\Component\HttpFoundation\Request;
    Request::enableHttpMethodParameterOverride();

    $app->get("/", function() use ($app){
        return $app['twig']->render('index.html.twig', array('stylists'=>Stylist::getAll()));
    });

    $app->post("/stylists", function() use ($app){
        $stylist = new Stylist($id = null, $_POST['stylist_name']);
        $stylist->save();
        return $app['twig']->render('index.html.twig', array('stylists'=>Stylist::getAll()));
    });

    $app->get("/stylists/{id}", function($id) use ($app){
        $stylist = Stylist::find($id) ;
        return $app['twig']->render('clients.html.twig', array('stylist'=>$stylist,'clients'=>Stylist::getStylistClients()));
    });

    $app->get("/stylists/{id}/edit", function($id) use ($app){
            $stylist = Stylist::find($id);
            return $app['twig']->render('stylist_edit.html.twig', array('stylist' => $stylist));
    });

    $app->patch("/stylists/{id}", function($id) use ($app) {
            $stylist_name = $_POST['stylist_name'];
            $stylist = Stylist::find($id);
            $stylist->updateStylist($stylist_name);
            return $app['twig']->render('index.html.twig', array('stylists' =>Stylist::getAll()));
    });

    $app->delete("/stylists/{id}", function($id) use ($app) {
        $stylist = Stylist::find($id);
        $stylist->deleteStylist($id);
        return $app['twig']->render('index.html.twig', array('stylists' =>Stylist::getAll()));
    });

    $app->post("/clients", function() use ($app){
        $client_name = $_POST['client_name'];
        $stylist_id = $_POST['stylist_id'];
        $client = new Client($id = null, $client_name, $stylist_id);
        $client->save();
        $stylist = Stylist::find($stylist_id);
        return $app['twig']->render('clients.html.twig',array('stylist'=>$stylist, 'clients'=>$stylist->getStylistClients()));
    });

    $app->get("/clients/{id}/edit", function($id) use ($app){
            $client = Client::find($id);
            return $app['twig']->render('client_edit.html.twig', array('client' => $client));
    });

    $app->patch("/clients/{id}", function($id) use ($app) {
            $client_name = $_POST['client_name'];
            $client = Client::find($id);
            $client->updateClient($client_name);
            $stylist_id = $client->getStylistId();
            $stylist = Stylist::find($stylist_id)
            return $app['twig']->render('clients.html.twig', array('stylist'=>$stylist, 'clients'=>$stylist->getStylistClients()));
    });

    $app->delete("/clients/{id}", function($id) use ($app) {
        $client = Client::find($id);
        $client->deleteClient($id);
        return $app['twig']->render('index.twig', array('stylists' =>Stylist::getAll()));
    });


    return $app;
?>
