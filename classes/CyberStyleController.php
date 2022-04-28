<?php

class CyberStyleController {
    private $command;

    private $db;

    public function __construct($command) {
        $this->command = $command;
        $this->db = new Database();
    }
    
    public function run() {
        switch($this->command) {
            case "sign-up":
                $this->sign_up();
                break;
            case "wardrobe":
                $this->wardrobe();
                break;
            case "view-all-clothes":
                $this->view_all_clothes();
                break;
            case "Shirt":
            case "Dress":
            case "Pants": 
            case "Outerwear":
            case "Shoes":
            case "Accessories":
                $this->query_clothes($this->command);
                break;
            case "shirts":
            case "dresses":
            case "pants":
            case "outerwear":
            case "shoes":
            case "accessories":
                $this->clothing_by_category($this->command);
                break;
            case "add-to-closet":
                $this->add_to_closet();
                break;
            case "delete-from-closet":
                $this->delete_from_closet();
                break;
            case "search-clothes":
                $this->search_clothes();
                break;
            case "create-new-outfit":
                $this -> create_new_outfit();
                break; 
            case "logout":
                $this->logout();
            case "login":
                $this->login();
                break;
            default:
                $this->home();
                break;
        }
    }

    public function home() {
        include('templates/home.php');
    }

    public function sign_up() {
        $message = "";
        $error_msg = ""; 
        if (isset($_POST["email"])) {
            $regex = "/^([a-zA-Z0-9\.]+@+[a-zA-Z]+(\.)+[a-zA-Z]{2,3})$/";
            if (preg_match($regex, $_POST["email"]) === 1) {
                $user_id = $this->db->query("select id from users where email = ?;", "s", $_POST["email"]);
                print($user_id);
                if ($user_id === false || empty($user_id)) {
                    $insert = $this->db->query("insert into users (name, email, password) values (?, ?, ?);", 
                    "sss", $_POST["name"], $_POST["email"], 
                    password_hash($_POST["password"], PASSWORD_DEFAULT));
                    if ($insert === false) {
                        $error_msg = "Error inserting user";
                    }
                    setcookie("logged_in", "true", time() + 3600); 
                    $_SESSION["name"] = $_POST["name"];
                    $_SESSION["email"] = $_POST["email"];
                    header("Location: ?command=wardrobe");
                }
                else {
                    $error_msg = "<div class='alert alert-danger' role='alert'> Error: This account exists! Please login! </div>";
                    // header("Location: ?command=login");
                }
            }
            else {
                $message = "<div class='alert alert-danger' role='alert'> Error: Invalid Input! Please enter the correct email format using an @. </div>";
            }
        }
       
        include('templates/sign-up.php');
    }

    public function login() {
        $message = "";
        $error_msg = "";
        if (isset($_POST["email"])) {
            $regex = "/^([a-zA-Z0-9\.]+@+[a-zA-Z]+(\.)+[a-zA-Z]{2,3})$/";
            if (!preg_match($regex, $_POST["email"])){
                $message = "<div class='alert alert-danger' role='alert'> Error: Invalid Input! Please enter the correct email format using an @. </div>";
            }
            $data = $this->db->query("select * from users where email = ?;", "s", $_POST["email"]);
            if (empty($data)) {
                $error_msg = "<div class='alert alert-danger' role='alert'> Error: Account may not exist! </div>";
            } else if (!empty($data)) {
                if (password_verify($_POST["password"], $data[0]["password"])) {
                    setcookie("logged_in", "true", time() + 3600);
                    $_SESSION['name'] = $data[0]["name"];
                    $_SESSION['email'] = $data[0]["email"];
                    header("Location: ?command=wardrobe");
                } else {
                    $error_msg = "<div class='alert alert-danger' role='alert'> Error: Invalid password entered! </div>";
                }
            }
        }
        include('templates/login.php');
    }

    public function view_all_clothes() { 
        include('templates/view-all-clothes.php');
    }


    public function create_new_outfit(){
        if(!empty($_POST)){
            $hatID ="";
            $topID = "";
            $bottomID = "";
            $shoesID = "";
            if(isset($_POST["hat"])){
                $hatID = $this -> db -> query("select clothing_id from clothing where picture=?;", "s", $_POST["hat"]);
                $hatID = $hatID[0]["clothing_id"];
            }
            if(isset($_POST["top"])){
                $topID = $this -> db -> query("select clothing_id from clothing where picture=?;", "s", $_POST["top"]);
                $topID = $topID[0]["clothing_id"];
            }
            if(isset($_POST["bottom"])){
                $bottomID = $this -> db -> query("select clothing_id from clothing where picture=?;", "s", $_POST["bottom"]);
                $bottomID = $bottomID[0]["clothing_id"];
            }
            if(isset($_POST["shoes"])){
                $shoesID = $this -> db -> query("select clothing_id from clothing where picture=?;", "s", $_POST["shoes"]);
                $shoesID = $shoesID[0]["clothing_id"];
            }
            $user_id = $this->db->query("select id from users where email = ?;", "s", $_SESSION["email"]);
            $user_id = $user_id[0]["id"];
            $this -> db -> query("insert into outfits (user_id, hat_id, top_id, bottom_id, shoes_id) values (?, ?, ?, ?, ?);", "iiiii", $user_id, $hatID, $topID, $bottomID, $shoesID);
            header("Location: ?command=wardrobe");
        }
        include('templates/createNewOutfit.php');
    }

