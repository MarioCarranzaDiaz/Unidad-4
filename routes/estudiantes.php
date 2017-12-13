<?php
use \Psr\Http\Message\ServerRequestInterface  as  Request;
use \Psr\Http\Message\ResponseInterface as  Response;

$app  = new\Slim\App;

// Obtener todos los estudiantes

$app->get('/api/estudiantes', function(Request  $request, Response $response){
  //echo "Estudiantes";
$sql  = "select * from estudiante";

try{
  // Get DB Object
  $db = new db();
  // Connect
  $db = $db->connect();

  $stmt = $db->query($sql);
  $estudiantes  = $stmt->fetchAll(PDO::FETCH_OBJ);
  $db = null;
  echo json_encode($estudiantes);
} catch(PDOException  $e){
  echo '{"error": {"text":  '.$e->getMessage().'}';

    }
});

// Obtener un estudiante por no de control
$app->get('/api/estudiantes/{nocontrol}', function(Request $request, Response $response){
    $nocontrol = $request->getAttribute('nocontrol');
    $sql = "SELECT * FROM estudiante WHERE nocontrol = $nocontrol";
    try{
        // Obtener el objeto DB
        $db = new db();
        // Conectar
        $db = $db->connect();
        $stmt = $db->query($sql);
        $estudiante = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        echo json_encode($estudiante);
    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});

// Agregar un estudiante
$app->post('/api/estudiantes/add', function(Request $request, Response $response){
    $nocontrol = $request->getParam('nocontrol');
    $nombre = $request->getParam('nombre');
    $apellidop = $request->getParam('apellidop');
    $apellidom = $request->getParam('apellidom');
    $semestre = $request->getParam('semestre');
    $carrera_clave = $request->getParam('carrera_clave');
    $sql = "INSERT INTO estudiante (nocontrol, nombre, apellidop, apellidom, semestre, carrera_clave) VALUES (:nocontrol, :nombre, :apellidop, :apellidom, :semestre, :carrera_clave)";
    try{
        // Obtener el objeto DB
        $db = new db();
        // Conectar
        $db = $db->connect();
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':nocontrol',      $nocontrol);
        $stmt->bindParam(':nombre',         $nombre);
        $stmt->bindParam(':apellidop',      $apellidop);
        $stmt->bindParam(':apellidom',      $apellidom);
        $stmt->bindParam(':semestre',       $semestre);
        $stmt->bindParam(':carrera_clave',  $carrera_clave);
        $stmt->execute();
        echo '{"notice": {"text": "Estudiante agregado"}';
    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});

// Actualizar estudiante
$app->put('/api/estudiantes/update/{nocontrol}', function(Request $request, Response $response){
    $nocontrol = $request->getParam('nocontrol');
    $nombre = $request->getParam('nombre');
    $apellidop = $request->getParam('apellidop');
    $apellidom = $request->getParam('apellidom');
    $semestre = $request->getParam('semestre');
    $carrera_clave = $request->getParam('carrera_clave');
    $sql = "UPDATE estudiante SET
                nocontrol               = :nocontrol,
                nombre       = :nombre,
                apellidop   = :apellidop,
                apellidom   = :apellidom,
                semestre                = :semestre,
                carrera_clave           = :carrera_clave
            WHERE nocontrol = $nocontrol";
    try{
        // Obtener el objeto DB
        $db = new db();
        // Conectar
        $db = $db->connect();
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':nocontrol',      $nocontrol);
        $stmt->bindParam(':nombre',         $nombre);
        $stmt->bindParam(':apellidop',      $apellidop);
        $stmt->bindParam(':apellidom',      $apellidom);
        $stmt->bindParam(':semestre',       $semestre);
        $stmt->bindParam(':carrera_clave',  $carrera_clave);
        $stmt->execute();
        echo '{"notice": {"text": "Estudiante actualizado"}';
    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});


// Borrar estudiante
$app->delete('/api/estudiantes/delete/{nocontrol}', function(Request $request, Response $response){
  $nocontrol = $request->getAttribute('nocontrol');
  $sql = "DELETE FROM estudiante WHERE nocontrol = $nocontrol";
  try{
      // Obtener el objeto DB
      $db = new db();
      // Conectar
      $db = $db->connect();
      $stmt = $db->prepare($sql);
      $stmt->execute();
      $db = null;
      echo '{"notice": {"text": "Estudiante eliminado"}';
  } catch(PDOException $e){
      echo '{"error": {"text": '.$e->getMessage().'}';
  }
});

//CARRERAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA

$app->get('/api/carrera', function(Request  $request, Response $response){
  //echo "Estudiantes";
$sql  = "select * from carrera";

try{
  // Get DB Object
  $db = new db();
  // Connect
  $db = $db->connect();

  $stmt = $db->query($sql);
  $carrera  = $stmt->fetchAll(PDO::FETCH_OBJ);
  $db = null;
  echo json_encode($carrera);
} catch(PDOException  $e){
  echo '{"error": {"text":  '.$e->getMessage().'}';

    }
});

// Obtener un estudiante por no de control
$app->get('/api/carrera/{clave}', function(Request $request, Response $response){
    $clave = $request->getAttribute('clave');
    $sql = "SELECT * FROM carrera WHERE  clave = $clave";
    try{
        // Obtener el objeto DB
        $db = new db();
        // Conectar
        $db = $db->connect();
        $stmt = $db->query($sql);
        $carrera = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        echo json_encode($carrera);
    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});

//Agregar un estudiante
$app->post('/api/carrera/add', function(Request $request, Response $response){
    $clave= $request->getParam('clave');
    $nombre = $request->getParam('nombre');

    $sql = "INSERT INTO carrera (clave, nombre) VALUES (:clave, :nombre)";
    try{
        // Obtener el objeto DB
        $db = new db();
        // Conectar
        $db = $db->connect();
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':clave',      $clave);
        $stmt->bindParam(':nombre',         $nombre);
        $stmt->execute();
        echo '{"notice": {"text": "carrera agregada"}';
    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});



// Actualizar estudiante
$app->put('/api/carrera/update/{clave}', function(Request $request, Response $response){
    $clave = $request->getParam('clave');
    $nombre = $request->getParam('nombre');

    $sql = "UPDATE carrera SET clave = :clave, nombre= :nombre  WHERE clave='".$clave."'";
    try{
        // Obtener el objeto DB
        $db = new db();
        // Conectar
        $db = $db->connect();
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':clave',      $clave);
        $stmt->bindParam(':nombre',         $nombre);
        $stmt->execute();
        echo '{"notice": {"text": "Carrera actualizada"}';
    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});


// Borrar estudiante
$app->delete('/api/carrera/delete/{clave}', function(Request $request, Response $response){
  $clave = $request->getAttribute('clave');
  $sql = "DELETE FROM carrera WHERE clave = $clave";
  try{
      // Obtener el objeto DB
      $db = new db();
      // Conectar
      $db = $db->connect();
      $stmt = $db->prepare($sql);
      $stmt->execute();
      $db = null;
      echo '{"notice": {"text": "Carrera eliminada"}';
  } catch(PDOException $e){
      echo '{"error": {"text": '.$e->getMessage().'}';
  }
});

// I N S T R U C T O RRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRR


$app->get('/api/instructor', function(Request  $request, Response $response){
  //echo "Estudiantes";
$sql  = "select * from instructor";

try{
  // Get DB Object
  $db = new db();
  // Connect
  $db = $db->connect();

  $stmt = $db->query($sql);
  $instructor  = $stmt->fetchAll(PDO::FETCH_OBJ);
  $db = null;
  echo json_encode($instructor);
} catch(PDOException  $e){
  echo '{"error": {"text":  '.$e->getMessage().'}';

    }
});

// Obtener un estudiante por no de control
$app->get('/api/instructor/{rfc}', function(Request $request, Response $response){
    $rfc = $request->getAttribute('rfc');
    $sql = "SELECT * FROM instructor WHERE rfc= $rfc";
    try{
        // Obtener el objeto DB
        $db = new db();
        // Conectar
        $db = $db->connect();
        $stmt = $db->query($sql);
        $instructor = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        echo json_encode($instructor);
    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});

// Agregar un estudiante
$app->post('/api/instructor/add', function(Request $request, Response $response){
    $rfc = $request->getParam('rfc');
    $nombre = $request->getParam('nombre');
    $apellido_p = $request->getParam('apellido_p');
    $apellido_m = $request->getParam('apellido_m');
    $act_complementaria_clave_act = $request->getParam('act_complementaria_clave_act');
    $sql = "INSERT INTO instructor (rfc, nombre, apellido_p, apellido_m, act_complementaria_clave_act ) VALUES (:rfc,:nombre,:apellido_p,:apellido_m,:act_complementaria_clave_act)";
    try{
        // Obtener el objeto DB
        $db = new db();
        // Conectar
        $db = $db->connect();
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':rfc',             $rfc);
        $stmt->bindParam(':nombre',          $nombre);
        $stmt->bindParam(':apellido_p',      $apellido_p);
        $stmt->bindParam(':apellido_m',      $apellido_m);
        $stmt->bindParam(':act_complementaria_clave_act',  $act_complementaria_clave_act);
        $stmt->execute();
        echo '{"notice": {"text": "Instructor agregado"}';
    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});

// Actualizar estudiante
$app->put('/api/instructor/update/{rfc}', function(Request $request, Response $response){
    $rfc= $request->getParam('rfc');
    $nombre = $request->getParam('nombre');
    $apellido_p = $request->getParam('apellido_p');
    $apellido_m = $request->getParam('apellido_m');

    $act_complementaria_clave_act = $request->getParam('act_complementaria_clave_act');
    $sql = "UPDATE instructor SET  rfc = :rfc, nombre = :nombre, apellido_p = :apellido_p, apellido_m   = :apellido_m, act_complementaria_clave_act   = :act_complementaria_clave_act
            WHERE rfc ='".$rfc."'";
    try{
        // Obtener el objeto DB
        $db = new db();
        // Conectar
        $db = $db->connect();
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':rfc',      $rfc);
        $stmt->bindParam(':nombre',         $nombre);
        $stmt->bindParam(':apellido_p',      $apellido_p);
        $stmt->bindParam(':apellido_m',      $apellido_m);

        $stmt->bindParam(':act_complementaria_clave_act',  $act_complementaria_clave_act);
        $stmt->execute();
        echo '{"notice": {"text": "instructor actualizado"}';
    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});



// Borrar estudiante
$app->delete('/api/instructor/delete/{rfc}', function(Request $request, Response $response){
  $rfc = $request->getAttribute('rfc');
  $sql = "DELETE FROM instructor WHERE rfc= $rfc";
  try{
      // Obtener el objeto DB
      $db = new db();
      // Conectar
      $db = $db->connect();
      $stmt = $db->prepare($sql);
      $stmt->execute();
      $db = null;
      echo '{"notice": {"text": "instructor eliminado"}';
  } catch(PDOException $e){
      echo '{"error": {"text": '.$e->getMessage().'}';
  }
});

// INSTITUTOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOO


$app->get('/api/instituto', function(Request  $request, Response $response){
  //echo "Estudiantes";
$sql  = "select * from instituto";

try{
  // Get DB Object
  $db = new db();
  // Connect
  $db = $db->connect();

  $stmt = $db->query($sql);
  $instituto = $stmt->fetchAll(PDO::FETCH_OBJ);
  $db = null;
  echo json_encode($instituto);
} catch(PDOException  $e){
  echo '{"error": {"text":  '.$e->getMessage().'}';

    }
});


// Obtener un estudiante por no de control
$app->get('/api/instituto/{clave}', function(Request $request, Response $response){
    $clave = $request->getAttribute('clave');
    $sql = "SELECT * FROM instituto WHERE clave = $clave";
    try{
        // Obtener el objeto DB
        $db = new db();
        // Conectar
        $db = $db->connect();
        $stmt = $db->query($sql);
        $instituto = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        echo json_encode($instituto);
    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});

// Agregar un estudiante
$app->post('/api/instituto/add', function(Request $request, Response $response){
    $clave = $request->getParam('clave');
    $nombre = $request->getParam('nombre');

    $sql = "INSERT INTO instituto (clave, nombre) VALUES (:clave, :nombre)";
    try{
        // Obtener el objeto DB
        $db = new db();
        // Conectar
        $db = $db->connect();
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':clave',      $clave);
        $stmt->bindParam(':nombre',         $nombre);

        $stmt->execute();
        echo '{"notice": {"text": "Instituto agregado"}';
    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});


// Actualizar estudiante
$app->put('/api/instituto/update/{clave}', function(Request $request, Response $response){
    $clave = $request->getParam('clave');
    $nombre = $request->getParam('nombre');

    $sql = "UPDATE instituto SET clave = :clave, nombre = :nombre WHERE clave ='".$clave."'";
    try{
        // Obtener el objeto DB
        $db = new db();
        // Conectar
        $db = $db->connect();
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':clave',      $clave);
        $stmt->bindParam(':nombre',         $nombre);

        $stmt->execute();
        echo '{"notice": {"text": "Instituto actualizado"}';
    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});


// Borrar estudiante
$app->delete('/api/instituto/delete/{clave}', function(Request $request, Response $response){
  $clave = $request->getAttribute('clave');
  $sql = "DELETE FROM instituto WHERE clave = $clave";
  try{
      // Obtener el objeto DB
      $db = new db();
      // Conectar
      $db = $db->connect();
      $stmt = $db->prepare($sql);
      $stmt->execute();
      $db = null;
      echo '{"notice": {"text": "Instituto eliminado"}';
  } catch(PDOException $e){
      echo '{"error": {"text": '.$e->getMessage().'}';
  }
});

//TRABAJADORRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRR


$app->get('/api/trabajador', function(Request  $request, Response $response){
  //echo "Estudiantes";
$sql  = "select * from trabajador";

try{
  // Get DB Object
  $db = new db();
  // Connect
  $db = $db->connect();

  $stmt = $db->query($sql);
  $trabajador  = $stmt->fetchAll(PDO::FETCH_OBJ);
  $db = null;
  echo json_encode($trabajador);
} catch(PDOException  $e){
  echo '{"error": {"text":  '.$e->getMessage().'}';

    }
});

// Obtener un estudiante por no de control
$app->get('/api/trabajador/{rfc}', function(Request $request, Response $response){
    $rfc = $request->getAttribute('rfc');
    $sql = "SELECT * FROM trabajador WHERE rfc = $rfc";
    try{
        // Obtener el objeto DB
        $db = new db();
        // Conectar
        $db = $db->connect();
        $stmt = $db->query($sql);
        $trabajador = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        echo json_encode($trabajador);
    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});

// Agregar un estudiante
$app->post('/api/trabajador/add', function(Request $request, Response $response){
    $rfc = $request->getParam('rfc');
    $nombre = $request->getParam('nombre');
    $apellido_p = $request->getParam('apellido_p');
    $apellido_m = $request->getParam('apellido_m');
    $clave_presupuestal= $request->getParam('clave_presupuestal');
    $sql = "INSERT INTO trabajador (rfc, nombre, apellido_p, apellido_m, clave_presupuestal) VALUES (:rfc, :nombre, :apellido_p, :apellido_m, :clave_presupuestal)";
    try{
        // Obtener el objeto DB
        $db = new db();
        // Conectar
        $db = $db->connect();
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':rfc',      $rfc);
        $stmt->bindParam(':nombre',         $nombre);
        $stmt->bindParam(':apellido_p',      $apellido_p);
        $stmt->bindParam(':apellido_m',      $apellido_m);
        $stmt->bindParam(':clave_presupuestal',  $clave_presupuestal);
        $stmt->execute();
        echo '{"notice": {"text": "Trabajador agregado"}';
    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});

// Actualizar estudiante
$app->put('/api/trabajador/update/{rfc}', function(Request $request, Response $response){
    $rfc= $request->getParam('rfc');
    $nombre = $request->getParam('nombre');
    $apellido_p = $request->getParam('apellido_p');
    $apellido_m = $request->getParam('apellido_m');
    $clave_presupuestal = $request->getParam('clave_presupuestal');
    $sql = "UPDATE trabajador SET rfc = :rfc, nombre = :nombre, apellido_p = :apellido_p, apellido_m = :apellido_m, clave_presupuestal = :clave_presupuestal WHERE rfc = '".$rfc."'";
    try{
        // Obtener el objeto DB
        $db = new db();
        // Conectar
        $db = $db->connect();
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':rfc',      $rfc);
        $stmt->bindParam(':nombre',         $nombre);
        $stmt->bindParam(':apellido_p',      $apellido_p);
        $stmt->bindParam(':apellido_m',      $apellido_m);
        $stmt->bindParam(':clave_presupuestal',  $clave_presupuestal);
        $stmt->execute();
        echo '{"notice": {"text": "Trabajador actualizado"}';
    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});


// Borrar estudiante
$app->delete('/api/trabajador/delete/{rfc}', function(Request $request, Response $response){
  $rfc = $request->getAttribute('rfc');
  $sql = "DELETE FROM trabajador WHERE rfc = $rfc";
  try{
      // Obtener el objeto DB
      $db = new db();
      // Conectar
      $db = $db->connect();
      $stmt = $db->prepare($sql);
      $stmt->execute();
      $db = null;
      echo '{"notice": {"text": "Trabajador eliminado"}';
  } catch(PDOException $e){
      echo '{"error": {"text": '.$e->getMessage().'}';
  }
});
