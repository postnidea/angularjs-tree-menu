<?php
require '../vendor/autoload.php';
$app = new  \Slim\Slim();
$app->get('/getSelectedCategories/:id',  'getSelectedCategories');
$app->get('/getdata/:lat/:lng/:radius',  'get_data');
$app->get('/validate_key/:key',  'validate_key');
$app->post('/login', 'login');

$app->run();

function getCategories(){
    $sql = "SELECT id, category_name FROM `cms_product_categories` where pid=0";
     try {
        $db = getConnection();
        $stmt = $db->query($sql);
        $categories = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        echo '{"categories": ' . json_encode($categories) . '}';
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}

function getSelectedCategories($id){
 
$sql = "SELECT cpc1.id, cpc1.category_name, cpc.category_name AS parent_category_name, IF( cpc.category_name IS NULL , 0, 1 ) AS contain_levels
FROM `cms_product_categories` AS cpc1
LEFT JOIN cms_product_categories AS cpc ON cpc1.id = cpc.pid
 where cpc1.pid='".$id."' GROUP BY id";
     try {

        $db = getConnection();
        $stmt = $db->prepare($sql);
        $stmt->bindParam("id", $id);
        $stmt->execute();
        $categories = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        echo '{"categories": ' . json_encode($categories) . ', "parents":'. json_encode(finding_all_parents($id)) .'}';
        } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}


function getConnection() {
    $dbhost="localhost";
    $dbuser="root";
    $dbpass="";
    $dbname="menu";
    $dbh = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $dbh;
}

$GLOBALS['all_parents'] = array();

function finding_all_parents($id){
    $all_parents = array();
    find_parent($id);
   // var_dump(array_reverse($GLOBALS['all_parents'] ));
    if(isset($GLOBALS['all_parents']) && count($GLOBALS['all_parents'] ))
    {
       //echo "string123";  var_dump(array_reverse($GLOBALS['all_parents'] ));exit;  
        
        return array_reverse($GLOBALS['all_parents'] );
    }
    else
    {
        return $all_parents ;
    }
}

function find_parent($id)
{
    $sql = "SELECT * FROM `cms_product_categories`  WHERE id=:id";
    try {
        $db = getConnection();
        $stmt = $db->prepare($sql);
        $stmt->bindParam("id", $id);
        $stmt->execute();
        $parent = $stmt->fetchObject();;
        if(is_object($parent))
        {
        
            $GLOBALS['all_parents'][]=array('id'=>$parent->id,'category_name'=>$parent->category_name,'pid'=>$parent->pid); 

            if($parent->pid!=0)
            {
                find_parent($parent->pid);
            }
          }
    }
    catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}


function get_data($lat,$lng,$radius){
       // $radius = 12000;
        //$cordinate = get_geometry($address);
       // $query = "select *from markers where GeoDistDiff('mi','".$cordinate['lat']."','".$cordinate['lon']."',lat,lng)<".$radius;
        $query = "select *from markers where GeoDistDiff('mi','".$lat."','".$lng."',lat,lng)<".$radius;
        $db = getConnection();
        $stmt = $db->query($query);
        $all_cities = $stmt->fetchAll(PDO::FETCH_OBJ);
        //$db = null;
        echo json_encode($all_cities);
}

function secure_get_data($lat,$lng,$radius,$key){
       // $radius = 12000;
        //$cordinate = get_geometry($address);
       // $query = "select *from markers where GeoDistDiff('mi','".$cordinate['lat']."','".$cordinate['lon']."',lat,lng)<".$radius;
        if(validate_key()){
        $query = "select *from markers where GeoDistDiff('mi','".$lat."','".$lng."',lat,lng)<".$radius;
        $db = getConnection();
        $stmt = $db->query($query);
        $all_cities = $stmt->fetchAll(PDO::FETCH_OBJ);
        //$db = null;
        echo json_encode($all_cities);
        } else{

        }    
}

function validate_key($key){
    //echo $key;
    echo date("Y-m-d H:i:s");
}


function get_geometry($address){

    //$address = "India+Panchkula";
    $url = "http://maps.google.com/maps/api/geocode/json?address=$address&sensor=false&region=India";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_PROXYPORT, 3128);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    $response = curl_exec($ch);
    curl_close($ch);
    $response_a = json_decode($response);
    $lat = $response_a->results[0]->geometry->location->lat;
    $long = $response_a->results[0]->geometry->location->lng;
    $return_geometry = array("lat"=>$lat,"lon"=>$long);
    return $return_geometry;
}
// Enhancement for the cookies based location for angular menu
function get_cookies(){
    print_r($_COOKIE);
    // GET current lat
    // get cuurnt lon
}


function login(){
    
    $expire_duration = date("Y-m-d H:i:s",strtotime("+1 hour"));
    $token = md5(mt_rand());
    $app = new \Slim\Slim();
    $username = $app->request->params('username');
    $password = $app->request->params('password');
    $db = getConnection();
    $sql = "select *from tbl_user where username='".$username."' and `password`=md5('".$password."')";
    $stmt = $db->query($sql);
    $user_data = $stmt->fetchAll(PDO::FETCH_OBJ);
    if(count($user_data)){
        $db->query("update tbl_user set token='".$token."', token_expire='".$expire_duration."' where username='".$username."' and `password`=md5('".$password."')");
    }
}

?>