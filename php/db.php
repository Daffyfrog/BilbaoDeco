<?php
ini_set('display_startup_errors',1);
ini_set('display_errors',1);
error_reporting(-1);
$host = "localhost";
$user = "kayou";
$pass = "patate";
$database = "bilbaodeco";
if($con = mysqli_connect($host, $user, $pass, $database, 3306)){
    mysqli_select_db($con, $database);

}else{
    print_r(json_encode(array(['err' => "could not connect"])));

}


//echo 'Connected successfully';


/**  Switch Case to Get Action from controller  **/

switch($_GET['action'])  {
    case 'login' :
        login($con);
        break;
    case 'getArticles':
        getArticles($con);
        break;
    case 'getArticleById' :
        getArticleById($con);
        break;
    case 'insertArticle':
        insertArticle($con);
        break;
}

/** Login function
 * @param $con
 * SQLi Connection
 */
function login($con){
    $data = json_decode(file_get_contents("php://input"));
    $user_login = $data->login;
    $user_password = md5($data->password);
    try{
        $query = 'SELECT * FROM admin WHERE login="' . $user_login . '" AND password ="' . $user_password . '";';
        $query_res = mysqli_query($con, $query);
        if($donnees = mysqli_fetch_assoc($query_res))
        {
            $arr = array('login_ok' => true);

        } else {
            $arr = array('login_ok' => false);

        }
        mysqli_free_result($query_res);
        print_r(json_encode($arr));
    } catch (Exception $e){
        error_log($e);
    }
}

function getArticleById($con){
    $data = json_decode(file_get_contents("php://input"));
    $article_id = $data->article_id;
    $article = [];
    try{
        $query = 'SELECT * FROM article WHERE idarticle = ' . $article_id . ';';
        $query_res = mysqli_query($con, $query);
        if($donnees = mysqli_fetch_assoc($query_res))
        {
            $article = [
            'idarticle' => $donnees['idarticle'],
            'title' => $donnees['title'],
            'date' => $donnees['date'],
            'text' => $donnees['text'],
            'author' => $donnees['author'],
            'thumb' => $donnees['thumb']
            ];


        }
        mysqli_free_result($query_res);
        print_r(json_encode($article));
    } catch (Exception $e){
        error_log($e);
    }
}