    public function query_clothes($category) {
        $user = $this->db->query("select id from users where email = ?;", "s", $_SESSION["email"]);
        $array = $this->db->query("select * from clothing where (user_id = ?) and (category = ?);", "is", $user[0]["id"],
     strval($category));
        $rows = array();
        foreach ($array as $i) {
            $rows[] = $i;
        }
        header("Content-type: application/json");
        echo json_encode($rows, JSON_PRETTY_PRINT);
        //clothing_by_category("shirts");
        //header("Location: ?command=shirts");
        //clothing_by_category($category);
        //include('templates/view-all-' . strtolower($category) . '.php');
    }

    public function clothing_by_category($category) {
    //     $user = $this->db->query("select id from users where email = ?;", "s", $_SESSION["email"]);
    //     $array = $this->db->query("select * from clothing where (user_id = ?) and (category = ?);", "is", $user[0]["id"],
    //  strval($category));
    //     $rows = array();
    //     foreach ($array as $i) {
    //         $rows[] = $i;
    //     }
    //     echo json_encode($rows);
        //$template = 'templates/view-all-' + strtolower($category) + '.php'
        include('templates/view-all-' . strtolower($category) . '.php');
    }

    public function search_clothes() {
        echo isset($_POST['search']);
        $search_tag = $_POST['search'];
        echo $search_tag;
        $user_id = $this->db->query("select id from users where email = ?;", "s", $_SESSION["email"]);
        $user_id = $user_id[0]["id"];
        $array = $this->db->query("select * from clothing where (user_id = ?) and ((category like ?)
        or (brand like ?) or (color like ?) or (name like ?));",
        "issss", $user_id, $search_tag, $search_tag, $search_tag, $search_tag);
        //print_r($array);
        $rows = array();
        foreach ($array as $i) {
            $rows[] = $i;
        }
        print($rows);
        //print_r($rows);
        header("Content-type: application/json");
        echo json_encode($rows, JSON_PRETTY_PRINT);
        // if (isset($_POST["search"])) {
        //     $search_tag = $_POST["search"];
        //     $user_id = $this->db->query("select id from users where email = ?;", "s", $_SESSION["email"]);
        //     $user_id = $user_id[0]["id"];
        //     $applicable_clothes = $this->db->query("select * from clothing where (user_id = ?) and ((category like ?)
        //     or (brand like ?) or (color like ?) or (name like ?));",
        //     "issss", $user_id, $search_tag, $search_tag, $search_tag, $search_tag);
        //     $_SESSION["active-search"] = true;
        // }
        //include('templates/view-all-clothes.php');
    }

    public function delete_from_closet() {
        if (isset($_POST['delete_clothes'])) {
            $this->db->query("delete from clothing where clothing_id = ?", "i", $_POST['delete_clothes']);
            header("Location: ?command=view-all-clothes");
        }
        include('templates/view-all-clothes.php');
    }

    public function add_to_closet() {
        if (isset($_POST["name"])) {
            $user_id = $this->db->query("select id from users where email = ?;", "s", $_SESSION["email"]);
            $user_id = $user_id[0]["id"];
            $name = "_" . $user_id . "_" . $_FILES['file']['name'];
            $target_dir = "./images/users";
            $target_file = $target_dir . "_" . $user_id . "_" . basename($_FILES["file"]["name"]);
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
            $extensions_arr = array("jpg","jpeg","png","gif");
            // Check extension
            if( in_array($imageFileType,$extensions_arr) ){
              // Upload file
              if(move_uploaded_file($_FILES['file']['tmp_name'],$target_dir.$name)){
                 // Convert to base64 
                 $image_base64 = base64_encode(file_get_contents('./images/users/'.$name) );
                 $image = 'data:image/'.$imageFileType.';base64,'.$image_base64;
              }
            }
            if (isset($_POST["brand"])) {
                $this->db->query("insert into clothing (user_id, category, color, brand, name, picture) 
                values (?, ?, ?, ?, ?, ?);", "isssss", $user_id, $_POST["category"], $_POST["color"],
                $_POST["brand"], $_POST["name"], $name);
                header("Location: ?command=wardrobe");
            } else {
                $this->db->query("insert into clothing (user_id, category, color, name, picture) 
                values (?, ?, ?, ?, ?, ?);", "isssb", $user_id, $_POST["category"], $_POST["color"], 
                $_POST["name"], $name);
                header("Location: ?command=wardrobe");
            }
        }
        include('templates/add-to-closet.php');
    }

    public function wardrobe() {
        include('templates/wardrobe.php');
    }
           

    public function logout() {
        setcookie("logged_in", "", time() - 3600);
        session_destroy();
        header("Location: ?command=home");
    }
}