function getArticles($con){
    $data = json_decode(file_get_contents("php://input"));
    try{
        $query = 'SELECT * FROM article WHERE ispage != 1 limit 5;';
        $query_res = mysqli_query($con, $query);
        $articles = [];
        while($donnees = mysqli_fetch_assoc($query_res))
        {
            $articles[] = array('idarticle' => $donnees['idarticle'], 'title' => $donnees['title'], 'date' => $donnees['date'], 'text' => $donnees['text'], 'author' => $donnees['author'], 'thumb' => $donnees['thumb']);
        }
        mysqli_free_result($query_res);
        print_r(json_encode($articles));
    } catch (Exception $e){
        error_log($e);
    }
}
function getPages($con){
    $data = json_decode(file_get_contents("php://input"));
    try{
        $query = 'SELECT * FROM article WHERE ispage = 1 limit 5;';
        $query_res = mysqli_query($con, $query);
        $articles = [];
        while($donnees = mysqli_fetch_assoc($query_res))
        {
            $articles[] = array('idarticle' => $donnees['idarticle'], 'title' => $donnees['title'], 'date' => $donnees['date'], 'text' => $donnees['text'], 'author' => $donnees['author'], 'thumb' => $donnees['thumb']);
        }
        mysqli_free_result($query_res);
        print_r(json_encode($articles));
    } catch (Exception $e){
        error_log($e);
    }
}
function insertArticle($con){
    $data = json_decode(file_get_contents("php://input"));
    $title = $data->title;
    $text = $data->text;
    $file_name = $data->file_name;
    $author = $data->author;
    try{
        $query = 'INSERT INTO article (title, text, thumb, date, author, ispage) values ("' . $title . '","' . $text . '","' . $file_name . '","'. date("Y-m-d H:i:s") . '","'. $author . '",0)';
        $query_res = mysqli_query($con, $query);
        if ($query_res) {
            $arr = array('msg' => "Ajout de l'article effectué !", 'error' => '', 'id' => mysqli_insert_id($con));
            $jsn = json_encode($arr);
            // print_r($jsn);
        }
        else {
            $arr = array('msg' => "", 'error' => 'Error In inserting record');
            $jsn = json_encode($arr);
            // print_r($jsn);
        }
        print_r($jsn);
    } catch (Exception $e){
        error_log($e);
    }
}
function editArticle($con){
    $data = json_decode(file_get_contents("php://input"));
    $id = $data->id
    $title = $data->title;
    $text = $data->text;
    $file_name = $data->file_name;
    $author = $data->author;
    try{
        $query = 'UPDATE article SET title = "' . $title. '", text = "' . $text. '", thumb, date, author) values ("' . $title . '","' . $text . '","' . $file_name . '","'. date("Y-m-d H:i:s") . '","'. $author . '",0)';
        $query_res = mysqli_query($con, $query);
        if ($query_res) {
            $arr = array('msg' => "Ajout de l'article effectué !", 'error' => '', 'id' => mysqli_insert_id($con));
            $jsn = json_encode($arr);
            // print_r($jsn);
        }
        else {
            $arr = array('msg' => "", 'error' => 'Error In inserting record');
            $jsn = json_encode($arr);
            // print_r($jsn);
        }
        print_r($jsn);
    } catch (Exception $e){
        error_log($e);
    }
}
/*
function add_product() {
    $data = json_decode(file_get_contents("php://input")); 
    $prod_name      = $data->prod_name;    
    $prod_desc      = $data->prod_desc;
    $prod_price     = $data->prod_price;
    $prod_quantity  = $data->prod_quantity;
 
    print_r($data);
    $qry = 'INSERT INTO product (prod_name,prod_desc,prod_price,prod_quantity) values ("' . $prod_name . '","' . $prod_desc . '",' .$prod_price . ','.$prod_quantity.')';
   
    $qry_res = mysqli_query($con, $qry);
    if ($qry_res) {
        $arr = array('msg' => "Product Added Successfully!!!", 'error' => '');
        $jsn = json_encode($arr);
        // print_r($jsn);
    }
    else {
        $arr = array('msg' => "", 'error' => 'Error In inserting record');
        $jsn = json_encode($arr);
        // print_r($jsn);
    }
}


function get_product() {    
    $qry = mysqli_query('SELECT * from product');
    $data = array();
    while($rows = mysqli_fetch_array($qry))
    {
        $data[] = array(
                    "id"            => $rows['id'],
                    "prod_name"     => $rows['prod_name'],
                    "prod_desc"     => $rows['prod_desc'],
                    "prod_price"    => $rows['prod_price'],
                    "prod_quantity" => $rows['prod_quantity']
                    );
    }
    print_r(json_encode($data));
    return json_encode($data);  
}



function delete_product() {
    $data = json_decode(file_get_contents("php://input"));     
    $index = $data->prod_index;     
    //print_r($data)   ;
    $del = mysqli_query("DELETE FROM product WHERE id = ".$index);
    if($del)
    return true;
    return false;     
}



function edit_product() {
    $data = json_decode(file_get_contents("php://input"));     
    $index = $data->prod_index; 
    $qry = mysqli_query('SELECT * from product WHERE id='.$index);
    $data = array();
    while($rows = mysqli_fetch_array($qry))
    {
        $data[] = array(
                    "id"            =>  $rows['id'],
                    "prod_name"     =>  $rows['prod_name'],
                    "prod_desc"     =>  $rows['prod_desc'],
                    "prod_price"    =>  $rows['prod_price'],
                    "prod_quantity" =>  $rows['prod_quantity']
                    );
    }
    print_r(json_encode($data));
    return json_encode($data);  
}



function update_product() {
    $data = json_decode(file_get_contents("php://input")); 
    $id             =   $data->id;
    $prod_name      =   $data->prod_name;    
    $prod_desc      =   $data->prod_desc;
    $prod_price     =   $data->prod_price;
    $prod_quantity  =   $data->prod_quantity;
   // print_r($data);
    
    $qry = "UPDATE product set prod_name='".$prod_name."' , prod_desc='".$prod_desc."',prod_price='.$prod_price.',prod_quantity='.$prod_quantity.' WHERE id=".$id;
  
    $qry_res = mysqli_query($qry);
    if ($qry_res) {
        $arr = array('msg' => "Product Updated Successfully!!!", 'error' => '');
        $jsn = json_encode($arr);
        // print_r($jsn);
    } else {
        $arr = array('msg' => "", 'error' => 'Error In Updating record');
        $jsn = json_encode($arr);
        // print_r($jsn);
    }
}*/

?>